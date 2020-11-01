'use strict';


class Tasks {
    constructor() {
        this.init();
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
        this.transferBtn = '.task_transfer_btn';
    }

//	_post(url, data) {
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
    _post(url, data) {
        return $.post({
            url: url,
            data: data,
            success: function (data) {

                //data приходят те данные, который прислал на сервер
                if (data.result !== true) {
                    console.log('ERROR_GET_DATA_');
                }
            }
        })
    }

    _clearCurrentInput(inputBlock) {
        $(inputBlock).val('');
    }

    _deleteEmptyBlock(emptyBlock) {
        emptyBlock.remove();
    }

    renderAllTasks(tasksBlock, html) {
        return $(tasksBlock).replaceWith(html);
    }

    _createTask(inputBlock) {

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
        this._post('/task/create', sendData)
            .then(data => {
                if (data.result) {
                    this._clearCurrentInput(inputBlock);
                    let tasksBlock = $(inputBlock).parents('.tasks__list');
                    this._deleteEmptyBlock(tasksBlock.children('.text__list_empty'));
                    this.renderAllTasks(tasksBlock, data.tasks);
                    let newInput = document.querySelector(this.inputTaskClass + `[data-type="${this.type_id}"][data-next_period="${this.nextPeriod}"]`);
                    this._addSettingsEvents(newInput);
                    newInput.focus();

                }
            })
            .catch(error => {
            });
    }
    
    _tranferTasks(elementTasks, type) {
        let sendData = {
                'type': type,
        };
        this._post('/task/transfer', sendData)
            .then(data => {
                if (data.result) {
                    this.renderAllTasks(elementTasks.parentNode, data.tasks)
                }
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

    getFormData(form) {
        let settings = $(form).parent().children(this.inputSettingsClass);
        this.task = form.value;
        this.private_id = settings.children('select').val();
        this.type_id = $(form).data('type');
        this.nextPeriod = $(form).data('next_period');
        return true;
    }

    _addSettingsEvents(el) {
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
    }

    init() {
        let elems = document.querySelectorAll(this.inputTaskClass);
        if (!elems.length) {
            return false;
        }
        // let settingsAll = $(this.inputSettingsClass);
        elems.forEach((el) => {
            this._addSettingsEvents(el);
            let settings = $(el).parent().children(this.inputSettingsClass);
            el.addEventListener('focus', (e) => {
                settings.show();
                // закрытие окна при клике вне окна
                $(document).mousedown(function (e) { // событие клика по веб-документу
                    // если клик был не по нашему блоку и не по его дочерним элементам
                    if (!$(el).is(e.target) && !settings.is(e.target) && settings.has(e.target).length === 0) {
                        settings.fadeOut(1); // скрываем его
                    }
                });

            });

        });
        let tranferBtns = document.querySelectorAll(this.transferBtn);
        tranferBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                this._tranferTasks(btn, btn.dataset.type);
            })
        })       
    }

    _initCreateTask(elementInput) {
        this.getFormData(elementInput);
        this._createTask(elementInput);
    }

}
let tasks = new Tasks();
tasks.init();