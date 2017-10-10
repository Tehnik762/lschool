<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
*/

// Task #7

echo "<table>";

for ($i = 1; $i < 11; $i++) {
    echo "<tr>";
    for ($j = 1; $j < 11; $j++) {
        echo "<td>";
        echo $i." х ".$j." = ";
        $r = $i*$j;
        if ($i%2 == 0 & $j%2 == 0) {
            echo "(".$r.")";
        } else {
            echo "[".$r."]";
        }
        
        echo "</td>";
    }
    echo "</tr>";
}



echo "</table>";

