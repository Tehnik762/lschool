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

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'eight',
    'username'  => 'eight',
    'password'  => '123123',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// Cleaning
Capsule::schema()->dropAllTables();


Capsule::schema()->create('goods', function ($table) {
    $table->increments('id');
    $table->string('name');
    $table->text('description')->nullable();
    $table->integer('cat_id');
    $table->timestamps();
});

class Good extends Illuminate\Database\Eloquent\Model {
    
}

$faker = Faker\Factory::create('ru_RU'); 


for ($i=1; $i<100; $i++) {
    $g = new Good();
    $g->name = $faker->unique()->word;
    $g->description = $faker->unique()->paragraph;
    $g->cat_id = 1;
    $g->save();    
}