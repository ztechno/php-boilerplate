<?php

class Validation
{

    static function run(array $validate, $data, $return = "redirect")
    {
        foreach($validate as $key => $rules)
        {
            foreach($rules as $rule)
            {
                $v = self::validate($rule, $key, $data);
                if(isset($v['status']) && $v['status'] == false)
                {
                    if($return == 'redirect')
                    {
                        redirectBack(['error' => $v['message'],'old' => $data]);
                        return;
                    }

                    if($return == 'json')
                    {
                        http_response_code(400);
                        echo json_encode(['success' => false, 'message' => $v['message']]);
                        die();
                    }
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
            if((!isset($data[$key]) || empty($data[$key])) || (isset($_FILES[$key]) && empty($_FILES[$key]['name'])))
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

        if(startWith($rule, 'unique'))
        {
            // unique:tblname,except_key,except_value
            $exists = explode(':', $rule);
            $clause = $exists[1]; // dbname
            $clause = explode(',',$clause);
            $tablename = $clause[0];

            $_clause = [$key => $data[$key]];
            if(isset($clause[1]))
            {
                unset($clause[0]); // remove item at index 0
                $clause = array_values($clause); // 'reindex' array
    
                foreach($clause as $k => $c)
                {
                    $n = $k+1;
                    if($n%2==0) continue;
                    $_clause[$c] = ['<>',$clause[$n]];
                }
            }

            $conn = conn();
            $db   = new Database($conn);

            $data = $db->exists($tablename,$_clause);
            
            if($data || !empty($data))
            {
                return ['status' => false, 'message' => __($key) . ' field is already exists'];
            }
        }

        if($rule == 'file')
        {
            if(!isset($_FILES[$key]))
            {
                return ['status' => false, 'message' => __($key) . ' field must be a file'];
            }
        }

        if(startWith($rule, 'mime'))
        {
            $_rule = explode(':', $rule);
            $all_mimes = $_rule[1]; // dbname
            $mimes = explode(',',$all_mimes);
            $ext  = pathinfo($data[$key]['name'], PATHINFO_EXTENSION);
            if(!in_array($ext,$mimes))
            {
                return ['status' => false, 'message' => __($key) . ' field extension must be '.$all_mimes];
            }
        }

        return;
    }

}
