<?php
namespace App;

class AppError{


    public function __construct($errorCode, $errorText = '')
    {

        switch ($errorCode){
            case '404':
                self::displayError($errorCode, $errorText);
                break;
            default:
                self::displayError($errorCode, $errorText);
        }

    }

    public static function displayError($error, $text = ''){

        echo $error.': ';
        echo empty($text) ? 'Unkown error' : $text;

    }

}