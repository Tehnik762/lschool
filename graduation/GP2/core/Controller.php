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
        
    }
}