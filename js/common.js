$(window).on("scroll", function () {
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
});

$(window).on("load", function () {
	$(".footerContacts").width(parseInt($(".wide").width() - $(".footerLogo").width()));
});

$(function() {
    $("body").css({padding:0,margin:0});

    const f = function() {
        $(".ndra-container").css({position:"relative"});

        const h1 = $("body").height();
        const h2 = $(window).height();
        const d = h2 - h1;
        const ruler = $("<div>").appendTo(".ndra-container");

        let h = $(".ndra-container").height() + d;

        h = Math.max(ruler.position().top, h);

        ruler.remove();

        $(".ndra-container").height(h);
    };

    setInterval(f, 1000);

    $(window).resize(f);

    f();
});

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