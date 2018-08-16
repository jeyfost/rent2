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
    <script src="/js/index.js"></script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->
</head>

<body id="index">
    <div class="menu transition">
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
                <div class="menuPhone" onmouseover="phoneHover(1)" onmouseout="phoneHover(0)">
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

    <div class="section" id="start">
        <div class="greetingsContainer">
            <span class="headerFont">Добро пожаловать!</span>
            <br /><br />
            <p>
                <?php
                    $textResult = $mysqli->query("SELECT * FROM rent_text WHERE name = 'main'");
                    $text = $textResult->fetch_assoc();

                    echo $text['text'];
                ?>
            </p>
        </div>
    </div>

    <div class="section grey text-center" id="services">
        <span class="headerFont">Наши услуги</span>
        <br /><br />
        <div class="servicesContainer">
            <div class="serviceContainer">
                <i class="fa fa-circle yellow" aria-hidden="true"></i>&nbsp;<span>Краткосрочная/долгосрочная аренда легковых автомобилей</span>
                <br />
                <i class="fa fa-circle yellow" aria-hidden="true"></i>&nbsp;<span>Краткосрочная/долгосрочная аренда микроавтобусов</span>
            </div>
            <div class="serviceContainer">
                <i class="fa fa-circle yellow" aria-hidden="true"></i>&nbsp;<span>Аренда квартир на сутки</span>
                <br />
                <i class="fa fa-circle yellow" aria-hidden="true"></i>&nbsp;<span>Аренда прицепов</span>
                <br />
                <i class="fa fa-circle yellow" aria-hidden="true"></i>&nbsp;<span>Прокат авто без водителя</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="section text-center" id="advantages">
        <span class="headerFont">С нами комфортно</span>
        <br /><br />
        <div class="advantagesContainer">
            <div class="advantageContainer">
                <img src="/img/system/1.png" />
                <br />
                <span class="advantageHeader">Удобный сервис</span>
                <br />
                <span>Легко получить<br />авто в аренду</span>
            </div>
            <div class="advantageContainer">
                <img src="/img/system/2.png" />
                <br />
                <span class="advantageHeader">Система скидок</span>
                <br />
                <span>Бонусы для<br />постоянных клиентов</span>
            </div>
            <div class="advantageContainer">
                <img src="/img/system/3.png" />
                <br />
                <span class="advantageHeader">Всегда доступны</span>
                <br />
                <span>Работаем для Вас<br />24/7</span>
            </div>
            <div class="advantageContainer">
                <img src="/img/system/4.png" />
                <br />
                <span class="advantageHeader">Отличное состояние</span>
                <br />
                <span>Каждый автомобиль<br />своевременно проходит ТО</span>
            </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="section grey" id="map">
        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A96c945bccec3c441040c28c64f0d9573d35c4a9d0d1a2778fb871a9afa423af6&amp;width=100%25&amp;height=440&amp;lang=ru_RU&amp;scroll=false"></script>
    </div>

    <div class="section ndra-container" id="footer">
        <div class="wide">
            <div class="footerLogo"><a href="/"><img src="/img/system/logo.png" /></a></div>
            <div class="footerContacts">
                <div class="footerContactsContainer">
                    <a class="transition" href="tel: <?= COUNTRY_CODE.PHONE_CODE.str_replace('-', '', PHONE_NUMBER) ?>"><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;<?= COUNTRY_CODE." (".PHONE_CODE.") ".PHONE_NUMBER ?></a>
                    <br />
                    <a class="transition" href="tel: <?= COUNTRY_CODE.SECOND_PHONE_CODE.str_replace('-', '', SECOND_PHONE_NUMBER) ?>"><i class="fa fa-mobile" aria-hidden="true"></i>&nbsp;<?= COUNTRY_CODE." (".SECOND_PHONE_CODE.") ".SECOND_PHONE_NUMBER ?>&nbsp;</a>
                </div>
                <div class="footerContactsContainer">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;<?= COMPANY_ADDRESS ?>
                    <br />
                    <a class="transition" href="mailto: <?= CONTACT_EMAIL ?>"><i class="fa fa-at" aria-hidden="true"></i>&nbsp;<?= CONTACT_EMAIL ?>&nbsp;</a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <br />
        </div>
        <div class="line"></div>
        <div class="wide">
            <br />
            <div style="float: left;">Аренда &laquo;У ПАЛЫЧА&raquo; &copy; 2014 - <?= date('Y') ?></div>
            <div style="float: right;">Создание сайта: <a href="https://airlab.by/" style="color: #cfcfcf;"><span class="maker transition">airlab</span></a></div>
            <div class="clear"></div>
        </div>
    </div>
</body>

</html>