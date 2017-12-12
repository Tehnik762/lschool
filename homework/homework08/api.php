<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class Good extends Illuminate\Database\Eloquent\Model
{
    
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'eight',
    'username' => 'eight',
    'password' => '123123',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

class API
{

    public function __construct()
    {
        $s = strtoupper($_SERVER['REQUEST_METHOD']);

        switch ($s) {
            case "GET":
                if (!empty($_GET['goods'])) {
                    echo $this->getGood($_GET['goods']);
                } else {
                    if (isset($_GET['goods'])) {
                        echo $this->getAll();
                    } else {
                        http_response_code(405);
                    }
                }

                break;
            case "POST":

                if (isset($_POST['name']) AND !empty($_POST['name'])) {
                    $info['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                    $info['description'] = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                    $info['cat_id'] = filter_var($_POST['cat_id'], FILTER_SANITIZE_STRING);
                    echo $this->createNew($info);
                } else {
                    http_response_code(405);
                }
                break;
            case "DELETE":

                break;
            case "PUT":
            case "PATCH":

                break;
        }
    }

    private function getAll()
    {
        $g = new Good();
        return $g->all()->toJson();
    }

    private function getGood($id)
    {
        
        if (is_int((int)$id)) {
            $g = Good::where('id', $id)->get();
            return $g->toJson();
            
            
        } else {
            http_response_code(405);
        }
    }
    
    private function createNew($info) {
        $g = new Good();
        $g->name = $info['name'];
        $g->description = $info['description'];
        $g->cat_id = $info['cat_id'];
        $g->save();
        return $g->id;
    }
}

$api = new API();
