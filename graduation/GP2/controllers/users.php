<?php

/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

namespace MVC;

class Users extends Controller {

    public function all() {

        require_once 'models/user.php';
        $users = new User();
    }

}
