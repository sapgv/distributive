<?php 

use yii\helpers\Html;
use yii\widgets\ListView;
 ?>


<?php 
	
	// по умолчанию выводим списком
    echo Html::Tag(
        'div',

        ListView::widget( [
    'dataProvider' => $dataProvider,
    'layout' => "{items}",
    'emptyText'=>'Ничего не найдено',
    'emptyTextOptions'=>['class'=>'row'],
    // 'options' => ['class'=>'row'],
    // 'view' => $this->render('/site/popular/row'),
    'itemView' => '/site/popular/row',
    'itemView' => function ($model, $key, $index, $widget) {
    return $this->render('/catalogs/listView',['model'=>$model]);
    },

    ] ),
        ['class'=>'col-xs-12 col-sm-12 col-md-12 col-lg-12']


        );

 ?>