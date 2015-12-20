<?php

namespace common\models\orders;

use Yii;
use yii\db\ActiveRecord;
use yii2mod\ftp\FtpClient;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property float $quantity
 * @property float $price
 * @property float $summa
 * @property string $status
 * @property string $email
 * @property string $phone
 * @property string $delivery
 * @property string $address
 * @property string $comment
 */

class Orders extends ActiveRecord
{
	
	const STATUS_NEW = 'new';
	const STATUS_CANCELED = 'canceled';
	const STATUS_ACCEPT = 'accept';
	const STATUS_CLOSED = 'closed';

	/**
	 * @return string the associated database table name
	 */
	public static function tableName()
    {
        return 'orders';
    }

    public function scenarios()
    {
		$scenarios = parent::scenarios();
		$scenarios['newOrder'] = ['name', 'email', 'phone', 'comment'];
		return $scenarios;
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		
		return [
        
        [['name', 'email', 'phone'], 'required'],
        [['create_time', 'name', 'email', 'phone', 'comment', 'status', 'address'], 'safe'],

        // the email attribute should be a valid email address
        ['email', 'email'],
        // ['phone', 'number'],
    ];
		
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::className(),
				'attributes'=>['createdAtAttribute'],
				'createdAtAttribute' => 'create_time',
				'value' => new Expression('NOW()')
			],
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
			'order_id'=>'№',
			'name'=>'Ваше имя',
			'phone' => 'Телефон',
			'email' => 'Email',
			'status' => 'Статус',
			'summa' => 'Сумма',
			'comment' => 'Комментарий к заказу',
			'address'=>'Адрес доставки',
		);
	}

	
	
	public function getStatuses()
	{
	return array (
		self::STATUS_NEW => 'Новый',
		self::STATUS_CANCELED => 'Отменен',
		self::STATUS_ACCEPT => 'Подтвержден',
		self::STATUS_CLOSED => 'Закрыт',
	);
	}


	
	public function getStatusText ()
	{
	$Statuses=$this->getStatuses();
	return isset($Statuses[$this->status]) ? $Statuses[$this->status] : "unkown status({$this->status})";
	}

	public function getStatusesClass()
	{
		return array (
			self::STATUS_NEW => 'label label-warning',
			self::STATUS_CANCELED => 'label label-danger',
			self::STATUS_ACCEPT => 'label label-primary',
			self::STATUS_CLOSED => 'label label-success',
		);
	}

	public function getStatusClass()
	{
	$StatusesClass=$this->getStatusesClass();
	return isset($StatusesClass[$this->status]) ? $StatusesClass[$this->status] : "label label-danger";
	}



	public function afterSave($insert, $changedAttributes)
	{

		parent::afterSave($insert, $changedAttributes);

		if ($this->scenario == 'newOrder') {
			//сохраним товары заказа
			$this->saveOrdersProducts();

			//сохраним XML заказ на фтп
			$this->saveOrderFtp();

			// отправка почты
			$this->sentOrderMail();

		}



	}

	public function saveOrdersProducts()
	{
		$products = Yii::$app->cart->getPositions();
		foreach ($products as $product) {
			
			$ordersProducts = new OrdersProducts;
			$ordersProducts->order_id = $this->order_id;
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

		$message = Yii::$app->mail->compose('order-mail',['model'=>$this]);

		$message->setFrom([Yii::$app->params['adminEmail']]);
		$message->setTo("grisha.sapgv@mail.ru");
		$message->setSubject("Интернет заказ № ".$this->order_id);
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


            $order = $this;

            $orderXML = new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"windows-1251\"?><order></order>");
            
            $orderXML->addAttribute('order_id', $order->order_id);
            $orderXML->addAttribute('create_time', $order->getFormattedCreateTime());
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

            $ftp->putFromString('order_'.$order->order_id.'.xml',$xml);


        }


	}
	public function getProducts()
	{
		return $this->hasMany(OrdersProducts::className(), ['order_id' => 'order_id']);
	}

	public function getFormattedCreateTime()
	{
		$newOrder = Orders::findOne($this->order_id);
		return \DateTime::createFromFormat('Y-m-d H:i:s', $newOrder->create_time)->format('d.m.Y');
	}

	

}
