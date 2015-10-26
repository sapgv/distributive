<?php 

use yii\helpers\Html;

?>

<?php
$arr = $catalog->children()->asArray()->all();
?>
<?php if (empty($arr)): ?> 

<?php 
echo Html::beginTag('ul',['style'=>'list-style:none;padding-left:0px;']);
foreach ($catalog->products as $product) {

echo Html::beginTag('li');
echo Html::a($product->name, ['products/view','product_id'=>$product->id],['style'=>'display:block;']);                       
echo Html::endTag('li');

}
echo Html::endTag('ul');
?>



<?php else: ?>


	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 0px;padding-right: 0px;">


			<?php 

			echo Html::beginTag('ul',['style'=>'list-style:none;padding-left:0px;']);
										foreach ($catalog->children()->all() as $child) {
											// echo $product->description;
											echo Html::beginTag('li',['style'=>'margin-bottom: 10px;']);
											echo Html::beginTag('div',['class'=>'row','style'=>'margin-left: 0px;margin-right: 0px;']);
												echo Html::beginTag('div',['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2','style'=>'padding-top:10px; text-align:center;']);
													if ($child->getBehavior('coverBehavior')->hasImage()) {

													echo Html::a(
														Html::img($child->getBehavior('coverBehavior')->getUrl('original'),['class'=>'img-responsive','style' => 'display:inline; max-height:80px;']),
														['catalogs/view','catalog_id'=>$child->catalog_id]

														);



													}
												echo Html::endTag('div');
					
												echo Html::beginTag('div',['class'=>'col-xs-10 col-sm-10 col-md-10 col-lg-10']);
												echo Html::a($child->name, ['catalogs/view','catalog_id'=>$child->catalog_id],['class'=>'maintainHover','style'=>'font-size:large;']);                       
												echo Html::Tag('p',$child->description,['class'=>'text-muted']);
												echo Html::endTag('div');
											echo Html::endTag('div');
											echo Html::endTag('li');
										}

				echo Html::endTag('ul');
			 ?>

			










		
	</div>
	</div>




<?php endif; ?>
	
