/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });


var graphicsCvaize = {
    //Переменные
    var: {
        //Заготовки
        templates: {
            modals: {
                title: function (title) {
                    return '<h4 class="modal__title">' + ((title) ? title : '') + '</h4>'
                },
                description: function (description) {
                    return '<p class="modal__description">' + ((description) ? description : '') + '</p>'
                },
                progress: function (c) {
                    return '<div class="progress modal__progress ' + ((c) ? c : '') + '"> <div class="indeterminate"></div> </div>'
                },
                btn: function (l, c, t) {
                    return '<a href="' + ((l) ? l : '') + '" class="' + ((c) ? c : '') + '">' + ((t) ? t : '') + '</a>';
                },
                button: function (c, t) {
                    return '<button type="submit" class="' + ((c) ? c : '') + '">' + ((t) ? t : '') + '</button>';
                }
            },
            forms: {
                inputDel: function (n, v) {
                    return '<input type="hidden" name="' + ((n) ? n : '') + '" value="' + ((v) ? v : '') + '">';
                },
                input: function () {
                    return '<div class="row"><div class="input-field col s6"><input placeholder="Placeholder" id="first_name" type="text" class="validate"><label for="first_name">First Name</label></div></div>';
                },
                marker: function (n) {
                    return '<div class="data-form-type" data-type="' + ((n) ? n : '') + '" style="display: none!important;"></div>';
                },
                select: function () {
                    return '';
                }
            }
        },
        //Хранилище данных
        state: {
            // target:[{
            //     data_status: '-',
            //     data_type: '-',
            //     data_selector: '-'
            // }]
        },
        timeout: {
            modal: null,
            add_time_line: null,
            convertLCinit: null
        }
    },
    helpers: {
        translit: {
            arrru: [' ', 'Я', 'я', 'Ю', 'ю', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ж', 'ж', 'А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ы', 'ы', 'Ь', 'ь', 'Ъ', 'ъ', 'Э', 'э'],
            arren: ['_', 'Ya', 'ya', 'Yu', 'yu', 'Ch', 'ch', 'Sh', 'sh', 'Sh', 'sh', 'Zh', 'zh', 'A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'E', 'e', 'Z', 'z', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'F', 'f', 'H', 'h', 'C', 'c', 'Y', 'y', '`', '`', '\'', '\'', 'E', 'e'],
            cyrill_to_latin: function (text) {
                for (var i = 0; i < graphicsCvaize.helpers.translit.arrru.length; i++) {
                    var reg = new RegExp(graphicsCvaize.helpers.translit.arrru[i], "g");
                    text = text.replace(reg, graphicsCvaize.helpers.translit.arren[i]);
                }
                return text;
            },
            latin_to_cyrill: function (text) {
                for (var i = 0; i < graphicsCvaize.helpers.translit.arren.length; i++) {
                    var reg = new RegExp(graphicsCvaize.helpers.translit.arren[i], "g");
                    text = text.replace(reg, graphicsCvaize.helpers.translit.arrru[i]);
                }
                return text;
            },
            cl: function (text) {
                return graphicsCvaize.helpers.translit.cyrill_to_latin(text);
            },
            lc: function (text) {
                return graphicsCvaize.helpers.translit.latin_to_cyrill(text);
            }
        },
        colorRandom: function () {
            this.letters = '0123456789ABCDEF'.split('');
            this.color = '#';
            for (this.i = 0; this.i < 6; this.i++) {
                this.color += this.letters[Math.round(Math.random() * 15)];
            }
            return this.color;
        },
        remove: function () {
            console.log(this);
        }
    },
    // Функция обновляющая состояние, в частности удаляет все элементы находящиеся в очереди на удаление
    // updateState: function () {
    //     console.log(graphicsCvaize.var.state.target);
    //     for( graphicsCvaize.var.i = 0; graphicsCvaize.var.i < graphicsCvaize.var.state.target.length; graphicsCvaize.var.i++ ){
    //         console.log(graphicsCvaize.var.state.target[graphicsCvaize.var.i]);
    //         switch (graphicsCvaize.var.state.target[graphicsCvaize.var.i].data_type) {
    //             case 'delete':
    //                 $(graphicsCvaize.var.state.target[graphicsCvaize.var.i].data_selector).remove();
    //                 break;
    //             default:
    //                 console.log("default");
    //         }
    //     }
    //     while (graphicsCvaize.var.state.target.length) {
    //         graphicsCvaize.var.state.target.pop();
    //     }
    //
    // },
    //Функции относящиеся к модальным окнам
    modalsFun: {
        //Функция формирует модальные окна удаления
        del: function (target, id, name) {

            graphicsCvaize.modalsFun.clearModal();

            switch (target) {
                case 'device':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Удалить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description('Устройство "' + name + '".'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('DELETE'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn red modal__target', 'Удалить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white green btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                case 'typeofdata':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Удалить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description('Тип данных "' + name + '".'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('DELETE'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn red modal__target', 'Удалить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white green btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                case 'data':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Удалить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description('Данные ' + name + '.'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('DELETE'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn red modal__target', 'Удалить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white green btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                case 'all_data':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Удалить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description(name));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('DELETE'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn red modal__target', 'Удалить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white green btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                case 'timegraphic':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Удалить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description('График "' + name + '".'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('DELETE'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn red modal__target', 'Удалить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white green btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                default:
                    console.log("default");
            }
        },
        add: function (target, id, name) {


            graphicsCvaize.modalsFun.clearModal();

            switch (target) {
                case 'data':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Добавить?'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description(name));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('rol', 'demo'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('POST'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn green modal__target', 'Добавить'));
                    $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white red btn', 'Отменить'));

                    $('#modal-all').modal('open');
                    break;
                default:
                    console.log("default");
            }
        },
        // update: function (target) {
        //
        //     graphicsCvaize.modalsFun.clearModal();
        //
        //     switch (target) {
        //         case 'data':
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Изменить данные'));
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress());
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.input());
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('device_id', $('.meta.device_id').val()));
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('type_id', $('.meta.type_id').val()));
        //             $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('PUT'));
        //             $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.button('modal-action waves-effect waves-white btn green modal__target', 'Изменить'));
        //             $('#modal-all .modal-footer').append(graphicsCvaize.var.templates.modals.btn('#!', 'modal-action modal-close waves-effect waves-white red btn', 'Отменить'));
        //
        //             $('#modal-all').modal('open');
        //             break;
        //         default:
        //             console.log("default");
        //     }
        // },
        showToken: function (target, id, name) {

            graphicsCvaize.modalsFun.clearModal();

            switch (target) {
                case 'device':
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.title('Токен "' + name + '"'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.progress('active'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.modals.description('получение...'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('id', id));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('target', target));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.inputDel('get', 'token'));
                    $('#modal-all .modal-content').append(graphicsCvaize.var.templates.forms.marker('GET'));

                    $('#modal-all').modal('open');
                    $(".form-all").submit();
                    break;
                default:
                    console.log("default");
            }

        },
        // Фукция очищающая модальное окно
        clearModal: function () {
            $('#modal-all .modal-content').empty();
            $('#modal-all .modal-footer').empty();
        }
    },
    // Функция обработчик нажатия на кнопки вызова модальных окон
    modal_trigger: function () {
        graphicsCvaize.this = this;
        // console.log(this);
        clearTimeout(graphicsCvaize.var.timeout.modal);
        graphicsCvaize.var.timeout.modal = setTimeout(function () {
            switch ($(graphicsCvaize.this).data('type')) {
                case 'del':
                    graphicsCvaize.modalsFun.del($(graphicsCvaize.this).data('target'), $(graphicsCvaize.this).data('id'), $(graphicsCvaize.this).data('name'));
                    break;
                // case 'update':
                //     graphicsCvaize.modalsFun.update($(graphicsCvaize.this).data('target'));
                //     break;
                case 'add':
                    graphicsCvaize.modalsFun.add($(graphicsCvaize.this).data('target'), $(graphicsCvaize.this).data('id'), $(graphicsCvaize.this).data('name'));
                    break;
                case 'showToken':
                    graphicsCvaize.modalsFun.showToken($(graphicsCvaize.this).data('target'), $(graphicsCvaize.this).data('id'), $(graphicsCvaize.this).data('name'));
                    break;
                default:

            }
        }, 0);

        return false;
    },
    generateUUID: function () {
        var d = new Date().getTime();

        if (window.performance && typeof window.performance.now === "function") {
            d += performance.now();
        }

        var uuid = 'xxxxxxxxxxxxxxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = (d + Math.random() * 16) % 16 | 0;
            d = Math.floor(d / 16);
            return (c == 'x' ? r : (r & 0x3 | 0x8)).toString(16);
        });

        return uuid;
    },
    refreshToken: function (input, btn) {
        if ($('*').is(input) && $('*').is(btn)) {
            if ($(input).val().length === 0) {
                $(input).val(graphicsCvaize.generateUUID());
            }
            $(btn).click(function () {
                $(input).val(graphicsCvaize.generateUUID());
            });
        }
    },
    //Функция отправки данных для методов CRUD
    submit: function () {
        $(".form-all, .form-graphic").on("submit", function (event) {
            event.preventDefault();

            if ($(this).find('*').is('.required')) {
                graphicsCvaize.r = false;
                $(this).find('*.required:not(div)').each(function (index) {
                    if ($(this).val() == null || $(this).val().length === 0) {
                        graphicsCvaize.r = true;
                        Materialize.toast($(this).data('required'), 3000, 'rounded red');
                    }
                });
                if (graphicsCvaize.r) {
                    return false;
                }

            }

            $.ajax({
                type: $(this).find('.data-form-type').data('type'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                // dataType: 'json',
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                beforeSend: function () {
                    $(".form-all .modal__progress").addClass('active');
                },
                complete: function () {
                },
                success: function (j) {
                    console.log(j);
                    graphicsCvaize.callback(j)
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    setTimeout(function () {
                        $(".form-all .modal__progress").removeClass('active');
                    }, 200);
                    Materialize.toast('Что-то пошло не так!', 3000, 'rounded red');
                    setTimeout(function () {
                        $('#modal-all').modal('close');
                    }, 2000);
                }
            });
            return false;
        });

    },
    callback: function (j) {

        if (j.res === 'ok') {

            setTimeout(function () {
                $(".form-all .modal__progress").removeClass('active');
            }, 200);

            switch (j.callback.type) {
                case 'remove':

                    Materialize.toast(j.mes, 1000, 'rounded green');

                    $('.' + j.callback.name + '-' + j.callback.id).remove();

                    setTimeout(function () {
                        $('#modal-all').modal('close');
                    }, 500);

                    break;
                case 'showToken':

                    $('#modal-all .modal-content .modal__description').text(j.mes);
                    Materialize.toast('Токен получен!', 1000, 'rounded green');

                    break;
                case 'saveDevice':

                    Materialize.toast(j.mes, 3000, 'rounded green');
                    $(".form-all")[0].reset();
                    graphicsCvaize.refreshToken('#input-token', '.refresh-token');
                    $(".form-all #input-token").focus();
                    $(".form-all #input-name").focus();

                    break;
                case 'saveTypeOfDevice':

                    Materialize.toast(j.mes, 3000, 'rounded green');
                    $(".form-all")[0].reset();
                    $(".form-all #input-alias").focus();
                    $(".form-all #input-name").focus();

                    break;
                case 'notconfirmed':

                    Materialize.toast(j.mes, 3000, 'rounded red');

                    break;
                case 'confirmed':

                    Materialize.toast(j.mes, 3000, 'rounded green');

                    break;
                case 'add_demo_data':

                    Materialize.toast(j.mes, 1000, 'rounded green');
                    Materialize.toast('Обновите страницу.', 3000, 'rounded yellow');
                    setTimeout(function () {
                        $('#modal-all').modal('close');
                    }, 500);

                    break;
                case 'graphic_show':

                    j.callback.target.forEach(function (value) {
                        graphicsCvaize.graphics.create.formation(value.selector, value.data, value.title);
                        Materialize.toast(value.mes, 3000, 'rounded green');
                    });

                    break;
                default:

            }

        } else {
            Materialize.toast('Что-то пошло не так!', 3000, 'rounded red');
        }
    },
    //Инициализация функции конвертации кирилицы в латиницу
    convertLCinit: function (l, c) {
        $(c).keyup(function () {
            clearTimeout(graphicsCvaize.var.timeout.convertLCinit);
            graphicsCvaize.var.timeout.convertLCinit = setTimeout(function () {
                $(l).val(graphicsCvaize.helpers.translit.cl($(c).val()));
            }, 0);
        });
    },
    pages: {
        create: {
            time_graph: {
                add_line: {
                    f: function (s2, s3, s4) {
                        for (graphicsCvaize.i = 1; graphicsCvaize.i <= 100; graphicsCvaize.i++) {
                            if (!$('*').is(s3 + graphicsCvaize.i)) {
                                break;
                            }
                        }
                        graphicsCvaize.r = '';
                        $.each($(s4).data('value'), function (index, value) {
                            graphicsCvaize.r += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $(s2).append('<div class="row ' + (s3 + graphicsCvaize.i).replace(/\./g, "") + '"> <div class="input-field col s4"> <input placeholder="-" name="time_line[]" id="time_line-' + graphicsCvaize.i + '" type="text" value="" required=""> <label for="time_line-' + graphicsCvaize.i + '" class="active">Название линии</label> </div><div class="input-field col s4"> <select name="time_line[]" class="required" data-required="Выберите тип данных"> <option value="" disabled="" selected="">Выберите тип данных</option> ' + graphicsCvaize.r + ' </select> <label>Закрепление типа данных</label> </div><div class="input-field col s3"> <input placeholder="-" name="time_line[]" id="time_line_color-' + graphicsCvaize.i + '" type="text" class="inputColor" value="' + graphicsCvaize.helpers.colorRandom() + '" required=""> <label for="time_line_color-' + graphicsCvaize.i + '" class="active">Цвет</label> </div><div class="col s1"> <a class="waves-effect waves-light red btn" data-target="' + s3 + graphicsCvaize.i + '"  onclick="$($(this).data(\'target\')).remove();">Удалить</a> </div></div>');
                        $('select').material_select();
                        $('.inputColor').colorpicker({
                            horizontal: true
                        });

                    },
                    t: function (btn_target, box, selecter_item, data_types) {
                        $(btn_target).click(function (e) {
                            e.preventDefault();
                            clearTimeout(graphicsCvaize.var.timeout.add_time_line);
                            graphicsCvaize.var.timeout.add_time_line = setTimeout(graphicsCvaize.pages.create.time_graph.add_line.f(box, selecter_item, data_types), 0);
                            return false;
                        });


                    }
                }
            }
        }
    },
    graphics: {
        create: {
            formation: function (id, data, title) {
                Highcharts.setOptions({
                    lang: {
                        months: [
                            'Январь', 'Февраль', 'Март', 'Апрель',
                            'Май', 'Июнь', 'Июль', 'Август',
                            'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
                        ],
                        shortMonths: [ "Янв" , "Фев" , "Мар" , "Апр" , "Май" , "Июн" , "Июл" , "Авг" , "Сен" , "Окт" , "Ноя" , "Дек" ],
                        weekdays: [
                            'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
                            'Четверг', 'Пятница', 'Суббота'
                        ],
                        printChart: "Распечатать график",
                        downloadCSV: "Загрузить CSV",
                        downloadJPEG: "Загрузить изображение в формате JPEG",
                        downloadPDF: "Загрузить документ в формате PDF",
                        downloadPNG: "Загрузить изображение PNG",
                        downloadSVG: "Загрузить изображение в формате SVG"
                    }
                });
                Highcharts.stockChart(id, {
                    title: {
                        text: title
                    },
                    // time: {
                    //     // timezone: 'Europe/Moscow'
                    //     // useUTC: true
                    // },
                    yAxis: {
                        // labels: {
                        //     formatter: function () {
                        //         return (this.value > 0 ? ' + ' : '') + this.value + '';
                        //     }
                        // },
                        plotLines: [{
                            value: 0,
                            width: 2,
                            color: 'silver'
                        }]
                    },
                    // plotOptions: {
                    //     series: {
                    //         compare: 'percent',
                    //         showInNavigator: true
                    //     }
                    // },
                    legend: {
                        enabled: true,
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 60,
                        itemStyle: {padding: '10px'}
                    },
                    rangeSelector: {
                        buttons: [
                            {type: 'day', count: 1, text: '1д'},
                            {type: 'day', count: 3, text: '3д'},
                            {type: 'month', count: 1, text: '1м'},
                            {type: 'month', count: 3, text: '3м'},
                            {type: 'month', count: 6, text: '6м'},
                            {type: 'ytd', count: 1, text: 'YTD'},
                            {type: 'year', count: 1, text: '1г'},
                            {type: 'all', text: 'Всё'}
                        ],
                        selected: 0
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
                        valueDecimals: 2,
                        split: true
                    },

                    series: data
                });

            },
            target: function (selector_btn, selector_form) {

                $(selector_form).each(function (index, value) {
                    $(value).submit();
                });

                $(selector_btn).click(function () {
                    $(selector_form).each(function (index, value) {
                        $(value).submit();
                    });
                });

            }
        }
    },
    //Инициализирующая функция
    init: function () {
        $('select').material_select();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Сегодня',
            clear: 'Очистить',
            close: 'Ok',
            closeOnSelect: false, // Close upon selecting a date,
            // The title label to use for the month nav buttons
            labelMonthNext: 'Следующий месяц',
            labelMonthPrev: 'Прошлый месяц',

            // The title label to use for the dropdown selectors
            labelMonthSelect: 'Выберите месяц',
            labelYearSelect: 'Выберите год',
            format: 'dd-mm-yyyy',
            // Months and weekdays
            monthsFull: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
            monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
            weekdaysFull: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
            weekdaysShort: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            //
            // Materialize modified
            weekdaysLetter: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб']
        });
        // $('.timepicker').pickatime({
        //     default: 'now', // Set default time: 'now', '1:30AM', '16:30'
        //     fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
        //     twelvehour: false, // Use AM/PM or 24-hour format
        //     donetext: 'OK', // text for done-button
        //     cleartext: 'Очистить', // text for clear-button
        //     canceltext: 'Отменить', // Text for cancel-button
        //     autoclose: false, // automatic close timepicker
        //     ampmclickable: true, // make AM PM clickable
        //     aftershow: function(){} //Function for after opening timepicker
        // });
        $(".button-collapse").sideNav();
        $('.modal').modal();
        $('.tooltipped').tooltip({delay: 50});
        $('.collapsible').collapsible('open', 0);
        graphicsCvaize.refreshToken('#input-token', '.refresh-token');
        graphicsCvaize.convertLCinit('.data-auto-convert-cl-l', '.data-auto-convert-cl-c');
        $('.inputColor').colorpicker({
            horizontal: true
        });
        graphicsCvaize.pages.create.time_graph.add_line.t('.add_time_line', '.fields-lines', '.fields-line-', '.meta.types_data');
        $(".modal-trigger").click(graphicsCvaize.modal_trigger);


        //Вызов функции обработчика отправки данных через модальные формы
        graphicsCvaize.submit();
        graphicsCvaize.graphics.create.target('.createGraph', '.form-graphic');
    }
};
graphicsCvaize.init();
