<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 29.08.2018
 * Time: 13:51
 */

    include("../scripts/connect.php");

    $pageResult = $mysqli->query("SELECT * FROM rent_pages WHERE url = 'contacts'");
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
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/contacts.js"></script>

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

    <div class="mobileMenu">
        <div class="row" id="mobileMenuClose"><i class="fa fa-times" aria-hidden="true" onclick="closeMobileMenu()"></i></div>
        <div class="row text-center mobile">Главная</div>
        <div class="row text-center mobile"><a href="/cars">Автомобили</a></div>
        <div class="row text-center mobile"><a href="/apartments">Квартиры</a></div>
        <div class="row text-center mobile"><a href="/reviews">Отзывы</a></div>
        <div class="row text-center mobile mobileActive"><a href="/contacts">Контакты</a></div>
    </div>

    <div class="menuInner transition">
        <div class="menuContainer">
            <div class="logo">
                <a href="/"><img src="/img/system/logo_orange.png" /></a>
            </div>
            <div class="menuContent">
                <div class="menuPoints">
                    <a href="/">
                        <div class="menuPoint" style="margin-left: 15px;" onmouseover="pointInnerHover('mainLine', 'mainPointName', 1)" onmouseout="pointInnerHover('mainLine', 'mainPointName', 0)">
                            <div class="menuTopLine transition" id="mainLine"></div>
                            <div class="menuPointNameInner" id="mainPointName">Главная</div>
                        </div>
                    </a>
                    <a href="/cars">
                        <div class="menuPoint" onmouseover="pointInnerHover('carsLine', 'carsPointName', 1)" onmouseout="pointInnerHover('carsLine', 'carsPointName', 0)">
                            <div class="menuTopLine transition" id="carsLine"></div>
                            <div class="menuPointNameInner transition" id="carsPointName">Автомобили</div>
                        </div>
                    </a>
                    <a href="/apartments">
                        <div class="menuPoint" onmouseover="pointInnerHover('apartmentsLine', 'apartmentsPointName', 1)" onmouseout="pointInnerHover('apartmentsLine', 'apartmentsPointName', 0)">
                            <div class="menuTopLine transition" id="apartmentsLine"></div>
                            <div class="menuPointNameInner transition" id="apartmentsPointName">Квартиры</div>
                        </div>
                    </a>
                    <a href="/reviews">
                        <div class="menuPoint" onmouseover="pointInnerHover('reviewsLine', 'reviewsPointName', 1)" onmouseout="pointInnerHover('reviewsLine', 'reviewsPointName', 0)">
                            <div class="menuTopLine transition" id="reviewsLine"></div>
                            <div class="menuPointNameInner transition" id="reviewsPointName">Отзывы</div>
                        </div>
                    </a>
                    <a href="/contacts">
                        <div class="menuPoint">
                            <div class="menuTopLine transition menuTopLineActive" id="contactsLine"></div>
                            <div class="menuPointNameInner transition menuPointActive" id="contactsPointName">Контакты</div>
                        </div>
                    </a>
                    <div class="clear"></div>
                </div>
                <div class="menuSeparator"></div>
                <div class="menuPhoneInner">
                    <a class="transition" href="tel: <?= COUNTRY_CODE.PHONE_CODE.str_replace('-', '', PHONE_NUMBER) ?>"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;<span><?= COUNTRY_CODE ?> (<?= PHONE_CODE ?>) <b><?= PHONE_NUMBER ?></b></span></a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="mobileMenuIcon" onclick="showMobileMenu()"><i class="fa fa-bars" aria-hidden="true"></i></div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="ndra-container">
        <div class="section grey text-center custom">
            <span class='headerFont'>Контактная информация</span>
            <br /><br />
            <div class="column firstColumn">
                <i class="fa fa-map-marker" aria-hidden="true"></i> <?= FULL_COMPANY_ADDRESS ?>
            </div>
            <div class="column">
                <a class="transition" href="tel:<?= COUNTRY_CODE ?> (<?= PHONE_CODE ?>) <?= PHONE_NUMBER ?>"><i class="fa fa-mobile" aria-hidden="true"></i> <?= COUNTRY_CODE ?> (<?= PHONE_CODE ?>) <b><?= PHONE_NUMBER ?></b></a>
                <br />
                <a class="transition" href="tel:<?= COUNTRY_CODE ?> (<?= SECOND_PHONE_CODE ?>) <?= SECOND_PHONE_NUMBER ?>"><i class="fa fa-mobile" aria-hidden="true"></i> <?= COUNTRY_CODE ?> (<?= SECOND_PHONE_CODE ?>) <b><?= SECOND_PHONE_NUMBER ?></b></a>
            </div>
            <div class="column">
                <a class="transition" href="mailto:<?= CONTACT_EMAIL ?>"><i class="fa fa-envelope" aria-hidden="true"></i> <?= CONTACT_EMAIL ?></a>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section white text-center">
            <span class='headerFont'>Свяжитесь с нами</span>
            <br /><br />
            <div class="container60">
                <form id="contactForm" name="contactForm">
                    <label for="nameInput">Ваше имя:</label>
                    <br />
                    <input id="nameInput" name="name" />
                    <br /><br />
                    <label for="emailInput">Ваш email:</label>
                    <br />
                    <input id="emailInput" name="email" />
                    <br /><br />
                    <label for="phoneInput">Ваш номер телефона:</label>
                    <br />
                    <input id="phoneInput" name="phone" />
                    <br /><br />
                    <label for="messageInput">Текст сообщения:</label>
                    <br />
                    <textarea id="messageInput" name="message" onkeydown="textAreaHeight(this)" style="width: 95%;"></textarea>
                    <br /><br />
                    <div class="g-recaptcha" data-sitekey="6LfPHW0UAAAAADw_T1d4VDqD0rAwvcjj1N6LEKA7"></div>
                    <br />
                    <center><button onclick="sendEmail()" class="button" id="messageButton">Отправить&nbsp;&nbsp;&nbsp;<i class="fa fa-share" aria-hidden="true"></i></button></center>
                </form>
            </div>
        </div>

        <div class="section grey" id="map">
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A96c945bccec3c441040c28c64f0d9573d35c4a9d0d1a2778fb871a9afa423af6&amp;width=100%25&amp;height=440&amp;lang=ru_RU&amp;scroll=false"></script>
        </div>
    </div>

    <div class="section" id="footer" style="padding: 0;">
        <br /><br />
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
            <div class="footerLeft" style="float: left;">Аренда &laquo;У ПАЛЫЧА&raquo; &copy; 2014 - <?= date('Y') ?></div>
            <div class="footerRight" style="float: right;">Создание сайта: <a href="https://airlab.by/" style="color: #cfcfcf;"><span class="maker transition">airlab</span></a></div>
            <div class="clear"></div>
            <br /><br />
        </div>
    </div>

</body>

</html>
