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
    echo $lucky;
    if ($lucky == 1) {
        copy("output.json", "output2.json");
    } else {
        $new = task2_changer($a);
        $new = json_encode($new);
        file_put_contents("output2.json", $new);
    }
    
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