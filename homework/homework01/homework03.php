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
    echo "Константа существует"."<br/>";
}

echo THEANSWER."<br/>";

define('THEANSWER', 1);

