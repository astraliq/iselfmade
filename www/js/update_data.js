"use strict";

class Update {
    constructor() {
        this.interval = 10000;
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

    showNotifs() {
        let notifs = document.getElementById(this.notifBlockId);
        notifs.classList.remove('d-none');
        setTimeout(()=>{
            notifs.classList.remove('invisible');
        }, 1);
    }

    hideNotifs() {
        let notifs = document.getElementById(this.notifBlockId);
        notifs.classList.add('invisible');
        setTimeout(()=>{
            notifs.classList.add('d-none');
        }, 300);
    }

    init() {
        this.sendRequest();
        setInterval(() => {this.sendRequest()}, this.interval);
        let bell = document.getElementById(this.notifsId);

        bell.addEventListener('click', (e) => {
            this.getNotifs();
            this.showNotifs();
        });
        document.querySelector('.container').addEventListener('click', (e) => {
            if (!e.target.closest('.notification')) {
                this.hideNotifs();
            }
        });
    }

}

let update = new Update();
update.init();