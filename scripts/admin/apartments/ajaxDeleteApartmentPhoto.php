<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.09.2018
 * Time: 16:42
 */

include("../../connect.php");

$photoID = $mysqli->real_escape_string($_POST['photoID']);
$apartmentID = $mysqli->real_escape_string($_POST['apartmentID']);

$photoCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_apartments_photos WHERE id = '".$photoID."' AND apartment_id = '".$apartmentID."'");
$photoCheck = $photoCheckResult->fetch_array(MYSQLI_NUM);

if($photoCheck[0] > 0) {
    $photoResult = $mysqli->query("SELECT * FROM rent_apartments_photos WHERE id = '".$photoID."' AND apartment_id = '".$apartmentID."'");
    $photo = $photoResult->fetch_assoc();

    if($mysqli->query("DELETE FROM rent_apartments_photos WHERE id = '".$photoID."' AND apartment_id = '".$apartmentID."'")) {
        unlink("../../../img/apartments/big/".$photo['photo']);
        unlink("../../../img/apartments/small/".$photo['preview']);

        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "photo";
}