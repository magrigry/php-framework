<?php

namespace Core\View;

/**
 * Class Html
 * @package Core\View
 */
class Html
{

    /**
     * @var
     */
    private $title;

    /**
     * @var array
     */
    public $data = array();

    /**
     * @var array
     */
    private $errors = array();

    /**
     * @var
     */
    private $pageName;

    /**
     * @var
     */
    private static $_instance;

    /**
     * @return Html
     */
    public static function getInstance(): Html
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Html();
        }
        return self::$_instance;
    }

    /**
     * @param $str
     */
    public function setTitle($str)
    {
        $this->title = $str;
    }

    /**
     * @param $str
     */
    public function addError($str)
    {
        $this->errors[] = $str;
    }

    /**
     * @param $pageName
     */
    public function setPageName($pageName)
    {
        $this->pageName = $pageName;
    }

    /**
     * @param $var
     * @param $default
     * @return mixed
     */
    public function getAttr($var, $default)
    {
        return (isset($this->$var)) && ($this->$var != null) ? $this->$var : $default;
    }

    /**
     * @param $pageToTest
     * @param $str
     */
    public function ifCurrentPage($pageToTest, $str)
    {
        if ($pageToTest === $this->pageName) {
            echo $str;
        }
    }

    /**
     * @param $file
     * @param array $vars
     * @param bool $template
     * @return false|string
     */
    public function render($file, $vars = array(), $template = true)
    {

        foreach ($vars as $key => $var) {
            $$key = $var;
        }

        $this->data = (isset($var) && is_array($var)) ? $var : array();

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