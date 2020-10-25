'use strict';
class MainPage {
    constructor() {
        this._init();
        this.loginForm = document.getElementById('mwindow-login');
        this.remindForm = document.getElementById('mwindow-remind');
        this.regForm = document.getElementById('mwindow-reg');

    }

    _init() {
        let login = document.getElementById('login');
        login.addEventListener('click', (e) => {
            this.renderModal();
        });
        let modal = document.getElementById('modal');
        modal.addEventListener('click', (e) => {
            let target = e.target;
            if (!target.closest(".modal__style")) {
                mainPageStart.closeModal(modal);
            }
        });
    }

    renderModal(type=0) {
        this.strModal = '';
        let modal = document.getElementById('modal');
        modal.classList.remove('invisible');
        switch (type) {
            case 1:
                this.loginForm.classList.remove('invisible');
                this.remindForm.classList.add('invisible');
                this.regForm.classList.add('invisible');
                break;
            case 2:
                this.loginForm.classList.add('invisible');
                this.remindForm.classList.remove('invisible');
                this.regForm.classList.add('invisible');
                break;
            case 3:
                this.loginForm.classList.add('invisible');
                this.remindForm.classList.add('invisible');
                this.regForm.classList.remove('invisible');
                break;
            default:

        }

        let remind = document.getElementById('remind');
        remind.addEventListener('click', (e) => {
            this.renderModal(2);
        });

        let loginbtn = document.querySelectorAll('.loginbtn');
        loginbtn.forEach( (elem) => {
            elem.addEventListener('click', (e) => {
                this.renderModal(1);
            });
        })

        let regbtn = document.getElementById('regbtn');
        regbtn.addEventListener('click', (e) => {
            this.renderModal(3);
        });

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