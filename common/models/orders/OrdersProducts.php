<?php

namespace common\models\orders;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "orders_products".
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property float $quantity
 * @property float $price
 * @property float $summa
 * @property string $status
 */
class OrdersProducts extends ActiveRecord {

	const STATUS_NEW = 'new';
	const STATUS_ACCEPT = 'accept';


	/**
	 * @return string the associated database table name
	 */
	public static function tableName() {
		return 'orders_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {

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
	public function relations() {
		return [
		];
	}

	/**
	 * @return array customized attribute labels (name=&gt;label)
	 */
	public function attributeLabels() {
		return [
			'name'     => 'Наименование',
			'quantity' => 'Количество',
			'price'    => 'Цена',
			'summa'    => 'Сумма',

		];
	}


}