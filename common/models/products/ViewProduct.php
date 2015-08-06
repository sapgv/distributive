<?php

namespace common\models\products;

use Yii;

/**
 * This is the model class for table "view_product".
 *
 * @property integer $view_product_id
 * @property string $name
 * @property integer $common_characteristics
 */
class ViewProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'view_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'common_characteristics', 'use_characteristics',], 'required'],
            [['use_characteristics', 'common_characteristics'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'view_product_id' => 'Код',
            'name' => 'Наименование',
            'use_characteristics' => 'Использовать характеристики',
            'common_characteristics' => 'Использовать общие характеристики',
        ];
    }
}
