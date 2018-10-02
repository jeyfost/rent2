function editCar() {
    const id = $("#carSelect").val();
    const name = $("#nameInput").val();
    const url = $("#urlInput").val();
    const carType = $("#typeSelect").val();
    const year = $("#yearInput").val();
    const engine = $("#engineInput").val();
    const consumption = $("#consumptionInput").val();
    const transmission = $("#transmissionInput").val();
    const body = $("#bodyInput").val();
    const hour_1 = $("#1_hourInput").val();
    const day_1 = $("#1_dayInput").val();
    const days_2 = $("#2_daysInput").val();
    const days_3_10 = $("#3_10_daysInput").val();
    const days_10_20 = $("#10_20_daysInput").val();
    const days_20_30 = $("#20_30_daysInput").val();
    const max_day_1 = $("#max_1_dayInput").val();
    const max_days_2 = $("#max_2_daysInput").val();
    const max_days_3_10 = $("#max_3_10_daysInput").val();
    const max_days_10_20 = $("#max_10_20_daysInput").val();
    const max_days_20_30 = $("#max_20_30_daysInput").val();
    const min_term = $("#minTermInput").val();

    const formData = new FormData($("#carsForm").get(0));

    if(carType === "2") {
        var description = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
        formData.append("description", description);

        const places = $("#placesInput").val();

        if(places !== "") {
            var placesCheck = "ok";
        } else {
            var placesCheck = "empty";
        }
    } else {
        var placesCheck = "ok";
    }

    if(id !== "") {
        if(name !== "") {
            if(url !== "") {
                if(carType !== "") {
                    if(placesCheck === "ok") {
                        if(year !== "") {
                            if(engine !== "") {
                                if(consumption !== "") {
                                    if(transmission !== "") {
                                        if(body !== "") {
                                            if(hour_1 !== "") {
                                                if(day_1 !== "") {
                                                    if(days_2 !== "") {
                                                        if(days_3_10 !== "") {
                                                            if(days_10_20 !== "") {
                                                                if(days_20_30 !== "") {
                                                                    if(max_day_1 !== "") {
                                                                        if(max_days_2 !== "") {
                                                                            if(max_days_3_10 !== "") {
                                                                                if(max_days_10_20 !== "") {
                                                                                    if(max_days_20_30 !== "") {
                                                                                        if(min_term !== "") {
                                                                                            if(carType === "1" || (carType === "2" && (description !== '' && description !== '<p><br></p>'))) {
                                                                                                $.ajax({
                                                                                                    type: "POST",
                                                                                                    data: formData,
                                                                                                    processData: false,
                                                                                                    contentType: false,
                                                                                                    dataType: "json",
                                                                                                    url: "/scripts/admin/cars/ajaxEditCar.php",
                                                                                                    beforeSend: function() {
                                                                                                        $.notify("Идёт редактирование информации об автомобиле...", "info");
                                                                                                    },
                                                                                                    success: function (response) {
                                                                                                        switch(response) {
                                                                                                            case "ok":
                                                                                                                $.notify("Информация была успешно изменена.", "success");

                                                                                                                setTimeout(function () {
                                                                                                                    window.location.href = "/admin/cars/?id=" + id;
                                                                                                                }, 2000);
                                                                                                                break;
                                                                                                            case "failed":
                                                                                                                $.notify("В процессе обновления информации произошла ошибка. Попробуйте снова.", "error");
                                                                                                                break;
                                                                                                            case "photo":
                                                                                                                $.notify("Вы выбрали основную фотографию недопустимого формата.", "error");
                                                                                                                break;
                                                                                                            case "photo upload":
                                                                                                                $.notify("При загрузке основной фотографии произошла ошибка.", "error");
                                                                                                                break;
                                                                                                            case "photos":
                                                                                                                $.notify("Одна или несколько дополнительных фотографий имеют недопустимый формат.", "error");
                                                                                                                break;
                                                                                                            case "photos upload":
                                                                                                                $.notify("При загрузке дополнительных фотографий произошла ошибка.", "error");
                                                                                                                break;
                                                                                                            case "url":
                                                                                                                $.notify("Такой идентификатор уже существует.", "error");
                                                                                                                break;
                                                                                                            default:
                                                                                                                $.notify(response, "warn");
                                                                                                                break;
                                                                                                        }
                                                                                                    }
                                                                                                });
                                                                                            } else {
                                                                                                $.notify("Вы не ввели краткое описание.", "error");
                                                                                            }
                                                                                        } else {
                                                                                            $.notify("Вы не ввели минимальный срок аренды.", "error");
                                                                                        }
                                                                                    } else {
                                                                                        $.notify("Вы не ввели стоимость аренды за 20-30 дней за 500 км.", "error");
                                                                                    }
                                                                                } else {
                                                                                    $.notify("Вы не ввели стоимость аренды за 10-20 дней за 500 км.", "error");
                                                                                }
                                                                            } else {
                                                                                $.notify("Вы не ввели стоимость аренды за 3-10 дней за 500 км.", "error");
                                                                            }
                                                                        } else {
                                                                            $.notify("Вы не ввели стоимость аренды за 2 дня за 500 км.", "error")
                                                                        }
                                                                    } else {
                                                                        $.notify("Вы не ввели стоимость аренды за 1 день за 500 км.", "error");
                                                                    }
                                                                } else {
                                                                    $.notify("Вы не ввели стоимость аренды за 20-30 дней за 250 км.", "error");
                                                                }
                                                            } else {
                                                                $.notify("Вы не ввели стоимость аренды за 10-20 дней за 250 км.", "error");
                                                            }
                                                        } else {
                                                            $.notify("Вы не ввели стоимость аренды за 3-10 дней за 250 км.", "error");
                                                        }
                                                    } else {
                                                        $.notify("Вы не ввели стоимость аренды за 2 дня за 250 км.", "error");
                                                    }
                                                } else {
                                                    $.notify("Вы не ввели стоимость аренды за 1 день за 250 км.", "error");
                                                }
                                            } else {
                                                $.notify("Вы не ввели стоимость аренды за 1 час.", "error");
                                            }
                                        } else {
                                            $.notify("Вы не ввели тип кузова.", "error");
                                        }
                                    } else {
                                        $.notify("Вы не ввели тип коробки передач.", "error");
                                    }
                                } else {
                                    $.notify("Вы не средний расход топлива.", "error");
                                }
                            } else {
                                $.notify("Вы не ввели тип двигателя.", "error");
                            }
                        } else {
                            $.notify("Вы не ввели год выпуска автомобиля.", "error");
                        }
                    } else {
                        $.notify("Вы не ввели количество мест в автомобиле.", "error");
                    }
                } else {
                    $.notify("Вы не выбрали тип автомобиля.", "error");
                }
            } else {
                $.notify("Вы не ввели идентификатор.", "error");
            }
        } else {
            $.notify("Вы не ввели марку и модель (название) автомобиля.", "error");
        }
    } else {
        $.notify("Вы не выбрали автомобиль для редактирования.", "error");
    }
}

function loadCarDescription(id) {
    $.ajax({
        type: "POST",
        data: {"id": id},
        url: "/scripts/admin/cars/ajaxLoadDescription.php",
        success: function(response) {
            CKEDITOR.instances["textInput"].setData(response);
        }
    });
}

function deleteCarPhoto(photoID, carID) {
    if(confirm("Вы действительно хотите удалить эту фотографию?")) {
        $.ajax({
            type: "POST",
            data: {
                "photoID": photoID,
                "carID": carID
            },
            url: "/scripts/admin/cars/ajaxDeleteCarPhoto.php",
            beforeSend: function() {
                $.notify("Фотография удаляется...", "info");
            },
            success: function (response) {
                switch(response) {
                    case "ok":
                        $.notify("Фотография была успешно удалена.", "success");

                        setTimeout(function () {
                            window.location.href = "/admin/cars/?id=" + carID;
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При удалении фотографии произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "photo":
                        $.notify("Фотографии с таким идентификатором у выбранного автомобиля не существует.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        break;
                }
            }
        });
    }
}

function deleteCar() {
    if(confirm("Выдействительно хотите удалить этот автомобиль?")) {
        const formData = new FormData($("#carsForm").get(0));

        $.ajax({
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            url: "/scripts/admin/cars/ajaxDeleteCar.php",
            beforeSend: function () {
                $.notify("Автомобиль удаляется...", "info")
            },
            success: function (response) {
                switch (response) {
                    case "ok":
                        $.notify("Автомобиль был успешно удалён.", "success");

                        setTimeout(function() {
                            window.location.href = "/admin/cars";
                        }, 2000);
                        break;
                    case "failed":
                        $.notify("При удалении автомобиля произошла ошибка. Попробуйте снова.", "error");
                        break;
                    case "car":
                        $.notify("Автомобиль с указанным идентификатором не найден.", "error");
                        break;
                    default:
                        $.notify(response, "warn");
                        console.log(response);
                        break;
                }
            }
        });
    }
}