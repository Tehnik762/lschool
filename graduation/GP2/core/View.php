<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;

class View
{

    public $loader, $twig;

    public function __construct()
    {
        $this->loader = new \Twig_Loader_Filesystem('templates');
        $this->twig = new \Twig_Environment($this->loader, array(
            //'cache' => 'templates_c'
        ));
    }

    public function render($param=array(), $path = 'index.html')
    {
        $template = $this->twig->load($path);
        echo $template->render($param);
    }

    public static function render404($data = NULL)
    {
        echo "404";
    }
}
