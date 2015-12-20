<?php
/**
 * Created by PhpStorm.
 * User: sapgv
 * Date: 13.11.2015
 * Time: 0:01
 */

namespace common\models\properties;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "values".
 *
 * @property integer $id
 * @property string $name
 *
 */
class Values extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'values';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [ [ 'value_id', 'name' ], 'required' ],
            [ [ 'value_id' ], 'integer' ],
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
