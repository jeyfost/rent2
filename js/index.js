$(window).on("load", function () {
    $("#start").offset({top: $(window).height()});

    const diff = parseInt(($("#start").height() - $(".greetingsContainer p").height()) / 2);
    $(".greetingsContainer").offset({top: parseInt($("#start").offset().top + diff)});

    $("#services").offset({top: parseInt($("#start").height() + $("#start").offset().top + 80)});
    $("#advantages").offset({top: parseInt($("#services").height() + $("#services").offset().top + 80)});
    $("#map").offset({top: parseInt($("#advantages").height() + $("#advantages").offset().top + 80)});
    $("#footer").offset({top: parseInt($("#map").height() + $("#map").offset().top )});

    const gc = parseInt($(".greetingsContainer").offset().top + $(".greetingsContainer").height());
    const st = parseInt($("#start").offset().top + $("#start").height());

    if(gc > st) {
        console.log(11111);
        $("#start").height(parseInt($("#start").height() + parseInt(gc - st)));
    }
});

$(window).on("scroll", function () {
    if($(window).width() >= 768) {
        if($(window).scrollTop() > 10) {
            $(".menu").attr("name", "white");

            $(".menu").css("background-color", "#fff");
            $(".menu").css("box-shadow", "0 5px 6px -4px rgba(0, 0, 0, 0.3)");
            $(".logo a img").attr("src", "/img/system/logo_orange.png");
            $(".menuPhone a").css("color", "#333");

            $("#mainPointName").css("color", "#333");
            $("#carsPointName").css("color", "#333");
            $("#apartmentsPointName").css("color", "#333");
            $("#reviewsPointName").css("color", "#333");
            $("#contactsPointName").css("color", "#333");
        } else {
            $(".menu").attr("name", "");

            $(".menu").css("background-color", "transparent");
            $(".menu").css("box-shadow", "none");
            $(".logo a img").attr("src", "/img/system/logo.png");
            $(".menuPhone a").css("color", "#fff");

            $("#mainPointName").css("color", "#fff");
            $("#carsPointName").css("color", "#fff");
            $("#apartmentsPointName").css("color", "#fff");
            $("#reviewsPointName").css("color", "#fff");
            $("#contactsPointName").css("color", "#fff");
        }
    }
});

function phoneHover(action) {
    if(action === 1) {
        $(".menuPhone a").css("color", "#ffca00");
    } else {
        if($(".menu").attr("name") === "white") {
            $(".menuPhone a").css("color", "#333");
        } else {
            $(".menuPhone a").css("color", "#fff");
        }
    }
}

function pointHover(line, text, action) {
    if(action === 1) {
        $("#" + line).css("background-color", "#ffca00");
        $("#" + text).css("color", "#ffca00");
    } else {
        $("#" + line).css("background-color", "transparent");

        if($(".menu").attr("name") === "white") {
            $("#" + text).css("color", "#333");
        } else {
            $("#" + text).css("color", "#fff");
        }
    }
}