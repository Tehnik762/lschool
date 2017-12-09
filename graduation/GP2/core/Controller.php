<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/
namespace MVC;

class Controller {
    public $view, $data, $mainuser;
    public function __construct()
    {
        $this->view = new View();
        if (isset($_SESSION['name'])) {
            $this->data['name'] = $_SESSION['name'];
}
        $menu = Model::Menu();
        $this->data['menu']= $menu;
        $this->data['root'] = ROOT;
        if (isset($_SESSION['errors'])) {
            $this->data['error'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
            }
    }
}