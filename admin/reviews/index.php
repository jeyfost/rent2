<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 03.09.2018
 * Time: 12:44
 */

session_start();
include("../../scripts/connect.php");

if($_SESSION['userID'] != 1) {
    header("Location: ../");
}

if(!empty($_REQUEST['id'])) {
    $reviewCheckResult = $mysqli->query("SELECT COUNT(id) FROM rent_reviews WHERE id = '".$mysqli->real_escape_string($_REQUEST['id'])."'");
    $reviewCheck = $reviewCheckResult->fetch_array(MYSQLI_NUM);

    if($reviewCheck[0] == 0) {
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

    <title>Панель администрирования | Отзывы</title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="/img/system/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/system/favicon-16x16.png" sizes="16x16" />

    <link rel="stylesheet" type="text/css" href="/css/admin.css" />
    <link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script type="text/javascript" src="/js/admin/common.js"></script>
    <script type="text/javascript" src="/js/admin/reviews/index.js"></script>

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
            <div class="menuPointActive">
                <i class="fa fa-commenting-o" aria-hidden="true"></i><span> Отзывы</span>
            </div>
        </a>
        <a href="/admin/cars/">
            <div class="menuPoint">
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
        <span class="headerFont"><?php if(empty($_REQUEST['id'])) {echo "Редактирование отзывов";} else {echo "Редактирование отзыва";} ?></span>
        <br /><br />
        <?php
            if(empty($_REQUEST['id'])) {
                $reviewResult = $mysqli->query("SELECT * FROM rent_reviews ORDER BY date DESC");

                if($reviewResult->num_rows > 0) {
                    while($review = $reviewResult->fetch_assoc()) {
                        echo "
                            <br />
                            <div class='row border-bottom'>
                                <span class='nameFont'>".$review['name']."</span>
                                <br />
                                <span class='emailFont'>".$review['email']."</span>
                                <br />
                                <span>".dateToString($review['date'])."</span>
                                <br /><br />
                                <p>".$review['text']."</p>
                                <br />
                                <form id='showForm' method='post' class='relative'>
                                    <label for='showInput'>Отображать?</label>
                                    <input type='checkbox' id='showButton".$review['id']."' name='show' onclick='showReview(\"".$review['id']."\", \"showButton".$review['id']."\")' "; if($review['showing'] == 1) {echo "checked";} echo " />
                                </form>
                                <div class='clear'></div>
                                <br />
                                <a href='/admin/reviews/index.php?id=".$review['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Редактировать</a>
                                <br />
                                <span class='linkRed' onclick='deleteReview(\"".$review['id']."\")'><i class='fa fa-trash-o' aria-hidden='true'></i> Удалить</span>
                                <br /><br />
                            </div>
                        ";
                    }
                } else {
                    echo "На данный момент отзывов на сайте нет.";
                }
            } else {
                $reviewResult = $mysqli->query("SELECT * FROM rent_reviews WHERE id = '".$mysqli->real_escape_string($_REQUEST['id'])."'");
                $review = $reviewResult->fetch_assoc();

                echo "
                    <a href='/admin/reviews'><i class='fa fa-long-arrow-left' aria-hidden='true'></i> Вернуться к списку отзывов</a>
                    <br /><br />
                    <form id='reviewForm' method='post'>
                        <label for='nameInput'>Имя:</label>
                        <br />
                        <input id='nameInput' value='".$review['name']."' />
                        <br /><br />
                        <label for='textInput'>Текст отзыва:</label>
                        <br />
                        <textarea id='textInput' onkeydown='textAreaHeight(this)'>".str_replace("<br />", "", $review['text'])."</textarea>
                        <br /><br />
                        <input type='button' class='button' id='reviewSubmit' value='Редактировать' onmouseover='buttonHover(\"reviewSubmit\", 1)' onmouseout='buttonHover(\"reviewSubmit\", 0)' onclick='edit(\"".$review['id']."\")' />
                    </form>
                ";
            }
        ?>
    </div>

</body>

</html>