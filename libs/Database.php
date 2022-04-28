<?php

class Database
{
    public $get_error = false;
    public $query = '';
    public $table = '';
    public $type = '';
    private $without_quote = ['NULL','TIMESTAMP'];
    function __construct($connection)
    {
        $db = config('database');
        $this->connection = $connection;
        $this->type = $db['driver'];
    }

    function get_pk()
    {
        $query   = "SHOW KEYS FROM $this->table WHERE Key_name = 'PRIMARY'";
        $pk      = $this->connection->query($query);
        if($this->type == 'PDO')
            $pk      = $pk->fetchObject();
        else
            $pk      = $pk->fetch_object();
        return $pk->Column_name;
    }

    function insert($table, $val)
    {
        $this->table = $table;
        $this->query = "INSERT INTO $table";
        $fields = implode(',',array_keys($val));
        $values = "'".implode("','",array_values($val))."'";
        $this->query .= "($fields)VALUES($values)";
        return $this->exec('insert');
    }

    function update($table, $val, $clause)
    {
        $this->table = $table;
        $values = $this->build_values($val);
        $string = $this->build_clause($clause);
        $this->query = "UPDATE $table SET $values WHERE $string AND last_insert_id(".$this->get_pk().")";
        return $this->exec('update');
    }

    function updateall($table, $val)
    {
        $this->table = $table;
        $values = $this->build_values($val);
        $this->query = "UPDATE $table SET $values";
        return $this->exec('updateall');
    }

    function all($table, $clause = [], $order = [], $limit = 0)
    {
        $this->table = $table;
        $conn = $this->connection;
        $this->query = "SELECT * FROM $table";
        $string = $this->build_clause($clause);
        $string_order = $this->build_order($order);
        if($string)
            $this->query .= ' WHERE '.$string;
        
        if($string_order)
            $this->query .= ' ORDER BY '.$string_order;

        if($limit)
            $this->query .= ' LIMIT '.$limit;
        return $this->exec('all');
    }

    function single($table, $clause = [], $order = [])
    {
        $this->table = $table;
        $conn = $this->connection;
        $this->query = "SELECT * FROM $table";
        $string = $this->build_clause($clause);
        $string_order = $this->build_order($order);
        if($string)
            $this->query .= ' WHERE '.$string;
        
        if($string_order)
            $this->query .= ' ORDER BY '.$string_order;
        return $this->exec('single');
    }

    function delete($table, $clause = [])
    {
        $this->table = $table;
        $conn = $this->connection;
        $this->query = "DELETE FROM $table";
        if(count($clause) > 0)
        {
            $string = http_build_query($clause, '', ' AND ');
            $this->query .= ' WHERE '.$string;
        }
        return $this->exec();
    }

    function exists($table, $clause = [], $order = [])
    {
        $this->table = $table;
        $conn = $this->connection;
        $this->query = "SELECT * FROM $table";
        $string = $this->build_clause($clause);
        $string_order = $this->build_order($order);
        if($string)
            $this->query .= ' WHERE '.$string;
        
        if($string_order)
            $this->query .= ' ORDER BY '.$string_order;
        return $this->exec('exists');
    }

    function truncate($table)
    {
        $this->table = $table;
        $conn = $this->connection;
        $this->query = "TRUNCATE TABLE $table";

        return $this->exec();
    }

    function exec($type = false)
    {
        if($this->type == 'PDO')
        {
            if(in_array($type,['insert','update']))
            {
                $query_result = $this->connection->exec($this->query);
                // $last_id = $this->connection->insert_id;
                $last_id = $this->connection->lastInsertId();
                $pk = $this->get_pk();
                return $this->single($this->table,[$pk=>$last_id]);
            }
            else
            {
                $query_result = $this->connection->query($this->query);
                if($type == 'all')
                    return $query_result->fetchAll(PDO::FETCH_OBJ);
                if($type == 'single')
                    return $query_result->fetchObject();
                if($type == 'exists')
                    return count($query_result->fetchAll(PDO::FETCH_OBJ));
            }
        }
        else
        {
            if($type == 'multi_query')
                return $this->connection->multi_query($this->query);
            else
                $query_result = $this->connection->query($this->query);
            if($query_result)
            {
                if($type == 'all')
                    return json_decode(json_encode($query_result->fetch_all(MYSQLI_ASSOC)));
                if($type == 'single')
                    return $query_result->fetch_object();
                if($type == 'exists')
                    return $query_result->num_rows;
                if(in_array($type,['insert','update']))
                {
                    $last_id = $this->connection->insert_id;
                    $pk = $this->get_pk();
                    return $this->single($this->table,[$pk=>$last_id]);
                }
            }
            else
            {
                // echo $this->query;
                // echo "<br>";
                if($this->get_error) return $this->connection->error;
                print_r($this->connection->error);
                die();
            }

            return $query_result;
        }
    }

    function build_clause($clause)
    {
        $count_clause = count($clause);
        $string = "";
        if($count_clause > 0)
        {
            foreach($clause as $key => $value)
            {
                $operator = "=";
                $val = $value;
                if(is_array($value))
                {
                    $operator = $value[0];
                    $val = $value[1];
                }
                if(!in_array(strtoupper($operator),['NOT IN','IN']))
                    $val = $this->connection->real_escape_string($val);
                if(in_array($val,$this->without_quote) || in_array(strtoupper($operator),['NOT IN','IN']))
                $string .= "$key $operator $val";
                else
                $string .= "$key $operator '$val'";
                $last_iteration = !(--$count_clause);
                if(!$last_iteration)
                    $string .= ' AND ';
            }
        }

        return $string;
    }

    function build_values($values)
    {
        $count_values = count($values);
        $string = "";
        if($count_values > 0)
        {
            foreach($values as $key => $value)
            {
                $value = $this->connection->real_escape_string($value);
                if(in_array($value,$this->without_quote))
                $string .= "$key=$value";
                else
                $string .= "$key='$value'";
                $last_iteration = !(--$count_values);
                if(!$last_iteration)
                    $string .= ', ';
            }
        }

        return $string;
    }

    function build_order($order)
    {
        $count_order = count($order);
        $string = "";
        if($count_order > 0)
        {
            foreach($order as $key => $value)
            {
                $value = $this->connection->real_escape_string($value);
                $string .= "$key $value";
                $last_iteration = !(--$count_order);
                if(!$last_iteration)
                    $string .= ', ';
            }
        }

        return $string;
    }
}
