<?php

namespace common\models\products;

use yii\data\ActiveDataProvider;
use common\models\properties\ProductsProperties;
use Yii;
use sapgv\yii2\galleryManager\GalleryImage;
use sapgv\yii2\galleryManager\GalleryBehavior;
use yii\db\ActiveRecord;
use yii\db\Query;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
use common\models\catalogs\Catalogs;

/**
 * This is the model class for table "products".
 *
 * @property integer $product_id
 */
class Products extends ActiveRecord implements CartPositionInterface {

    const ALL = 'Все';
    const AVAILABLE = 'В наличии';
    const NOT_AVAILABLE = 'Под заказ';


    use CartPositionTrait;

    public function getPrice() {

        return $this->price;
    }

    public function getId() {
        return $this->product_id;
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'catalog_id', 'view_product_id', 'name', 'precontent', 'content' ], 'required' ],
            [ [ 'product_id', 'name', 'catalog_id', 'view_product_id', 'precontent', 'content', 'comment', 'popular' ], 'safe' ],
        ];
    }

    public function getCatalog() {
        return $this->hasOne(
            Catalogs::className(), [ 'catalog_id' => 'catalog_id' ]
        );
    }

    public function behaviors() {
        return [
            'galleryBehavior' => [
                'class'     => GalleryBehavior::className(),
                'type'      => 'products',
                'extension' => 'png',
                'directory' => Yii::getAlias('@imagesroot') . '/products/gallery',
                'url'       => Yii::getAlias('@images') . '/products/gallery',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'product_id'             => 'Код',
            'catalog_id'             => 'Каталог',
            'name'                   => 'Наименование',
            'common_characteristics' => 'Использовать общие характеристики',
            'view_product_id'        => 'Вид номенклатуры',
            'precontent'             => 'Краткое описание',
            'content'                => 'Полное описание',
            'comment'                => 'Комментарий',
            'popular'                => 'Популярный',
            'price'                  => 'Цена',
        ];
    }

    public function getMainPhoto() {
        $galleryBehavior = $this->getBehavior('galleryBehavior');
        $query = new Query();

        $mainPhotoData = $query
            ->select([ 'id', 'name', 'description', 'rank' ])
            ->from('gallery_image')
            ->where([ 'ownerId' => $this->id, 'main' => true ])
            ->orderBy([ 'rank' => 'asc' ])
            ->one();

        $imageData = [
            'id'          => $mainPhotoData[ 'id' ],
            'name'        => $mainPhotoData[ 'name' ],
            'description' => $mainPhotoData[ 'description' ],
            'rank'        => $mainPhotoData[ 'rank' ],
        ];

        $mainPhoto = new GalleryImage($galleryBehavior, $imageData);

        return $mainPhoto;
    }

    public function getProperties() {
        $query = ProductsProperties::find()->where([ 'product_id' => $this->product_id ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        return $dataProvider;
    }
}
