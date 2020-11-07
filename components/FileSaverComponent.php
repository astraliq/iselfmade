<?php


namespace app\components;


use app\base\BaseComponent;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileSaverComponent extends BaseComponent {

    public function saveFile(UploadedFile $file): ?string {
        $name = $this->genFileName($file);
        $path = $this->getPathToSave() . $name;
        if ($file->saveAs($path)) {
            return $name;
        }
        return null;
    }

    private function getPathToSave() {
        $path = \Yii::getAlias('@webroot/files/');
        FileHelper::createDirectory($path);
        return  $path;
    }

    public function saveAvatar(UploadedFile $file): ?string {
        $name = $this->genAvatarName($file);
        $path = $this->getPathToSaveAvatar() . $name;
        if ($file->saveAs($path)) {
            return $name;
        }
        return null;
    }

    private function getPathToSaveAvatar() {
        $path = \Yii::getAlias('@webroot/users/ava/');
        FileHelper::createDirectory($path);
        return  $path;
    }

    private function genAvatarName(UploadedFile $file) {
        return \Yii::$app->user->getId() . '-' . time() . '-' . $file->getBaseName() . '.' . $file->getExtension();
    }

    private function genFileName(UploadedFile $file) {
        return time() . '-' . $file->getBaseName() . '.' . $file->getExtension();
    }

}