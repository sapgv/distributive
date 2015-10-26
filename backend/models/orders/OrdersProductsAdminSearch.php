<?php

namespace backend\models\orders;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\orders\OrdersProducts;



/**
 * CatalogsAdminSearch represents the model behind the search form about `app\modules\admin\models\CatalogsAdmin`.
 */
class OrdersProductsAdminSearch extends OrdersProducts
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
    public function search($id)
    {
        $query = OrdersProducts::find()->where(['order_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'id_parent' => $this->id_parent,
        //     'expanded' => $this->expanded,
        //     'root' => $this->root,
        //     'lft' => $this->lft,
        //     'rgt' => $this->rgt,
        //     'level' => $this->level,
        // ]);

        // $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
