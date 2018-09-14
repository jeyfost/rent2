function loadApartmentDescription(id) {
    $.ajax({
        type: "POST",
        data: {"id": id},
        url: "/scripts/admin/apartments/ajaxLoadDescription.php",
        success: function(response) {
            CKEDITOR.instances["textInput"].setData(response);
        }
    });
}

function deleteApartmentPhoto(photoID, apartmentID) {
    if(confirm("Вы действительно хотите удалить эту фотографию?")) {
        $.ajax({
            type: "POST",
            data: {
                "photoID": photoID,
                "apartmentID": apartmentID
            },
            url: "/scripts/admin/apartments/ajaxDeleteApartmentPhoto.php",
            beforeSend: function() {
                $.notify("Фотография удаляется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Фотография была успешно удалена.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/apartments/?id=" + apartmentID;
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При удалении фотографии произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "photo":
                        $.notify("Фотографии с таким идентификатором у выбранной квартиры не существует.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}

function editApartment() {
    const id = $("#apartmentSelect").val();
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

    if(id !== "") {
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
                                            url: "/scripts/admin/apartments/ajaxEditApartment.php",
                                            beforeSend: function () {
                                                $.notify("Информация о квартире обновляется...", "info");
                                            },
                                            success: function (response) {
                                                switch(response) {
                                                    case "ok":
                                                        $.notify("Квартира успешно добавлена.", "success");

                                                        setTimeout(function () {
                                                            window.location.href = "/admin/apartments/?id=" + id;
                                                        }, 2000);
                                                        break;
                                                    case "failed":
                                                        $.notify("В процессе добавления квартиры произошла ошибка. Попробуйте снова.", "error");
                                                        break;
                                                    case "photo":
                                                        $.notify("Выбранная основная фотография имеет недопустимый формат.", "error");
                                                        break;
                                                    case "photo upload":
                                                        $.notify("В процессе загрузки основной фотографии произошла ошибка.", "error");
                                                        break;
                                                    case "photos":
                                                        $.notify("Одна или несколько дополнительных фотографий имеют недопустимый формат.", "error");
                                                        break;
                                                    case "photos upload":
                                                        $.notify("Во время загрузки дополнительных фотографий произошла ошибка.", "error");
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
    } else {
        $.notify("Вы не выбрали квартиру.", "error");
    }
}

function deleteApartment() {
    if(confirm("Вы действительно хотите удалить эту квартиру?")) {
        const formData = new FormData($("#apartmentsForm").get(0));

        $.ajax({
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            url: "/scripts/admin/apartments/ajaxDeleteApartment.php",
            beforeSend: function() {
                $.notify("Квартира удаляется...", "info");
            },
            success: function(response) {
                switch(response) {
                    case "ok":
                        $.notify("Квартира была успешно удалена.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/apartments";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("В процессе удаления квартиры произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "id":
                        $.notify("Квартиры с таким идентификатором не существует.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}