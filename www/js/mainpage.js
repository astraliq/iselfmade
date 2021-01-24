'use strict';
class MainPage {
    constructor() {
        this.loginWindow = document.getElementById('mwindow-login');
        this.remindWindow = document.getElementById('mwindow-remind');
        this.regWindow = document.getElementById('mwindow-reg');
        this.restoreWindow = document.getElementById('mwindow-restore');
        this.loginForm = document.getElementById('form-login');
        this.remindForm = document.getElementById('form-remind');
        this.restoreForm = document.getElementById('form-restore');
        this.regForm = document.getElementById('form-reg');

        this.loginWindow2 = document.getElementById('mwindow-login2');
        // this.remindWindow2 = document.getElementById('mwindow-remind2');
        this.regWindow2 = document.getElementById('mwindow-reg2');
        // this.restoreWindow2 = document.getElementById('mwindow-restore2');
        this.loginForm2 = document.getElementById('form-login2');
        // this.remindForm2 = document.getElementById('form-remind2');
        // this.restoreForm2 = document.getElementById('form-restore2');
        this.regForm2 = document.getElementById('form-reg2');
        this._init();
    }

    _formHandler(yiiForm, callback=null) {
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
                    if (callback) {
                        callback();
                    }
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
            let callback = () => {
                $('#mwindow-restore #user-email').val($('#remind-user-email').val());
                this.renderModal(4);
            };
            return this._formHandler(this.remindForm, callback);
        });
        $(this.restoreForm).on('beforeSubmit', (e) => {
            return this._formHandler(this.restoreForm);
        });
        // $(this.regForm).on('beforeSubmit', (e) => {
        //     return this._formHandler(this.regForm);
        // });

        // ---------------- второе модальное окно авторизации -----------------

        let tryBtns = document.querySelectorAll('.rates__btn');
        tryBtns.forEach( (btn) => {
            btn.addEventListener('click', (e) => {
                this.renderModal2();
            });
        });

        let modal2 = document.getElementById('modal2');
        modal2.addEventListener('mousedown', (e) => {
            let target = e.target;
            if (!target.closest('.modal2_group')) {
                mainPageStart.closeModal(modal2);
            }
        });
        let closeBtn = document.getElementById('close2');
        closeBtn.addEventListener('click', (e) => {
            mainPageStart.closeModal(modal2);
        });

        // let remind = document.getElementById('remind2');
        // remind.addEventListener('click', (e) => {
        //     this.renderModal2(2);
        // });

        let loginbtn2 = document.getElementById('loginbtn2');
        loginbtn2.addEventListener('click', (e) => {
            this.renderModal2(1);
        });

        let regbtn2 = document.getElementById('regbtn2');
        regbtn2.addEventListener('click', (e) => {
            this.renderModal2(3);
        });
        // $(this.loginForm).on('beforeSubmit', (e) => {
        //     return this._formHandler(this.loginForm);
        // });
        // $(this.remindForm).on('beforeSubmit', (e) => {
        //     let callback = () => {
        //         $('#mwindow-restore #user-email').val($('#remind-user-email').val());
        //         this.renderModal(4);
        //     };
        //     return this._formHandler(this.remindForm, callback);
        // });
        // $(this.restoreForm).on('beforeSubmit', (e) => {
        //     return this._formHandler(this.restoreForm);
        // })

    }

    renderModal(type=0) {
        this.strModal = '';
        let modal = document.getElementById('modal');
        modal.classList.remove('hide-modal');
        modal.classList.remove('d-none');
        switch (type) {
            case 1:
                this.loginWindow.classList.remove('invisible');
                this.remindWindow.classList.add('invisible');
                this.regWindow.classList.add('invisible');
                this.restoreWindow.classList.add('invisible');
                break;
            case 2:
                this.loginWindow.classList.add('invisible');
                this.remindWindow.classList.remove('invisible');
                this.regWindow.classList.add('invisible');
                this.restoreWindow.classList.add('invisible');
                break;
            case 3:
                this.loginWindow.classList.add('invisible');
                this.remindWindow.classList.add('invisible');
                this.regWindow.classList.remove('invisible');
                this.restoreWindow.classList.add('invisible');

                break;
            case 4:
                this.loginWindow.classList.add('invisible');
                this.remindWindow.classList.add('invisible');
                this.regWindow.classList.add('invisible');
                this.restoreWindow.classList.remove('invisible');
                break;
            default:

        }

    }
    renderModal2(type=0) {
        this.strModal = '';
        let modal = document.getElementById('modal2');
        modal.classList.remove('hide-modal');
        modal.classList.remove('d-none');
        let loginbtn2 = document.getElementById('loginbtn2');
        let regbtn2 = document.getElementById('regbtn2');
        switch (type) {
            case 1:
                this.loginWindow2.classList.remove('invisible');
                this.regWindow2.classList.add('invisible');
                loginbtn2.style.backgroundColor = '#fff';
                regbtn2.style.backgroundColor = '#f0f0f0';
                break;
            case 2:
                this.loginWindow2.classList.add('invisible');
                this.regWindow2.classList.add('invisible');
                break;
            case 3:
                this.loginWindow2.classList.add('invisible');
                this.regWindow2.classList.remove('invisible');
                loginbtn2.style.backgroundColor = '#f0f0f0';
                regbtn2.style.backgroundColor = '#fff';
                break;
            case 4:
                this.loginWindow2.classList.add('invisible');
                this.regWindow2.classList.add('invisible');
                break;
            default:
        }
    }

    closeModal(modal) {
        modal.classList.add('hide-modal');
        setTimeout(function(){
            modal.classList.add('d-none');
        }, 200);
    }

    checkEmailMask(value) {
        return (/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i.test(value))
    }

}

let mainPageStart = new MainPage();

