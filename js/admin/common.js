$(window).on("load", function () {
    if($('*').is($('#leftMenu'))) {
        if($('#leftMenu').height() < parseInt($(window).height() - $('#topLine').height())) {
            $('#leftMenu').height(parseInt($(window).height() - $('#topLine').height()));
        }
    }

    if($('*').is($('#content'))) {
        $('#content').width(parseInt($(window).width() - $('#leftMenu').width() - 130));
    }
});

$(window).on("resize", function () {
    if($('*').is($('#leftMenu'))) {
        if($('#leftMenu').height() < parseInt($(window).height() - $('#topLine').height())) {
            $('#leftMenu').height(parseInt($(window).height() - $('#topLine').height()));
        }
    }

    if($('*').is($('#content'))) {
        $('#content').width(parseInt($(window).width() - $('#leftMenu').width() - 130));
    }
});

function buttonHover(id, action) {
    if(action === 1) {
        document.getElementById(id).style.backgroundColor = "#ffdb54";
    } else {
        document.getElementById(id).style.backgroundColor = "#dedede";
    }
}

function exit() {
    $.ajax({
        type: "POST",
        url: "/scripts/admin/ajaxExit.php",
        success: function () {
            window.location.href = "../";
        }
    });
}