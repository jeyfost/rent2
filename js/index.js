$(window).on("load", function () {
    $("#start").offset({top: $(window).height()});

    const diff = parseInt(($("#start").height() - $(".greetingsContainer p").height()) / 2);
    $(".greetingsContainer").offset({top: parseInt($("#start").offset().top + diff)});

    $("#services").offset({top: parseInt($("#start").height() + $("#start").offset().top + 80)});
    $("#advantages").offset({top: parseInt($("#services").height() + $("#services").offset().top + 80)});
    $("#map").offset({top: parseInt($("#advantages").height() + $("#advantages").offset().top + 80)});
    $("#footer").offset({top: parseInt($("#map").height() + $("#map").offset().top )});
});