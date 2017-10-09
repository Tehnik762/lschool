<?php

//	Task #6

$bmv = [
	"model" => "X5",
	"speed" => 120,
	"doors" => 5,
	"year" => "2015"
];

$toyota = [
	"model" => "Auris",
	"speed" => 130,
	"doors" => 3,
	"year" => "2011"
];

$opel = [
	"model" => "Vectra",
	"speed" => 98,
	"doors" => 5,
	"year" => "1996"
];

$cars = [$bmv, $toyota, $opel];

foreach ($cars as $name=>$car) {
	echo "Car ".$name.PHP_EOL;
	foreach ($car as $params) {
	echo $params." ";
	}
	echo PHP_EOL;
}