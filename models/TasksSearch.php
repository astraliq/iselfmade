<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class TasksSearch extends Tasks {

    public function search($params = []): ActiveDataProvider {
        if (\Yii::$app->rbac->canViewAll()){
            $query = Tasks::find();
        } else {
            $query = Tasks::find()
                ->where(['user_id' => \Yii::$app->user->getId(),'deleted' => 0])
                ->orderBy('id');
        }

        $provider = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'date_create'=> SORT_DESC,
                    ]
                ],
                "pagination" => [
                    'pageSize' => 10,
                ]
            ]
        );
        $query->with('user');
//        if (!empty($params['year']) & !empty($params['month']) & !empty($params['day'])) {
//            $query->andFilterWhere(['dateStart'=>$params['year'].'-'.$params['month'].'-'.$params['day']]);
//        } elseif (!empty($params['year']) & !empty($params['month'])) {
//            $query->andWhere('YEAR(`dateStart`)= :year',['year'=>$params['year']]);
//            $query->andWhere('MONTH(`dateStart`)= :month',['month'=>$params['month']]);
//        } elseif (!empty($params['year'])) {
//            $query->andWhere('YEAR(`dateStart`)= :year',['year'=>$params['year']]);
//        }


        return $provider;
    }
}