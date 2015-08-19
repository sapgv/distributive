<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;


/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
 

class ProductsCartSearch extends Products
{

    
    /**
     * @inheritdoc
     */
    public function rules()
    {
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
    public function search($products)
    {
        $productsID = [];
        
        foreach ($products as $product) {
           $productsID[] = $product->product_id;
        }


        $query = Products::find()
        ->where(['product_id'=>$productsID])
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
                'pageSize' => 5,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // $query->andFilterWhere([
        //     'id' => $this->id,
        // ]);

        
        

        // $query->andFilterWhere(['like', 'name', $this->name])
            
        //     ;

        //     // print_r($query);

        // if ($params['ProductsPopularSearch']['count'] == self::ALL) {
        //     // echo "всееее";
        //     // $query->andWhere('a > :a', ['a' => 'a'])
        // }
        // elseif ($params['ProductsPopularSearch']['count'] == self::AVAILABLE) {
        //     // echo "в наличии";
        //     $query->andWhere('count > 0');
        // }
        // elseif ($params['ProductsPopularSearch']['count'] == self::NOT_AVAILABLE) {
        //     // echo "нетууу";
        //     $query->andWhere('count <= 0');
        // }
        return $dataProvider;
    }
}
