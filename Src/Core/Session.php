<?php
namespace Core;
class Session
{
    public static function start()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }
    public static function hasError($key)
    {
        return isset($_SESSION['errors']) && isset($_SESSION['errors'][$key]);
    }

    public static function get($key)
    {
        return self::has($key) ? $_SESSION[$key] : null;
    }
    public static function  flash($key)
    {
        $value = self::get($key);
        self::remove($key);
        return $value;
    }

    public static function remove($key)
    {
        if (self::has($key))
            unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        $_SESSION = [];
        session_destroy();
    }

    public static function regenerate()
    {
        session_regenerate_id(true);
    }
    public static function error($key)
    {
        if (self::hasError($key)) {
            $error = self::get('errors')[$key][0];
            unset($_SESSION['errors'][$key]);
            $error_massage = "<h6 class=\"text-danger\">" . $error . "</h6>";
            return $error_massage;
        }else{
            return null;
        }
    }
}
