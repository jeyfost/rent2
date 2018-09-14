<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 12.09.2018
 * Time: 16:35
 */

session_start();
include("../../scripts/connect.php");

if($_SESSION['userID'] != 1) {
    header("Location: ../");
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

    <title>Панель администрирования | Добавление автомобиля</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="/img/system/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/system/favicon-16x16.png" sizes="16x16" />

    <link rel="stylesheet" type="text/css" href="/css/admin.css" />
    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>
    <script type="text/javascript" src="/js/admin/cars/add.js"></script>

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

<body>

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
    <span class="headerFont">Добавление автомобиля</span>
    <br /><br />
    <form method="post" enctype="multipart/form-data" id="carsForm" name="carsForm">
        <label for='nameInput'>Марка и модель автомобиля (название):</label>
        <br />
        <input id='nameInput' name='name' />
        <br /><br />
        <label for='urlInput'>Идентификатор автомобиля:</label>
        <br />
        <input id='urlInput' name='url' />
        <br /><br />
        <label for='previewInput'>Фотография автомобиля:</label>
        <br />
        <input type='file' class='file' id='previewInput' name='preview' />
        <br /><br />
        <label for='additionalPhotosInput'>Дополнительный фотографии (не обязательно):</label>
        <br />
        <input type='file' class='file' id='additionalPhotosInput' name='additionalPhotos[]' multiple />
        <br /><br />
        <label for='typeSelect'>Тип:</label>
        <br />
        <select id='typeSelect' name='type' onchange="changeCarType()">
            <option value="">- Выберите тип автомобиля -</option>
            <?php
                $carTypeResult = $mysqli->query("SELECT * FROM rent_cars_types ORDER BY id");
                while ($carType = $carTypeResult->fetch_assoc()) {
                    echo "<option value='".$carType['id']."'>".$carType['name']."</option>";
                }
            ?>
        </select>
        <br /><br />
        <label for='yearInput'>Год выпуска:</label>
        <br />
        <input id='yearInput' name='year' />
        <br /><br />
        <label for='engineInput'>Тип двигателя:</label>
        <br />
        <input id='engineInput' name='engine' />
        <br /><br />
        <label for='consumptionInput'>Расход топлива:</label>
        <br />
        <input id='consumptionInput' name='consumption' />
        <br /><br />
        <label for='transmissionInput'>Трансмиссия:</label>
        <br />
        <input id='transmissionInput' name='transmission' />
        <br /><br />
        <label for='bodyInput'>Тип кузова:</label>
        <br />
        <input id='bodyInput' name='body' />
        <br /><br />
        <div id="placesInputContainer">
            <label for='placesInput'>Количество мест:</label>
            <br />
            <input id='placesInput' name='places' />
            <br /><br />
        </div>
        <label for='1_hourInput'>Цена за 1 час, руб.</label>
        <br />
        <input id='1_hourInput' name='1_hour' />
        <br /><br />
        <label for='1_dayInput'>Цена за 1 день, руб.</label>
        <br />
        <input id='1_dayInput' name='1_day' />
        <br /><br />
        <label for='2_daysInput'>Цена за 2 дня, руб.</label>
        <br />
        <input id='2_daysInput' name='2_days' />
        <br /><br />
        <label for='3_10_daysInput'>Цена за 3-10 дней, руб.</label>
        <br />
        <input id='3_10_daysInput' name='3_10_days' />
        <br /><br />
        <label for='10_20_daysInput'>Цена за 10-20 дней, руб.</label>
        <br />
        <input id='10_20_daysInput' name='10_20_days' />
        <br /><br />
        <label for='20_30_daysInput'>Цена за 20-30 дней, руб.</label>
        <br />
        <input id='20_30_daysInput' name='20_30_days' />
        <br /><br />
        <label for='minTermInput'>Минимальный срок аренды</label>
        <br />
        <input id='10_20_daysInput' name='10_20_days' />
        <br /><br />
        <div id="textInputContainer">
            <label for='textInput'>Краткое описание:</label>
            <br />
            <textarea id='textInput' name='text'></textarea>
            <br /><br />
        </div>
        <input type='button' class='button' id='addCarSubmit' value='Добавить' onmouseover='buttonHover("addCarSubmit", 1)' onmouseout='buttonHover("addCarSubmit", 0)' onclick='addCar()' />
    </form>
</div>

<script type="text/javascript">
    CKEDITOR.replace("text");
</script>

</body>

</html>