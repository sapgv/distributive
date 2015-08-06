<?php

namespace common\models\orders;

use Yii;

class OrdersProducts extends \yii\db\ActiveRecord
{
	
	const STATUS_NEW = 'new';
    const STATUS_ACCEPT = 'accept';
	

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
    {
        return 'orders_products';
    }

    

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return [
        
        // [['name', 'email', 'phone'], 'required'],
        // [['name', 'email', 'phone', 'comment'], 'safe'],

        // // the email attribute should be a valid email address
        // ['email', 'email'],
        // // ['phone', 'number'],
    ];
		
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=&gt;label)
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Наименование',
			'quantity'=>'Количество',
			'price'=>'Цена',
			'summa'=>'Сумма'
			
		);
	}

	
	
	
}