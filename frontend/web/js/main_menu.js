"use strict";

class Update {
    constructor() {
        this.interval = 3000;
        this.info_bell_ID = 'info-bell';
        this.notif_list;
        this.notifBlockId = 'notification__block';
        this.notifsId = 'notifications';
        this.settingsId = 'menu__settings';
        this.settingsItemsId = 'settings__items';
    }

    _get(url, data) {
        return $.get({
            url: url,
            data: data,
            success: function (data) {
            }
        })
    }

    _renderNotificationsCount(count) {
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

    getComments(report_ids) {
        const commentSection = document.getElementById(comment.commentsBlockID);
        if (commentSection) {
            const sectionReportId = commentSection.dataset.report_id
            let checkReportId = report_ids.find(id => {
                return id == sectionReportId;
            });

            if (checkReportId) {

                const commentsBlock = commentSection.querySelector('.comments__block');
                const commentsElems = document.querySelectorAll(comment.commentClass);
                let ids = [];
                commentsElems.forEach((elem) => {
                    ids.push(elem.dataset.id);
                });
                const commentsLastElem = document.querySelector(comment.commentClass + ':last-child');
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
                            data.new_comments.forEach((new_comment, i) => {
                                if (!ids.find((realId) => {
                                    return realId == data.new_comments_ids[i];
                                })) {
                                    comment._renderComment(commentsBlock, new_comment);
                                    comment._scrollCommentsDown(commentsBlock);
                                }
                                data.new_comments_ids.forEach((id) => {
                                    let newModals = new ModalImg(`comments__uploaded_files-${id}`, '.input_img');
                                    newModals.init();
                                });
                            });

                        }
                    })
                    .catch(error => {
                    });
            }
        }
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
        }, 10);
    }

    hideNotifs(elemId) {
        let elem = document.getElementById(elemId);
        elem.classList.add('invisible');
        setTimeout(()=>{
            elem.classList.add('d-none');
        }, 300);
    }

    init() {
        let bell = document.getElementById(this.notifsId);
        if (bell) {
            bell.addEventListener('click', (e) => {
                this.getNotifs(this.notifBlockId);
                this.showNotifs(this.notifBlockId);
            });
        }

        let settingsBtn = document.getElementById(this.settingsId);
        if (settingsBtn) {
            settingsBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.showNotifs(this.settingsItemsId);
            });
        }

        if (bell && settingsBtn) {
            document.querySelector('.container').addEventListener('click', (e) => {
                if (!e.target.closest('.notification')) {
                    this.hideNotifs(this.notifBlockId);
                }
            });
        }

    }

}

const update = new Update();
update.init();

class UserMenu extends Update{
    constructor(props) {
        super(props);
        this.userMenuID = 'user_menu';
        this.userMenuBlock = 'user_menu_block';
    }

    init() {
        let ava = document.getElementById(this.userMenuBlock);
        if (ava) {
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
}

const userMenu = new UserMenu();
userMenu.init();

class eventsUpdate {
    eventSource;
    eventsLog = [];
    update;
    userMenu;

    constructor(update, userMenu) {
        this.update = update;
        this.userMenu = userMenu;
        this._init();
    }

    _init() {
        this.eventSource = new EventSource('/site/events-update');

        this.eventSource.addEventListener('open', (e) => {
            this.eventsLog.status = 'EventSource first connection to server.';
            console.log(this.eventsLog.status);
        }, {once: true});

        this.eventSource.addEventListener('message', (e) => {
            e.data && console.log(e.data);
            if (e.lastEventId === '-1') {
                this.eventSource.close();
                this.eventsLog.status = 'EventSource connection closed by server limit.';
                console.log(this.eventsLog.status);
            }
        });

        this.eventSource.addEventListener('notifCountData', (e) => {
            const {count, report_ids} = JSON.parse(e.data);
            this.update._renderNotificationsCount(count);
            count > 0 && this.update.getComments(report_ids);
            // console.log(count, report_ids);
        })

        this.eventSource.addEventListener('error', (e) => {
            this.eventSource.close();
            this.eventsLog.status = `EventSource error:`;
            console.log(this.eventsLog.status);
            // console.log(e);
        }, {once: true});

    }

    closeConnection() {
        this.eventSource.close();
        this.eventLog.status = 'EventSource connection closed by client.'
    }

    _renderNotifications(html) {
        let notifBlock = document.getElementById(this.notifBlockId);
        notifBlock.innerHTML = '';
        notifBlock.insertAdjacentHTML('afterbegin', html);
    }

}

const events = new eventsUpdate(update, userMenu);