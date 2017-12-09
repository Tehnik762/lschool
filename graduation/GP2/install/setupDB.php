<?php
/*
 *  
 *     Graduation Project PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *     
 *      Blueprint to create Database for Project
 *  
*/
require_once '../vendor/autoload.php';
require_once '../config.php';

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

// Cleaning
Capsule::schema()->dropAllTables();

// Creating

Capsule::schema()->create('users', function ($table) {
    $table->increments('id');
    $table->string('name')->unique();
    $table->string('password');
    $table->integer('birth');
    $table->string('image');
    $table->text('description');
    $table->timestamps();
});

Capsule::schema()->create('files', function ($table) {
    $table->increments('id');
    $table->string('path')->unique();
    $table->integer('user_id');
    $table->timestamps();
});





class User extends \Illuminate\Database\Eloquent\Model {
    protected $fillable = ['name', 'password', 'birth', 'image', 'description'];
}

$m = new User();
$m->name = 'Thom';
$m->password = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq'; //rasmuslerdorf
$m->birth = '-38966400';
$m->image = 'images/tom.jpg';
$m->description = 'Томас Эдвард Йорк (англ. Thomas Edward Yorke, род. '
    . '7 октября 1968, Англия) — британский рок-музыкант, вокалист и гитарист группы '
    . 'Radiohead. Известен благодаря своему характерному голосу, вибрато и частому применению '
    . 'фальцета. В группе он играет на гитаре и клавишных, также владеет ударными инструментами '
    . 'и бас-гитарой (как это было при записи альбомов «Kid A» и «Amnesiac»).';
$m->save();

class File extends \Illuminate\Database\Eloquent\Model {
    protected $fillable = ['path', 'user_id'];
}

$f = new File();
$f->path = "uploads/1512860343387.jpg";
$f->user_id = "1";
$f->save();

$f = new File();
$f->path = "uploads/1512860386459.jpg";
$f->user_id = "1";
$f->save();




echo "Вы успешно обновили структуру таблиц в БД";