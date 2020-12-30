<?php


namespace app\controllers\actions\site;


use app\models\User;
use yii\base\Action;

class GradeResultAction extends Action {
    public function run($result) {
        $modelSignIn = new User([
            'scenario' => 'signIn'
        ]);
        $modelSignUp = new User([
            'scenario' => 'signUp'
        ]);
        $restoreModel = new User([
            'scenario' => 'restorePass'
        ]);
        $this->controller->view->params['signIn'] = $modelSignIn;
        $this->controller->view->params['signUp'] = $modelSignUp;
        $this->controller->view->params['restoreModel'] = $restoreModel;

        if ($result == 1) {
            return $this->controller->render('result_grades', [
                'text' => 'Оценки поставлены. Спасибо.',
            ]);
        }

        return $this->controller->render('result_grades', [
            'text' => 'Произошла ошибка. Оценки не поставлены. Возможно оценки уже были проставлены ранее.',
        ]);
    }
}