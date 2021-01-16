'use strict';

class Reports {
    constructor() {
        this.skipBtnID = 'skip_report';
        this.nextBtnID = 'next_report';
        this.reportDataBlockID = 'report_data';
        this.countReports = 'count_reports';
        this.userId;
        this.date;
    }

    _post(url, data) {
        return $.post({
            url: url,
            data: data,
            success: function (data) {
                //data приходят те данные, который прислал на сервер
                if (data.result !== true) {
                    console.log('ERROR_POST_DATA');
                }
            }
        })
    }

    _renderReport(html, countReports) {
        $('#' + this.countReports).text(countReports);
        return $('#' + this.reportDataBlockID).replaceWith(html);
    }

    _renderEnd() {
        let html = '<div class="check-content" id="report_data">' +
            '<p>Все отчеты проверены</p>' +
            '</div>';
        $('#' + this.countReports).text(0);
        return $('#' + this.reportDataBlockID).replaceWith(html);
    }

    _changeReportStatus(status) {
        let sendData = {
            'user_id': this.userId,
            'date': this.date,
            'status': status,
        };

        this._post('/report/change-report-status', sendData)
            .then(data => {
                if (data.result === true && data.reportsCount >= 0) {
                    this._renderReport(data.nextReport, data.reportsCount);
                } else {
                    this._renderEnd();
                }
            })
            .catch(error => {
            });
    }

    getData() {
        let reportBlock = document.getElementById(this.reportDataBlockID);
        this.userId = reportBlock.dataset.id;
        this.date = reportBlock.dataset.date;
    }

    init() {
        let nextBtn = document.getElementById(this.nextBtnID);
        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                this.getData();
                this._changeReportStatus(4);
            });
        }
        let skipBtn = document.getElementById(this.skipBtnID);
        if (skipBtn) {
            skipBtn.addEventListener('click', (e) => {
                this.getData();
                this._changeReportStatus(2);
            })
        }
    }
}

let reports = new Reports();
reports.init();







