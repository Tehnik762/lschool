<?php


require_once 'class.php';

$car = new Car("manual", 159);
$speed = 5;
$dist = 1000; 
$car->move($speed, $dist, "forward");
