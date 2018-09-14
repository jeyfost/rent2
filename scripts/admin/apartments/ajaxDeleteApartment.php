<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.09.2018
 * Time: 17:48
 */

include("../../connect.php");

$req = false;
ob_start();

$id = $mysqli->real_escape_string($_POST['apartment']);

$apartmentCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_apartments WHERE id = '".$id."'");
$apartmentCheck = $apartmentCheckResult->fetch_array(MYSQLI_NUM);

if($apartmentCheck[0] > 0) {
    $apartmentResult = $mysqli->query("SELECT * FROM rent_apartments WHERE id = '".$id."'");
    $apartment = $apartmentResult->fetch_assoc();

    if($mysqli->query("DELETE FROM rent_apartments WHERE id = '".$id."'")) {
        unlink("../../../img/apartments/big/".$apartment['photo']);
        unlink("../../../img/apartments/small/".$apartment['preview']);

        $photoResult = $mysqli->query("SELECT * FROM rent_apartments_photos WHERE apartment_id  = '".$id."'");
        while($photo = $photoResult->fetch_assoc()) {
            if($mysqli->query("DELETE FROM rent_apartments_photos WHERE id = '".$photo['id']."'")) {
                unlink("../../../img/apartments/big/".$photo['photo']);
                unlink("../../../img/apartments/small/".$photo['preview']);
            }
        }

        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "id";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;