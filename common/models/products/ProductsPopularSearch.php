<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use common\models\products\Products;
use common\models\catalogs;
use frontend\controllers\CookieController;
/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
 

class ProductsPopularSearch extends Products
{

    const ALL = 'Все';
    const AVAILABLE = 'В наличии';
    const NOT_AVAILABLE = 'Под заказ';
   

    public $name_catalog;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'catalog_id'], 'integer'],
            [['name_catalog'], 'string'],
            [['name', 'name_catalog', 'comment', 'precontent', 'content'], 'safe'],
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
    public function search($params)
    {
        $viewList = CookieController::getViewList();

        $query = Products::find()
        ->select([
            'product_id',
            'name',
            'price',
            'gallery_id',
            "IF (LENGTH(precontent) > 200,
                CONCAT(LEFT(TRIM(TRAILING '.' FROM precontent),150),'...'),
                LEFT(TRIM(TRAILING '.' FROM precontent),150))
             as precontent"
         ])
        
        ->where(['popular' => true]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

            'pagination' => [
                'pageSize' => ($viewList=='panel') ? 6 : 5,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'product_id' => $this->id,
        ]);

        
        

        $query->andFilterWhere(['like', 'name', $this->name])
            // ->andFilterWhere(['like', 'catalogs.name', $this->name_catalog])
            // ->andFilterWhere(['like', 'comment', $this->comment])
            // ->andFilterWhere(['like', 'precontent', $this->precontent])
            // ->andFilterWhere(['like', 'content', $this->content])
            // ->andFilterWhere(['like', 'source', $this->source])
            // ->andFilterWhere(['like', 'versions_data', $this->versions_data])
            ;

            // print_r($query);

//        if ($params['ProductsPopularSearch']['count'] == self::ALL) {
//            // echo "всееее";
//            // $query->andWhere('a > :a', ['a' => 'a'])
//        }
//        elseif ($params['ProductsPopularSearch']['count'] == self::AVAILABLE) {
//            // echo "в наличии";
//            $query->andWhere('count > 0');
//        }
//        elseif ($params['ProductsPopularSearch']['count'] == self::NOT_AVAILABLE) {
//            // echo "нетууу";
//            $query->andWhere('count <= 0');
//        }
        return $dataProvider;
    }
}
