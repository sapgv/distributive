<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\products\Products;
use app\models\Catalogs;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Button;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <div class="box-tools">
            <?php
            echo ButtonGroup::widget(
                [
                    'buttons' => [
                        Html::a(
                            'создать товар', Url::to(['/products/create']),
                            [
                                'class' => 'btn btn-sm btn-warning',
                            ]
                        ),
                    ],
                    // 'options'=>['class'=>'pull-right']
                ]
            );


            ?>


        </div>

    </div>

    <div class="box-body no-padding">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'summary'      => '',
                'tableOptions' => ['class' => 'table table-striped table-bordered', 'style' => 'margin-bottom:0px;'],
                'columns'      => [
                    // [
                    // 'class' => 'yii\grid\SerialColumn',
                    // 'header' =>'№'
                    // ],
                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label' => 'Код',
                        'value' => function ($data)
                        {

                            return $data['product_id'];
                        },
                    ],
                    [
                        'class'  => 'yii\grid\DataColumn',
                        'label'  => 'Аватар',
                        'format' => 'html',
                        'value'  => function ($model, $key, $index, $column)
                        {

                            // $product = Products::findOne($model->product_id);

                            // $mainPhoto = $product->mainPhoto;
                            // return Html::a(
                            //     Html::img($mainPhoto->url,['class'=>'img-responsive','style'=>'width:50px;']),
                            //     ['products/view','product_id'=>$product->product_id],['style'=>'display:block;']);

                        },
                    ],
                    [
                        'class'     => 'yii\grid\DataColumn',
                        'label'     => 'Каталог',
                        'attribute' => 'name_catalog',
                        'value'     => function ($data)
                        {

                            return $data['name_catalog'];
                        },
                    ],

                    [
                        'class'     => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label'     => 'Наименование',
                        'attribute' => 'name',
                        'value'     => function ($data)
                        {

                            return $data['name']; // $data['name'] for array data, e.g. using SqlDataProvider.
                        },
                    ],


                    // 'id',
                    // 'id_catalog',
                    // 'name',
                    // 'comment:ntext',
                    // 'precontent:ntext',
                    // 'content:ntext',
                    // 'source',
                    // 'count',
                    // 'price',
                    // 'popular',
                    // 'versions_data:ntext',

                    [
                        'class'      => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index)
                        {

                            return [$action, 'product_id' => $model->product_id];
                        },
                    ],
                ],
            ]
        ); ?>

    </div>

    <div class="box-footer clearfix">
        'footer'
    </div>
</div>



