<?php 
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\Url;
 ?>


<?php 
	echo Html::beginTag('div',['class'=>'panel-basic panel-basic-default panel-border','style'=>'height:326px;']);

		// panel heading
		echo Html::beginTag(
			'div',
			[
			'class'=>'panel-heading',
			'style'=>'height:80px;background-color:#fff;border:none;'
			]
			);

		echo Html::Tag(
			'p',
			Html::a($model->name,['products/view','product_id'=>$model->id],['style'=>'display:block;']),
			['class'=>'text-center',]


			);

		echo HTML::endTag('div');
		// panel heading

		// panel body
		echo Html::beginTag(
				'div',
				[
				'class'=>'panel-body',
				'style'=>'height:187px;text-align:center;'
				]
				);

				$mainPhoto = $model->MainPhoto;
				echo Html::a(
					Html::img(
						$mainPhoto->getUrl('original'),
						[
							'class' => 'img-responsive',
							'style' => 'display: -moz-inline-box; display: inline-block;	vertical-align: middle;	height:100%; zoom: 1;'
						]),
					[ 'products/view', 'product_id' => $model->product_id ]);

		echo HTML::endTag('div');
		// panel body


		// panel footer
		echo Html::beginTag('div',['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12']);
		echo Html::beginTag(
				'div',
				[
				'class'=>'panel-footer',
				'style'=>'background-color:#fff;'
				]
				);
				
				echo Html::Tag(
					'span',
					number_format($model->price,0,'.',' ') . '<i class="glyphicon glyphicon-ruble" style="font-size: 18px;" aria-hidden="true"></i>',
					['class'=>'h3','style'=>'color:#d2322d;line-height:1.42;']

					);

				echo Html::Button('Купить', [
					'id'=>"put".$model->id,
					'class' => 'btn btn-success pull-right',
					'style'=>'border-radius: 0px;'
					]);
		echo HTML::endTag('div');
		echo HTML::endTag('div');
		// panel footer


	echo HTML::endTag('div');


 ?>

 <?php 
			$url = Url::toRoute('/cart/put/');
			$jsCartPut = <<<JS

			$("#put$model->id").on('click',


				function() {

					$.ajax({
					type     :'POST',
					dataType :'json',
					cache    : false,
					async    : false,
					url  : '{$url}',
					data: {id: $model->id},
					success  : function(data) {
					
					$(".cartContent").html(data.cartContent);
					// $(".cart").html(data.summa);
					// $(".cart-hidden").removeClass('cart-hidden');
					}
					});

				}
				);

			
  
JS;
 
$this->registerJs($jsCartPut, \yii\web\View::POS_READY, $model->id);
			 ?>
	