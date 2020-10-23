class MainPage {
    constructor() {
        this._init();
    }

    _init() {
        let login = document.getElementById('login');
        login.addEventListener('click', this.renderModal);
    }

    renderModal() {
        this.strModal = `
        <div class="modal" id="modal">
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
                <button class="modal__reg modal__reg_white">Зарегистрироваться</button>
            </div>
        </div>
        </div>`;
        let preModal = document.getElementById('premodal');
        preModal.insertAdjacentHTML('afterend', this.strModal);

        let modal = document.getElementById('modal');
        modal.addEventListener('click', (e) => {
            let target = e.target;
            if (!target.closest(".modal__style")) {
                mainPageStart.closeModal();
            }
        });

        let checkEmail = false
        let emailFocus = false;
        let passFocus = false;
        let inputEmail = document.getElementById('inputEmail');
        let inputPass = document.getElementById('inputPass');

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

        inputPass.addEventListener('focus', () => {
            inputPass.placeholder = '';
            passFocus = true;
        });

        inputPass.addEventListener('mouseout', () => {
            (inputPass.value != '') ? inputPass.placeholder = inputPass.value: inputPass.placeholder = "Пароль";
        });

        let remind = document.getElementById('remind');
        remind.addEventListener('click', mainPageStart.remind);
    }

    closeModal() {
        document.getElementById('modal').classList.add('invisible')
    }

    checkEmailMask(value) {
        return (/^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i.test(value))
    }

    remind() {
        console.log('r1');
        let modal = document.getElementById('modal');
        let strRemind = `
        <div class="modal__close" id="close">&times;</div>
        <div class="modal__style" id="mwindow">
        <p class="modal__title">Напомнить пароль</p>
        <form class="modal__form">
            <input class="modal__input" type="text" placeholder="Email" id="inputEmail">
            <div class="modal__sub">
                <button class="modal__btn">Напомнить</button>
            </div>
        </form>
        <div class="div_center">
            <button class="modal__reg modal__reg_white">Зарегистрироваться</button>
        </div>
        </div>`;

        modal.innerHTML = '';
        // let preModal = document.getElementById('premodal');
        modal.insertAdjacentHTML('beforeend', strRemind);

        modal.addEventListener('click', (e) => {
            let target = e.target;
            if (!target.closest(".modal__style")) {
                mainPageStart.closeModal();
            }
        });
    }
}

let mainPageStart = new MainPage();