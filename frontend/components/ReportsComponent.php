<?php


namespace frontend\components;


use common\base\BaseComponent;
use frontend\models\UsersReports;
use yii\base\Component;
use yii\db\Expression;
use yii\web\UploadedFile;

class ReportsComponent extends BaseComponent {
    public $modelClass;

    public function init() {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function getModel() {
        return new $this->modelClass;
    }

    public function getFirstUserReport() {
        $todayUTC = date('Y-m-d');
        $report = UsersReports::find()
            ->andWhere(['OR',
                ['IS', 'status', null],
                ['=', 'status', 1],
            ])
            ->orderBy([
                'views' => SORT_ASC,
                'date' => SORT_ASC,
            ])
            ->one();

        if (!$report) {
            $report = UsersReports::find()
                ->where([
                    'status' => 2,
                ])
                ->orderBy([
                    'views' => SORT_ASC,
                    'date' => SORT_ASC,
                ])
                ->one();
        }
//        if (!$report) {
//            $report = UsersReports::find()
//                ->where([
//                    'status' => 3,
//                ])
//                ->orderBy([
//            'views' => SORT_ASC,
//            'date' => SORT_ASC,
//        ])
//        ->one();
//        }
        if ($report) {
            if (!$report->views) {
                $report->views = 1;
            } else {
                $report->views = ++$report->views;
            }
            $report->save();
        }

        return $report;
    }

    public function getNextUserReport() {
//        $todayUTC = date('Y-m-d');
        $report = UsersReports::find()
//            ->where([
//                'date' => $todayUTC,
//                'status' => null,
//            ])
            ->andWhere(['OR',
                ['IS', 'status', null],
                ['<', 'status', 3],
            ])
            ->one();
        return $report;
    }

    public function getUserReportById($id) {
        $report = UsersReports::find()
            ->where([
                'id' => $id,
            ])
            ->one();
        return $report;
    }

    public function getLastReportDate() {
        $report = UsersReports::find()
//            ->where([
//                'id' => $id,
//            ])
            ->orderBy(['date_create' => SORT_DESC])
            ->one();
        return $report->date_create;
    }

    public function getCountReportsToCheck() {
//        $todayUTC = date('Y-m-d');
        $reportsCount = UsersReports::find()
//            ->where([
//                'date' => $todayUTC,
//                'status' => null,
//            ])
            ->andWhere(['OR',
                ['IS', 'status', null],
                ['<', 'status', 3],
            ])
            ->count();
        return $reportsCount;
    }

    public function changeReportStatus($userId, $date, $status) {
        $d = \DateTime::createFromFormat('d.m.Y', $date)->format('Y-m-d');

        $this->modelClass = UsersReports::class;
        $model = $this->getModel();
        $report = $model->findOne(['user_id' => $userId, 'date' => $d]);

        $report->status = $status;
        if ($report->save(false)) {
            return true;
        }
        return false;
    }

    public function updateReport(UsersReports $report) :bool {
        $userId = \Yii::$app->user->getId();

        $report->uploadFiles = UploadedFile::getInstancesByName('UsersReports[uploadFiles]');
        $fileSaver = \Yii::createObject(['class' => FileSaverComponent::class]);
        $fileArr = [];
        if ($report->validate()) {
            if ($report->uploadFiles) {
                foreach ($report->uploadFiles as $file) {
                    $file = $fileSaver->saveReportFile($file, $userId);
                    array_push($fileArr, $file);
                    if (!$file) {
                        return false;
                    }
                }
                $report->files = join('/', $fileArr);
            }

            if ($report->save(false)) {
                return true;
            }

            \Yii::error($report->getErrors());
            return false;
        }

        //валидация файлов не прошла
        return false;
    }

    public function getUserReportsByDatesArr($dates) {
        $userId = \Yii::$app->user->getId();
        return UsersReports::find()
            ->where([
                'date' => $dates,
                'user_id' => $userId,
            ])
//            ->select(['id', 'date', 'status'])
            ->all();
    }

    public function getLastReports($count) {
        $userId = \Yii::$app->user->getId();
        $reports = UsersReports::find()
            ->where([
                'user_id' => $userId,
            ])
            ->orderBy('date')
            ->limit($count)
            ->all();
        return $reports;
    }

}