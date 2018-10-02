function changeCarType() {
    const carType = $("#typeSelect").val();

    if(carType === "2") {
        $("#placesInputContainer").css("display", "block");
        $("#textInputContainer").css("display", "block");
    } else {
        $("#placesInputContainer").css("display", "none");
        $("#textInputContainer").css("display", "none");
    }
}

function addCar() {
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
                                                                                        if(carType === "1" || (carType === "2" && (description !== '' && description !== "<p><br></p>"))) {
                                                                                            $.ajax({
                                                                                                type: "POST",
                                                                                                data: formData,
                                                                                                dataType: "json",
                                                                                                processData: false,
                                                                                                contentType: false,
                                                                                                url: "/scripts/admin/cars/ajaxAddCar.php",
                                                                                                beforeSend: function () {
                                                                                                    $.notify("Автомобиль добавляется...", "info");
                                                                                                },
                                                                                                success: function (response) {
                                                                                                    switch(response) {
                                                                                                        case "ok":
                                                                                                            $.notify("Автомобиль был успешно добавлен.", "success");

                                                                                                            setTimeout(function () {
                                                                                                                window.location.href = "/admin/cars";
                                                                                                            }, 2000);
                                                                                                            break;
                                                                                                        case "failed":
                                                                                                            $.notify("В процессе добавления автомобиля произошла ошибка. Попробуйте снова.", "error");
                                                                                                            break;
                                                                                                        case "photo":
                                                                                                            $.notify("Вы выбрали основную фотографию недопустимого формата.", "error");
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
                                                                                $.notify("Вы не ввели стоимость аренды за 10_20 дней за 500 км.", "error");
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
}