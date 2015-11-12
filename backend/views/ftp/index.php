<?php
use yii\helpers\Html;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Url;

?>


<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title">Загрузка данных по фтп</h3>

        <div class="box-tools">


        </div>

    </div>


    <div class="box-body">
        <?

//        if (Yii::$app->session->hasFlash('success')) {
//            echo Yii::$app->session->getFlash('success');
//        }
//        $allflash = \Yii::$app->session->getAllFlashes();
//        foreach ($allflash as $key => $mess) {
//            \yii\bootstrap\Alert::begin([
//                'options' => [
//                    'class' => 'alert-primary',
//                ],
//            ]);
//            echo $mess;
//            \yii\bootstrap\Alert::end();
//        }

        ?>

        <?= Html::a('Загрузить каталог', [ 'upload-catalogs' ], [ 'class' => 'btn btn-success' ]) ?>
        <?= Html::a('Загрузить товары', [ 'upload-products' ], [ 'class' => 'btn btn-success' ]) ?>
        <?= Html::a('Загрузить характеристики', [ 'upload-characteristics' ], [ 'class' => 'btn btn-success' ]) ?>
        <? //= Html::a('Загрузить значения характеристик', ['upload-characteristics'], ['class' => 'btn btn-success']) ?>
        <?//= Html::a('Загрузить картинки', [ 'upload-images' ], [ 'class' => 'btn btn-success' ]) ?>

    </div>


</div>