<?php

class Validation
{

    static function run(array $validate, $data)
    {
        foreach($validate as $key => $rules)
        {
            foreach($rules as $rule)
            {
                $v = self::validate($rule, $key, $data);
                if(isset($v['status']) && $v['status'] == false)
                {
                    redirectBack(['error' => $v['message'],'old' => $data]);
                    return;
                }
            }
        }
    }

    private static function validate($rule, $key, $data)
    {
        if(!isset($data[$key]))
        {
            return ['status' => false, 'message' => __($key) . ' doesn\'t exists'];
        }
        
        if($rule == 'required')
        {
            if(!isset($data[$key]) || empty($data[$key]))
            {
                return ['status' => false, 'message' => __($key) . ' field is required'];
            }
        }

        if($rule == 'number')
        {
            if(!is_numeric($data[$key]))
            {
                return ['status' => false, 'message' => __($key) . ' field must be a number'];
            }
        }

        if($rule == 'array')
        {
            if(!is_array($data[$key]))
            {
                return ['status' => false, 'message' => __($key) . ' field must be an array'];
            }
        }

        if(startWith($rule, 'in'))
        {
            $in = explode(':', $rule);
            $options = $in[1];
            $options = explode(",", $options);

            if(!in_array($data[$key]))
            {
                return ['status' => false, 'message' => __($key) . ' field must be in '. $in[1]];
            }
        }

        if(startWith($rule, 'min'))
        {
            $min = explode(':', $rule);
            $min = $min[1];

            if(strlen($data[$key]) < $min)
            {
                return ['status' => false, 'message' => __($key) . ' field minimum length is '. $min];
            }
        }

        if(startWith($rule, 'max'))
        {
            $max = explode(':', $rule);
            $max = $max[1];

            if(strlen($data[$key]) > $max)
            {
                return ['status' => false, 'message' => __($key) . ' field maximum length is '. $max];
            }
        }

        if(startWith($rule, 'exists'))
        {
            $exists = explode(':', $rule);
            $clause = $exists[1];
            $clause = explode(',',$clause);
            $tablename = $clause[0];

            unset($clause[0]); // remove item at index 0
            $clause = array_values($clause); // 'reindex' array

            $_clause = [];
            foreach($clause as $k => $c)
            {
                $n = $k+1;
                if($n%2==0) continue;
                $_clause[$c] = $clause[$n];
            }

            $conn = conn();
            $db   = new Database($conn);

            $data = $db->exists($tablename,$_clause);
            
            if(!$data || empty($data))
            {
                return ['status' => false, 'message' => __($key) . ' field doesn\'t valid'];
            }
        }

        return;
    }

}