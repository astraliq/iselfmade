<?php


namespace app\controllers\actions\site;


use app\models\User;
use yii\base\Action;

class ConfirmCuratorEmailAction extends Action {
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
            return $this->controller->render('confirmed_for_curator', [
                'text' => 'Подтверждение зафиксировано. Спасибо.',
            ]);
        }

        return $this->controller->render('confirmed_for_curator', [
            'text' => 'Ошибка подтверждения. Возможно пользователь отменил действие или Вам отправлено другое письмо со ссылкой подтверждения',
        ]);
    }
}