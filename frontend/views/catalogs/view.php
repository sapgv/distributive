<?php 

use yii\helpers\Html;
use frontend\controllers\CookieController;

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\LinkPager;
 ?>


<!-- <div class="row"> -->
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

		 ?>
		 <?php 
		 
		 if ($model->children()->count() > 0) {
		 	echo Html::Tag('hr',null,['style'=>'margin:20px 0px 20px;']);
		 }

		  ?>
		

		
<?

if ( $searchModel->price_min == 0) {
	$price_min_val = 0;
}
else {
	$price_min_val = $searchModel->price_min;	
}

if ( $searchModel->price_max == 0) {
	$price_max_val = $price_max;
}
else {
	$price_max_val = $searchModel->price_max;	
}

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

	
		
		

<?php 
    
    $viewList = CookieController::getViewList();
    
    if ($viewList =='list' OR !isset($viewList)) {
        echo $this->render('_list',
            [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]
            );
    }
    elseif ($viewList =='panel') {
        echo $this->render('_panel',
             [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]
            );
    }

 ?>

	<?php 

    echo LinkPager::widget([
    'pagination'=>$dataProvider->pagination,
]);
     ?>
<!-- </div> -->