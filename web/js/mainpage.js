class MainPage {
    constructor() {
        this._init();
        this.strModal;
        this.strModalLogin;
        this.strModalRemind;
        this.strModalReg;
    }

    _init() {
        let login = document.getElementById('login');
        login.addEventListener('click', () => {
            this.renderModal(1);
        });
    }

    renderModal(type) {
        this.strModal = '';
        this.strModalLogin = `
        <div class="modal__close" id="close">&times;</div>
        <div class="modal__style" id="mwindow">
            <p class="modal__title">Вход в систему</p>
            <form class="modal__form">
                <input class="modal__input" type="text" placeholder="Email" id="inputEmail">
                <input class="modal__input" type="password" placeholder="Пароль" id="inputPass">
                <div class="modal__sub">
                    <button class="modal__btn">Войти</button>
                    <a class="modal__link" id="remind">Напомнить пароль</a>
                </div>
            </form>
            <div class="div_center">
                <button class="modal__reg modal__reg_white" id="regbtn">Зарегистрироваться</button>
            </div>
        </div>`;

        this.strModalRemind = `
        <div class="modal__close" id="close">&times;</div>
        <div class="modal__style" id="mwindow">
        <p class="modal__title">Напомнить пароль</p>
        <form class="modal__form-remind">
            <input class="modal__input" type="text" placeholder="Email" id="inputEmail">
            <div class="modal__sub">
                <button class="modal__btn">Напомнить</button>
            </div>
        </form>
        <div class="div_center">
            <button class="modal__reg modal__reg_white" id="regbtn">Зарегистрироваться</button>
        </div>
        </div>`;

        this.strModalReg = `
        <div class="modal__close" id="close">&times;</div>
        <div class="modal__style" id="mwindow">
        <p class="modal__title">Регистрация</p>
        <form class="modal__form-sign">
            <input class="modal__input" type="text" placeholder="Email" id="inputEmail">
            <input class="modal__input" type="password" placeholder="Пароль" id="inputPass">
            <input class="modal__input" type="password" placeholder="Повтор" id="inputPass2">
            <p class="modal__sign-text">Нажимая на кнопку, вы соглашаетесь с <a class="modal__sign-text_link" href="#">нашими правилами</a>
            и <a class="modal__sign-text_link" href="#">политикой конфиденциальности</a></p>
        </form>
        <div class="div_center">
            <button class="modal__btn modal__btn-sign" id="regbtn">Зарегистрироваться</button>
        </div>
        </div>`;

        if (type == 1) {
            document.getElementById('modal').innerHTML = '';
            this.strModal = this.strModalLogin;
        } else if (type == 2) {
            document.getElementById('modal').innerHTML = '';
            this.strModal = this.strModalRemind;
        } else if (type == 3) {
            document.getElementById('modal').innerHTML = '';
            this.strModal = this.strModalReg;
        };

        let modal = document.getElementById('modal');
        modal.classList.remove('invisible');
        modal.insertAdjacentHTML('beforeend', this.strModal);

        if (type == 1) {
            let remind = document.getElementById('remind');
            remind.addEventListener('click', () => {
                document.getElementById('modal').innerHTML = '';
                this.renderModal(2);
            });
        }

        let regbtn = document.getElementById('regbtn');
        regbtn.addEventListener('click', () => {
            document.getElementById('modal').innerHTML = '';
            this.renderModal(3);
        });

        let checkEmail = false
        let emailFocus = false;
        // let passFocus = false;
        let inputEmail = document.getElementById('inputEmail');
        // let inputPass = document.getElementById('inputPass');

        inputEmail.addEventListener('focus', () => {
            inputEmail.placeholder = '';
            emailFocus = true;
        });

        inputEmail.addEventListener('mouseout', () => {
            (inputEmail.value != '') ? inputEmail.placeholder = inputEmail.value: inputEmail.placeholder = "Email";

            checkEmail = mainPageStart.checkEmailMask(inputEmail.value);
            if (!checkEmail && emailFocus) {
                inputEmail.classList.add('input_error');
            } else {
                inputEmail.classList.remove('input_error');
            }
        });

        // inputPass.addEventListener('focus', () => {
        //     inputPass.placeholder = '';
        //     passFocus = true;
        // });

        // inputPass.addEventListener('mouseout', () => {
        //     (inputPass.value != '') ? inputPass.placeholder = inputPass.value: inputPass.placeholder = "Пароль";
        // });

        document.getElementById('modal').addEventListener('click', (e) => {
            let target = e.target;
            if (!target.closest(".modal__style")) {
                mainPageStart.closeModal();
            }
        });
    }

    closeModal() {
        document.getElementById('modal').classList.add('invisible')
        document.getElementById('modal').innerHTML = '';
    }

    checkEmailMask(value) {
        return (/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i.test(value))
    }
}

let mainPageStart = new MainPage();