<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsCartSearch extends Products {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // [['id', 'id_catalog'], 'integer'],
            // [['name_catalog'], 'string'],
            // [['name', 'name_catalog', 'comment', 'precontent', 'content'], 'safe'],
            // [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $products
     *
     * @return ActiveDataProvider
     */
    public function search($products) {
        $productsID = [ ];

        foreach ($products as $product) {
            $productsID[] = $product->product_id;
        }


        $query = Products::find()
            ->where([ 'product_id' => $productsID ]);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,

            'pagination' => [
                'pageSize' => 5,
            ],

        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
