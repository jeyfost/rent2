<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 29.08.2018
 * Time: 10:41
 */

    include("../scripts/connect.php");

    $pageResult = $mysqli->query("SELECT * FROM rent_pages WHERE url = 'reviews'");
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
    <link rel="stylesheet" href="/libs/remodal/dist/remodal.css" />
    <link rel="stylesheet" href="/libs/remodal/dist/remodal-default-theme.css" />
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="/libs/notify/notify.js"></script>
    <script type="text/javascript" src="/libs/remodal/dist/remodal.min.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/reviews.js"></script>

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
                        <div class="menuPoint">
                            <div class="menuTopLine transition menuTopLineActive" id="reviewsLine"></div>
                            <div class="menuPointNameInner transition menuPointActive" id="reviewsPointName">Отзывы</div>
                        </div>
                    </a>
                    <a href="/contacts">
                        <div class="menuPoint" onmouseover="pointInnerHover('contactsLine', 'contactsPointName', 1)" onmouseout="pointInnerHover('contactsLine', 'contactsPointName', 0)">
                            <div class="menuTopLine transition" id="contactsLine"></div>
                            <div class="menuPointNameInner transition" id="contactsPointName">Контакты</div>
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
            <div class="clear"></div>
        </div>
    </div>

    <div class="ndra-container">
        <div class="section grey text-center">
            <span class='headerFont'>Отзывы о сервисе проката авто &laquo;У ПАЛЫЧА&raquo;</span>
            <br /><br />
            <a data-remodal-target='modal'><div class="promoButton promoButtonInner transition" style="width: 130px;">Оставить отзыв</div></a>
            <br /><br />
            <div class="reviews">
                <?php
                    $reviewCountResult = $mysqli->query("SELECT COUNT(id) FROM rent_reviews WHERE showing = '1'");
                    $reviewCount = $reviewCountResult->fetch_array(MYSQLI_NUM);

                    $i = 0;

                    $reviewResult = $mysqli->query("SELECT * FROM rent_reviews WHERE showing = '1' ORDER BY date DESC");
                    while($review = $reviewResult->fetch_assoc()) {
                        $i++;
                        echo "
                            <div class='custom review text-left'>
                                <b>".$review['name']."</b> ".dateToString($review['date'])."
                                <br /><br />
                                ".$review['text']."
                                <br /><br />
                        ";

                        if($i < $reviewCount[0]) {
                            echo "<hr /><br />";
                        }

                        echo "
                            </div>
                        ";
                    }
                ?>
            </div>
            <br />
            <a data-remodal-target='modal'><div class="promoButton promoButtonInner transition" style="width: 130px;">Оставить отзыв</div></a>
        </div>
    </div>

    <div class="remodal" data-remodal-id="modal" data-remodal-options="closeOnConfirm: false">
        <button data-remodal-action="close" class="remodal-close"></button>
        <div style='width: 80%; margin: 0 auto;'><h1>Пожалуйста, оставьте свой отзыв.<br />Для нас это очень важно!</h1></div>
        <br /><br />
        <form method="post" id="modalForm">
            <input id="nameInput" name="name" placeholder="Имя" />
            <br /><br />
            <input id="emailInput" name="email" placeholder="E-mail" />
            <br /><br />
            <textarea id="textInput" name="text" placeholder="Отзыв"></textarea>
        </form>
        <br />
        <button data-remodal-action="confirm" class="remodal-confirm" style="width: 150px;" onclick="sendReview()">Оставить отзыв</button>
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