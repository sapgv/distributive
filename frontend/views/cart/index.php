<?php 

use yii\helpers\Html;
use yii\helpers\Url; 
use yii\bootstrap\Button;
use yii\widgets\ActiveForm;
use yii\bootstrap\Alert;
use yii\grid\GridView;
use kartik\touchspin\TouchSpin;
 ?>


 <!-- <div class="row"> -->
 	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
 		
 	<div class="panel-basic panel-basic-default row">
 		
 	
	<div class="panel-basic-heading" style="background-color:#fff;font-weight:bold">Корзина товаров</div>
		
	 <?php 
	 if(Yii::$app->session->hasFlash('order')) {
	 	$params = Yii::$app->session->getFlash('order');

	 	echo Html::Tag(
		 		'p',
		 		'Уважаемый <strong>'.$params['name'].'</strong>, заказ №<strong>'.$params['id'].'</strong> успешно оформлен. Копия заказа отправлена вам на почту <strong>'.$params['email'].'</strong>',
		 		[
		 		'class'=>'bg-success',
		 		'style'=>'padding:15px;margin:15px;'
		 		]
		 		);
	 }
	 else {
	 	if (Yii::$app->cart->getCount() > 0) {
			
			echo Html::Tag(
			'div',
			'Пожалуйста проверьте ваш заказ перед оформлением.',
			['class'=>'panel-basic-body cart-message']
			);
			
			echo $this->render('_cartTable',
			['dataProvider'=>$dataProvider]
			);
			}
			else {
			
			echo Html::Tag(
			'div',
			'Ваша корзина пуста',
			['class'=>'panel-basic-body cart-message']
			);
			
			}

	 	}
	         
	?> 
        
 	</div>


 	</div>
 <!-- </div> -->


<div id="cart_order" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
 		
 	<?php 
	if (Yii::$app->cart->getCount() > 0) {
	echo $this->render('_cartOrder',
					['order'=>$order]
					);
	}

	 ?>


 	</div>


