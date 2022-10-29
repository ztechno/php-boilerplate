<?php

class Session
{
    static function get($key = false)
    {
        if($key)
        {
            if(isset($_SESSION[$key]))
                return $_SESSION[$key];
            return;
        }
        $data = $_SESSION;
        if(isset($data['user_id']))
        {
            $conn = conn();
            $db   = new Database($conn);
            $data['user'] = $db->single('users',[
                'id' => $data['user_id']
            ]);
        }
        return (new ArrayHelper($data))->toObject();
    }

    static function set($params)
    {
        if(!is_array($params)) return false;
        foreach($params as $key => $value)
        {
            $_SESSION[$key] = $value;
        }
    }

    static function clear($key)
    {
        unset($_SESSION[$key]);
    }

    static function destroy()
    {
        session_destroy();
    }

    static function set_flash($key, $value)
    {
        $_SESSION['flash'][$key] = $value;
    }

    static function get_flash($key = false)
    {
        if($key)
        {
            if(isset($_SESSION['flash'][$key]))
            {
                $flash = $_SESSION['flash'][$key];
                unset($_SESSION['flash'][$key]);
                return $flash;
            }

            return false;
        }

        return (new ArrayHelper($_SESSION['flash']))->toObject();
    }
}