<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\orders\OrdersAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="row">
            <?php
            echo $this->render('_search', [
                'model' => $searchModel,
            ]);


            ?>

        </div>

    </div>




    <div class="box-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'tableOptions' => ['class'=>'table table-bordered table-hover'],
            'columns' => [
                // [
                // 'class' => 'yii\grid\SerialColumn',
                // 'header' =>'#'
                // ],
                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label' => '№',
                    'value' => function ($model) {
                        return $model->order_id;
                    },
                ],
                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label' => 'Дата',
                    'format' => ['date', 'php:d.m.Y'],
                    'value' => function ($model) {
                        return $model->create_time;
                    },
                ],



                'name',
                'email',
                'phone',
//                'status',
                [
                    'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                    'label' => 'Статус',
                    'format'=>'raw',
                    'value' => function ($model) {
//                        return $model->getStatusText();
//                         "<span class="label label-danger">Danger</span>";
                        return Html::label($model->getStatusText(),null,['class'=>$model->getStatusClass()]);
                    },
                ],
                'address',
                'summa',



                [
                    'class'      => 'yii\grid\ActionColumn',
                    'urlCreator' => function ($action, $model, $key, $index)
                    {

                        return [$action, 'order_id' => $model->order_id];
                    },
                ],
            ],
        ]); ?>

        <?php

        echo LinkPager::widget([
            'pagination'=>$dataProvider->pagination,
        ]);
        ?>
    </div>


</div>



