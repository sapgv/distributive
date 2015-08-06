<?php

namespace common\models\property;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\property\PropertyCharacteristic;

/**
 * CharacteristicsSearch represents the model behind the search form about `app\models\characteristics\Characteristics`.
 */
class PropertyCharacteristicSearch extends PropertyCharacteristic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

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
        $query = PropertyCharacteristic::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }




        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
