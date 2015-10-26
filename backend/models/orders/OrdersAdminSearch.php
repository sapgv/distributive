<?php

namespace backend\models\orders;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\orders\Orders;


/**
 * CatalogsAdminSearch represents the model behind the search form about `app\modules\admin\models\CatalogsAdmin`.
 */
class OrdersAdminSearch extends Orders
{
    
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        // if (!$this->validate()) {
        //     // uncomment the following line if you do not want to any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // $dateFrom = Yii::$app->request->queryParams['date_from'];
        // $dateTo   = strtotime(Yii::$app->request->queryParams['date_to']);

        // $dateFrom = strtotime(Yii::$app->request->queryParams['date_from']);
//         $dateTo   = strtotime(Yii::$app->request->queryParams['date_to']);

        $dateFrom = \DateTime::createFromFormat('d.m.Y', Yii::$app->request->queryParams['date_from']);
        $dateTo = \DateTime::createFromFormat('d.m.Y', Yii::$app->request->queryParams['date_to']);

        if ($dateFrom) {
            $query->andWhere(['>=', 'create_time', $dateFrom->format('Y-m-d')]);
        }

        if ($dateTo) {
            $query->andWhere(['<=', 'create_time', $dateTo->format('Y-m-d')]);
        }

        // if ($dateTo!==null) {

        //    $query->andWhere(['<=', 'create_time', $dateTo]);
        // }

        // print_r($query);

        // $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
