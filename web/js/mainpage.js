'use strict';
class MainPage {
    constructor() {
        this._init();
        this.loginWindow = document.getElementById('mwindow-login');
        this.remindWindow = document.getElementById('mwindow-remind');
        this.regWindow = document.getElementById('mwindow-reg');
        this.loginForm = document.getElementById('form-login');
        this.remindForm = document.getElementById('form-remind');
        this.regForm = document.getElementById('form-reg');

    }

    _formHandler(e) {
        let $yiiform = $(this);
        // отправляем данные на сервер
        $.ajax({
                type: $yiiform.attr('method'),
                url: $yiiform.attr('action'),
                data: $yiiform.serializeArray()
            }
        )
            .done(function(data) {
                if(data.success) {
                    // данные сохранены
                } else {
                    // сервер вернул ошибку и не сохранил наши данные
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
            if (!target.closest(".modal__style")) {
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

        $(this.loginForm).on('beforeSubmit', (e) => {
            this._formHandler();
        })
        $(this.regForm).on('beforeSubmit', (e) => {
            this._formHandler();
        })
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

        // let checkEmail = false
        // let emailFocus = false;
        // let passFocus = false;
        // let inputEmail = document.getElementById('inputEmail');
        // let inputPass = document.getElementById('inputPass');

        // inputEmail.addEventListener('focus', (e) => {
        //     inputEmail.placeholder = '';
        //     emailFocus = true;
        // });

        // inputEmail.addEventListener('mouseout', (e) => {
        //     (inputEmail.value != '') ? inputEmail.placeholder = inputEmail.value: inputEmail.placeholder = "Email";
        //
        //     checkEmail = mainPageStart.checkEmailMask(inputEmail.value);
        //     if (!checkEmail && emailFocus) {
        //         inputEmail.classList.add('input_error');
        //     } else {
        //         inputEmail.classList.remove('input_error');
        //     }
        // });

        // inputPass.addEventListener('focus', () => {
        //     inputPass.placeholder = '';
        //     passFocus = true;
        // });

        // inputPass.addEventListener('mouseout', () => {
        //     (inputPass.value != '') ? inputPass.placeholder = inputPass.value: inputPass.placeholder = "Пароль";
        // });
    }

    closeModal(modal) {
        modal.classList.add('invisible');
    }

    checkEmailMask(value) {
        return (/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i.test(value))
    }
}

let mainPageStart = new MainPage();