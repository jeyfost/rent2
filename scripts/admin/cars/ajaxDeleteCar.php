<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 12.09.2018
 * Time: 16:11
 */

include("../../connect.php");

$req = false;
ob_start();

$id = $mysqli->real_escape_string($_POST['car']);

$carCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_cars WHERE id = '".$id."'");
$carCheck = $carCheckResult->fetch_array(MYSQLI_NUM);

if($carCheck[0] > 0) {
    $carResult = $mysqli->query("SELECT * FROM rent_cars WHERE id = '".$id."'");
    $car = $carResult->fetch_assoc();

    if($mysqli->query("DELETE FROM rent_cars WHERE id = '".$id."'")) {
        unlink("../../../img/cars/big/".$car['photo']);
        unlink("../../../img/cars/small/".$car['preview']);

        $carPhotoResult = $mysqli->query("SELECT * FROM rent_cars_photos WHERE car_id = '".$id."'");
        while($carPhoto = $carPhotoResult->fetch_assoc()) {
            $mysqli->query("DELETE FROM rent_cars_photos WHERE id = '".$carPhoto['id']."'");

            unlink("../../../img/cars/big/".$carPhoto['photo']);
            unlink("../../../img/cars/small/".$carPhoto['preview']);
        }

        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "car";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;