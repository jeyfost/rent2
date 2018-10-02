<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 04.09.2018
 * Time: 10:50
 */

include("../../connect.php");
include("../../image.php");

$req = false;
ob_start();

$id = $mysqli->real_escape_string($_POST['car']);
$name = $mysqli->real_escape_string($_POST['name']);
$url = $mysqli->real_escape_string($_POST['url']);
$type = $mysqli->real_escape_string($_POST['type']);
$year = $mysqli->real_escape_string($_POST['year']);
$engine = $mysqli->real_escape_string($_POST['engine']);
$consumption = $mysqli->real_escape_string($_POST['consumption']);
$transmission = $mysqli->real_escape_string($_POST['transmission']);
$body = $mysqli->real_escape_string($_POST['body']);
$hour_1 = $mysqli->real_escape_string($_POST['1_hour']);
$day_1 = $mysqli->real_escape_string($_POST['1_day']);
$days_2 = $mysqli->real_escape_string($_POST['2_days']);
$days_3_10 = $mysqli->real_escape_string($_POST['3_10_days']);
$days_10_20 = $mysqli->real_escape_string($_POST['10_20_days']);
$days_20_30 = $mysqli->real_escape_string($_POST['20_30_days']);
$max_day_1 = $mysqli->real_escape_string($_POST['max_1_day']);
$max_days_2 = $mysqli->real_escape_string($_POST['max_2_days']);
$max_days_3_10 = $mysqli->real_escape_string($_POST['max_3_10_days']);
$max_days_10_20 = $mysqli->real_escape_string($_POST['max_10_20_days']);
$max_days_20_30 = $mysqli->real_escape_string($_POST['max_20_30_days']);
$min_term = $mysqli->real_escape_string($_POST['minTerm']);

if($type == 2) {
    $places = $mysqli->real_escape_string($_POST['places']);
    $description = $mysqli->real_escape_string($_POST['description']);
} else {
    $places = 0;
    $description = "";
}

$url = str_replace(" ", "-", $url);
$url = str_replace("_", "-", $url);

$urlCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_cars WHERE url = '".$url."' AND id != '".$id."'");
$urlCheck = $urlCheckResult->fetch_array(MYSQLI_NUM);

if($urlCheck[0] == 0) {
    $carResult = $mysqli->query("SELECT * FROM rent_cars WHERE id = '".$id."'");
    $car = $carResult->fetch_assoc();

    if(!empty($_FILES['preview']['tmp_name'])) {
        if($_FILES['preview']['error'] == 0 and substr($_FILES['preview']['type'], 0, 5) == "image") {
            $previewTmpName = $_FILES['preview']['tmp_name'];
            $previewName = randomName($previewTmpName);
            $previewDBName = $previewName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
            $previewUploadDir = "../../../img/cars/small/";
            $previewUpload = $previewUploadDir.$previewDBName;

            $photoTmpName = $_FILES['preview']['tmp_name'];
            $photoName = randomName($photoTmpName);
            $photoDBName = $photoName.".".substr($_FILES['preview']['name'], count($_FILES['preview']['name']) - 4, 4);
            $photoUploadDir = "../../../img/cars/big/";
            $photoUpload = $photoUploadDir.$photoDBName;

            if($mysqli->query("UPDATE rent_cars SET photo = '".$photoDBName."', preview = '".$previewDBName."' WHERE id = '".$id."'")) {
                unlink($previewUploadDir.$car['preview']);
                unlink($photoUploadDir.$car['photo']);

                copy($photoTmpName, $photoUpload);

                image_resize($previewTmpName, $previewUpload, 200, 100);
                move_uploaded_file($previewTmpName, $previewUpload);
            } else {
                echo "photo upload";

                $req = ob_get_contents();
                ob_end_clean();
                echo json_encode($req);

                exit;
            }
        } else {
            echo "photo";

            $req = ob_get_contents();
            ob_end_clean();
            echo json_encode($req);

            exit;
        }
    }

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
        foreach ($_FILES['additionalPhotos']['error'] as $key => $error) {
            if($error == UPLOAD_ERR_OK) {
                $previewTmpName = $_FILES['additionalPhotos']['tmp_name'][$key];
                $previewName = randomName($previewTmpName);
                $previewDBName = $previewName.".".substr($_FILES['additionalPhotos']['name'][$key], count($_FILES['additionalPhotos']['name'][$key]) - 4, 4);
                $previewUploadDir = "../../../img/cars/small/";
                $previewUpload = $previewUploadDir.$previewDBName;

                $photoTmpName = $_FILES['additionalPhotos']['tmp_name'][$key];
                $photoName = randomName($photoTmpName);
                $photoDBName = $photoName.".".substr($_FILES['additionalPhotos']['name'][$key], count($_FILES['additionalPhotos']['name'][$key]) - 4, 4);
                $photoUploadDir = "../../../img/cars/big/";
                $photoUpload = $photoUploadDir.$photoDBName;

                $start++;

                if($mysqli->query("INSERT INTO rent_cars_photos (car_id, preview, photo) VALUES ('".$id."', '".$previewDBName
                    ."', '".$photoDBName."')")) {
                    copy($photoTmpName, $photoUpload);

                    image_resize($previewTmpName, $previewUpload, 200, 100);
                    move_uploaded_file($previewTmpName, $previewUpload);

                    $finish++;
                }
            } else {
                $errors++;
            }
        }

        if($start != $finish) {
            echo "photos upload";

            $req = ob_get_contents();
            ob_end_clean();
            echo json_encode($req);

            exit;
        }
    } else {
        echo "photos";

        $req = ob_get_contents();
        ob_end_clean();
        echo json_encode($req);

        exit;
    }

    if($mysqli->query("UPDATE rent_cars SET car_type = '".$type."', name = '".$name."', year = '".$year."', engine = '".$engine."', consumption = '".$consumption."', transmission = '".$transmission."', body = '".$body."', places = '".$places."', description = '".$description."', 1_hour = '".$hour_1."', 1_day = '".$day_1."', 2_days = '".$days_2."', 3_10_days = '".$days_3_10."', 10_20_days = '".$days_10_20."', 20_30_days = '".$days_20_30."', max_1_day = '".$max_day_1."', max_2_days = '".$max_days_2."', max_3_10_days = '".$max_days_3_10."', max_10_20_days = '".$max_days_10_20."', max_20_30_days = '".$max_days_20_30."', min_term = '".$min_term."', url = '".$url."' WHERE id = '".$id."'")) {
        echo "ok";
    } else {
        echo "failed";
    }
} else {
    echo "url";
}

$req = ob_get_contents();
ob_end_clean();
echo json_encode($req);

exit;