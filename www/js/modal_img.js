'use strict';

class ModalImg {
    constructor(listId, imgClass) {
        this.listId = listId; // блок с картинками
        this.imgClass = imgClass; // класс с картинок
        this.imgFolder = ''; // папка с файлами картинок
        this.listBlock;
        this.images;
        this.userId;
    }

    _renderModal(name, img) {
        let modalWindow = $('#modal_image');
        let modalImage = $('#modal_img');
        let timeout;
        if (modalWindow.is(":visible")) {
            timeout = 500;
            this._closeModal();
        } else {
            timeout = 0;
        }

        setTimeout( () =>{
            let html = `<img class="modal_img" id="modal_img" src="${this.imgFolder + name}" alt="${name}" title="${name}">`;
            document.getElementById('image_block').innerHTML = html;
            let modalWindow = $('#modal_image');
            let modalImage = $('#modal_img');
            let winH = $(window).height();
            let winW = $(window).width();
            //Устанавливаем всплывающее окно по центру
            modalImage.css('max-height', winH / 1.15);
            modalImage.css('max-width', winW / 1.15);
            modalWindow.css('top', winH / 2 - modalWindow.height() / 2);
            modalWindow.css('left', winW / 2 - modalWindow.width() / 2);
            modalWindow.fadeIn(500);
        }, timeout);

        $(document).mouseup((e) => { // событие клика по веб-документу
            if (!modalWindow.is(e.target) && modalWindow.has(e.target).length === 0) { // если клик был не по нашему блоку и не по его дочерним элементам
                this._closeModal();
            }
        });
    }

    _closeModal() {
        $('#modal_image').fadeOut(500);
    }

    init() {
        // document.querySelector('body').addEventListener('click', (e) => {
        //     if (e.target != document.getElementById('modal_image')) {
        //         this._closeModal();
        //     }
        // });
        if (document.getElementById('user_id')) {
            this.userId = document.getElementById('user_id').dataset.user_id;
            this.imgFolder = '/users/report_files/' + this.userId + '/';
        }

        this.listBlock = document.getElementById(this.listId);
        if (this.listBlock) {
            this.images = this.listBlock.querySelectorAll(this.imgClass);
        }
        let html = `<div class="modal_image" id="modal_image" style="display: none"> 
                <div class="image_block" id="image_block"></div>
                <div class="modal_image-close" id="modal_image-close">+</div>
            </div>`;
        if (this.listBlock) {
            this.listBlock.insertAdjacentHTML('afterend', html);

            document.getElementById('modal_image-close').addEventListener('click', (e) => {
                this._closeModal();
            });
            if (this.listBlock) {
                this.images.forEach( (img) => {
                    img.addEventListener('click', (e) => {
                        this._renderModal(img.dataset.name, img);
                    });
                });
            }
        }


    }

}

let modalImg = new ModalImg('file_list', '.input_img');
modalImg.init();
let modalImg2 = new ModalImg('check_uploaded_files', '.input_img');
modalImg2.init();
let modalImg3 = new ModalImg('comments', '.input_img');
modalImg3.init();