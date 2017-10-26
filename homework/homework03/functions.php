<?php
/*
 *  
 *     Homework PHP LoftSchool
 *     Student: Braslavskii Anton
 *     Email: yastroitel@gmail.com
 *  
 */

function task1($file)
{
    $x = simplexml_load_file($file);

    $res = "Order #" . $x['PurchaseOrderNumber'] . " Date - " . $x['OrderDate'] . "<br/><hr/>";
    $res .= "<h2>Address</h2><hr/><table border=1>"
        . "<tr><td>Type</td>"
        . "<td>Name</td><td>Street</td><td>City</td><td>State</td>"
        . "<td>Zip</td><td>Country</td>"
        . "</tr>";

    foreach ($x->Address as $value) {
        $res .= "<tr>";
        $res .= "<td>" . $value['Type'] . "</td>";
        foreach ($value as $info) {
            $res .= "<td>" . $info . "</td>";
        }

        $res .= "</tr>";
    }
    $res .= "</table>";
    $res .= "<div><h3>Delivery notes:</h3><hr/>" . $x->DeliveryNotes . "</div>";
    $res .= "<h2>Items</h2><hr/>";

    foreach ($x->Items->Item as $value) {

        $res .= "Item Part Number - " . $value['PartNumber'] . "<br/>";
        foreach ($value as $key => $info) {
            $res .= "<div><b>" . $key . "</b> - " . $info . "</div>";
        }
        $res .= "<hr/>";
    }

//echo "<pre>";
//print_r($x);
    return $res;
}

function task2($a)
{
    $res = json_encode($a);
    file_put_contents("output.json", $res);
    $lucky = rand(1, 2);
//    echo $lucky;
    if ($lucky == 1) {
        copy("output.json", "output2.json");
    } else {
        $new = task2_changer($a);
        $new = json_encode($new);
        file_put_contents("output2.json", $new);
    }
    $f1 = file_get_contents("output.json");
    $f2 = file_get_contents("output2.json");

    if ($f1 == $f2) {
        return "<br/>Файлы идентичны<br/>";
    } else {
        $f1 = json_decode($f1, TRUE);
        $f2 = json_decode($f2, TRUE);
        return "Файлы не идентичны!!!<br/>" . task2_compare($f1, $f2);
    }
}

function task2_compare($a1, $a2)
{
    $res .= "<br/><ul>";
    foreach ($a1 as $key => $value) {
        if (is_array($value)) {
            if ($a1[$key] != $a2[$key]) {
                $res .= "<ul> Массив в элементе " . $key;
                $res .= task2_compare($a1[$key], $a2[$key]);
                $res .= "</ul>";
            }
        } else {
            if ($a1[$key] != $a2[$key]) {
                $res .= "<li>Элемент " . $key . " отличается - "
                    . "1 вариант: <b>" . $a1[$key] . "</b> --- "
                    . "2 вариант: <b>" . $a2[$key] . "</b></li>";
            }
        }
    }
    $res .= "</ul>";

    return $res;
}

function task2_changer($arr)
{
    foreach ($arr as $key => $value) {
        if (is_array($value)) {
            $res[$key] = task2_changer($value);
        } else {
            $lucky = rand(1, 2);
            if ($lucky == 1) {
                $res[$key] = $value;
            } else {
                $res[$key] = rand(0, 42000);
            }
        }
    }
    return $res;
}

function task3()
{
    $f = fopen("file.csv", "w");

    for ($i = 0; $i < 50; $i++) {
        $mass = rand(1, 100) . "\r\n";
        fwrite($f, $mass);
    }

    fclose($f);

    $table = file("file.csv");
    $sum = 0;
    foreach ($table as $key => $value) {
        if ($value % 2 == 0) {
            $sum += $value;
        }
    }
    return $sum;
}

function task4($url)
{
    //init
    $ch = curl_init($url);
    //opt
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    ////exec
    $res = curl_exec($ch);
    //close
    curl_close($ch);

    $res = json_decode($res, TRUE);
    $key = key($res['query']['pages']);

    $result['page_id'] = $key;
    $result['title'] = $res['query']['pages'][$key]['title'];
    return $result;
}
