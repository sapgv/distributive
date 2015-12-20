<?php

namespace common\models\products;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\catalogs;
use frontend\controllers\CookieController;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsPopularSearch extends Products {

    public $name_catalog;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'product_id', 'catalog_id' ], 'integer' ],
            [ [ 'name_catalog' ], 'string' ],
            [ [ 'name', 'name_catalog', 'comment', 'precontent', 'content' ], 'safe' ],
            [ [ 'price' ], 'number' ],
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
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
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
             as precontent",
            ])
            ->where([ 'popular' => true ]);

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,

            'pagination' => [
                'pageSize' => ($viewList == 'panel') ? 6 : 5,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            return $dataProvider;
        }

        if (isset($params[ 'ProductsPopularSearch' ][ 'count' ])) {

            if ($params[ 'ProductsPopularSearch' ][ 'count' ] == Products::AVAILABLE) {
                // echo "в наличии";
                $query->andWhere('count > 0');
            }
            elseif ($params[ 'ProductsPopularSearch' ][ 'count' ] == Products::NOT_AVAILABLE) {
                // echo "нетууу";
                $query->andWhere('count <= 0');
            }
        }

        return $dataProvider;
    }
}
