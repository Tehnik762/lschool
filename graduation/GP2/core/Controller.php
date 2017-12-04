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
    public function render($name, $param) {
        require 'views/'.$name.'.php';
    }
}