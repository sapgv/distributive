<?php

namespace common\models\products;

use yii\data\ActiveDataProvider;
use common\models\properties\ProductsProperties;
use Yii;
use sapgv\yii2\galleryManager\GalleryImage;
use sapgv\yii2\galleryManager\GalleryBehavior;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;
use common\models\catalogs\Catalogs;
use common\models\products\ViewProduct;
use common\models\characteristics\Techchar;
//use kartik\tree\models\TreeTrait;
use yii\helpers\Html;
/**
 * This is the model class for table "products".
 *
 */
class Products extends \yii\db\ActiveRecord implements CartPositionInterface {

    const ALL = 'Все';
    const AVAILABLE = 'В наличии';
    const NOT_AVAILABLE = 'Под заказ';

    public $name_catalog;
    public $mainPhoto;

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
            [['catalog_id', 'view_product_id', 'name', 'precontent', 'content'], 'required'],
            [['product_id', 'name', 'catalog_id', 'view_product_id', 'precontent', 'content', 'comment', 'popular'], 'safe'],
        ];
    }


    public function getCatalog() {

        return $this->hasOne(
            Catalogs::className(), ['catalog_id' => 'catalog_id']
        );
    }

    public function getViewproduct() {

        return $this->hasOne(
            ViewProduct::className(), ['view_product_id' => 'view_product_id']
        );
    }


    public function behaviors() {

        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'products',
                'extension' => 'png',
                'directory' => Yii::getAlias('@imagesroot') . '/products/gallery',
                'url' => Yii::getAlias('@images') . '/products/gallery',

            ]
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

    public static function getCartContent()
    {
        if (\Yii::$app->cart->getCount() >= 100 ) {
            $cartBadge = "cart-100";
            $cartCost = "cart-cost-100";
        }
        elseif (\Yii::$app->cart->getCount() >= 10) {
            $cartBadge = "cart-10";
            $cartCost = "cart-cost-10";
        }
        else {
            $cartBadge = "cart-1";
            $cartCost = "cart-cost-1";
        }
        $cartContent = '';
        $cartContent .=
            (\Yii::$app->cart->getCount() > 0) ?
                Html::tag(
                    'span',
                    Html::tag(
                        'span',\Yii::$app->cart->getCount(),['class'=>'badge badge-cart '.$cartBadge]),
                    ['class'=>'glyphicon glyphicon-shopping-cart',
                     'style'=>'color:#34495e;'
                    ]
                )
                .
                Html::tag(
                    'span',
                    number_format(\Yii::$app->cart->getCost(), 0, '.', ' '),
                    ['class'=>$cartCost,
                     'style'=>'color:#34495e;'
                    ]
                )
                . " " .
                Html::tag(
                    'span',
                    null,
                    [
                        'class'=>'glyphicon glyphicon-ruble',
                        'style'=>'font-size: 18px;color:#34495e;'
                    ]
                )

                :

                Html::tag(
                    'span',

                    Html::tag(
                        'span',"<span style='font-weight: bold;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;'> КОРЗИНА</span>"),

                    ['class'=>'glyphicon glyphicon-shopping-cart',
                     'style'=>'color:#34495e;//margin-right:15px;'
                    ]
                );

        return $cartContent;
    }

    public function getMainPhoto()
    {

        $galleryBehavior = $this->getBehavior('galleryBehavior');
        $query = new \yii\db\Query();

        $mainPhotoData = $query
                ->select(['id', 'name', 'description', 'rank'])
                ->from('gallery_image')
                ->where(['ownerId' => $this->id, 'main'=>true])
                ->orderBy(['rank' => 'asc'])
                ->one();

        $imageData = [
            'id'=>$mainPhotoData['id'],
            'name'=>$mainPhotoData['name'],
            'description'=>$mainPhotoData['description'],
            'rank'=>$mainPhotoData['rank'],
        ];

        $mainPhoto = new GalleryImage($galleryBehavior, $imageData);
        return $mainPhoto;

    }

    public function getProperties()
    {
//        return $this->hasMany(ProductsProperties::className(), ['product_id' => 'product_id']);
//            ->orderBy('id');

        $query = ProductsProperties::find()->where(['product_id' => $this->product_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

       return $dataProvider;
    }
}
