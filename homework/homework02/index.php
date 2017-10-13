<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */
require_once 'functions.php';
// Task 02-01

echo "Задание №1" . PHP_EOL;

$example = ["asd", "qwe", "qaz"];

task1($example);

$x = task1($example, TRUE);

echo $x . PHP_EOL;

// Task 02-02
echo "Задание №2" . PHP_EOL;
$arr = [30, 20, 10];

echo task2($arr, "+") . PHP_EOL;
echo task2($arr, "-") . PHP_EOL;
echo task2($arr, "*") . PHP_EOL;
echo task2($arr, "/") . PHP_EOL;
echo task2($arr, "111") . PHP_EOL;

// Task 02-03
echo "Задание №3" . PHP_EOL;
echo task3("+", 30, 25, 22, 14, 22, 9) . PHP_EOL;
echo task3("-", 300, 25, 22, 14, 22, 9) . PHP_EOL;
echo task3("*", 3, 2, 2, 4, 5, 4) . PHP_EOL;
echo task3("/", 10, 2, 1, 2) . PHP_EOL;

// Task 02-04
echo "Задание №4" . PHP_EOL;

echo task4(5, 15);
echo task4(5.5, 15);
