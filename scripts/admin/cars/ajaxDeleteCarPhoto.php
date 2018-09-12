<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 12.09.2018
 * Time: 15:41
 */

include("../../connect.php");

$photoID = $mysqli->real_escape_string($_POST['photoID']);
$carID = $mysqli->real_escape_string($_POST['carID']);

$photoCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_cars_photos WHERE id = '".$photoID."' AND car_id = '".$carID."'");
$photoCheck = $photoCheckResult->fetch_array(MYSQLI_NUM);

if($photoCheck[0] > 0) {
    $photoResult = $mysqli->query("SELECT * FROM rent_cars_photos WHERE id = '".$photoID."' AND car_id = '".$carID."'");
    $photo = $photoResult->fetch_assoc();

    if($mysqli->query("DELETE FROM rent_cars_photos WHERE id = '".$photoID."' AND car_id = '".$carID."'")) {
        unlink("../../../img/cars/big/".$photo['photo']);
        unlink("../../../img/cars/small/".$photo['preview']);

        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "photo";
}