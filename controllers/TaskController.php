<?php


namespace app\controllers;


use app\base\BaseController;
use app\controllers\actions\site\ErrorAction;
use app\controllers\actions\task\ArchiveAction;
use app\controllers\actions\task\BoardAction;
use app\controllers\actions\task\CreateAction;
use app\controllers\actions\task\DeleteAction;
use app\controllers\actions\task\FinishAction;
use app\controllers\actions\task\FuruteAction;
use app\controllers\actions\task\GetArchiveAction;
use app\controllers\actions\task\GetMonthsArchiveDataAction;
use app\controllers\actions\task\GoalsAction;
use app\controllers\actions\task\GroupAction;
use app\controllers\actions\task\NextRepeatDateAction;
use app\controllers\actions\task\PossibleAction;
use app\controllers\actions\task\PromisesAction;
use app\controllers\actions\task\RepeatedAction;
use app\controllers\actions\task\SetGradeAction;
use app\controllers\actions\task\TransferAction;
use app\controllers\actions\task\UpdateAllAction;
use app\controllers\actions\task\ViewAction;
use app\controllers\actions\task\ViewAllTasks;
use app\controllers\actions\task\WelcomeAction;
use yii\web\HttpException;


class TaskController extends BaseController {

    public $layout = 'base';


    public function actions() {

        return [
            'create'=>['class'=>CreateAction::class, 'view' => 'create'],
            'change' => ['class' =>CreateAction::class, 'view' => 'create'],
            'transfer'=>['class'=>TransferAction::class],
            'view' => ['class' =>ViewAction::class],
            'report' => ['class' =>ViewAllTasks::class],
            'del' => ['class' =>DeleteAction::class],
            'restore' => ['class' =>DeleteAction::class],
            'hard-del' => ['class' =>DeleteAction::class],
            'finish' => ['class' =>FinishAction::class],
            'update-all' => ['class' =>UpdateAllAction::class],
            'error' => ['class' => ErrorAction::class],
            'repeated' => ['class' => RepeatedAction::class],
            'next-repeat-date' => ['class' => NextRepeatDateAction::class],
            'archive' => ['class' => ArchiveAction::class],
            'get-archive' => ['class' => GetArchiveAction::class],
            'set-grade' => ['class' => SetGradeAction::class],
            'get-months-archive-data' => ['class' => GetMonthsArchiveDataAction::class],
            'welcome' => ['class' => WelcomeAction::class],
            'goals' => ['class' => GoalsAction::class],
            'future' => ['class' => FuruteAction::class],
            'possible' => ['class' => PossibleAction::class],
            'promises' => ['class' => PromisesAction::class],
            'group' => ['class' => GroupAction::class],
            'board' => ['class' => BoardAction::class],
        ];

    }

    public function beforeAction($action) {

        if(!parent::beforeAction($action) ){
            return false;
        }

        if (\Yii::$app->user->isGuest) {
            $this->redirect('/');
            return false;
        }

        if (!\Yii::$app->rbac->canViewOwnTask()) {
            throw new HttpException(403, 'Нет доступа' );
        }

//        if (in_array($action->id, ['index'])) {
//            $this->enableCsrfValidation = false;
//        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


}