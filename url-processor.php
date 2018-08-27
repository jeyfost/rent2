<?php
/**
 * Created by PhpStorm.
 * User: jeyfost
 * Date: 23.08.2018
 * Time: 12:02
 */

include("scripts/connect.php");

$url = substr($_SERVER['REQUEST_URI'], 1);
$url = explode("/", $url);

/*
 * $url[0] — тип услуг (автомобили или квартиры)
 * $url[1] — конкретный автомобиль или квартира
 */

if($url[0] != "cars" and $url[0] != "apartments") {
    header("Location: /");
}

if(!empty($url[1])) {
    $type = "good";
} else {
    $type = "category";
}

$pageResult = $mysqli->query("SELECT * FROM rent_pages WHERE url = '".$url[0]."'");
$page = $pageResult->fetch_assoc();

?>

<html>

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
    <link rel="stylesheet" href="/libs/strip/dist/css/strip.css" />
    <link rel="stylesheet" href="/css/main.css" />
    <link rel="stylesheet" href="/css/media.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/libs/strip/dist/js/strip.pkgd.min.js"></script>
    <script src="/js/common.js"></script>

    <!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
    <!-- Google Analytics counter --><!-- /Google Analytics counter -->
</head>

<body>

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
                        <div class="menuPoint" <?php if($url[0] != "cars") {echo "onmouseover='pointInnerHover(\"carsLine\", \"carsPointName\", 1)' onmouseout='pointInnerHover(\"carsLine\", \"carsPointName\", 0)'";} ?>>
                            <div class="menuTopLine transition <?php if($url[0] == "cars") {echo "menuTopLineActive";} ?>" id="carsLine"></div>
                            <div class="menuPointNameInner transition <?php if($url[0] == "cars") {echo "menuPointActive";} ?>" id="carsPointName">Автомобили</div>
                        </div>
                    </a>
                    <a href="/apartments">
                        <div class="menuPoint" <?php if($url[0] != "apartments") {echo "onmouseover='pointInnerHover(\"apartmentsLine\", \"apartmentsPointName\", 1)' onmouseout='pointInnerHover(\"apartmentsLine\", \"apartmentsPointName\", 0)'";} ?>>
                            <div class="menuTopLine transition <?php if($url[0] == "apartments") {echo "menuTopLineActive";} ?>" id="apartmentsLine"></div>
                            <div class="menuPointNameInner transition <?php if($url[0] == "apartments") {echo "menuPointActive";} ?>" id="apartmentsPointName">Квартиры</div>
                        </div>
                    </a>
                    <a href="/reviews">
                        <div class="menuPoint" onmouseover="pointInnerHover('reviewsLine', 'reviewsPointName', 1)" onmouseout="pointInnerHover('reviewsLine', 'reviewsPointName', 0)">
                            <div class="menuTopLine transition" id="reviewsLine"></div>
                            <div class="menuPointNameInner transition" id="reviewsPointName">Отзывы</div>
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
            <?php
                switch($type) {
                    case "category":
                        if($url[0] == "cars") {
                            echo "
                                <span class='headerFont'>Легковые автомобили</span>
                                <br /><br />
                            ";

                            $carResult = $mysqli->query("SELECT * FROM rent_cars WHERE car_type = '1'");
                            while($car = $carResult->fetch_assoc()) {
                                echo "
                                    <div class='tab'>
                                        <span class='tabName'>".$car['name']."</span>
                                        <br />
                                        <a href='/img/cars/big/".$car['photo']."' class='strip' data-strip-caption='".$car['name']."'><img src='/img/cars/small/".$car['preview']."' class='transition' /></a>
                                        <br /><br />
                                        <div class='text-left'>
                                            <b>Год выпуска:</b>&nbsp;".$car['year']."
                                            <br />
                                            <b>Тип двигателя:</b>&nbsp;".$car['engine']."
                                            <br />
                                            <b>Тип трансмиссии:</b>&nbsp;".$car['transmission']."
                                            <br />
                                            <b>Расход:</b>&nbsp;".$car['consumption']."
                                            <br />
                                            <b>Тип кузова:</b>&nbsp;".$car['body']."
                                            <br /><br />
                                            <b>Цена за 1 час, руб:</b>&nbsp;".$car['1_hour']."
                                            <br />
                                            <b>Цена за 1 сутки, руб:</b>&nbsp;".$car['1_day']."
                                            <br />
                                            <b>Цена за 2 суток, руб:</b>&nbsp;".$car['2_days']."
                                            <br />
                                            <b>Цена за 3-10 суток, руб:</b>&nbsp;".$car['3_10_days']."
                                            <br />
                                            <b>Цена за 10-20 суток, руб:</b>&nbsp;".$car['10_20_days']."
                                            <br />
                                            <b>Цена за 20-30 суток, руб:</b>&nbsp;".$car['20_30_days']."
                                            <br /><br />
                                            <span>* Минимальный срок аренды: ".$car['min_term']."</span>
                                        </div>
                                        <br /><br />
                                        <a href='/cars/".$car['url']."'><div class='promoButton transition'>Подробнее <i class='fa fa-angle-double-right' aria-hidden='true'></i></div></a>
                                    </div>
                                ";
                            }

                            $busCountResult = $mysqli->query("SELECT COUNT(id) FROM rent_cars WHERE car_type = '2'");
                            $busCount = $busCountResult->fetch_array(MYSQLI_NUM);

                            if($busCount[0] > 0) {
                                echo "
                                    <br /><br /><br /><br />
                                    <span class='headerFont'>Микроавтобусы</span>
                                    <br /><br />
                                ";

                                $carResult = $mysqli->query("SELECT * FROM rent_cars WHERE car_type = '2'");
                                while($car = $carResult->fetch_assoc()) {
                                    echo "
                                        <div class='tab'>
                                            <span class='tabName'>".$car['name']."</span>
                                            <br />
                                            <a href='/img/cars/big/".$car['photo']."' class='strip' data-strip-caption='".$car['name']."'><img src='/img/cars/small/".$car['preview']."' class='transition' /></a>
                                            <br /><br />
                                            <div class='text-left'>
                                                <b>Год выпуска:</b>&nbsp;".$car['year']."
                                                <br />
                                                <b>Тип двигателя:</b>&nbsp;".$car['engine']."
                                                <br />
                                                <b>Тип трансмиссии:</b>&nbsp;".$car['transmission']."
                                                <br />
                                                <b>Расход:</b>&nbsp;".$car['consumption']."
                                                <br />
                                                <b>Тип кузова:</b>&nbsp;".$car['body']."
                                                <br /><br />
                                                <b>Цена за 1 час, руб:</b>&nbsp;".$car['1_hour']."
                                                <br />
                                                <b>Цена за 1 сутки, руб:</b>&nbsp;".$car['1_day']."
                                                <br />
                                                <b>Цена за 2 суток, руб:</b>&nbsp;".$car['2_days']."
                                                <br />
                                                <b>Цена за 3-10 суток, руб:</b>&nbsp;".$car['3_10_days']."
                                                <br />
                                                <b>Цена за 10-20 суток, руб:</b>&nbsp;".$car['10_20_days']."
                                                <br />
                                                <b>Цена за 20-30 суток, руб:</b>&nbsp;".$car['20_30_days']."
                                                <br /><br />
                                                <span>* Минимальный срок аренды: ".$car['min_term']."</span>
                                            </div>
                                            <br /><br />
                                            <a href='/cars/".$car['url']."'><div class='promoButton transition'>Подробнее <i class='fa fa-angle-double-right' aria-hidden='true'></i></div></a>
                                        </div>
                                    ";
                                }
                            }
                        }

                        if($url[0] == "apartments") {
                            echo "
                                <span class='headerFont'>Квартиры</span>
                                <br /><br />
                            ";

                            $apartmentResult = $mysqli->query("SELECT * FROM rent_apartments");
                            while($apartment = $apartmentResult->fetch_assoc()) {
                                echo "
                                    <div class='tab'>
                                        <span class='tabName'>".$apartment['name']."</span>
                                        <br />
                                        <a href='/img/apartments/big/".$apartment['photo']."' class='strip' data-strip-caption='".$car['name']."'><img src='/img/apartments/small/".$apartment['preview']."' class='transition' /></a>
                                        <br /><br />
                                        <div class='text-left'>
                                            <b>Количество комнат:</b>&nbsp;".$apartment['rooms']."
                                            <br />
                                            <b>Количество спальных мест:</b>&nbsp;".$apartment['sleeping_areas']."
                                            <br />
                                            <b>Бытовая техника:</b>&nbsp;".$apartment['appliances']."
                                            <br />
                                            <b>Wi-Fi:</b>&nbsp;"; if($apartment['wifi'] == 1) {echo "есть";} else {echo "нет";} echo "
                                            <br /><br />
                                            <b>Цена за 1 сутки, руб:</b>&nbsp;".$apartment['price']."
                                        </div>
                                        <br /><br />
                                        <a href='/apartments/".$apartment['url']."'><div class='promoButton transition'>Подробнее <i class='fa fa-angle-double-right' aria-hidden='true'></i></div></a>
                                    </div>
                                ";
                            }
                        }
                        break;
                    case "good":
                        if($url[0] == "cars") {

                        }

                        if($url[0] == "apartments") {

                        }
                        break;
                    default:
                        break;
                }
            ?>
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
            <div style="float: left;">Аренда &laquo;У ПАЛЫЧА&raquo; &copy; 2014 - <?= date('Y') ?></div>
            <div style="float: right;">Создание сайта: <a href="https://airlab.by/" style="color: #cfcfcf;"><span class="maker transition">airlab</span></a></div>
            <div class="clear"></div>
            <br /><br />
        </div>
    </div>
</body>

</html>
