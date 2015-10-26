<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;
use common\models\catalogs;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
 

class ProductsCatalogSearch extends Products
{

    const ALL = 'Все';
    const AVAILABLE = 'В наличии';
    const NOT_AVAILABLE = 'Под заказ';
   

    public $name_catalog;
    public $price_min;
    public $price_max;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'catalog_id'], 'integer'],
            [['name_catalog'], 'string'],
            [['name', 'name_catalog', 'price_min', 'price_max', 'comment', 'precontent', 'content'], 'safe'],
            [['price'], 'number'],
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
    public function search($params,$catalog)
    {   
        $productsID = [];

        $productsID = array_merge($productsID,$catalog->getProducts()->select('product_id')->asArray()->all());
        
        foreach ($catalog->children()->all() as $child) {
           $productsID = array_merge($productsID,$child->getProducts()->select('product_id')->asArray()->all());
        }


        $query = Products::find()
        ->where(['product_id'=>$productsID])
        ;

        $price_min = $query->min('price');
        $price_max = $query->max('price');

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

 

        $query->andFilterWhere(['like', 'name', $this->name]);

            // print_r($this->price_min);
        $query->andFilterWhere(['>=', 'price', $this->price_min]);
        $query->andFilterWhere(['<=', 'price', $this->price_max]);

        //print_r($params['ProductsCatalogSearch']);
        if ($params['ProductsCatalogSearch']['count'] == self::ALL) {
            // echo "всееее";
            // $query->andWhere('a > :a', ['a' => 'a'])
        }
        elseif ($params['ProductsCatalogSearch']['count'] == self::AVAILABLE) {
            // echo "в наличиbbи";
            $query->andWhere('count > 0');
        }
        elseif ($params['ProductsCatalogSearch']['count'] == self::NOT_AVAILABLE) {
            // echo "нетууу";
            $query->andWhere('count <= 0');
        }

        return [
                'dataProvider'=>$dataProvider,
                'price_min'=>$price_min,
                'price_max'=>$price_max];
    }
}
