<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.09.2018
 * Time: 12:54
 */

include("../../connect.php");

$id = $mysqli->real_escape_string($_POST['id']);
$showing = $mysqli->real_escape_string($_POST['checked']);

if($showing != 1) {
    $showing = 0;
}

if($mysqli->query("UPDATE rent_reviews SET showing = '".$showing."' WHERE id = '".$id."'")) {
    if($showing == 1) {
        echo "on";
    } else {
        echo "off";
    }
} else {
    echo "failed";
}