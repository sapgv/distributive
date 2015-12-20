<?php

use common\models\products\ProductsCartSearch;


/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\BaseMessage instance of newly created mail message */

?>



<?php
	$products = Yii::$app->cart->getPositions();

	$searchModel = new ProductsCartSearch();
	$dataProvider = $searchModel->search($products);

	$models = $dataProvider->getModels();
	foreach ($models as $model) {

		echo $model->name;

	}



// 	$html = GridView::widget([
//    'dataProvider' => $dataProvider,
//    'layout' => "{items}",
//    'showFooter'=>true,
//
//
//
//    'tableOptions' => [
//    	'class'=>'table table-bordered',
//    	'id'=>'cart_table',
//    	// 'style'=>'border: 1px solid #ddd;'
//    	],
//
//    'columns' => [
//
//        [
//        'class' => 'yii\grid\SerialColumn',
//        'header' => '№',
//        ],
//
//        [
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => 'Наименование',
//		'headerOptions'=>['style'=>'border-right:none;'],
//		'format'=>'raw',
//		'value' => function ($model, $key, $index, $column) use ($message) {
//
//			$mainPhoto = $model->MainPhoto;
//			return Html::a(
//				Html::img($mainPhoto->getUrl('original'), [ 'class' => 'img-responsive', 'style' => 'width:80px;' ]),
//				[ 'products/view', 'product_id' => $model->product_id ], [ 'style' => 'display:block;' ]);
//
////			$mainPhoto = $model->MainPhoto;
//////			$imageFileName = Yii::getAlias('@webroot'.$mainPhoto->url);
////			$imageFileName = $mainPhoto->getUrl('original');
////
////			if ($mainPhoto === null) {
////				$srcImg = "";
////			}
////			else {
////				$srcImg = $message->embed($imageFileName);
////			}
////
////			return Html::img($srcImg,['class'=>'img-responsive','style'=>'width:80px;']);
//
//    		},
//		],
//        [
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => '',
//		'headerOptions'=>['style'=>'border-left:none;'],
//		'format'=>'raw',
//		'value' => function ($model) {
//            return $model->name;
//    		},
//		],
//        [
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => 'Цена',
//		'format'=>'raw',
//		'headerOptions'=>['style'=>'border-right:0;'],
//		'contentOptions'=>['style'=>'border-right:0;px;'],
//		'footer'=>'<span style="font-size: 22px;">Итого</span>',
//		'footerOptions'=>[
//		'class'=>'text-right',
//		'style'=>'border-right:none;'],
//
//		'value' => function ($model) {
//            return '<span style="font-size: 22px;">' . number_format($model->price,0,'.',' ') .
//            '</span>';
//
//
//    		},
//		],
//		[
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => '',
//		'format'=>'raw',
//		'headerOptions'=>['style'=>'border-left:0;'],
//		'contentOptions'=>['style'=>'border-left:0;padding-top: 13px;'],
//		'footerOptions'=>['style'=>'border-left:none;'],
//		'value' => function ($model) {
//            return
//            '<i class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;font-size: 22px;">Р</i>';
//        	},
//		],
//        [
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => 'Количество',
//		'headerOptions'=>['style'=>''],
//		'contentOptions'=>['style'=>'max-width:100px!important;font-size: 22px;'],
//		'footer'=>'<span id="cart_quantity" style="font-size: 22px;">'.Yii::$app->cart->getCount().'</span>',
//		'footerOptions'=>['style'=>''],
//		'format'=>'raw',
//		'value' => function ($model) {
//            return Yii::$app->cart->getPositionById($model->id)->getQuantity();
//    		},
//		],
//
//		[
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => 'Сумма',
//		'format'=>'raw',
//		'headerOptions'=>['style'=>'border-right:0;'],
//		'contentOptions'=>['style'=>'border-right:0;'],
//		'footer'=>'<span class="cart_cost"style="color:#d2322d;font-size: 22px;">'. number_format(Yii::$app->cart->getCost(),0,'.',' ') .
//            '</span>',
//		'footerOptions'=>['style'=>'border-right:0;min-width:100px!important;'],
//		'value' => function ($model) {
//		 	return '<span id="position_cost_' . $model->id .'" style="color:#d2322d;font-size: 22px;">' .
//		 	number_format(Yii::$app->cart->getPositionById($model->id)->getCost(),0,'.',' ') .
//            '</span>';
//            return ;
//    		},
//		],
//		[
//		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
//		'label' => '',
//		'format'=>'raw',
//		'headerOptions'=>['style'=>'border-left:0;'],
//		'contentOptions'=>['style'=>'border-left:0;padding-top: 13px;'],
//		'footer'=>'<i class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;color:#d2322d;font-size: 22px;">Р</i></span>',
//		'footerOptions'=>['style'=>'border-left:0;padding-top: 13px;'],
//		'value' => function ($model) {
//			return '<i id="clear" class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;color:#d2322d;font-size: 22px;">Р</i>';
//
//    		},
//		],
//
//
//
//
//    ]
//]);




 	 ?>

<h2><?php echo $order->name; ?>, благодарим вас за покупку в нашем интернет магазине Softline</h2>
<h3>Ваш заказ № <?php echo $order->order_id; ?></h3>

<?php 
	

//	// create instance
//	$cssToInlineStyles = new CssToInlineStyles();
//
//	// $css = ;
//	$css = file_get_contents(Yii::getAlias('@webroot/css/mail/tables.css'));
//	// <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
//	// $css = file_get_contents("http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css");
//	$cssToInlineStyles->setHTML($html);
//	$cssToInlineStyles->setEncoding(Yii::$app->charset);
//
//	$cssToInlineStyles->setCSS($css);
	// output
//	echo $cssToInlineStyles->convert();
	echo $html;
 ?>





