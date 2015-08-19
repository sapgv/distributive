<?php 
use yii\helpers\Html;
use yii\helpers\Url; 
use yii\bootstrap\Button;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\touchspin\TouchSpin;
?>

<?php 
 			$url = Url::toRoute('/cart/clear/');
			$jsCartClear = <<<JS

			$("#clear").on('click',


				function() {
					// event.preventDefault();
					$.ajax({
					type     :'POST',
					dataType :'json',
					cache    : false,
					async    : false,
					url  : '{$url}',
					success  : function(data) {
					
							  // $('.cart_cost').html(data.cart_cost);
							  $(".cartContent").html(data.cartContent);
							  $('#cart_quantity').html(data.cart_quantity);                      
                              $('#cart_table').html('');
                              $('#cart_order').html('');
                              $('.cart-message').html("Ваша корзина пуста");
					}
					});

				}
				);

			
  
JS;
 
$this->registerJs($jsCartClear, \yii\web\View::POS_READY);

 	echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}",
    'options'=>['style'=>'margin-left:-1px;margin-right:-2px;'],
    'showFooter'=>true,
    'rowOptions'=>function ($model, $key, $index, $grid) {
    	return ['id' => "product_" . $model->product_id];

    },


    'tableOptions' => [
    	'class'=>'table table-bordered',
    	'id'=>'cart_table',
    	// 'class'=>'table table-striped table-bordered',
    	'style'=>'border:0;margin-bottom:0px;'
    	],

    'columns' => [
        // 'id',
        [
        'class' => 'yii\grid\SerialColumn',
        'header' => '№',
        'headerOptions'=>['style'=>'border-left:none;border-top:1px solid #ddd;'],
        'contentOptions'=>['style'=>'border-left:none;'],
        'footerOptions'=>['style'=>'border-left:none;border-bottom:1px solid #ddd;'],
        ],

        [
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => 'Наименование',
		'headerOptions'=>['style'=>'border-right:none;border-top:1px solid #ddd;'],
		// 'contentOptions'=>['style'=>'max-height: 100px;'],
		'footerOptions'=>[
		'class'=>'text-right',
		'style'=>'border-bottom:1px solid #ddd;'],
		 
		'format'=>'html',
		'value' => function ($model) { 		                     
             $mainPhoto = $model->mainPhoto;
			return Html::img($mainPhoto->url,['class'=>'img-responsive','style'=>'width:80px;']);

            
    		},
		],
        [
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => '',
		'headerOptions'=>['style'=>'border-left:none;border-top:1px solid #ddd;'],
		// 'footer'=>'Итого',
		'footerOptions'=>[
		'class'=>'text-right',
		'style'=>'border-bottom:1px solid #ddd;'],
		 
		'format'=>'raw',
		'value' => function ($model) { 		                     
            return 
            Html::a(
            	$model->name,
            	['products/view','product_id'=>$model->product_id],
            	['style'=>'display:block;']
            	);
    		},
		],
        [
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => 'Цена',
		'format'=>'html',
		'headerOptions'=>['style'=>'border-top:1px solid #ddd;border-right:0;'],
		'contentOptions'=>['style'=>'border-right:0;'],
		'footer'=>'<span style="font-size: 22px;">Итого</span>',
		'footerOptions'=>[
		'class'=>'text-right',
		'style'=>'border-right:none;border-bottom:1px solid #ddd;'],

		'value' => function ($model) { 		                     
            return '<span style="font-size: 16px;">' . number_format($model->price,0,'.',' ') . 
            '</span>';

            
    		},
		],
		[
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => '',
		'format'=>'html',
		'headerOptions'=>['style'=>'border-top:1px solid #ddd;border-left:0;'],
		'contentOptions'=>['style'=>'border-left:0;padding-top: 10px;'],
		// 'footer'=>'<span style="font-size: 22px;">Итого</span>',
		'footerOptions'=>['style'=>'border-left:none;border-bottom:1px solid #ddd;'],
		'value' => function ($model) { 		                     
            return  
            '<i class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;font-size: 14px;"></i>';

            
    		},
		],
        [
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => 'Количество',
		'headerOptions'=>['style'=>'border-top:1px solid #ddd;'],
		'contentOptions'=>['style'=>'max-width:100px!important;'],
		'footer'=>'<span id="cart_quantity" style="font-size: 22px;">'.Yii::$app->cart->getCount().'</span>',
		'footerOptions'=>['style'=>'border-bottom:1px solid #ddd;'],
		'format'=>'raw',
		'value' => function ($model) { 		                     
            // return Yii::$app->cart->getPositionById($model->id)->getQuantity();
            
            return TouchSpin::widget([
				    'name' => 'count',
				    'pluginOptions' => [
				    	'verticalbuttons' => true,
				    	'min'=>1,
				    	'initval' => Yii::$app->cart->getPositionById($model->product_id)->getQuantity(),
				    	'verticalupclass' => 'glyphicon glyphicon-plus',
        				'verticaldownclass' => 'glyphicon glyphicon-minus',
        				'buttonup_txt' => '<i class="glyphicon glyphicon glyphicon-plus"></i>', 
        				'buttondown_txt' => '<i class="glyphicon glyphicon glyphicon-minus"></i>'
				    ],

				    'pluginEvents' => [
					    // 'change' => 'function() { console.log("touchspin.on.startspin"); }',

				    	'change' => "function() { 

							// if (this.value>100) {
							// 	//не больше 100 штук
							// 	this.value = 100;
							// }
							jQuery.ajax(
							{
							'type':'POST',
							'data':{'product_id':\"$model->product_id;\",'quantity':this.value},
							
							'dataType':'json',
							'success':function(data){
							$('.cart_cost').html(data.cart_cost);
							$('.cartContent').html(data.cartContent);
							$('#cart_quantity').html(data.cart_quantity);
							
							$('#position_cost_$model->product_id').html(data.position_cost);
							
							},
							'url':'/cart/change-quantity/',
							'cache':false
							});

				    	 }",





					    
					],


				]);
    		},
		],

		

		[
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => 'Сумма',
		'format'=>'raw',
		'headerOptions'=>['style'=>'border-top:1px solid #ddd;border-right:0;'],
		'contentOptions'=>['style'=>'border-right:0;'],
		'footer'=>'<span class="cart_cost"style="color:#d2322d;font-size: 22px;">'. number_format(Yii::$app->cart->getCost(),0,'.',' ') . 
            '</span>',
		'footerOptions'=>['style'=>'border-right:0; border-bottom:1px solid #ddd;min-width:100px!important;'],
		'value' => function ($model) {
		 	return '<span id="position_cost_' . $model->product_id .'" style="color:#d2322d;font-size: 22px;">' .
		 	number_format(Yii::$app->cart->getPositionById($model->product_id)->getCost(),0,'.',' ') .
            '</span>';	                     
            return ;
    		},
		],
		[
		'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
		'label' => ' ',
		'format'=>'html',
		'headerOptions'=>['style'=>'border-top:1px solid #ddd;border-left:0;'],
		'contentOptions'=>['style'=>'border-left:0;padding-top: 12px;'],
		'footer'=>'<i class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;color:#d2322d;font-size: 20px;"></i></span>',
		'footerOptions'=>['style'=>'border-left:0;border-bottom:1px solid #ddd;padding-top: 12px;'],
		'value' => function ($model) {

			

		 	return '<i id="clear" class="glyphicon-cart glyphicon-ruble" style="margin-left:20px;color:#d2322d;font-size: 20px;"></i>';	                     
           
    		},
		],

		[
        'class' => '\yii\grid\ActionColumn',
        'header' => 

        			Html::a(
			 			Html::Tag(
			 			'i',
			 			null,
			 			[
			 			'class'=>'glyphicon-cart glyphicon-remove cart-remove',
						]
			 			),
			 			['#'],
			 			[
			 			'id'=>'clear',
			 			'style'=>'text-decoration:none;'
			 			]
		 			)




        ,
        'headerOptions'=>['style'=>'border-top:1px solid #ddd;border-right:none;'],
        'contentOptions'=>['style'=>'border-right:none;'],
        'footerOptions'=>['style'=>'border-right:none;'],
        'template'=>'{delete}',
        'buttons'=>[
            'delete'=>function ($url, $model) {
                    
            $url = Url::toRoute('/cart/remove/');
			$jsCartRemove = <<<JS

			$("#remove_$model->product_id").on('click',


				function() {

					$.ajax({
					type     :'POST',
					dataType :'json',
					cache    : false,
					async    : false,
					url  : '{$url}',
					data: {id: $model->product_id},
					success  : function(data) {
					
						if (data.cart_quantity > 0) {
	                                          $("#product_{$model->product_id}").html('');

	                                          $('.cart_cost').html(data.cart_cost);
	                                          $(".cartContent").html(data.cartContent);
	                                          $('#cart_quantity').html(data.cart_quantity);
                            }
                        else {
                          $("#product_{$model->product_id}").html('');
                          $('.cart_cost').html(data.cart_cost);
                          $(".cartContent").html(data.cartContent); 
                          $('#cart_quantity').html(data.cart_quantity);
                          $('.cart-message').html("Ваша корзина пуста");
                          $('#cart_table').html('');
                          $('#cart_order').html('');
                          $('#cart_flash').append("<p class='bg-warning' style='padding:15px;margin-top:15px;'>Ваша корзина пуста</p>");
                          
                         
                          
                        }
					
					}
					});

				}
				);

			
  
JS;
 
$this->registerJs($jsCartRemove, \yii\web\View::POS_READY, $model->id);

                    
            return Html::a(
            	'<span class="glyphicon glyphicon-remove cart-remove"></span>',
            	'#',
            	[
            	'id'=>"remove_".$model->id,
            	'style'=>'font-size: 14px;',
            	]
            	);
          	 }
        ],
           
    	]

 
    ],
])




 	 ?>