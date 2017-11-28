<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

// Описание категорий и товаров

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'seven',
    'username'  => 'seven',
    'password'  => '123123',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Creating

Capsule::schema()->create('cats', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->text('description');
    $table->timestamps();
});

Capsule::schema()->create('goods', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->text('description');
    $table->integer('cat_id');
    $table->timestamps();
});
