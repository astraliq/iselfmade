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
        this.taskItem = '.created_tasks';
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
            autosize($(el));
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

    _addEventsTasksInput(el) {
        el.addEventListener('click', (e) => {
            let data = $(el).html();
            let typeId = $(el).data('type');
            let nextPeriod = $(el).data('next_period');
            let privateId = $(el).data('private_id');
            this._renderTaskInput(el, typeId, nextPeriod, data, privateId)
        })
    }


    init() {
        let taskItems = document.querySelectorAll(this.taskItem);
        
        // устанавливаем события рендера textarea
        taskItems.forEach( (el) => {
           this._addEventsTasksInput(el);
        });

        let elems = document.querySelectorAll(this.inputTaskClass);
        if (!elems.length) {
            return false;
        }

        // устанавливаем события на показ окна с настройками задачи
        elems.forEach((el) => {
            this._addSettingsEvents(el);
        });


        // события кнопки трансфера прошлых задач
        let tranferBtns = document.querySelectorAll(this.transferBtn);
        tranferBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                this._tranferTasks(btn, btn.dataset.type);
            })
        })


    }

    _renderTaskInput(elem, typeId, nextPeriod, data, privateId) {
        let selected = ['','','',''];
        selected[privateId-1] = 'selected';

        let html = `<li class="text__list_item" data-next_period="${nextPeriod}" data-type="${typeId}">` +
                '<div class="task__input_block">' +
                `<textarea class="task__input" data-type="${typeId}" data-next_period="${nextPeriod}" type="text" maxlength="70">${data}</textarea>` +
                '<div class="task__settings">'+
                    '<label for="private_id">Доступность:</label>' +
                    '<select name="private_id" id="private_id">' +
                        `<option value="1" ${selected[0]}>Видна всем</option>` +
                        `<option value="2" ${selected[1]}>Видна только бадди</option>` +
                        `<option value="3" ${selected[2]}>Видна только куратору</option>` +
                        `<option value="4" ${selected[3]}>Видна только мне</option>` +
                    '</select>' +
                '</div>' +
            '</div>' +
        '</li>';
        $(elem).replaceWith(html);
        let textareas = document.querySelectorAll('textarea');
        autosize.destroy(textareas);
        autosize(textareas);

    }

    _initCreateTask(elementInput) {
        this.getFormData(elementInput);
        this._createTask(elementInput);
    }

}
let tasks = new Tasks();
tasks.init();


