<?php

namespace app\models\products;

use Yii;

/**
 * This is the model class for table "products_characteristics_assignment".
 *
 * @property integer $products_id
 * @property integer $characteristics_id
 *
 * @property Characteristics $characteristics
 * @property Products $products
 */
class ProductsCharacteristicsAssignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_characteristics_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'characteristics_id'], 'required'],
            [['products_id', 'characteristics_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'characteristics_id' => 'Characteristics ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristics()
    {
        return $this->hasOne(Characteristics::className(), ['id' => 'characteristics_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'products_id']);
    }
}
