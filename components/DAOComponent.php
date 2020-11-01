<?php


namespace app\components;


use app\base\BaseComponent;
use yii\base\Component;
use yii\caching\TagDependency;
use yii\db\Connection;
use yii\db\Query;

class DAOComponent extends BaseComponent {

    public $usersTable = 'users';
    public $tasksTable = 'mission_tasks';

    private function GetConnection():Connection {
        return \Yii::$app->db;
    }

    public function getUsersList():?array {
        $sql = "SELECT * FROM $this->usersTable";
        return $this->getConnection()->createCommand($sql)->queryAll();
    }

    public function getAllUserTasks($userId=''): ?array {
        $sql = "SELECT * FROM $this->tasksTable WHERE user_id = :userId";
        return $this->getConnection()->createCommand($sql,[':userId' => $userId])->queryAll();
    }

    /**
     * @param string $userId - id пользователя в текущей сессии
     * @param string $typeId - id типа задачи
     * @return array
     */
    public function getUserTasksByType($userId='',$typeId=''){
        $query=new Query();
//        TagDependency::invalidate(\Yii::$app->cache,'tag1');
        return $query->from($this->tasksTable)
            ->select('*')
            ->andWhere(['user_id'=>$userId,'type_id'=>$typeId])
            ->orderBy(['date_create'=>SORT_DESC])
//            ->cache(10,new TagDependency(['tags' => ['tag1','tag2']]))
            ->all($this->getConnection());
//        ->createCommand()->rawSql;
    }

    /*
    public function getCountMissions(){
        $query=new Query();
        $record=$query->from('activity')
            ->select('count(id)')
            ->cache(10)
            ->scalar($this->getConnection());
        return $record;
    }

    public function getActivityReader(){
        $query=new Query();
        $record=$query->from('activity')
            ->createCommand()->query();
        return $record;
    }

    public function insertTransactions(){
        $trans=$this->getConnection()->beginTransaction();
        try{
            $i=$this->getConnection()
                ->createCommand()
                ->insert('activity',['title'=>'new1','userID'=>1,'dateStart'=>date('Y-m-d')])
                ->execute();
//            throw new Exception('er');
            $this->getConnection()->createCommand()
                ->update('activity',['title'=>'update1'],['id'=>1])
                ->execute();
            $trans->commit();
        }catch (\Exception $e){
            $trans->rollBack();
            \Yii::error($e->getTrace());
        }
        $this->getConnection()->transaction(function(){

        });
    }
    */
}