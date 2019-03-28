<?php
namespace App\View;

class Html{

    public function Respond($file, $template = true){

        $file = str_replace('/', DS, $file);
        $file = str_replace('\\', DS, $file);

        ob_start();

        require_once(ROOT.DS.'view'.DS.$file.'.php');

        $content = ob_get_contents();
        
        if($template == true){
            ob_start();
            require_once(ROOT.DS.'view/template.php');
            $content = ob_get_contents();
            ob_end_clean();
            return (string) $content;
        }
        else{
            return $content;
        }

    }

}