function addApartment() {
    const name = $("#nameInput").val();
    const url = $("#urlInput").val();
    const rooms = $("#roomsInput").val();
    const sleeping_areas = $("#sleepingAreasInput").val();
    const appliances = $("#appliancesInput").val();
    const wifi = $("#wifiInput").val();
    const price = $("#priceInput").val();
    const description = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;

    const formData = new FormData($("#apartmentsForm").get(0));

    formData.append("text", description);

    if(name !== "") {
        if(url !== "") {
            if(rooms !== "") {
                if(sleeping_areas !== "") {
                    if(appliances !== "") {
                        if(wifi !== "") {
                            if(price !== "") {
                                if(description !== "" && description !== "<p><br></p>") {
                                    $.ajax({
                                        type: "POST",
                                        data: formData,
                                        dataType: "json",
                                        processData: false,
                                        contentType: false,
                                        url: "/scripts/admin/apartments/ajaxAddApartment.php",
                                        beforeSend: function () {
                                            $.notify("Квартира добавляется...", "info");
                                        },
                                        success: function (response) {
                                            switch(response) {
                                                case "ok":
                                                    $.notify("Квартира успешно добавлена.", "success");

                                                    setTimeout(function() {
                                                        window.location.href = "/admin/apartments";
                                                    }, 2000);
                                                    break;
                                                case "failed":
                                                    $.notify("В процессе добавления квартиры произошла ошибка. Попробуйте снова.", "error");
                                                    break;
                                                case "photo":
                                                    $.notify("Выбранная основная фотография имеет недопустимый формат.", "error");
                                                    break;
                                                case "photo empty":
                                                    $.notify("Вы не выбрали основную фотографию.", "error");
                                                    break;
                                                case "photos":
                                                    $.notify("Одна или несколько дополнительных фотографий имеют недопустимый формат.", "error");
                                                    break;
                                                case "photos upload":
                                                    $.notify("В процессе загрузки дополнительных фотографий произошла ошибка. Попробуйте снова.", "error");
                                                    break;
                                                case "url":
                                                    $.notify("Квартира с указанным идентификатором уже существует.", "error");
                                                    break;
                                                default:
                                                    $.notify(response, "warn");
                                                    break;
                                            }
                                        }
                                    });
                                } else {
                                    $.notify("Вы не ввели описание квартиры.", "error");
                                }
                            } else {
                                $.notify("Вы не ввели стоимость аренды за 1 сутки.", "error");
                            }
                        } else {
                            $.notify("Вы не указали наличие Wi-Fi.", "error");
                        }
                    } else {
                        $.notify("Вы не перечислили бытовую технику.", "error");
                    }
                } else {
                    $.notify("Вы не ввели количество спальных мест.", "error");
                }
            } else {
                $.notify("Вы не ввели количество комнат.", "error");
            }
        } else {
            $.notify("Вы не ввели идентификатор квартиры.", "error");
        }
    } else {
        $.notify("Вы не ввели название квартиры.", "error");
    }
}