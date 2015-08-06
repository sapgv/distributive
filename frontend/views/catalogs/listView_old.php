<?php 
use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\Url;
 ?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default panel-border" style="margin-bottom:10px; height:150px; ">

		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			<div style="padding-top:15px;max-height:120px;">
				<?php 

			$mainPhoto = $model->mainPhoto;
			echo Html::a(
				Html::img($mainPhoto->url,['class'=>'img-responsive','style'=>'max-height:120px;']),
				['products/view','product_id'=>$model->id],['style'=>'display:block;']);
			
			?>


			</div>
		</div>
		<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
			<h4><?= Html::a($model->name,['products/view','product_id'=>$model->id],['style'=>'display:block;']); ?></h4>			
			<p class="text-muted"><?php echo $model->precontent; ?></p>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:120px;padding-left:50px;margin-top:15px;border-left: solid 1px #ccc">
				<h3 class="text-center" style="color:#d2322d;"><?php echo number_format($model->price,0,'.',' '); ?><i class="glyphicon glyphicon-ruble" style="font-size: 18px;" aria-hidden="true"></i></h3>
			<p class="text-center">
			<?
			echo Html::Button(
				'Купить',
				 [
				 'id'=>"put".$model->id,
				 'class' => 'btn btn-success put',
				 'style'=>'border-radius: 0px;'
				 ]

				 ) ;

			


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
					
					// $(".cart").html(data.summa);
					$(".cartContent").html(data.cartContent);
					}
					});

				}
				);

			
  
JS;
 
$this->registerJs($jsCartPut, \yii\web\View::POS_READY, $model->id);
			 ?>
			
			</p>
			</div>
			
		</div>
	</div>
</div>