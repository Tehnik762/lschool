<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'ham',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);


$capsule->setAsGlobal();

$capsule->bootEloquent();


class User extends Illuminate\Database\Eloquent\Model {
    public $timestamps = false;
       
    public function orders()
    {
        return $this->hasMany('Order');
    }
}

class Order extends Illuminate\Database\Eloquent\Model {
        public $timestamps = false;
        
            public function user()
    {
        return $this->belongsTo('User');
    }
        
        
        
}

$user = Order::where('user_id', 5)
    ->count();


jbdump($GLOBALS);
