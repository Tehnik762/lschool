<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

require_once 'class.php';
renderString("<h3>Машина № 1</h3> 159 лс");
$car = new Car("Manual", 159);
$speed = 115;
$dist = 1000;
$car->move($speed, $dist, "forward");

renderString("<hr/><h3>Машина № 2</h3> 115 лс");
$speed = 5;
$dist = 10;
$car2 = new Car("Auto", "115");
$car2->move($speed, $dist, "back");

renderString("<hr/><h3>Машина № 3</h3> 30 лс");
$car3 = new Car("Manual", 30);
$speed = 5;
$dist = 100;
$car3->move($speed, $dist, "forward");

renderString("<hr/><h3>Машина № 4</h3> 30 лс");
$car4 = new Car("Manual", 30);
$speed = 500;
$dist = 100;
$car4->move($speed, $dist, "forward");
