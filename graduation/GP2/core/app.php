<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;
require_once 'config.php';
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/View.php';

class MVC
{

    public function __construct()
    {   
        if ($this->checkAuth()) {
        $url = $_GET['url'];
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        if (!empty($url[0])) {
            $c = $url[0];
        } else {
            $c = 'Main';
        }
        $method = $this->getGET($url[1]);
        if (!empty($method[0])) {
            $m = $method[0];
        } else {
            $m = 'index';
        }

        if (is_file('controllers/' . strtolower($c) . '.php')) {
            require_once 'controllers/' . strtolower($c) . '.php';
            
            $c = "\\MVC\\".$c;
            $controller = new $c();
            
            if (method_exists($controller, $m)) {
                if (!empty($method[1])) {
                $controller->$m($method[1]);}
                else {
                $controller->$m();                    
                }
            } else {
                View::render404();
                jbdump($url);
            }
        } else {
            View::render404();
            jbdump($url);
        }
        }
        else {
            $v = new View();
            $v->render(array(), 'login.html');
        }
    }

    private function getGET($data) {
        $data = explode("?", $data);
        $res[] = $data[0];
        $params = explode("&", $data[1]);
        foreach ($params as $p) {
            $pre = explode("=", $p);
            $attr[$pre[0]]=$pre[1];
            
        }
        $res[] = $attr;
        return $res;
    }
    
    private function checkAuth() 
    {
        if (isset($_SESSION['auth']) AND !empty($_SESSION['auth'])) {
            return TRUE;
        } else {
            
            return FALSE;
        }
    }
    
    
        }
