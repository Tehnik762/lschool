<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

// Task #3

define('THEANSWER', 42);

if (defined('THEANSWER')) {
    echo "Константа существует".PHP_EOL;
}

echo THEANSWER.PHP_EOL;

define('THEANSWER', 1);

