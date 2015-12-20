<?php 

use yii\helpers\Html;
use frontend\controllers\CookieController;

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
 ?>



	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default">
		<h4><?php echo $model->name; ?></h4>
		<hr style="margin:20px 0px 20px;">
		
		<?php 

		echo Html::beginTag('div',['style'=>'margin-bottom:15px;']);
		foreach ($model->children()->all() as $catalog) {
			
			
				echo Html::Tag(
					'span',

					Html::a(
					$catalog->name . " (". $catalog->getProducts()->count() .")",
					['catalogs/view','catalog_id'=>$catalog->catalog_id],
					['style'=>'margin-right:30px;']
					),
					['style'=>'display:inline-block;']

					);


		}

		



		echo Html::endTag('div');


		echo $this->render('_search', [
			'model' => $searchModel,
			'catalog' =>$model,
			'price_min'=>$price_min,
			'price_max'=>$price_max,
			'price_min_val'=>$price_min_val,
			'price_max_val'=>$price_max_val
		]);
		 ?>
		 
		
	
		


	</div>

	
		
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default" style="padding:20px;">
		<span class="h4">Ничего не найдено</span>
	</div>	

