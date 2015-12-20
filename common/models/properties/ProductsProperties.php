<?php
/**
 * Created by PhpStorm.
 * User: sapgv
 * Date: 13.11.2015
 * Time: 0:16
 */

namespace common\models\properties;


use yii\db\ActiveRecord;

class ProductsProperties extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'products_properties';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'product_id', 'property_name', 'value_name' ], 'required' ],
            [ [ 'product_id' ], 'integer' ],
            [ [ 'property_name', 'value_name' ], 'string' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'product_id'    => 'Код товара',
            'property_name' => 'Свойство',
            'value_name'    => 'Значение',
        ];
    }

}