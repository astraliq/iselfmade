'use strict';
class MainPage {
    constructor() {
        this.loginWindow = document.getElementById('mwindow-login');
        this.remindWindow = document.getElementById('mwindow-remind');
        this.regWindow = document.getElementById('mwindow-reg');
        this.loginForm = document.getElementById('form-login');
        this.remindForm = document.getElementById('form-remind');
        this.regForm = document.getElementById('form-reg');
        this._init();
    }

    _formHandler(yiiForm) {
        let $yiiform = $(yiiForm);
        // отправляем данные на сервер

        $.ajax({
                type: $yiiform.attr('method'),
                url: $yiiform.attr('action'),
                data: $yiiform.serializeArray()
            }
        )
            .done(function(data) {
                if(data.result) {
                    // данные сохранены
                    console.log('OK');
                } else {
                    // сервер вернул ошибку и не сохранил наши данные
                    console.log('ne OK');
                }
            })
            .fail(function () {
                // не удалось выполнить запрос к серверу
            });

        return false; // отменяем отправку данных формы
    }


    _init() {
        let login = document.getElementById('login');
        login.addEventListener('click', (e) => {
            this.renderModal();
        });
        let modal = document.getElementById('modal');
        modal.addEventListener('mousedown', (e) => {
            let target = e.target;
            if (!target.closest('.modal__style')) {
                mainPageStart.closeModal(modal);
            }
        });

        let remind = document.getElementById('remind');
        remind.addEventListener('click', (e) => {
            this.renderModal(2);
        });

        let loginbtn = document.querySelectorAll('.loginbtn');
        loginbtn.forEach( (elem) => {
            elem.addEventListener('click', (e) => {
                this.renderModal(1);
            });
        });

        let regbtn = document.getElementById('regbtn');
        regbtn.addEventListener('click', (e) => {
            this.renderModal(3);
        });
        // $(this.loginForm).on('beforeSubmit', (e) => {
        //     return this._formHandler(this.loginForm);
        // });
        $(this.remindForm).on('beforeSubmit', (e) => {
            return this._formHandler(this.remindForm);
        });
        // $(this.regForm).on('beforeSubmit', (e) => {
        //     return this._formHandler(this.regForm);
        // });
    }

    renderModal(type=0) {
        this.strModal = '';
        let modal = document.getElementById('modal');
        modal.classList.remove('invisible');
        switch (type) {
            case 1:
                this.loginWindow.classList.remove('invisible');
                this.remindWindow.classList.add('invisible');
                this.regWindow.classList.add('invisible');
                break;
            case 2:
                this.loginWindow.classList.add('invisible');
                this.remindWindow.classList.remove('invisible');
                this.regWindow.classList.add('invisible');
                break;
            case 3:
                this.loginWindow.classList.add('invisible');
                this.remindWindow.classList.add('invisible');
                this.regWindow.classList.remove('invisible');
                break;
            default:

        }

    }

    closeModal(modal) {
        modal.classList.add('invisible');
    }

    checkEmailMask(value) {
        return (/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i.test(value))
    }
}

let mainPageStart = new MainPage();

