<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.09.2018
 * Time: 10:29
 */

session_start();

if($_SESSION['userID'] == 1) {
    header("Location: admin.php");
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

    <title>Вход в панель администрирования</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="/img/system/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/system/favicon-16x16.png" sizes="16x16" />

    <link rel="stylesheet" type="text/css" href="/css/admin.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>
    <script type="text/javascript" src="/js/admin/index.js"></script>

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

<div id="loginContainer">
    <form method="post">
        <label for="loginInput">Логин:</label>
        <br />
        <input id="loginInput" />
        <br /><br />
        <label for="passwordInput">Пароль:</label>
        <br />
        <input type="password" id="passwordInput" />
        <br /><br />
        <input type="button" id="loginSubmit" class="button" value="Войти" onmouseover="buttonHover('loginSubmit', 1)" onmouseout="buttonHover('loginSubmit', 0)" onclick="login()" />
    </form>
    <div style="clear: both;"></div>
</div>

</body>

</html>