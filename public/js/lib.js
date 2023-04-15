/////////////  SCHEDULE  /////////////
//
//
//
function activateTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

function getRoomHelperData() {
    const currentRoomsSelector  = '#room-helper #current-rooms';
    const upcomingRoomsSelector = '#room-helper #upcoming-rooms';

    let settings = {
        type: 'GET',
        dataType: 'json',
        url: '/room-helper',
        data: {},
        success: function(response) {
            let currentRooms        = response.currentRooms;
            let currentTimeslot     = response.currentTimeslot;
            let upcomingRooms       = response.upcomingRooms;
            let upcomingTimeslot    = response.upcomingTimeslot;

            $(currentRoomsSelector).html(currentRooms.join(', '));
            $(upcomingRoomsSelector).html(upcomingRooms.join(', '));
        }
    };
    $.ajax(settings);
}

/**
 * Автоматическая отправка данных формы на сервер при выборе даты
 */
function dateSubmitByChange() {
    const dateSelector              = '#date';
    const datePickerFormSelector    = '#date-picker';

    $(dateSelector).change(function() {
        $(datePickerFormSelector).submit();
    });
}

function changeDate(selector) {
    const dateSelector              = '#date';
    const datePickerFormSelector    = '#date-picker';
    const previousDaySelector       = '#previous-day';

    $(selector).click(function() {
        let number      = (selector === previousDaySelector) ? -1 : 1;
        let currentDate = getValue(dateSelector);
        let newDate     = getNewDate(number, currentDate);

        setValue(dateSelector, newDate);
        $(datePickerFormSelector).submit();
    });
}

function getNewDate(number, currentDate) {
    let date = new Date(currentDate);
    date.setDate(date.getDate() + number);

    let day     = ('0' + date.getDate()).slice(-2);
    let month   = ('0' + (date.getMonth() + 1)).slice(-2);

    return date.getFullYear() + '-' + month + '-' + day;
}

function todayByClick() {
    const todayBtnSelector          = '#today';
    const dateSelector              = '#date';
    const datePickerFormSelector    = '#date-picker';

    $(todayBtnSelector).click(function() {
        let today = getTodayDate();
        $(dateSelector).val(today);
        $(datePickerFormSelector).submit();
    });
}

function getTodayDate() {
    let today = new Date();
    let dd = String(today.getDate()).padStart(2, '0');
    let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    let yyyy = today.getFullYear();

    return yyyy + '-' + mm + '-' + dd;
}

function fastLessonButtonsToggle() {
    const tableCellSelector = '#grid td';
    const createBtnSelector = '.fast-create-lesson';
    const editBtnSelector   = '.fast-edit-lesson';

    $(tableCellSelector).hover(function() {
        $(this).find(createBtnSelector).show();
        $(this).find(editBtnSelector).show();
    }, function (event) {
        $(this).find(createBtnSelector).hide();
        $(this).find(editBtnSelector).hide();
    });
}

/*global window*/
(function (global) {
    function Clock(el) {
        let document = global.document;
        this.el = document.getElementById(el);
        this.months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
        this.days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
    }
    Clock.prototype.addZero = function (i) {
        if (i < 10) {
            i = "0" + i;
            return i;
        }
        return i;
    };
    Clock.prototype.updateClock = function () {
        let now, year, month, dayNo, day, hour, minute, second, result, self;
        now = new global.Date();
        year = now.getFullYear();
        month = now.getMonth();
        dayNo = now.getDay();
        day = now.getDate();
        hour = this.addZero(now.getHours());
        minute = this.addZero(now.getMinutes());
        second = this.addZero(now.getSeconds());
        result = this.days[dayNo] + ", " + day + " " + this.months[month] + " " + year + " " + hour + ":" + minute + ":" + second;
        self = this;
        self.el.innerHTML = result;
        global.setTimeout(function () {
            self.updateClock();
        }, 1000);
    };
    global.Clock = Clock;
}(window));

function addEvent(elm, evType, fn, useCapture) {
    if (elm.addEventListener) {
        elm.addEventListener(evType, fn, useCapture);
    } else if (elm.attachEvent) {
        elm.attachEvent('on' + evType, fn);
    } else {
        elm['on' + evType] = fn;
    }
}

addEvent(window, "load", function () {
    if (document.getElementById('today')) {
        let clock = new Clock('today');
        clock.updateClock();
    }
});




/////////////  DASHBOARD  /////////////
//
//
//
function confirmBeforeRemove() {
    return confirm('Удалить?');
}

function tooltipRun() {
    const tooltipSelector = '[data-bs-toggle="tooltip"]';
    const tooltipTriggerList = document.querySelectorAll(tooltipSelector);
    const tooltipList = [...tooltipTriggerList].map(
        tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl)
    );
}

function filtersSlideToggle() {
    let target = '#filters';
    let elementIds = [
        '#lesson-filters',
        '#user-filters',
        '#teacher-filters',
    ];

    elementIds.forEach(function (elementId) {
        $(target).click(function () {
            $(elementId).slideToggle();
        });
    });
}

function perPageFormSubmit() {
    const perPageSelector       = '#per-page';
    const perPageFormSelector   = '#per-page-form';

    $(perPageSelector).change(function() {
        $(perPageFormSelector).submit();
    });
}

function copyLessonLinkToClipboard() {
    if (document.querySelector('#lesson') && document.querySelector('#lesson-id')) {
        const url = 'http://schedule.distant.udsu.local/dashboard/lessons/';
        let button = document.querySelector('#lesson-id');
        let lessonId = button.getAttribute('data-id');
        if (!lessonId) {
            return;
        }

        button.onclick = function() {
            let lessonLink = getLessonLink(lessonId);

            copyToClipboard(lessonLink);
            showNotification();

            /**
             * @param lessonId
             * @returns {string}
             */
            function getLessonLink(lessonId) {
                return url + lessonId;
            }

            /**
             * https://stackoverflow.com/questions/33855641/copy-output-of-a-javascript-variable-to-the-clipboard
             *
             * @param text
             */
            function copyToClipboard(text) {
                let dummy = document.createElement('input');
                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
            }

            function showNotification() {
                let text = 'Ссылка скопирована';
                let element = '<div class="get-course-link-notify">' + text + '</div>';
                $(element).css({display: 'none'})
                    .prependTo('body')
                    .slideDown(200)
                    .delay(1000)
                    .slideUp(200, function() { $(this).remove(); });
            }
        }
    }
}

function approveLesson() {
    const buttonSelector            = '#approve';
    const formInputMethodSelector   = '#lesson-update input[name="_method"]';
    const formSelector              = '#lesson-update';

    $(buttonSelector).click(function (event) {
        setValue(formInputMethodSelector, 'POST');
        let lessonId = $(buttonSelector).data('id');
        let path = '/dashboard/lessons/' + lessonId + '/approve';
        $(formSelector).attr('action', path).submit();
    });
}

function enabledApproveButton() {
    const buttonSelector = '#approve';
    const roomIdSelector = '#room-id';

    $(roomIdSelector).change(function(event) {
        let optionValue = parseInt(getValue(event.target));
        if (optionValue > 0) {
            enableElement(buttonSelector);
        }
    });
}

function chooseRoom() {
    const cellSelector      = '#grid-layout .table .marked .cell:not(.occupied)';
    const roomSelector      = '#room-id';
    const dataAttributeName = 'room-id';

    $(cellSelector).click(function(event) {
        let roomId = $(event.target).data(dataAttributeName);
        $(roomSelector).val(roomId).change();
    });
}

function checkLinkType() {
    const checkedLinkTypeSelector   = 'input[name=link_type]:checked';
    const textareaSelector          = '#link';

    let linkType = parseInt(getValue(checkedLinkTypeSelector));
    if (linkType === 2) {
        enableElement(textareaSelector);
    }
}

function enabledLinkTextarea() {
    const linkTypeSelector          = 'input[name=link_type]';
    const checkedLinkTypeSelector   = 'input[name=link_type]:checked';
    const textareaSelector          = '#link';

    $(linkTypeSelector).on('change', function() {
        let linkType = parseInt(getValue(checkedLinkTypeSelector));
        if (linkType === 2) {
            enableElement(textareaSelector);
        } else {
            disableElement(textareaSelector);
        }
    });
}

function applySelect2() {
    let select2Selectors = [
        '#create-lesson #groups',
        '#edit-lesson #groups',
        '#create-lesson #teacher-id',
        '#edit-lesson #teacher-id',
        '#lessons #timeslots',
        '#lessons #groups',
    ];

    select2Selectors.forEach(function(selector) {
        if ($(selector).length) {
            $(selector).select2({
                theme: 'bootstrap-5'
            });
        }
    });
}

function toggleDateMode() {
    const chooseDateSelector        = 'input[type=radio][name=choose_date]';
    const datesSelector             = '#dates';
    const dateSelector              = '#date';
    const periodicitySelector       = '#periodicity';
    const expirationDateSelector    = '#expiration-date';
    const multiDateModeSelector     = '#multi-date-mode';

    const soloRadioBtnValue = 'solo';
    const manyRadioBtnValue = 'many';

    $(chooseDateSelector).change(function() {
        if (this.value === soloRadioBtnValue) {
            enableElement(dateSelector);
            enableElement(periodicitySelector);
            disableElement(datesSelector);
            setValue(multiDateModeSelector, 0);
        } else if (this.value === manyRadioBtnValue) {
            enableElement(datesSelector);
            disableElement(dateSelector);
            disableElement(periodicitySelector);
            disableElement(expirationDateSelector);
            setValue(periodicitySelector, 1);
            setValue(multiDateModeSelector, 1);
        }
    });
}

function periodicityChange() {
    const periodicitySelector       = '#periodicity';
    const expirationDateSelector    = '#expiration-date';

    $(periodicitySelector).change(function() {
        if (parseInt(this.value) === 1) {
            disableElement(expirationDateSelector);
        } else {
            enableElement(expirationDateSelector);
        }
    });
}

function getValue(selector) {
    return $(selector).val();
}

function setValue(selector, value) {
    $(selector).val(value);
}

function enableElement(selector) {
    $(selector).prop('disabled', false);
}

function disableElement(selector) {
    $(selector).prop('disabled', true);
}

/**
 * Загружает на сервер Excel-файл с данными
 */
// function uploadExcelFile() {
//     Dropzone.options.uploadFile = {
//         paramName: 'file',
//         maxFilesize: 10, // MB
//         accept: function(file, done) {done()},
//         init: function() {
//             this.on('complete', function(file) {
//                 // window.location.replace('/admin');
//             });
//             this.on('success', function(file, response) {
//                 console.log(response);
//                 //displayNotification(response);
//             });
//         }
//     };
// }
