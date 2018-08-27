$(window).on("load", function () {
	$(".footerContacts").width(parseInt($(".wide").width() - $(".footerLogo").width()));
});

$(window).on("scroll", function () {
    if($(window).scrollTop() > 10) {
        $(".menuInner").css("position", "fixed");
        $(".menuInner").css("top", "0");
        $(".menuInner").css("left", "0");
        $(".ndra-container").css("margin-top", "90px");
    } else {
        $(".menuInner").css("position", "absolute");
        $(".ndra-container").css("margin-top", "90px");
    }
});

$(function() {
    const f = function () {
        const c = parseInt($(".ndra-container").offset().top + $(".ndra-container").height());
        const fp = parseInt($(window).height() - $("#footer").height());

        if($("#footer").offset().top < fp) {
            let h = parseInt(fp - c);
            $(".ndra-container").height(parseInt($(".ndra-container").height() + h));
            $(".footerContacts").width(parseInt($(".wide").width() - $(".footerLogo").width()));
        }
    };

    setInterval(f, 1000);
});

function pointInnerHover(line, text, action) {
    if(action === 1) {
        $("#" + line).css("background-color", "#ffca00");
        $("#" + text).css("color", "#ffca00");
    } else {
        $("#" + line).css("background-color", "#fff");
        $("#" + text).css("color", "#333");
    }
}