<?php

namespace common\models\characteristics;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\characteristics\Characteristics;

/**
 * CharacteristicsSearch represents the model behind the search form about `app\models\characteristics\Characteristics`.
 */
class CharacteristicsSearch extends Characteristics
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['characteristic_id', 'product_id'], 'integer'],
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
    public function search($params,$product)
    {
        $query = Characteristics::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($product->viewproduct->common_characteristics) {
            //общие характеристики ищем по view_product (вид номенклатуры)
            $query->andFilterWhere([
                'view_product_id' => $product->viewproduct->view_product_id,
            ]);
        }
        else {
            //индивидуальные характеристики ищем по product (номенклатуре)
            $query->andFilterWhere([
                'product_id' => $product->product_id,
            ]);
        }
        $query->andFilterWhere([
            'characteristic_id' => $this->characteristic_id,
        ]);


        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
