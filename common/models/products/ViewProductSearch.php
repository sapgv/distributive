<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\ViewProduct;

/**
 * ViewProductSearch represents the model behind the search form about `app\models\products\ViewProduct`.
 */
class ViewProductSearch extends ViewProduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['view_product_id', 'common_characteristics'], 'integer'],
            [['name'], 'safe'],
        ];
    }

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
        $query = ViewProduct::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'view_product_id' => $this->view_product_id,
            'common_characteristics' => $this->common_characteristics,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
