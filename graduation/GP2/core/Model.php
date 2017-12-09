<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
namespace MVC;

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => $db,
    'username' => $user,
    'password' => $password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

class Model extends \Illuminate\Database\Eloquent\Model
{

    public static function Menu()
    {
        $menu = [
            "Список пользователей" => ROOT . "users/all",
            "Новый пользователь" => ROOT . "users/newuser",
            "Все файлы" => ROOT . "files/all",
            "Добавить файл" => ROOT . "files/upload"
        ];
        return $menu;
    }
}
