<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

use app\models\products\Products;
use app\models\Catalogs;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
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
                ]
            );


            ?>


        </div>

    </div>

    <div class="box-body">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel'  => $searchModel,
                'summary'      => '',
                'tableOptions' => ['class'=>'table table-bordered table-hover'],
                'columns'      => [

                    [
                        'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label' => 'Код',
                        'value' => function ($data)
                        {

                            return $data['product_id'];
                        },
                    ],
                    [
                        'label'=>'<i class="fa fa-picture-o"></i>',
                        'encodeLabel'=>false,
                        'format'=>'raw',
                        'value'=>function ($model) {
                            $mainPhoto = $model->MainPhoto;
                            return Html::a(
                                Html::img($mainPhoto->getUrl('original'),['class'=>'img-responsive','style'=>'max-width:50px;']),
                                ['products/view','product_id'=>$model->product_id],['style'=>'display:block;']);
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

                    [
                        'class'     => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label'     => 'Цена',
                        'format'=>'raw',
                        'attribute' => 'price',
                        'contentOptions'=> ['style'=>'text-align: center; color:#d2322d'],
                        'value'     => function ($data)
                        {
                            return $data['price'];
                        },
                    ],

                    [
                        'class'     => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label'     => 'Остаток',
                        'format'=>'raw',
                        'attribute' => 'count',
                        'contentOptions'=> ['style'=>'text-align: center;'],
                        'value'     => function ($data)
                        {
                            return $data['count'];
                        },
                    ],
                    [
                        'class'     => 'yii\grid\DataColumn', // can be omitted, as it is the default
                        'label'     => 'Популярный',
                        'format'=>'raw',
                        'attribute' => 'popular',
                        'filter' => Html::activeDropDownList($searchModel, 'popular', [true=>'Да',false=>'Нет'],['class'=>'form-control','prompt' => '']),
                        'contentOptions'=> ['style'=>'text-align: center;'],
                        'value'     => function ($data)
                        {
                            return $data['popular'] ? Html::label('Популярный',null,['class'=>'label label-success']) : '';
                        },
                    ],
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

        <?php

//        echo LinkPager::widget([
//            'pagination'=>$dataProvider->pagination,
//        ]);
        ?>
    </div>


</div>



