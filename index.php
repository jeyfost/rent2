<?php
    include("scripts/connect.php");

    $pageResult = $mysqli->query("SELECT * FROM rent_pages WHERE url = ''");
    $page = $pageResult->fetch_assoc();
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

	<title><?= $page['title'] ?></title>

	<meta name="description" content="<?= $page['description'] ?>" />
	<meta name="keywords" content="<?= $page['keywords'] ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="icon" type="image/png" href="/img/system/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/system/favicon-16x16.png" sizes="16x16" />

    <link href="https://fonts.googleapis.com/css?family=Istok+Web|Montserrat" rel="stylesheet">

	<link rel="stylesheet" href="/libs/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/css/main.css" />
	<link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/js/common.js"></script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->
</head>

<body id="index">
    <div class="menu">
        <div class="menuContainer">
            <div class="logo">
                <a href="/"><img src="/img/system/logo.png" /></a>
            </div>
            <div class="menuContent">
                <div class="menuPoints">
                    <a href="/">
                        <div class="menuPoint" style="margin-left: 15px;">
                            <div class="menuTopLine menuTopLineActive" id="mainLine"></div>
                            <div class="menuPointName menuPointActive">Главная</div>
                        </div>
                    </a>
                    <a href="/cars">
                        <div class="menuPoint" onmouseover="pointHover('carsLine', 'carsPointName', 1)" onmouseout="pointHover('carsLine', 'carsPointName', 0)">
                            <div class="menuTopLine transition" id="carsLine"></div>
                            <div class="menuPointName transition" id="carsPointName">Автомобили</div>
                        </div>
                    </a>
                    <a href="/apartments">
                        <div class="menuPoint" onmouseover="pointHover('apartmentsLine', 'apartmentsPointName', 1)" onmouseout="pointHover('apartmentsLine', 'apartmentsPointName', 0)">
                            <div class="menuTopLine transition" id="apartmentsLine"></div>
                            <div class="menuPointName transition" id="apartmentsPointName">Квартиры</div>
                        </div>
                    </a>
                    <a href="/reviews">
                        <div class="menuPoint" onmouseover="pointHover('reviewsLine', 'reviewsPointName', 1)" onmouseout="pointHover('reviewsLine', 'reviewsPointName', 0)">
                            <div class="menuTopLine transition" id="reviewsLine"></div>
                            <div class="menuPointName transition" id="reviewsPointName">Отзывы</div>
                        </div>
                    </a>
                    <a href="/contacts">
                        <div class="menuPoint" onmouseover="pointHover('contactsLine', 'contactsPointName', 1)" onmouseout="pointHover('contactsLine', 'contactsPointName', 0)">
                            <div class="menuTopLine transition" id="contactsLine"></div>
                            <div class="menuPointName transition" id="contactsPointName">Контакты</div>
                        </div>
                    </a>
                    <div class="clear"></div>
                </div>
                <div class="menuSeparator"></div>
                <div class="menuPhone">
                    <a class="transition" href="tel: <?= COUNTRY_CODE.PHONE_CODE.str_replace('-', '', PHONE_NUMBER) ?>"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<span><?= COUNTRY_CODE ?> (<?= PHONE_CODE ?>) <b><?= PHONE_NUMBER ?></b></span></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="promo">
        <span>Аренда автомобилей в Могилёве</span>
        <br /><br />
        <p>Мы предлагаеам в аренду только проверенные модели автомобилей в отличном техническом состоянии и с полным ходовым ресурсом.</p>
        <br />
        <a href="/cars"><div class="promoButton transition">Подробнее <i class="fa fa-angle-double-right" aria-hidden="true"></i></div></a>
    </div>
</body>

</html>