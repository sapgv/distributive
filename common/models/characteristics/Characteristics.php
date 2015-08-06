<?php

namespace common\models\characteristics;

use Yii;

/**
 * This is the model class for table "characteristics".
 *
 * @property integer $characteristic_id
 * @property string $name
 * @property integer $product_id
 *
 * @property Products $product
 */
class Characteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'product_id'], 'required'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'characteristic_id' => 'Characteristic ID',
            'name' => 'Name',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
