<?php
namespace App;

class Response{

    private static $status = 'HTTP/1.0 200 OK';
    private static $content;
    private static $priority = 100;

    public static function set($content, $priority, $status = 'HTTP/1.0 200 OK'){
        if(self::$priority > $priority){
            self::$content = $content;
            self::$status = $status;
        }
    }

    public static function send(){
        header(self::$status);
        echo self::$content;
    }

}