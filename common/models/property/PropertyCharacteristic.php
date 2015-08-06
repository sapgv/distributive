<?php

namespace common\models\property;

use Yii;
use common\models\products\ViewProduct;

/**
 * This is the model class for table "property".
 *
 * @property integer $property_id
 * @property string property_owner
 * @property string $name
 * @property string $type_value
 */
class PropertyCharacteristic extends \yii\db\ActiveRecord {

    //константы для владельца property_owner
    const PRODUCTS = 'products';
    const CHARACTERISTICS = 'characteristics';

    //константы для типа значений type_value
    const C_BOOLEAN = 'boolean';
    const C_DATE = 'date';
    const C_STRING = 'string';
    const C_INT = 'int';
    const C_VAL = 'val';


    /**
     * @inheritdoc
     */
    public static function tableName() {

        return 'characteristic_property';
    }

    /**
     * @inheritdoc
     */
    public function rules() {

        return [
            [['property_owner', 'name', 'type_value'], 'required'],
            [['property_id'], 'integer'],
            [['property_owner', 'name', 'type_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {

        return [
            'property_id'    => 'Код',
            'property_owner' => 'Владелец',
            'name'           => 'Наименование',
            'type_value'     => 'Тип значения',
        ];
    }

    public function getOwners() {

        $owners = [];
        $owners['Общее свойство']='Общее свойство';

        $viewProducts = ViewProduct::find()->all();

        foreach ($viewProducts as $viewProduct) {
            $owners[$viewProduct->name] = $viewProduct->name;
        }

        return $owners;

    }

    public function getOwnerText() {

        $Owners = $this->getOwners();

        return isset($Owners[ $this->property_owner ]) ? $Owners[ $this->property_owner ] : "unkown property_owner({$this->property_owner})";
    }

    public function getTypeValues() {

        return [
            self::C_BOOLEAN => 'Булево',
            self::C_DATE    => 'Дата',
            self::C_STRING  => 'Строка',
            self::C_INT     => 'Число',
            self::C_VAL     => 'Доп. значение',
        ];
    }

    public function getTypeValueText() {

        $TypeValues = $this->getTypeValue();

        return isset($TypeValues[ $this->type_value ]) ? $TypeValues[ $this->type_value ] : "unkown type_value({$this->type_value})";
    }
}
