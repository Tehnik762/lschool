<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;

require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/View.php';

class MVC
{

    public function __construct()
    {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        if (!empty($url[0])) {
            $c = $url[0];
        } else {
            $c = 'Main';
        }
        if (!empty($url[1])) {
            $m = $url[1];
        } else {
            $m = 'index';
        }

        if (is_file('controllers/' . strtolower($c) . '.php')) {
            require_once 'controllers/' . strtolower($c) . '.php';
            
            $c = "\\MVC\\".$c;
            $controller = new $c();
            
            if (method_exists($controller, $m)) {
                $controller->$m();
            } else {
                View::render404();
                jbdump($url);
            }
        } else {
            View::render404();
            jbdump($url);
        }
    }
}
