"use strict";

class Comments {
    constructor(commentsID, commentsSendBtnID, commentClass, commentText) {
        this.commentsBlockID = commentsID;
        this.commentsSendBtnID = commentsSendBtnID;
        this.commentClass = commentClass;
        this.commentInputID = commentText;
        this.comment;
        this.report_id;
        this.files;

    }

    _post(url, data) {
        return $.ajax({
            url: url,
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            // отключаем обработку передаваемых данных, пусть передаются как есть
            processData: false,
            // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
            contentType: false,
            success: function (data) {
                //data приходят те данные, который прислал на сервер
                if (data.result !== true) {
                    console.log('ERROR_POST_DATA');
                }
            }
        })
    }

    getFormData(commentsSection, commentInput) {
        this.comment = commentInput.value;
        this.report_id = commentsSection.dataset.report_id;
        this.files = userReport.files;
    }

    checkComment(comment) {
        return comment.length > 0;
    }

    updateAutoresize(commentInput) {
        autosize.destroy(commentInput);
        autosize(commentInput);
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

    _addEventsToInput(commentsBlock, commentsSection, commentInput) {
        // ctrl + enter - переход на новую строку
        commentInput.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.keyCode == 17) && (e.which == 13 || e.keyCode == 13)) {
                e.preventDefault();
                let caretPos = this.getCaretPos(commentInput);
                let comment = $(commentInput).val();
                comment = comment.slice(0, caretPos) + '\r\n' + comment.slice(caretPos,comment.length);
                $(commentInput).val(comment);
                this.setCaretPosition(commentInput, caretPos+1);
                autosize.update($(commentInput));
            }
        });

        // не ctrl + enter - создание новой задачи
        commentInput.addEventListener('keypress', (e) => {
            if ((!e.ctrlKey || !e.which == 17) && (e.which == 13 || e.keyCode == 13)) {
                e.preventDefault();
                this.addComment(commentsBlock, commentsSection, commentInput);
            }
        });
    }

    addComment(commentsBlock, commentsSection, commentInput) {
        this.getFormData(commentsSection, commentInput);
        if (!this.checkComment(this.comment) && !this.files) {
            console.log('Комментарий не может быть пустой.');
            return false;
        }

        let sendData = new FormData();
        if (this.files) {
            let counter = 0;
            this.files.forEach( (file, index) => {
                if (file ) {
                    sendData.append(`ReportComments[uploadFiles][${counter}]`, userReport.realFileList[index]);
                    counter++;
                }
            });
        }
        sendData.append('ReportComments[comment]', this.comment);
        sendData.append('ReportComments[report_id]', this.report_id);

        this._post('/report/add-comment', sendData)
            .then(data => {
                if (data.result) {
                    this._renderComment(commentsBlock, data.comment);
                    commentInput.value = '';
                    this._scrollCommentsDown(commentsBlock);
                    this._clearFiles();
                    autosize.update($(commentInput));
                    let newModals = new ModalImg(`comments__uploaded_files-${data.comment_id}`, '.input_img');
                    newModals.init();
                } else {
                    console.log('false');
                }
            })
            .catch(error => {
            });
    }

    init() {
        let commentsSection = document.getElementById(this.commentsBlockID);
        if (!commentsSection) {
            console.log('Отсутствует блок коментариев...');
            return false;
        }
        let btn = document.getElementById(this.commentsSendBtnID);
        let commentInput = document.getElementById(this.commentInputID);
        let commentsBlock = commentsSection.querySelector('.comments__block');
        let comments = commentsSection.querySelectorAll(this.commentClass);
        
        this.updateAutoresize(commentInput);
        this._scrollCommentsDown(commentsBlock);
        this._addEventsToInput(commentsBlock, commentsSection, commentInput);

        btn.addEventListener('click', (e) => {
           this.addComment(commentsBlock, commentsSection, commentInput);
        });
    }

    _scrollCommentsDown(commentsBlock) {
        $(commentsBlock).scrollTop( $(commentsBlock).prop('scrollHeight'));
    }

    _clearFiles() {
        this.files = [];
        userReport.realFileList = [];
        document.getElementById(userReport.fileListId).innerHTML = '';
    }

    _renderComment(commentsBlock, comment) {
        let noComments = commentsBlock.querySelector('.comments__no');
        if (noComments) {
            noComments.remove();
        }
        commentsBlock.insertAdjacentHTML('beforeEnd', comment);
    }


}

let comment = new Comments('comments', 'send_comment','comments__item', 'comment_text');
comment.init();