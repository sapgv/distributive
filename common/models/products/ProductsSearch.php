<?php

namespace app\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\products\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 * @property mixed name
 */
class ProductsSearch extends Products
{
    public $name_catalog;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'id_catalog', 'popular'], 'integer'],
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
        ->select('products.product_id as product_id, products.name as name, catalogs.name as name_catalog')
        ->leftJoin('catalogs as catalogs','Products.id_catalog = catalogs.id')
        ;

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
            'product_id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'catalogs.name', $this->name_catalog]);
        return $dataProvider;
    }
}
