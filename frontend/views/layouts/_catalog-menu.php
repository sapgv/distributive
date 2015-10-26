<?php 

use yii\helpers\Html;

?>

<?php 
	// echo Html::Tag('p','dsfsdfs',['style'=>'']);
foreach ($catalog->children()->all() as $child) {
	echo Html::beginTag('div',['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2','style'=>'']);
		if ($child->getBehavior('coverBehavior')->hasImage()) {
		echo Html::img($child->getBehavior('coverBehavior')->getUrl('original'),['class'=>'img-responsive','style' => '']);
		
		} 
	echo Html::endTag('div');

	echo Html::beginTag('div',['class'=>'col-xs-10 col-sm-10 col-md-10 col-lg-10']);
	echo Html::a($child->name, ['catalogs/view','catalog_id'=>$child->id],['class'=>'maintainHover','style'=>'font-size:large;']);                       
	echo Html::Tag('p',$child->description,['class'=>'text-muted']);
	echo Html::endTag('div');
}
	// echo Html::beginTag('ul',['style'=>'']);

	// 	echo Html::beginTag('li',['style'=>'']);
	// 		echo Html::a($child->name, ['catalogs/view','catalog_id'=>$child->id],['class'=>'','style'=>'font-size:large;']);                       
	// 	echo Html::endTag('li');
	// echo Html::endTag('ul');
 ?>


	<!-- <div class="row"> -->
		<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;"> -->


			<?php 

			// echo Html::beginTag('ul',['style'=>'list-style:none;padding-left:0px;']);
			// 							foreach ($catalog->children()->all() as $child) {
											
			// 								echo Html::beginTag('li',['style'=>'margin-bottom: 10px;']);
			// 								echo Html::beginTag('div',['class'=>'row','style'=>'margin-left: 0px;margin-right: 0px;']);
			// 									echo Html::beginTag('div',['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2','style'=>'']);
			// 										if ($child->getBehavior('coverBehavior')->hasImage()) {
			// 										echo Html::img($child->getBehavior('coverBehavior')->getUrl('catalog'),['class'=>'img-responsive','style' => '']);
													
			// 										} 
			// 									echo Html::endTag('div');
					
			// 									echo Html::beginTag('div',['class'=>'col-xs-10 col-sm-10 col-md-10 col-lg-10']);
			// 									echo Html::a($child->name, ['catalogs/view','catalog_id'=>$child->id],['class'=>'maintainHover','style'=>'font-size:large;']);                       
			// 									echo Html::Tag('p',$child->description,['class'=>'text-muted']);
			// 									echo Html::endTag('div');
			// 								echo Html::endTag('div');
			// 								echo Html::endTag('li');
			// 							}

			// 	echo Html::endTag('ul');
			 ?>

			










		
	<!-- </div> -->
	<!-- </div> -->





	
