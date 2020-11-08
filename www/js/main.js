'use strict';


class Tasks {
    constructor() {
        this.task = '';
        this.id = null;
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
        this.newInputTaskClass = '.new_input_task';
        this.taskListClass = '.tasks__list';
        this.taskListItemClass = '.text__list_item';
        this.createdTasksClass = '.created_tasks';
        this.inputSettingsClass = '.task__settings';
        this.transferBtn = '.task_transfer_btn';
        this.checkBtn = '.check_btn';
        this.finishClass = '.text__strike';
        this.allTasksClass = '.tasks-all';
        this.savingClass = '.saving_tasks';
        this.timerInput;
        this.timerSavind;
        this.tasksForUpdate = [];
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
                    console.log('ERROR_POST_DATA');
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

    renderOneTask(tasksBlock, html) {
        return $(tasksBlock).parent().parent().before(html);
    }

    renderAllTasks(tasksBlock, html) {
        return $(tasksBlock).replaceWith(html);
    }

    replaceOneTask(task, html) {
        return $(task).replaceWith(html);
    }

    finishTask(taskInput) {
        this.finished = taskInput.dataset.finished;
        let btn = $(taskInput).parent().children(this.checkBtn);
        if (this.finished == 1) {
            taskInput.dataset.finished = '0';
            $(taskInput).parents(this.taskListItemClass).removeClass(this.finishClass.slice(1));
            btn.removeClass('icon-check');
            btn.addClass('icon-check-empty');
        } else if (this.finished == 0) {
            taskInput.dataset.finished = '1';
            $(taskInput).parents(this.taskListItemClass).addClass(this.finishClass.slice(1));
            btn.removeClass('icon-check-empty');
            btn.addClass('icon-check');
        }
    }

    renderSaving(types) {
        types.forEach( (type) => {
            let saving = document.querySelector(this.taskListClass + `[data-type="${type}"]`).querySelector(this.savingClass);
            saving.style.display = 'inline-block';
        })
    }

    stopRenderSaving(types) {
        types.forEach( (type) => {
            let saving = document.querySelector(this.taskListClass + `[data-type="${type}"]`).querySelector(this.savingClass);
            saving.style.display = 'none';
        })

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
                    // this._clearCurrentInput(inputBlock);
                    let tasksBlock = $(inputBlock).parents(this.taskListClass);
                    // this._deleteEmptyBlock(tasksBlock.children('.text__list_empty'));
                    this.renderOneTask(inputBlock, data.task);
                    let createdTasks = tasksBlock.find(this.createdTasksClass);
                    let newTask = createdTasks[createdTasks.length - 1];
                    this._addEventsTasks([newTask.querySelector(this.inputTaskClass)]);
                    this._clearCurrentInput(inputBlock);
                    inputBlock.focus();
                }
            })
            .catch(error => {
            });
    }

    _updateTask(inputBlock) {
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
            },
            'id': this.id,
        };
        this._post('/task/change', sendData)
            .then(data => {
                if (data.result) {
                    // this._clearCurrentInput(inputBlock);
                    // let tasksBlock = $(inputBlock).parents('.tasks__list');
                    // this._deleteEmptyBlock(tasksBlock.children('.text__list_empty'));
                    this.renderOneTask(tasksBlock, data.tasks);
                    let task = document.querySelectorAll(this.inputTaskClass + `[data-type="${this.type_id}"][data-next_period="${this.nextPeriod}"]`);
                    this._addEventsTasks([task]);
                    inputBlock.focus();
                }
            })
            .catch(error => {
            });
    }

    _updateChangedTasks(tasks, types) {
        let sendPropertiesData = [];
        tasks.forEach( (task) => {
            if (task._validateTask()) {
                sendPropertiesData.push({
                    'id': task.id,
                    'task': task.task,
                    'private_id': task.private_id,
                    'type_id': task.type_id,
                    'cat_id': task.cat_id,
                    'aim_id': task.aim_id,
                    'goal_id': task.goal_id,
                    'hashtags': task.hashtags,
                    'date_calculate': task.date_calculate,
                    'curator_emails': task.curator_emails,
                    'finished': task.finished,
                    'repeat_type_id': task.repeat_type_id,
                    'nextPeriod': task.nextPeriod,
                });
            } else {
                console.log('ошибка валидации - ' + task.id);
            }
        });

        let sendData = {
            'Tasks': sendPropertiesData,
        };

        this._post('/task/update-all', sendData)
            .then(data => {
                if (data.result) {
                    clearTimeout(this.timerSavind);
                    this.renderSaving(types);
                    this.timerSavind = setTimeout( () => {
                        this.stopRenderSaving(types);
                    }, 2000)
                }
            })
            .catch(error => {
            });
    }

    _finishTask(inputBlock) {
        let sendData = {
            'id': this.id,
            'nextPeriod': this.nextPeriod,
        };
        this._post('/task/finish', sendData)
            .then(data => {
                if (data.result) {
                    this.finishTask(inputBlock);
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
                    this.renderAllTasks(elementTasks.parentNode, data.tasks);
                    this.updateAutoresize();
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

    getFormData(input) {
        let settings = $(input).parent().children(this.inputSettingsClass);
        this.task = input.value;
        this.private_id = settings.children('select').val();
        this.type_id = input.dataset.type;
        this.nextPeriod = input.dataset.next_period;
        this.finished = input.dataset.finished;
        return true;
    }

    _addEventsTasks(elems) {
        elems.forEach((el) => {
            let settings = $(el).parent().children(this.inputSettingsClass);
            autosize($(el));

            // появление настроек при фокусировке на textarea
            el.addEventListener('focus', (e) => {
                settings.show();
                // закрытие окна при клике вне окна
                $(document).mousedown(function (e) { // событие клика по веб-документу
                    if (!$(el).is(e.target) && !settings.is(e.target) && settings.has(e.target).length === 0) {
                        // если клик был не по нашему блоку и не по его дочерним элементам
                        settings.fadeOut(1); // скрываем его
                    }
                });
            });

            // ctrl + enter - переход на новую строку
            el.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.keyCode == 17) && (e.which == 13 || e.keyCode == 13)) {
                    e.preventDefault();
                    let caretPos = this.getCaretPos(el);
                    let task = $(el).val();
                    task = task.slice(0,caretPos) + '\r\n' + task.slice(caretPos,task.length);
                    $(el).val(task);
                    this.setCaretPosition(el, caretPos+1);
                    autosize.update($(el));
                }
            });

            // не ctrl + enter - создание новой задачи
            if ($(el).hasClass(this.newInputTaskClass.slice(1))) {
                el.addEventListener('keypress', (e) => {
                    if ((!e.ctrlKey || !e.which == 17) && (e.which == 13 || e.keyCode == 13)) {
                        e.preventDefault();
                        this._initCreateTask(el, settings);
                    }
                })
            }

            // завершение задачи при клике по кнопке
            if (el.parentNode.querySelector('.check_btn')) {
                el.parentNode.querySelector('.check_btn').addEventListener('click', (e) => {
                    this._initFinishTask(el);
                })
            }

            // события сохранения измененных задач
            if ($(el).parents(this.taskListItemClass).hasClass(this.createdTasksClass.slice(1))) {
                el.addEventListener('input', (e) => {
                    // обновляем таймаут сохранения
                    clearTimeout(this.timerInput);

                    this.id = el.dataset.id;
                    // добавляем в массив id, которые были изменены
                    this.tasksForUpdate.push(this.id);
                    // удаляем дубликаты
                    this.tasksForUpdate = [...new Set(this.tasksForUpdate)];
                    this.timerInput = setTimeout(() => {
                        this._initUpdateTasks(this.tasksForUpdate);
                        this.tasksForUpdate = [];
                    }, 2000)
                })
            }

        });

    }

     setCaretPosition(elem, caretPos) {
        elem.value = elem.value;
        if(elem != null) {
            if(elem.createTextRange) {
                let range = elem.createTextRange();
                range.move('character', caretPos);
                range.select();
            }
            else {
                if(elem.selectionStart) {
                    elem.focus();
                    elem.setSelectionRange(caretPos, caretPos);
                }
                else
                    elem.focus();
            }
        }
    }

    getCaretPos(obj) {
        obj.focus();
        if (document.selection) { // IE
            let sel = document.selection.createRange();
            let clone = sel.duplicate();
            sel.collapse(true);
            clone.moveToElementText(obj);
            clone.setEndPoint('EndToEnd', sel);
            return clone.text.length;
        } else if (obj.selectionStart!==false) return obj.selectionStart; // Gecko
        else return 0;
    }

    init() {
        let elems = document.querySelectorAll(this.inputTaskClass);
        if (!elems.length) {
            return false;
        }

        // устанавливаем события на элементы ввода задач
        this._addEventsTasks(elems);

        // события кнопки трансфера прошлых задач
        let tranferBtns = document.querySelectorAll(this.transferBtn);
        tranferBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                this._tranferTasks(btn, btn.dataset.type);
            })
        })

    }

    updateAutoresize() {
        let textareas = document.querySelectorAll('textarea');
        autosize.destroy(textareas);
        autosize(textareas);
    }

    _initCreateTask(elementInput) {
        this.getFormData(elementInput);
        this._createTask(elementInput);
    }

    _initUpdateTask(elementInput) {
        this.getFormData(elementInput);
        this.id = elementInput.dataset.id;
        this._updateTask(elementInput);
    }

    _initUpdateTasks(idArr) {
        let tasks = [];
        let types = [];

        idArr.forEach( (id) => {
            this.id = id;
            this.getFormData($(this.allTasksClass).find(this.inputTaskClass + `[data-id="${id}"]`)[0]);
            tasks.push(new Task(this));
            types.push(this.type_id);
        });
        // удаляем дубликаты
        types = [...new Set(types)];

        this._updateChangedTasks(tasks, types);
    }

    _initFinishTask(elementInput) {
        this.getFormData(elementInput);
        this.id = elementInput.dataset.id;
        this._finishTask(elementInput);
    }

}

class Task extends Tasks {
    constructor(task) {
        super();
        this.task = task.task;
        this.id = task.id;
        this.private_id = task.private_id;
        this.type_id = task.type_id;
        this.cat_id = task.cat_id;
        this.aim_id = task.aim_id;
        this.goal_id = task.goal_id;
        this.hashtags = task.hashtags;
        this.curator_emails = task.curator_emails;
        this.finished = task.finished;
        this.deleted = task.deleted;
        this.repeat_type_id = task.repeat_type_id;
        this.nextPeriod = task.nextPeriod;
    }

}

class Modal {
    constructor() {

    }

    _post(url, data) {
        return $.post({
            url: url,
            data: data,
            success: function (data) {
                //data приходят те данные, который прислал на сервер
                if (data.result !== true) {
                    console.log('ERROR_POST_DATA');
                }
            }
        })
    }
    _get(url, data) {
        return $.get({
            url: url,
            data: data,
            success: function (data) {
                //data приходят те данные, который прислал на сервер
                if (data.result !== true) {
                    console.log('ERROR_GET_DATA');
                }
            }
        })
    }

    sendConfirmationEmail(confEmailBlock) {
        let sendData = {
            'confirmation': true,
        };
        this._post('/auth/send-confirmation-email', sendData)
            .then(data => {
                if (data.result) {
                    this.closeConfirmEmailWindow(confEmailBlock);
                }
            })
            .catch(error => {
                this.enableBtn(btnSendEmail);
                console.log(error);
            });
    }

    init() {
        let confEmailBlock = document.querySelector('.email_confirmation');
        if (confEmailBlock) {
            let btnSendEmail = confEmailBlock.querySelector('.btn_conf_email');
            let closeWindow = confEmailBlock.querySelector('.email_confirmation_close');
            btnSendEmail.addEventListener('click', (e) => {
                this.sendConfirmationEmail(confEmailBlock);
                this.disableBtn(btnSendEmail);
            });

            closeWindow.addEventListener('click', (e) => {
                this.closeConfirmEmailWindow(confEmailBlock);
            });

        }
    }

    disableBtn(btn) {
        btn.setAttribute('disabled', 'disabled');
    }

    enableBtn(btn) {
        btn.removeAttribute('disabled');
    }

    closeConfirmEmailWindow(window) {
        window.style.display = 'none';
    }

}

let tasks = new Tasks();
tasks.init();

let confirmModal = new Modal();
confirmModal.init();

