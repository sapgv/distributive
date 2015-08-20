<?php

namespace backend\models\products;
        
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;
use common\models\catalogs\Catalogs;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsAdminSearch extends Products
{
    public $name_catalog;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'catalog_id', 'popular'], 'integer'],
            [['name_catalog'], 'string'],
            [['name', 'name_catalog', 'comment', 'precontent', 'content', 'source', 'versions_data'], 'safe'],
            [['count', 'price'], 'number'],
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
        $query = Products::find()
        ->select('products.product_id as product_id, products.name as name, products.price as price, products.count as count, products.popular as popular, catalogs.name as name_catalog')
        ->leftJoin('catalogs as catalogs','Products.catalog_id = catalogs.catalog_id')
        ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'products.popular' => $this->popular,
           
        ]);

        $query->andFilterWhere([
            'product_id' => $this->product_id,

        ]);

        $query->andFilterWhere(['like', 'products.name', $this->name])
            ->andFilterWhere(['like', 'catalogs.name', $this->name_catalog])
            
            ;

        return $dataProvider;
    }
}
