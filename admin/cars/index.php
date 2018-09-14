<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.09.2018
 * Time: 13:24
 */

session_start();
include("../../scripts/connect.php");

if($_SESSION['userID'] != 1) {
    header("Location: ../");
}

if(!empty($_REQUEST['id'])) {
    $carCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_cars WHERE id = '".$mysqli->real_escape_string($_REQUEST['id'])."'");
    $carCheck = $carCheckResult->fetch_array(MYSQLI_NUM);

    if($carCheck[0] == 0) {
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>

<!--[if lt IE 7]><html lang="ru" class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html lang="ru" class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html lang="ru" class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ru">
<!--<![endif]-->

<head>

    <meta charset="utf-8" />

    <title>Панель администрирования | Автомобили</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="/img/system/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/system/favicon-16x16.png" sizes="16x16" />

    <link rel="stylesheet" type="text/css" href="/css/admin.css" />
    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="/libs/strip/dist/css/strip.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script src="/libs/strip/dist/js/strip.pkgd.min.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>
    <script type="text/javascript" src="/js/admin/cars/index.js"></script>

    <style>
        #page-preloader {position: fixed; left: 0; top: 0; right: 0; bottom: 0; background: #fff; z-index: 100500;}
        #page-preloader .spinner {width: 160px; height: 20px; position: absolute; left: 50%; top: 50%; background: url('/img/system/spinner.gif') no-repeat 50% 50%; margin: -80px 0 0 -10px;}
    </style>

    <script type="text/javascript">
        $(window).on('load', function () {
            const $preloader = $('#page-preloader'), $spinner = $preloader.find('.spinner');
            $spinner.delay(500).fadeOut();
            $preloader.delay(850).fadeOut();
        });
    </script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->
</head>

<body <?php if(!empty($_REQUEST['id'])) {echo "onload='loadCarDescription(\"".$mysqli->real_escape_string($_REQUEST['id'])."\")'";} ?>>

    <div id="page-preloader"><span class="spinner"></span></div>

    <div id="topLine">
        <div id="logo">
            <a href="/"><span><i class="fa fa-home" aria-hidden="true"></i> <?= $_SERVER['HTTP_HOST'] ?></span></a>
        </div>
        <a href="admin.php"><span class="headerText">Панель администрирвания</span></a>
        <div id="exit" onclick="exit()">
            <span>Выйти <i class="fa fa-sign-out" aria-hidden="true"></i></span>
        </div>
    </div>
    <div id="leftMenu">
        <a href="/admin/pages/">
            <div class="menuPoint">
                <i class="fa fa-file-text-o" aria-hidden="true"></i><span> Страницы</span>
            </div>
        </a>
        <a href="/admin/text/">
            <div class="menuPoint">
                <i class="fa fa-font" aria-hidden="true"></i><span> Тексты</span>
            </div>
        </a>
        <a href="/admin/reviews/">
            <div class="menuPoint">
                <i class="fa fa-commenting-o" aria-hidden="true"></i><span> Отзывы</span>
            </div>
        </a>
        <a href="/admin/cars/">
            <div class="menuPointActive">
                <i class="fa fa-car" aria-hidden="true"></i><span> Автомобили</span>
            </div>
        </a>
        <a href="/admin/apartments/">
            <div class="menuPoint">
                <i class="fa fa-building-o" aria-hidden="true"></i><span> Квартиры</span>
            </div>
        </a>
        <a href="/admin/security/">
            <div class="menuPoint">
                <i class="fa fa-shield" aria-hidden="true"></i><span> Безопасность</span>
            </div>
        </a>
    </div>

    <div id="content">
        <span class="headerFont">Управление автомобилями</span>
        <br /><br />
        <form method="post" enctype="multipart/form-data" id="carsForm" name="carsForm">
            <label for="carSelect">Автомобиль:</label>
            <br />
            <select id="carSelect" name="car" onchange="window.location = '?id=' + this.options[this.selectedIndex].value">
                <option value="">- Выберите автомобиль -</option>
                <?php
                    $carResult = $mysqli->query("SELECT * FROM rent_cars ORDER BY name");
                    while($car = $carResult->fetch_assoc()) {
                        echo "<option value='".$car['id']."'"; if($_REQUEST['id'] == $car['id']) {echo " selected";} echo ">".$car['name']."</option>";
                    }
                ?>
            </select>
            <?php
                if(!empty($_REQUEST['id'])) {
                    $carResult = $mysqli->query("SELECT * FROM rent_cars WHERE id = '".$mysqli->real_escape_string($_REQUEST['id'])."'");
                    $car = $carResult->fetch_assoc();

                    echo "
                        <br /><br />
                        <label for='nameInput'>Марка и модель автомобиля (название):</label>
                        <br />
                        <input id='nameInput' name='name' value='".$car['name']."' />
                        <br /><br />
                        <label for='urlInput'>Идентификатор автомобиля:</label>
                        <br />
                        <input id='urlInput' name='url' value='".$car['url']."' />
                        <br /><br />
                        <label for='previewInput'>Фотография автомобиля:</label>
                        <br />
                        <a href='/img/cars/big/".$car['photo']."' class='photoLink strip'>Нажмите для просмотра фотографии</a>
                        <br /><br />
                        <input type='file' class='file' id='previewInput' name='preview' />
                        <br /><br />
                        <label for='additionalPhotosInput'>Дополнительный фотографии (не обязательно):</label>
                        ";

                    $carPhotoResult = $mysqli->query("SELECT * FROM rent_cars_photos WHERE car_id = '".$car['id']."'");
                    if($carPhotoResult->num_rows > 0) {
                        echo "<div class='goodPhotos'>";

                        while ($carPhoto = $carPhotoResult->fetch_assoc()) {
                            echo "
                                <div class='goodPhoto'>
                                    <a href='/img/cars/big/".$carPhoto['photo']."' class='strip' data-strip-group='photos'><img src='/img/cars/small/".$carPhoto['preview']."' /></a>
                                    <br />
                                    <span onclick='deleteCarPhoto(\"".$carPhoto['id']."\", \"".$car['id']."\")' class='photoLink'>Удалить</span>
                                </div>
                            ";
                        }

                        echo "</div>";
                    }

                    echo "
                            <br />
                            <input type='file' class='file' id='additionalPhotosInput' name='additionalPhotos[]' multiple />
                            <br /><br />
                            <label for='typeSelect'>Тип:</label>
                            <br />
                            <select id='typeSelect' name='type'>
                        ";

                        $carTypeResult = $mysqli->query("SELECT * FROM rent_cars_types ORDER BY id");
                        while($carType = $carTypeResult->fetch_assoc()) {
                            echo "
                                <option value='".$carType['id']."'"; if($car['car_type'] == $carType['id']) {echo " selected";} echo ">".$carType['name']."</option>
                            ";
                        }

                        echo "
                            </select>
                            <br /><br />
                            <label for='yearInput'>Год выпуска:</label>
                            <br />
                            <input id='yearInput' name='year' value='".$car['year']."' />
                            <br /><br />
                            <label for='engineInput'>Тип двигателя:</label>
                            <br />
                            <input id='engineInput' name='engine' value='".$car['engine']."' />
                            <br /><br />
                            <label for='consumptionInput'>Расход топлива:</label>
                            <br />
                            <input id='consumptionInput' name='consumption' value='".$car['consumption']."' />
                            <br /><br />
                            <label for='transmissionInput'>Трансмиссия:</label>
                            <br />
                            <input id='transmissionInput' name='transmission' value='".$car['transmission']."' />
                            <br /><br />
                            <label for='bodyInput'>Тип кузова:</label>
                            <br />
                            <input id='bodyInput' name='body' value='".$car['body']."' />
                            <br /><br />
                        ";

                        if($car['car_type'] == 2) {
                            echo "
                                <label for='placesInput'>Количество мест:</label>
                                <br />
                                <input id='placesInput' name='places' value='".$car['places']."' />
                                <br /><br />
                            ";
                        }

                        echo "
                            <label for='1_hourInput'>Цена за 1 час, руб.</label>
                            <br />
                            <input id='1_hourInput' name='1_hour' value='".$car['1_hour']."' />
                            <br /><br />
                            <label for='1_dayInput'>Цена за 1 день, руб.</label>
                            <br />
                            <input id='1_dayInput' name='1_day' value='".$car['1_day']."' />
                            <br /><br />
                            <label for='2_daysInput'>Цена за 2 дня, руб.</label>
                            <br />
                            <input id='2_daysInput' name='2_days' value='".$car['2_days']."' />
                            <br /><br />
                            <label for='3_10_daysInput'>Цена за 3-10 дней, руб.</label>
                            <br />
                            <input id='3_10_daysInput' name='3_10_days' value='".$car['3_10_days']."' />
                            <br /><br />
                            <label for='10_20_daysInput'>Цена за 10-20 дней, руб.</label>
                            <br />
                            <input id='10_20_daysInput' name='10_20_days' value='".$car['10_20_days']."' />
                            <br /><br />
                            <label for='20_30_daysInput'>Цена за 20-30 дней, руб.</label>
                            <br />
                            <input id='20_30_daysInput' name='20_30_days' value='".$car['20_30_days']."' />
                            <br /><br />
                            <label for='minTermInput'>Минимальный срок аренды</label>
                            <br />
                            <input id='minTermInput' name='minTerm' value='".$car['10_20_days']."' />
                            <br /><br />
                        ";

                        if($car['car_type'] == 2) {
                            echo "
                                <label for='textInput'>Краткое описание:</label>
                                <br />
                                <textarea id='textInput' name='text'></textarea>
                                <br /><br />
                            ";
                        }

                        echo "
                            <input type='button' class='button relative' id='editCarSubmit' value='Редактировать' onmouseover='buttonHover(\"editCarSubmit\", 1)' onmouseout='buttonHover(\"editCarSubmit\", 0)' onclick='editCar()' />
                            <input type='button' class='button relative' id='deleteCarSubmit' value='Удалить' onmouseover='buttonHoverRed(\"deleteCarSubmit\", 1)' onmouseout='buttonHoverRed(\"deleteCarSubmit\", 0)' onclick='deleteCar()' style='margin-left: 20px;' />
                        ";
                }
            ?>
            <br /><br /><hr /><br />
            <span class="headerFont">Добавление автомобилей</span>
            <br /><br />
            <a href='/admin/cars/add.php'><input type='button' class='button relative' id='newCarSubmit' value='Добавить новый автомобиль' onmouseover='buttonHover("newCarSubmit", 1)' onmouseout='buttonHover("newCarSubmit", 0)' /></a>
        </form>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace("text");
    </script>

</body>

</html>