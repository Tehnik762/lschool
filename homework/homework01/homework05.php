<?php

// Task #5

$day = rand();

switch ($day) {
case 1:
case 2:
case 3:
case 4:
case 5:
	echo "Это рабочий день";
case 6:
case 7:
	echo "Это   выходной   день";
default:
	echo "Неизвестный   день";
}
	