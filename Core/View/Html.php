<?php

namespace Core\View;

class Html
{

    public $title;

    public $data = array();

    public $errors = array();

    private $pageName;

    public function __construct($pageName)
    {
        $this->pageName = $pageName;
    }

    public function getAttr($var, $default)
    {
        return (isset($this->$var)) && ($this->$var != null) ? $this->$var : $default;
    }

    public function ifCurrentPage($pageToTest, $str){
        if($pageToTest === $this->pageName){
            echo $str;
        }
    }

    public function send($file, $var, $template = true)
    {


        $this->data = (is_array($var)) ? $var : array();



        $file = str_replace('/', DS, $file);
        $file = str_replace('\\', DS, $file);

        ob_start();

        require_once(ROOT . DS . 'view' . DS . $file);

        $content = ob_get_contents();

        ob_end_clean();

        if ($template == true) {
            ob_start();
            require_once(ROOT . DS . 'view/template.php');
            $content = ob_get_contents();
            ob_end_clean();
            return (string)$content;
        } else {
            return $content;
        }

    }

}