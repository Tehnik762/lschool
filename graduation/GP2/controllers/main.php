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
        $this->render("menu", $menu);
    }
    
}