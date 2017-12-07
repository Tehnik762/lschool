<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/
namespace MVC;

class Main extends Controller{
    
    public function index() {
        $menu = Model::Menu();
        $this->data =[ 'menu' => $menu ,
            'title' => 'MVC Start Page'];
        $this->view->render($this->data);
    }
    
}