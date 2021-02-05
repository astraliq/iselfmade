"use strict";

class Update {
    constructor() {
        this.interval = 3000;
        this.info_bell_ID = 'info-bell';
        this.notif_list;
        this.notifBlockId = 'notification__block';
        this.notifsId = 'notifications';
    }

    _get(url, data) {
        return $.get({
            url: url,
            data: data,
            success: function (data) {
            }
        })
    }

    _renderNotificationsCount(count, notifList) {
        let bell = document.getElementById(this.info_bell_ID);
        if (count == 0) {
            $(bell).hide();
            return;
        }
        $(bell).show();
        bell.innerText = count;
    }

    _renderNotifications(html) {
        let notifBlock = document.getElementById(this.notifBlockId);
        notifBlock.innerHTML = '';
        notifBlock.insertAdjacentHTML('afterbegin', html);
    }

    sendRequest() {
        let commentSection = document.getElementById(comment.commentsBlockID);
        let commentsBlock;
        if (commentSection) {
            commentsBlock = commentSection.querySelector('.comments__block');
            let commentsElems = document.querySelectorAll(comment.commentClass);
            let ids = [];
            commentsElems.forEach( (elem) => {
                ids.push(elem.dataset.id);
            });
            let commentsLastElem = document.querySelector(comment.commentClass + ':last-child');
            let lastId;
            if (commentsLastElem) {
                lastId = commentsLastElem.dataset.id;
            }
            let sendData2 = {
                'lastCommentId': lastId,
                'reportId': commentSection.dataset.report_id,
            };

            this._get('/report/get-new-comments', sendData2)
                .then(data => {
                    if (data.result) {
                        data.new_comments.forEach( (new_comment, i) => {
                            if (!ids.find( (realId) => {
                                return realId == data.new_comments_ids[i];
                            })) {
                                comment._renderComment(commentsBlock, new_comment);
                                comment._scrollCommentsDown(commentsBlock);
                            }
                            data.new_comments_ids.forEach( (id) => {
                                let newModals = new ModalImg(`comments__uploaded_files-${id}`, '.input_img');
                                newModals.init();
                            });
                        });

                    }
                })
                .catch(error => {
                });
        }
        let sendData = {
        };

        this._get('/site/update-data', sendData)
            .then(data => {
                if (data.result) {
                    this.notif_list = data.new_comments;
                    this._renderNotificationsCount(data.notif_count, data.new_comments);
                } else {
                    this.notif_list = data.new_comments;
                    this._renderNotificationsCount(data.notif_count, data.new_comments);
                }
            })
            .catch(error => {
            });

    }

    getNotifs() {
        let sendData = {
        };

        this._get('/site/get-notifs', sendData)
            .then(data => {
                if (data.result) {
                    this._renderNotifications(data.html);
                } else {
                    this._renderNotifications(data.html);
                }
            })
            .catch(error => {
            });
    }

    showNotifs(elemId) {
        let elem = document.getElementById(elemId);
        if (!elem.classList.contains('invisible')) {
            this.hideNotifs(elemId);
            return;
        }
        elem.classList.remove('d-none');
        setTimeout(()=>{
            elem.classList.remove('invisible');
        }, 1);
    }

    hideNotifs(elemId) {
        let elem = document.getElementById(elemId);
        elem.classList.add('invisible');
        setTimeout(()=>{
            elem.classList.add('d-none');
        }, 300);
    }

    init() {
        this.sendRequest();
        setInterval(() => {this.sendRequest()}, this.interval);
        let bell = document.getElementById(this.notifsId);
        bell.addEventListener('click', (e) => {
            this.getNotifs(this.notifBlockId);
            this.showNotifs(this.notifBlockId);
        });
        document.querySelector('.container').addEventListener('click', (e) => {
            if (!e.target.closest('.notification')) {
                this.hideNotifs(this.notifBlockId);
            }
        });
    }

}

let update = new Update();
update.init();

class UserMenu extends Update{
    constructor(props) {
        super(props);
        this.userMenuID = 'user_menu';
        this.userImgID = 'user__img';
    }

    init() {
        let ava = document.getElementById(this.userImgID);
        ava.addEventListener('click', (e) => {
            this.getNotifs(this.userMenuID);
            this.showNotifs(this.userMenuID);
        });
        document.querySelector('.container').addEventListener('click', (e) => {
            if (!e.target.closest('.user_menu')) {
                this.hideNotifs(this.userMenuID);
            }
        });
    }
}

let userMenu = new UserMenu();
userMenu.init();