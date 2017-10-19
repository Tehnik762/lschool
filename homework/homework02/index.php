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

echo "Задание №1" . "<br/>";

$example = ["asd", "qwe", "qaz"];

task1($example);

$x = task1($example, TRUE);

echo $x . "<br/>";

// Task 02-02
echo "Задание №2" . "<br/>";
$arr = [30, 20, 10];
$arr2 = [30, 0, 10];
$arr3 = [30, "asd", 10];



echo task2($arr, "+") . "<br/>";
echo task2($arr, "-") . "<br/>";
echo task2($arr, "*") . "<br/>";
echo task2($arr, "/") . "<br/>";
echo task2($arr, "111") . "<br/>";
echo task2($arr2, "/") . "<br/>";
echo task2($arr3, "+") . "<br/>";
echo task2("20 20 20", "+") . "<br/>";



// Task 02-03
echo "Задание №3" . "<br/>";
echo task3("+", 30, 25, 22, 14, 22, 9) . "<br/>";
echo task3("-", 300, 25, 22, 14, 22, 9) . "<br/>";
echo task3("*", 3, 2, 2, 4, 5, 4) . "<br/>";
echo task3("/", 10, 2, 1, 2) . "<br/>";

// Task 02-04
echo "Задание №4" . "<br/>";

echo task4(5, 15);
echo task4(5.5, 15);


// Task 02-05
echo "Задание №5" . "<br/>";

$x = task5("Улыбок тебе дед Макар");
echo checkTask5($x) . "<br/>";
$x = task5("Я не стар брат Сеня");
echo checkTask5($x);


// Task 02-06
echo "Задание №6" . "<br/>";
task6();


// Task 02-07

echo "Задание №7" . "<br/>";
task7();


// Task 02-08
echo "Задание №8" . "<br/>";
echo task8("RX packets:950381 errors:0 dropped:0 overruns:0 frame:0. ");
echo "<br/>";
echo task8("RX packets:950381 errors:0 :) dropped:0 overruns:0 frame:0. ");

// Task 02-09
echo "Задание №9" . "<br/>";
echo task9("test.txt") . "<br/>";


// Task 02-10
echo "Задание №10" . "<br/>";
task10();
