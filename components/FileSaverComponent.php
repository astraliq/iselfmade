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

    public function saveReportFile(UploadedFile $file, $userId): ?string {
        $name = $this->genReportFileName($file);
        $path = $this->getPathToSaveReportFile($userId) . $name;
        if ($file->saveAs($path)) {
            return $name;
        }
        return null;
    }

    public function saveCommentFile(UploadedFile $file, $userId): ?string {
        $name = $this->genReportFileName($file);
        $path = $this->getPathToSaveCommentFile($userId) . $name;
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

    private function getPathToSaveReportFile($userId) {
        $path = \Yii::getAlias('@webroot/users/report_files/' . $userId . '/');
        FileHelper::createDirectory($path);
        return  $path;
    }

    private function getPathToSaveCommentFile($userId) {
        $path = \Yii::getAlias('@webroot/users/comment_files/' . $userId . '/');
        FileHelper::createDirectory($path);
        return  $path;
    }

    private function genAvatarName(UploadedFile $file) {
        return \Yii::$app->user->getId() . '-' . time() . '-' . $file->getBaseName() . '.' . $file->getExtension();
    }

    private function genReportFileName(UploadedFile $file) {
        return \Yii::$app->user->getId() . '-' . time() . '-' . $file->getBaseName() . '.' . $file->getExtension();
    }

    private function genFileName(UploadedFile $file) {
        return time() . '-' . $file->getBaseName() . '.' . $file->getExtension();
    }

}