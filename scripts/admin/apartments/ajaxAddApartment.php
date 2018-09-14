<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.09.2018
 * Time: 18:12
 */

include("../../connect.php");
include("../../image.php");

$req = false;
ob_start();

$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);
$rooms = $mysqli->real_escape_string($_POST['rooms']);
$sleepingAreas = $mysqli->real_escape_string($_POST['sleepingAreas']);
$appliances = $mysqli->real_escape_string($_POST['appliances']);
$wifi = $mysqli->real_escape_string($_POST['wifi']);
$price = $mysqli->real_escape_string($_POST['price']);
$text = $mysqli->real_escape_string($_POST['text']);

$url = str_replace(" ", "-", $url);
$url = str_replace("_", "-", $url);

$urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_apartments WHERE url = '".$url."'");
$urlCheck = $urlCheckResult->fetch_assoc();

if($urlCheck[0] == 0) {
    if(!empty($_FILES['preview']['tmp_name'])) {
        if($_FILES['preview']['error'] == 0 and substr($_FILES['preview']['type'], 0, 5) == "image") {
            $start = 0;
            $finish = 0;
            $errors = 0;

            foreach ($_FILES['additionalPhotos']['error'] as $key => $error) {
                if(!empty($_FILES['additionalPhotos']['tmp_name'][$key])) {
                    if($error != UPLOAD_ERR_OK or substr($_FILES['additionalPhotos']['type'][$key], 0, 5) != "image") {
                        $errors++;
                    }
                }
            }

            if($errors == 0) {
                $maxIDResult = $mysqli->query("SELECT MAX(id) FROM rent_apartments");
                $maxID = $maxIDResult->fetch_array(MYSQLI_NUM);

                $id = $maxID[0] + 1;

                foreach ($_FILES['additionalPhotos']['error'] as $key => $error) {
                    if($error == UPLOAD_ERR_OK) {
                        $previewTmpName = $_FILES['additionalPhotos']['tmp_name'][$key];
                        $previewName = randomName($previewTmpName);
                        $previewDBName = $previewName.".".substr($_FILES['additionalPhotos']['name'][$key], count($_FILES['additionalPhotos']['name'][$key]) - 4, 4);
                        $previewUploadDir = "../../../img/apartments/small/";
                        $previewUpload = $previewUploadDir.$previewDBName;

                        $photoTmpName = $_FILES['additionalPhotos']['tmp_name'][$key];
                        $photoName = randomName($photoTmpName);
                        $photoDBName = $photoName.".".substr($_FILES['additionalPhotos']['name'][$key], count($_FILES['additionalPhotos']['name'][$key]) - 4, 4);
                        $photoUploadDir = "../../../img/apartments/big/";
                        $photoUpload = $photoUploadDir.$photoDBName;

                        $start++;

                        if($mysqli->query("INSERT INTO rent_apartments_photos (apartment_id, preview, photo) VALUES ('".$id."', '".$previewDBName."', '".$photoDBName."')")) {
                            copy($photoTmpName, $photoUpload);

                            resize($previewTmpName, 200);
                            move_uploaded_file($previewTmpName, $previewUpload);

                            $finish++;
                        }
                    } else {
                        $errors++;
                    }
                }

                if($start == $finish) {
                    $previewTmpName = $_FILES['preview']['tmp_name'];
                    $previewName = randomName($previewTmpName);
                    $previewDBName = $previewName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
                    $previewUploadDir = "../../../img/apartments/small/";
                    $previewUpload = $previewUploadDir.$previewDBName;

                    $photoTmpName = $_FILES['preview']['tmp_name'];
                    $photoName = randomName($photoTmpName);
                    $photoDBName = $photoName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
                    $photoUploadDir = "../../../img/apartments/big/";
                    $photoUpload = $photoUploadDir.$photoDBName;

                    if($mysqli->query("INSERT INTO rent_apartments (id, name, rooms, sleeping_areas, appliances, wifi, text, price, preview, photo, url) VALUES ('".$id."', '".$name."', '".$rooms."', '".$sleepingAreas."', '".$appliances."', '".$wifi."', '".$text."', '".$price."', '".$previewDBName."', '".$photoDBName."', '".$url."')")) {
                        copy($photoTmpName, $photoUpload);

                        resize($previewTmpName, 200);
                        move_uploaded_file($previewTmpName, $previewUpload);

                        echo "ok";
                    } else {
                        echo "failed";
                    }
                } else {
                    echo "photos upload";
                }
            } else {
                echo "photos";
            }
        } else {
            echo "photo";
        }
    } else {
        echo "photo empty";
    }
} else {
    echo "url";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;