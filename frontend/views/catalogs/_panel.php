<?php 

use yii\helpers\Html;
use yii\widgets\ListView;
 ?>

<div class="row">
	<?php 

	 echo ListView::widget( [
    'dataProvider' => $dataProvider,
    'layout' => "{items}",
    'emptyText'=>'Ничего не найдено',
    'emptyTextOptions'=>['class'=>'row'],
    // 'options' => ['class'=>'row'],
    // 'view' => $this->render('/site/popular/row'),
    'itemOptions' => ['class'=>'col-xs-4 col-sm-4 col-md-4 col-lg-4'],
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('/catalogs/panelView',['model'=>$model]);
    },
    
] );


 ?>
</div>