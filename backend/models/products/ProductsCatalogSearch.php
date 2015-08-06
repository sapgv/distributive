<?php

namespace app\modules\admin\models\products;
        
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\products\Products;
use app\models\catalogs\catalogs;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsCatalogSearch extends Products
{
    public $name_catalog;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_catalog', 'popular'], 'integer'],
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
        // ->select('products.id as id, products.name as name, catalogs.name as name_catalog')
        // ->leftJoin('catalogs as catalogs','Products.id_catalog = catalogs.id')
        ;
        // print_r($params['id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            // return $dataProvider;
        }


        $query->andFilterWhere([
            'id' => $params['id'],
            // 'id_catalog' => $this->id_catalog,
            // 'id_catalog' => $this->catalog->name,
            // 'count' => $this->count,
            // 'price' => $this->price,
            // 'popular' => $this->popular,
        ]);

        // $query->andFilterWhere(['like', 'name', $this->name])
        //     ->andFilterWhere(['like', 'catalogs.name', $this->name_catalog])
        //     // ->andFilterWhere(['like', 'comment', $this->comment])
        //     // ->andFilterWhere(['like', 'precontent', $this->precontent])
        //     // ->andFilterWhere(['like', 'content', $this->content])
        //     // ->andFilterWhere(['like', 'source', $this->source])
        //     // ->andFilterWhere(['like', 'versions_data', $this->versions_data])
        //     ;

        //     // print_r($query);
        return $dataProvider;
    }
}
