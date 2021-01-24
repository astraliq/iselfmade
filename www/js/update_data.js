"use strict";

class Update {
    constructor() {
        this.interval = 5000;
        this.info_bell_ID = 'info-bell';
        this.notif_list;
    }

    _get(url, data) {
        return $.get({
            url: url,
            data: data,
            success: function (data) {
                if (!data.result) {
                    console.log('ERROR_GET_DATA');
                }
            }
        })
    }

    _renderNotifications(count, notifList) {
        let bell = document.getElementById(this.info_bell_ID);
        $(bell).show();
        bell.innerText = count;
    }

    sendRequest() {
        let sendData = {
        };

        this._get('/site/update-data', sendData)
            .then(data => {
                if (data.result) {
                    this.notif_list = data.new_comments;
                    this._renderNotifications(data.notif_count, data.new_comments);
                }
            })
            .catch(error => {
            });
    }

    init() {
        this.sendRequest();
        setInterval(() => {this.sendRequest()}, this.interval);
    }

}

let update = new Update();
update.init();