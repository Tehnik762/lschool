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
            // проверим доп параметры
            $p = count($_GET);
            if ($p > 1) {
                $params = $this->getGET($_GET);
            }

            $url = $_GET['url'];

            $url = rtrim($url, '/');
            $url = explode('/', $url);
            if (!empty($url[0])) {
                $c = $url[0];
            } else {
                $c = 'Main';
            }
            $method = $url[1];
            if (!empty($method)) {
                $m = $method;
            } else {
                $m = 'index';
            }

            if (is_file('controllers/' . strtolower($c) . '.php')) {
                require_once 'controllers/' . strtolower($c) . '.php';

                $c = "\\MVC\\" . $c;
                $controller = new $c();

                if (method_exists($controller, $m)) {
                    if (isset($params)) {
                        $controller->$m($params);
                    } else {
                        $controller->$m();
                    }
                } else {
                    View::render404();
                }
            } else {
                View::render404();
            }
        } else {
            $v = new View();
            $token = time() . rand(0, 100);
            $_SESSION['token'] = $token;
            $data['hash'] = password_hash($token, PASSWORD_DEFAULT);
            if ($_SESSION['errors']) {
                $data['error'] = $_SESSION['errors'];
                unset($_SESSION['errors']);
            }
            $v->render($data, 'login.html');
        }
    }

    private function getGET(array $data)
    {
        foreach ($data as $key => $value) {
            if ($key != "url") {
                $res[$key] = $value;
            }
        }

        return $res;
    }

    private function checkAuth()
    {
        if (isset($_SESSION['auth']) AND ! empty($_SESSION['auth'])) {
            return TRUE;
        } else {
            if (isset($_POST['token'])) {
                if (password_verify($_SESSION['token'], $_POST['token'])) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        }
    }
}
