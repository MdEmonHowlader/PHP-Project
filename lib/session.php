<?php
class Session{
    public static  function init(){
        session_start();
    }
    public static function set($key, $value){
        $_SESSION[$key]=$value;
    }
}


?>