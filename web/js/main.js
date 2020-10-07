'use strict';


class Tasks {
    constructor() {
        this.task = '';
        this.private_id = null;
        this.type_id = 1;
        this.cat_id = null;
        this.aim_id = null;
        this.goal_id = null;
        this.hashtags = null;
        this.curator_emails = null;
        this.finished = 0;
        this.deleted = 0;
        this.repeat_type_id = null;
        this.nextPeriod = 0;
        this.inputTaskClass = '.task__input';
        this.inputSettingsClass = '.task__settings';
    }

//	_getJson(url, data) {
//		return fetch(url, {
//			method: 'POST',
//			headers: {
//				'Content-Type': 'application/json',
//			},
//			body: JSON.stringify(data)
//		})
//			.then ( result => result.json())
//			.catch( error => console.log('Ошибка запроса: ' + error.message + error))
//	}
    _getJson(url, data) {
        return $.post({
            url: url,
            data: data,
            success: function (data) {
                //data приходят те данные, который прислал на сервер
                if (data.result !== "OK") {
                    console.log('ERROR_GET_DATA_');
                }
            }
        })
    }

    addTaskToHTML(tasksBlock, htmlTask) {
        tasksBlock.prepend(htmlTask);
    }

    _clearCurrentInput(inputBlock) {
        $(inputBlock).val('');
    }

    _deleteEmptyBlock(emptyBlock) {
        emptyBlock.remove();
    }

    _createTask(inputBlock, settingsBlock) {

        if (!this._validateTask()) {
            console.log('ошибка валидации');
            return false;
        }
        
        let sendData = {
            'Tasks': {
                'task': this.task,
                'private_id': this.private_id,
                'type_id': this.type_id,
                'cat_id': this.cat_id,
                'aim_id': this.aim_id,
                'goal_id': this.goal_id,
                'hashtags': this.hashtags,
                'date_calculate': '',
                'curator_emails': this.curator_emails,
                'finished': this.finished,
                'repeat_type_id': this.repeat_type_id,
                'nextPeriod': this.nextPeriod,
            }
        };
        this._getJson('/task/create', sendData)
            .then(data => {
                this._clearCurrentInput(inputBlock);
                let tasksBlock = $(inputBlock).parent().parent().parent();
                this._deleteEmptyBlock(tasksBlock.children('.text__list_empty'));
                this.addTaskToHTML(tasksBlock, data.task)
            })
            .catch(error => {
			    console.log(error);
            });
    }

    _validateTask() {
        if (this.task.length < 2) {
            console.log('ошибка, в задаче менее 2х символов');
            return false;
        }
        if (this.task.length > 70) {
            console.log('ошибка, в задаче более 70и символов');
            return false;
        }
        return true;
    }

    getFormData(form, settings) {
        this.task = form.value;
        this.private_id = settings.children('select').val();
        this.type_id = $(form).data('type');
        this.nextPeriod = $(form).data('next_period');
        return true;
    }

    init() {
        let elems = document.querySelectorAll(this.inputTaskClass);
        if (!elems.length) {
            return false;
        }
        // let settingsAll = $(this.inputSettingsClass);
        elems.forEach((el) => {
            let settings = $(el).parent().children(this.inputSettingsClass);
            el.addEventListener('focus', (e) => {
                settings.show();
                // закрытие окна при клике вне окна
                $(document).mousedown(function (e) { // событие клика по веб-документу
                    if (!$(el).is(e.target) && !settings.is(e.target) && settings.has(e.target).length === 0) { // если клик был не по нашему блоку и не по его дочерним элементам
                        settings.fadeOut(1); // скрываем его
                    }
                });

            });
            el.addEventListener('keypress', (e) => {
                if (e.which == 13 || e.keyCode == 13) {
                    e.preventDefault();
                    this._initCreateTask(el, settings);
                }
            })
            // el.parentElement.parentElement.parentElement.querySelector(this.inputSettingsClass).addEventListener('blur', (e) => {
            //     el.parentElement.parentElement.parentElement.querySelector(this.inputSettingsClass).style.display = 'none';
            //
            // });
            // el.addEventListener('blur', (e) => {
            //     console.log(e);
            //
            // });
        });
        
    }

    _initCreateTask(elementInput, elemetSettings) {
        this.getFormData(elementInput, elemetSettings);
        this._createTask(elementInput, elemetSettings);
    }


    _render(task) {

    }
}
let tasks = new Tasks();
tasks.init();



