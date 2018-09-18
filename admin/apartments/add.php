<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 14.09.2018
 * Time: 17:56
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

    <title>Панель администрирования | Квартиры</title>

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
    <script type="text/javascript" src="/js/admin/apartments/add.js"></script>

    <style>
        #page-preloader {position: fixed; left: 0; top: 0; right: 0; bottom: 0; background: #fff; z-index: 100500;}
        #page-preloader .spinner {width: 160px; height: 20px; position: absolute; left: 50%; top: 40%; background: url('/img/system/spinner.gif') no-repeat 50% 50%; margin: 0 0 0 -80px;}
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
        <div class="menuPoint">
            <i class="fa fa-car" aria-hidden="true"></i><span> Автомобили</span>
        </div>
    </a>
    <a href="/admin/apartments/">
        <div class="menuPointActive">
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
    <span class="headerFont">Добавление квартир</span>
    <br /><br />
    <form method="post" enctype="multipart/form-data" id="apartmentsForm" name="apartmentsForm">
        <label for='nameInput'>Название:</label>
        <br />
        <input id='nameInput' name='name' />
        <br /><br />
        <label for='urlInput'>Идентификатор квартиры:</label>
        <br />
        <input id='urlInput' name='url' />
        <br /><br />
        <label for='previewInput'>Фотография квартиры:</label>
        <br />
        <input type='file' class='file' id='previewInput' name='preview' />
        <br /><br />
        <label for='additionalPhotosInput'>Дополнительные фотографии (не обязательно):</label>
        <br />
        <input type='file' class='file' id='additionalPhotosInput' name='additionalPhotos[]' multiple />
        <br /><br />
        <label for='roomsInput'>Количество комнат:</label>
        <br />
        <input id='roomsInput' name='rooms' />
        <br /><br />
        <label for='sleepingAreasInput'>Количество спальных мест:</label>
        <br />
        <input id='sleepingAreasInput' name='sleepingAreas' />
        <br /><br />
        <label for='appliancesInput'>Бытовая техника:</label>
        <br />
        <input id='appliancesInput' name='appliances' />
        <br /><br />
        <label for='wifiInput'>Наличие Wi-Fi (1 = есть; 0 = нет):</label>
        <br />
        <input type="number" step="1" min="0" max="1" id='wifiInput' name='wifi' />
        <br /><br />
        <label for='priceInput'>Цена аренды за 1 сутки, руб.:</label>
        <br />
        <input id='priceInput' name='price' />
        <br /><br />
        <label for='textInput'>Описание:</label>
        <br />
        <textarea id='textInput' name='text'></textarea>
        <br /><br />
        <input type='button' class='button' id='addApartmentSubmit' value='Добавить' onmouseover='buttonHover("addApartmentSubmit", 1)' onmouseout='buttonHover("addApartmentSubmit", 0)' onclick='addApartment()' />
    </form>
</div>

<script type="text/javascript">
    CKEDITOR.replace("text");
</script>

</body>

</html>
