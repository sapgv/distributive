<?php

namespace common\models\orders;

use Yii;
use yii2mod\ftp\FtpClient;
use common\models\orders\OrdersProducts;
use yii\helpers\Html;

class Orders extends \yii\db\ActiveRecord
{
	
	const STATUS_NEW = 'new';
    const STATUS_ACCEPT = 'accept';

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
    {
        return 'orders';
    }

    public function scenarios()
    {
        return [
            'newOrder' => ['name', 'email', 'phone', 'comment']
        ];
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return [
        
        [['name', 'email', 'phone'], 'required'],
        [['name', 'email', 'phone', 'comment'], 'safe'],

        // the email attribute should be a valid email address
        ['email', 'email'],
        // ['phone', 'number'],
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
			'create_time'=>'Дата',
			'id'=>'№',
			'name'=>'Ваше имя',
			'phone'=>'Телефон',
			'email'=>'Email',
			// 'status'=>'Статус',
			// 'summa'=>'Сумма',
			'comment'=>'Комментарий к заказу',
			// 'address'=>'Адрес доставки',
		);
	}

	
	
	public function getStatuses()
	{
	return array (
	self::STATUS_NEW   =>'Новый',
	self::STATUS_ACCEPT  =>'Подтвержден',
	);
	}
	
	public function getStatusText ()
	{
	$Statuses=$this->getStatuses();
	return isset($Statuses[$this->status]) ? $Statuses[$this->status] : "unkown status({$this->status})";
	}

	public function afterSave($insert, $changedAttributes)
	{
		//сохраним товары заказа
		$this->saveOrdersProducts();
		
		//сохраним XML заказ на фтп
		$this->saveOrderFtp();

		// отправка почты
		$this->sentOrderMail();

		parent::afterSave($insert, $changedAttributes);
	}

	public function saveOrdersProducts()
	{
		$products = Yii::$app->cart->getPositions();
		foreach ($products as $product) {
			
			$ordersProducts = new OrdersProducts;
			$ordersProducts->order_id = $this->id;
			$ordersProducts->product_id = $product->id;
			$ordersProducts->name = $product->name;
			$ordersProducts->quantity = Yii::$app->cart->getPositionById($product->id)->getQuantity();
			$ordersProducts->price = $product->price;
			$ordersProducts->summa = Yii::$app->cart->getPositionById($product->id)->getCost();
			
			$ordersProducts->save();
		}
	}

	public function sentOrderMail()
	{
		
		
		$message = Yii::$app->mail->compose('order',['order'=>$this]);
		
		$message->setFrom([Yii::$app->params['adminEmail']]);
		$message->setTo("grisha.sapgv@mail.ru");
		$message->setSubject("Интернет заказ № ".$this->id);
		$message->send();

	}

	public function saveOrderFtp()
	{
		
		$host = Yii::$app->params['ftp']['host'];
        $name = Yii::$app->params['ftp']['name'];
        $pass = Yii::$app->params['ftp']['pass'];
        $ftp  = new FtpClient();
        $ftp->connect($host);
        $ftp->login($name, $pass);

        $dirExist = $ftp->isDir('orders');
        
        if (!$dirExist) {
             $ftp->mkdir('orders');
        }

        if (ftp_chdir($ftp->getConnection(), "orders")) {
            
            // $order = \app\models\orders\Orders::findOne(70);
            $order = $this;
            $orderXML = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"windows-1251\"?><order></order>");
            
            $orderXML->addAttribute('id', $order->id);
            $orderXML->addAttribute('create_time', $order->create_time);
            $orderXML->addAttribute('name', $order->name);
            $orderXML->addAttribute('email', $order->email);
            $orderXML->addAttribute('phone', $order->phone);
            $orderXML->addAttribute('delivery', $order->delivery);
            $orderXML->addAttribute('address', $order->address);
            $orderXML->addAttribute('comment', $order->comment);

            $products = $order->products;
            $productsXML = $orderXML->addChild('products');
            foreach ($products as $product) {
                
                $productXML = $productsXML->addChild('product');
                $productXML->addAttribute('product_id', $product->product_id);
                $productXML->addAttribute('name', $product->name);
                $productXML->addAttribute('quantity', $product->quantity);
                $productXML->addAttribute('price', $product->price);
                $productXML->addAttribute('summa', $product->summa);

            }

            $xml = $orderXML->asXML();

            $ftp->putFromString('order_'.$order->id.'.xml',$xml);


        }


	}
	public function getProducts()
	{
		return $this->hasMany(OrdersProducts::className(), ['order_id' => 'id']);
	}

	

}
