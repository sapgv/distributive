<?php
/**
 * Created by PhpStorm.
 * User: sapgv
 * Date: 13.11.2015
 * Time: 0:14
 */

namespace common\models\properties;


use yii\db\ActiveRecord;

class Properties extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'properties';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'property_id', 'name' ], 'required' ],
            [ [ 'property_id' ], 'integer' ],
            [ [ 'name' ], 'string', 'max' => 255 ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'value_id' => 'Код',
            'name'     => 'Наименование',
        ];
    }

}