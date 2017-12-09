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

    public function render($param = array(), $path = 'index.html')
    {
        $template = $this->twig->load($path);
        echo $template->render($param);
    }

    public static function render404()
    {
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader, array());
        $template = $twig->load('index.html');
        $param['content']['Страница не найдена'] = ""
            . "<div>Очевидно вы ввели не существующий адрес. Попробуйте начать сначала!</div>";
        echo $template->render($param);
    }

    public function renderPart($param = array(), $path = 'index.html')
    {
        $template = $this->twig->load($path);
        return $template->render($param);
    }
}
