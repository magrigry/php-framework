<?php

namespace Core\View;

use Core\App;

/**
 * Class Html
 * @package Core\View
 */
class Html
{

    private $_Html_template = ROOT . DS . 'view' . DS . "template.php";

    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function render($_Html_file, $vars = array(), $_Html_template = true)
    {


        foreach ($vars as $key => $var) {
            $$key = $var;
        }

        if($_Html_template == true){
            ob_start();
            require ROOT . DS . 'view' . DS . $_Html_file;
            ob_end_clean();

            ob_start();
            require $this->_Html_template;
            $_Html_fileContent = ob_get_clean();

            return $_Html_fileContent;
        }

        ob_start();
        require ROOT . DS . 'view' . DS . $_Html_file;
        ob_end_clean();

        return $_content_body;

    }

}