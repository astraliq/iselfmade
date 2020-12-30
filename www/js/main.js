'use strict';

function get_cookie (cookie_name) {
    let results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
    if ( results )
        return ( unescape ( results[2] ) );
    else
        return null;
}

function validateEmail(email) {
    let re = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(phone) {
    let re = /^\d[\d\(\)\ -]{4,14}\d$/;
    return  re.test(phone);
}

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
        this.repeated_weekdays = null;
        this.repeat_by_id = null;
        this.nextPeriod = 0;
        this.inputTaskClass = '.task__input';
        this.inputTaskBlockClass = '.task__input_block';
        this.newInputTaskClass = '.new_input_task';
        this.taskListClass = '.tasks__list';
        this.taskListItemClass = '.text__list_item';
        this.createdTasksClass = '.created_tasks';
        this.inputSettingsClass = '.task__settings';
        this.weekendsBlockClass = '.weekends_block';
        this.repeatedByIdClass = '.repeated_by_id'; // select настроек повтора
        this.transferBtn = '.task_transfer_btn';
        this.checkBtn = '.check_btn';
        this.finishClass = '.text__strike';
        this.allTasksClass = '.tasks-all';
        this.savingClass = '.saving_tasks';
        this.nextRepeatDate = '.next_repeat_date';
        this.tasksFinishedClass = '.tasks_show_finished';
        this.timerInput;
        this.timerSavind;
        this.timerLastFinishTask;
        this.tasksForUpdate = [];
        this.tasksToHide = [];
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
        let parentBlock = $(taskInput).parents(this.taskListItemClass);
        let finishBtn = $(parentBlock).parent().parent().children(this.tasksFinishedClass);
        this.finished = taskInput.dataset.finished;
        let btn = $(taskInput).parent().children(this.checkBtn);
        if (this.finished == 1) {
            taskInput.dataset.finished = '0';
            parentBlock.removeClass(this.finishClass.slice(1));
            btn.removeClass('icon-check');
            btn.addClass('icon-check-empty');
            this.tasksToHide.find( (el, index) => {
                if (el == parentBlock[0]) {
                    this.tasksToHide.splice(index, 1);
                }
            })
        } else if (this.finished == 0) {
            taskInput.dataset.finished = '1';
            parentBlock.addClass(this.finishClass.slice(1));
            btn.removeClass('icon-check-empty');
            btn.addClass('icon-check');
            if (finishBtn[0].innerText === 'Показать завершенные') {
                clearTimeout(this.timerLastFinishTask);
                this.tasksToHide.push(parentBlock[0]);
                this.timerLastFinishTask = setTimeout( () => {
                    this._hideTasks(this.tasksToHide);
                }, 2000)
            }

        }
    }

    renderSaving(blocksIds) {
        blocksIds.forEach( (id) => {
            let saving = document.getElementById(id).querySelector(this.savingClass);
            saving.style.display = 'inline-block';
        })
    }

    stopRenderSaving(blocksIds) {
        blocksIds.forEach( (id) => {
            let saving = document.getElementById(id).querySelector(this.savingClass);
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
                'repeat_by_id': this.repeat_by_id,
                'repeated_weekdays': this.repeated_weekdays,
                'nextPeriod': this.nextPeriod,
            }
        };
        this._post('/task/create', sendData)
            .then(data => {
                if (data.result === true) {
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
                'repeat_by_id': this.repeat_by_id,
                'repeated_weekdays': this.repeated_weekdays,
                'nextPeriod': this.nextPeriod,
            },
            'id': this.id,
        };
        this._post('/task/change', sendData)
            .then(data => {
                if (data.result === true) {
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

    _updateChangedTasks(tasks, blocksIds) {
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
                    'repeat_by_id': this.repeat_by_id,
                    'repeated_weekdays': this.repeated_weekdays,
                    'nextPeriod': task.nextPeriod,
                });
            } else if(task.task.length == 0) {
                task.deleted = 1;
                sendPropertiesData.push({
                    'id': task.id,
                    'private_id': task.private_id,
                    'type_id': task.type_id,
                    'cat_id': task.cat_id,
                    'aim_id': task.aim_id,
                    'goal_id': task.goal_id,
                    'hashtags': task.hashtags,
                    'date_calculate': task.date_calculate,
                    'curator_emails': task.curator_emails,
                    'finished': task.finished,
                    'deleted': task.deleted,
                    'repeat_type_id': task.repeat_type_id,
                    'repeat_by_id': this.repeat_by_id,
                    'repeated_weekdays': this.repeated_weekdays,
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
                if (data.result === true) {
                    tasks.forEach( (task) => {
                        let repeatDate = document.getElementById(`repeated-${task.id}`);
                        if (repeatDate) {
                            this.updateRepeatDate(repeatDate);
                        }
                        if (task.deleted == 1) {
                            let tasksEl = document.querySelectorAll(this.inputTaskClass);
                            tasksEl.forEach( (taskEl) => {
                                if (taskEl.dataset.id == task.id) {
                                    taskEl.parentElement.parentElement.style.display = 'none';
                                }
                            });
                        }
                    });

                    clearTimeout(this.timerSavind);
                    this.renderSaving(blocksIds);
                    this.timerSavind = setTimeout( () => {
                        this.stopRenderSaving(blocksIds);
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
                if (data.result === true) {
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
                if (data.result === true) {
                    this.renderAllTasks(elementTasks.parentNode, data.tasks);
                    this.updateAutoresize();
                }
            })
            .catch(error => {
                console.log(error);
            });
    }

    updateRepeatDate(dateElement) {
        let sendData = {
                'id': dateElement.dataset.id,
        };
        this._post('/task/next-repeat-date', sendData)
            .then(data => {
                if (data.result === true) {
                    dateElement.innerText = data.nextDate;
                } else {
                    dateElement.innerText = '';
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

    _checkTaskLength(taskInput) {
        if (taskInput.value.length == 1) {
            taskInput.style.borderBottomColor = 'red';
        } else {
            taskInput.style.removeProperty('borderBottomColor');
        }
    }

    getFormData(input) {
        let settings = $(input).parent().children(this.inputSettingsClass);
        this.task = input.value;
        this.id = input.dataset.id;
        this.type_id = input.dataset.type;
        this.nextPeriod = input.dataset.next_period;
        this.finished = input.dataset.finished ? input.dataset.finished : 0;
        this.deleted = input.dataset.deleted ? input.dataset.deleted : 0;

        // настройки задачи
        this.private_id = settings.find('.private_id').val();
        let repeatIdValue = settings.find('.repeated_by_id').val();
        this.repeat_type_id = repeatIdValue == 0 ? null : repeatIdValue;
        let weekdaysInputs = settings.find('.repeat_weekdays')[0].querySelectorAll('input');
        let weekdayData = [];
        weekdaysInputs.forEach( (input) => {
            if (input.checked) {
                weekdayData.push(input.dataset.id);
            }
        });
        this.repeated_weekdays = weekdayData.join(',');
        return true;
    }

    _addEventsTasks(elems) {
        elems.forEach((el) => {
            let settings = $(el).parent().children(this.inputSettingsClass);
            // let repeatDate = $(el).parent().children(this.nextRepeatDate);
            autosize.destroy($(el));
            autosize($(el));

            // появление настроек при фокусировке на textarea
            el.addEventListener('focus', (e) => {
                settings.show();
                // settings.css('display', 'flex');

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
                    task = task.slice(0, caretPos) + '\r\n' + task.slice(caretPos,task.length);
                    $(el).val(task);
                    this.setCaretPosition(el, caretPos+1);
                    el.classList.add('transition_none');
                    autosize.update($(el));
                    el.classList.add('transition_all');
                }
            });

            // не ctrl + enter - создание новой задачи
            if ($(el).hasClass(this.newInputTaskClass.slice(1))) {
                el.addEventListener('keypress', (e) => {
                    if ((!e.ctrlKey || !e.which == 17) && (e.which == 13 || e.keyCode == 13)) {
                        e.preventDefault();
                        el.classList.add('transition_none');
                        this._initCreateTask(el, settings);
                        el.classList.add('transition_all');
                    }
                });
            }

            document.addEventListener('keypress', (e) => {
                if ((!e.ctrlKey || !e.which == 17) && (e.which == 13 || e.keyCode == 13)) {
                    // if (e.target) {
                    //     e.preventDefault();
                    //     el.classList.add('transition_none');
                    //     this._initCreateTask(el, settings);
                    //     el.classList.add('transition_all');
                    // }
                }
            });

            // завершение задачи при клике по кнопке
            if (el.parentNode.querySelector('.check_btn')) {
                el.parentNode.querySelector('.check_btn').addEventListener('click', (e) => {
                    this._initFinishTask(el);
                })
            }

            // события появления найтроек повтора по дням недели
            let elemRepeatSettings = $(el).parents(this.inputTaskBlockClass).find(this.repeatedByIdClass);
            elemRepeatSettings[0].addEventListener('change', (e) => {
                let weekends = elemRepeatSettings.parents(this.inputSettingsClass).find(this.weekendsBlockClass);
                if (elemRepeatSettings[0].value == 8) {
                    weekends[0].classList.remove('hidden_block_anim');
                } else {
                    weekends[0].classList.add('hidden_block_anim');
                }
            });

            // события сохранения измененных задач
            if ($(el).parents(this.taskListItemClass).hasClass(this.createdTasksClass.slice(1))) {
                // let repeatedById = el.dataset.repeated_by_id ? el.dataset.repeated_by_id : el.dataset.id;
                // //находим такую же повторную задачу
                // let sameNextPeriod = el.dataset.next_period == 0 ? 1 : 0;
                // let sameTask, sameSettings;
                // if (repeatedById) {
                //     sameTask = document.querySelector(this.inputTaskClass + `[data-repeated_by_id="${repeatedById}"][data-next_period="${sameNextPeriod}"]`);
                //     if (!sameTask) {
                //         sameTask = document.querySelector(this.inputTaskClass + `[data-id="${repeatedById}"][data-next_period="${sameNextPeriod}"]`);
                //     }
                //     sameSettings = $(sameTask).parent().children(this.inputSettingsClass);
                // }

                el.addEventListener('input', (e) => {
                    // if (sameTask) {
                    //     sameTask.value = el.value;
                    // }
                    this._checkTaskLength(el);
                    this._updateTasksByEvent(el);
                });

                let selects = settings[0].querySelectorAll('select');
                let inputs = settings[0].querySelectorAll('input');
                selects.forEach( (select) => {
                    select.addEventListener('change', (e) => {

                        // копируем настройки селектов в такие же повторные задачи
                        // if (sameTask) {
                        //     let selectVal = $(e.target).val();
                        //     let sameSelectVal = sameSettings[0].querySelector('.' + e.target.className);
                        //     $(sameSelectVal).children(`option[value=${selectVal}]`).prop('selected', true);
                        //
                        //     let sameWeekends = sameSettings.find(this.weekendsBlockClass);
                        //     if (selectVal == 8) {
                        //         sameWeekends[0].classList.remove('hidden_block_anim');
                        //     } else {
                        //         sameWeekends[0].classList.add('hidden_block_anim');
                        //     }
                        // }
                        this._updateTasksByEvent(el);
                    })
                });
                inputs.forEach( (input) => {
                    input.addEventListener('change', (e) => {
                        // if (sameTask) {
                        //     // копируем настройки инпутов дней недели в такие же повторные задачи
                        //     let selectVal = e.target.checked;
                        //     let sameInputVal = sameSettings[0].querySelector(`.repeat_weekdays input[data-id="${e.target.dataset.id}"]`);
                        //     sameInputVal.checked = selectVal;
                        // }
                        this._updateTasksByEvent(el);
                    })
                });


            }

            let hideBlocks = [document.getElementById('task-3-0'), document.getElementById('task-2-0')];
            hideBlocks.forEach( (el) => {
                if (el) {
                    el.addEventListener('click', (e) => {
                        if ($(el).is(':checked')) {
                            document.cookie = `${el.id}=1`;
                        } else {
                            document.cookie = `${el.id}=0`;
                        }
                    })
                }
            })
        });

    }

    _updateTasksByEvent(el) {
        // обновляем таймаут сохранения
        clearTimeout(this.timerInput);
        el.classList.add('transition_none');
        this.id = el.dataset.id;
        // добавляем в массив id, которые были изменены
        this.tasksForUpdate.push(this.id);
        // удаляем дубликаты
        this.tasksForUpdate = [...new Set(this.tasksForUpdate)];
        // устанавливаем задержку перед сохранением после последнего изменения
        this.timerInput = setTimeout(() => {
            this._initUpdateTasks(this.tasksForUpdate);
            this.tasksForUpdate = [];
            el.classList.add('transition_all');
        }, 2000)
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
        });

        let showFinishedTasksBtn = document.querySelectorAll(this.tasksFinishedClass);
        if (showFinishedTasksBtn) {
            let parent = showFinishedTasksBtn[0].parentNode;
            let tasksBlock = parent.querySelector('ol');
            showFinishedTasksBtn.forEach( (btn) => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (btn.innerText === 'Скрыть завершенные') {
                        this._hideFinished(tasksBlock, btn);
                    } else {
                        this._showFinished(tasksBlock, btn);
                    }
                });
                if (get_cookie('show_finished') == 0) {
                    this._showFinished(tasksBlock, btn);
                } else {
                    this._hideFinished(tasksBlock, btn);
                }
            });

        }

        this.updateHidingByCookie();

    }

    updateHidingByCookie() {
        let hideBlocks = [document.getElementById('task-3-0'), document.getElementById('task-2-0')];
        hideBlocks.forEach( (el) => {
            if (el) {
                if (get_cookie(el.id) == 1) {
                    el.checked = 1;
                }
            }
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
        let blocksIds = [];
        idArr.forEach( (id) => {
            this.id = id;
            let input = $(this.allTasksClass).find(this.inputTaskClass + `[data-id="${id}"]`);
            let tasksList = input.parents(this.taskListClass)[0];
            this.getFormData(input[0]);
            tasks.push(new Task(this));
            blocksIds.push(tasksList.id);
        });
        // удаляем дубликаты
        blocksIds = [...new Set(blocksIds)];
        this._updateChangedTasks(tasks, blocksIds);
    }

    _initFinishTask(elementInput) {
        this.getFormData(elementInput);
        this.id = elementInput.dataset.id;
        this._finishTask(elementInput);
    }

    _hideFinished(block, btn) {
        let tasks = block.querySelectorAll(this.createdTasksClass);
        tasks.forEach( (task) => {
            let finish = task.querySelector(this.inputTaskClass).dataset.finished;
            if (finish == 1) {
                task.style.display = 'none';
            }
        });
        btn.textContent = 'Показать завершенные';
        document.cookie = 'show_finished=1';
    }

    _hideTasks(tasks) {
        tasks.forEach( (task) => {
            task.style.display = 'none';
        })
    }

    _showFinished(block, btn) {
        let tasks = block.querySelectorAll(this.createdTasksClass);
        tasks.forEach( (task) => {
            let finish = task.querySelector(this.inputTaskClass).dataset.finished;
            if (finish == 1) {
                task.style.display = 'list-item';
            }
        });
        btn.textContent = 'Скрыть завершенные';
        document.cookie = 'show_finished=0';
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
                if (data.result === true) {
                    this.closeConfirmEmailWindow(confEmailBlock);
                }
            })
            .catch(error => {
                this.enableBtn(btnSendEmail);
                console.log(error);
            });
    }

    init() {
        let confEmailBlocks = document.querySelectorAll('.email_confirmation');
        confEmailBlocks.forEach( (confEmailBlock) => {
            if (confEmailBlock) {
                let btnSendEmail = confEmailBlock.querySelector('.btn_conf_email');
                let closeWindow = confEmailBlock.querySelector('.email_confirmation_close');
                if (btnSendEmail) {
                    btnSendEmail.addEventListener('click', (e) => {
                        this.sendConfirmationEmail(confEmailBlock);
                        this.disableBtn(btnSendEmail);
                    });
                }
                let okBtn = confEmailBlock.querySelector('.btn_ok');
                closeWindow.addEventListener('click', (e) => {
                    this.closeConfirmEmailWindow(confEmailBlock);
                });
                if (okBtn) {
                    okBtn.addEventListener('click', (e) => {
                        this.closeConfirmEmailWindow(confEmailBlock);
                    });
                }

            }
        });

    }

    showConfirmSendingCuratorsEmail() {
        let modal = document.getElementById('modal_confirm_curators_email');
        modal.style.display = 'flex';
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

class User {
    constructor() {
        this.id = null;
        this.name = '';
        this.surname = '';
        this.email = '';
        this.avatar = '';
        this.sex = '';
        this.birthday = '';
        this.balance = null;
        this.curators_emails = '';
        this.btnConfirmCuratorId = 'curators_emails_btn_conf';
        this.iconConfirmCuratorId = 'curators_emails_confirm';
        this.curatorsEmailsClass = '.curators_emails';
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

    _getFormData() {
        let curatorEmailInput = document.querySelector(this.curatorsEmailsClass);
        if (curatorEmailInput) {
            this.curators_emails = curatorEmailInput.value;
        }
        return true;
    }

    _sendCuratorsEmailConfirm(btn) {
        this._getFormData();
        if (!validateEmail(this.curators_emails)) {
            console.log('Ошибка валидации электронной почты куратора.');
            return false;
        }
        btn.classList.add('hidden_block');
        let sendData = {
            'User': {
                'curators_emails': this.curators_emails,
            }
        };

        this._post('/user/curators-email-confirm', sendData)
            .then(data => {
                if (data.result === true) {
                    console.log(data.result);
                    confirmModal.showConfirmSendingCuratorsEmail();
                    let iconConfirm = document.getElementById(this.iconConfirmCuratorId);
                    iconConfirm.classList.add('failure_icon');
                    iconConfirm.classList.remove('success_icon');
                }
                let dateCookie = new Date(Date.now() + 3600e3).toUTCString();
                document.cookie = 'curator_email_send=1; expires=' + dateCookie;
            })
            .catch(error => {
                btn.classList.remove('hidden_block');
                document.cookie = 'curator_email_send=0';
            });
    }

    _showBtn(btn) {
        btn.classList.remove('hidden_block');
    }

    _hideBtn(btn) {
        btn.classList.add('hidden_block');
    }

    init() {
        this._getFormData();
        let curatorEmailInput = document.querySelector(this.curatorsEmailsClass);
        if (curatorEmailInput) {
            let btnCuratorsEmailConfirm = document.getElementById(this.btnConfirmCuratorId);
            if (btnCuratorsEmailConfirm) {
                btnCuratorsEmailConfirm.addEventListener('click', (e) => {
                    e.preventDefault();
                    this._sendCuratorsEmailConfirm(btnCuratorsEmailConfirm);
                });

                let iconCuratorConfirm = document.getElementById(this.iconConfirmCuratorId);
                if (get_cookie('curator_email_send') != 1 && !iconCuratorConfirm.classList.contains('success_icon') && this.curators_emails) {
                    this._showBtn(btnCuratorsEmailConfirm);
                } else {
                    this._hideBtn(btnCuratorsEmailConfirm);
                }
            }

            curatorEmailInput.addEventListener('input', (e) => {
                if (this.curators_emails === curatorEmailInput.value) {
                    this._hideBtn(btnCuratorsEmailConfirm);
                } else {
                    this._showBtn(btnCuratorsEmailConfirm);
                }
            });
        }
    }

}

let user = new User();
user.init();

class ArchiveTasks extends Tasks{
    constructor() {
        super();
        this.archiveListClass = '.archive__list';
        this.calendarId = 'calendar_block';
        this.archiveHTMLId = 'archive-0';
        this.day = '';
        this.month = '';
        this.year = '';
        this.timerMessage;
    }

    _addCalendEvents(calendar) {
        let calBtns = calendar.querySelectorAll('td a');
        if (calBtns) {
            calBtns.forEach((btn) => {
                btn.addEventListener('click', (e) => {
                    this._getDateFromCalend(calendar, btn);
                    this._getTasksArchive(calendar,btn);
                    // this.changeDateColor(calendar, btn);
                });
            });
        }

    }

    _getDateFromCalend(calendar, btn) {
        let table = calendar.querySelector('table');
        this.day = btn.innerText;
        this.day = this.day.length === 1 ? `0${this.day}` : this.day;
        this.month = Number(table.dataset.month) + 1;
        this.year =  table.dataset.year;
    }

    _validateDate() {
        if (this.day === '' || this.month === '' || this.year === '') {
            return false;
        }
        return true;
    }

    renderHTML(html) {
        return $(document.getElementById(this.archiveHTMLId)).replaceWith(html);
    }

    renderMessage(message) {
        let calendBlock = document.getElementById(this.calendarId);
        let messageCalend = calendBlock.querySelector('.message');
        if (messageCalend) {
            messageCalend.innerHTML = message;
            return;
        }
        let html = `<p class="message">${message}</p>`;
        calendBlock.insertAdjacentHTML('beforeEnd', html);
    }

    hideMessage() {
        let calendBlock = document.getElementById(this.calendarId);
        $('.message').remove();
    }

    changeDateColor(calandar, btn) {
        let allCells = calandar.querySelectorAll('.calend_cell');
        allCells.forEach( (cell) => {
            if (!cell.classList.contains('today')) {
                cell.classList.remove('active');
            }
        });
        btn.classList.add('active');
    }

    _getTasksArchive(calendar, btn) {
        if (!this._validateDate()) {
            console.log('Ошибка валидации даты архива.');
            return false;
        }
        let sendData = {
            'date': `${this.day}.${this.month}.${this.year}`,
        };
        this._post('/task/get-archive', sendData)
            .then(data => {
                if (data.result === true) {
                    this.renderHTML(data.html);
                    this.changeDateColor(calendar, btn);
                } else {
                    this.renderMessage(data.message);
                    this.timerMessage = setTimeout(() => {
                        this.hideMessage();
                    }, 4000)
                }
            })
            .catch(error => {
            });
    }

    init() {
        let cal = document.getElementById(this.calendarId);
        if (cal) {
            this._addCalendEvents(cal);
        }
    }
}
let archive = new ArchiveTasks();

function createCalendar(elem, year, month, day) {
    let now = new Date();
    let nowDay = now.getDate();
    let nowMonth = now.getMonth();
    let nowYear = now.getFullYear();

    let months = {
        0: 'Январь',
        1: 'Февраль',
        2: 'Март',
        3: 'Апрель',
        4: 'Май',
        5: 'Июнь',
        6: 'Июль',
        7: 'Август',
        8: 'Сентябрь',
        9: 'Октябрь',
        10: 'Ноябрь',
        11: 'Декабрь',
    };
    let mon = month; // месяцы в JS идут от 0 до 11, а не от 1 до 12
    let d = new Date(year, mon);
    //	console.log('d--> ' +d);
    let previousMonth = (mon === 0) ? 11 : month - 1;
    let nextMonth = (mon === 11) ? 0 : month + 1;
    let previousYear = (mon === 0) ? year - 1 : year;
    let nextYear = (mon === 11) ? year + 1 : year;

    let table = `<table class="cal" data-date="${day}" data-month="${mon}" data-year="${year}"><caption><span class="prev" onclick="createCalendar(calendar, ${previousYear}, ${previousMonth}, ${day})">←</span><span class="next" onclick="createCalendar(calendar, ${nextYear}, ${nextMonth}, ${day})">→</span><a href="">${months[month]} ${year}</a></caption>`;

    table += '<thead><tr><th>Пн</th><th>Вт</th><th>Ср</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr></thead><tbody><tr>';

    // пробелы для первого ряда
    // с понедельника до первого дня месяца
    // * * * 1  2  3  4
    for (let i = 0; i < getDay(d); i++) {
        table += '<td class="off"></td>';
    }

    // <td> ячейки календаря с датами
    while (d.getMonth() == mon) {
        if (d.getDate() == nowDay && d.getMonth() == nowMonth && d.getFullYear() == nowYear) {
            // сегодня
            table += `<td class="today" title="сегодня"><a class="calend_cell today">${d.getDate()}</a></td>`;
        } else if (ifDayIsActive(d, activitiesArr) || (d.getDate() == (nowDay - 1) && d.getMonth() == nowMonth && d.getFullYear() == nowYear)) {
            // активная дата
            table += `<td class=""><a class="calend_cell active">${d.getDate()}</a></td>`;
        } else {
            // обычная дата
            table += '<td class=""><a class="calend_cell">' + d.getDate() + '</a></td>';
        }


        if (getDay(d) % 7 == 6) { // вс, последний день - перевод строки
            table += '</tr><tr>';
        }

        d.setDate(d.getDate() + 1);
    }

    // добить таблицу пустыми ячейками, если нужно
    // 29 30 31 * * * *
    if (getDay(d) != 0) {
        for (let i = getDay(d); i < 7; i++) {
            table += '<td class="off"></td>';
        }
    }

    // закрыть таблицу
    table += '</tr></tbody></table>';
    let oldTable = $('.cal');
    if (oldTable) {
        oldTable.detach();
    }
    elem.prepend(table);

    archive.init();
}

function ifDayIsActive(date, activities) {

    for (let i = 0; i < activities.length; i++) {
        let activityDate = new Date(activities[i].dateStart.replace(/(\d{2})\.(\d{2})\.(\d{4})/, '$3-$2-$1'));
        if (date.getDate() === activityDate.getDate() && date.getMonth() === activityDate.getMonth() && date.getFullYear() === activityDate.getFullYear()) {
            return true;
        }
    }
}

function getDay(date) { // получить номер дня недели, от 0 (пн) до 6 (вс)
    let day = date.getDay();
    if (day == 0) day = 7; // сделать воскресенье (0) последним днем
    return day - 1;
}

let activitiesArr = [];
let now = new Date();
let calendar = $('#calendar_block');
createCalendar(calendar, now.getFullYear(), now.getMonth(), now.getDate());

