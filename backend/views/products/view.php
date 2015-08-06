<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

// $this->title = $model->name;
$this->title = $model->name . ' ' . '(Просмотр)';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h3 style="margin-top:0px;"><?= Html::encode($this->title) ?></h3>

    <?php

    $items = [
        [
            'label'   => '<i class="glyphicon glyphicon-home"></i> Home',
            'content' => "dfdf",
            'active'  => true,
        ],

        [
            'label'       => '<i class="glyphicon glyphicon-user"></i> Profile',
            'content'     => $content2,
            'linkOptions' => ['data-url' => \yii\helpers\Url::to([''])],
        ],
        [
            'label' => '<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
            'items' => [
                [
                    'label'   => '<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                    'encode'  => false,
                    'content' => $content3,
                ],
                [
                    'label'   => '<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                    'encode'  => false,
                    'content' => $content4,
                ],
            ],
        ],
        [
            'label'         => '<i class="glyphicon glyphicon-king"></i> Disabled',
            'headerOptions' => ['class' => ''],
        ],
    ];

    // Above
    echo TabsX::widget(
        [
            'items'        => $items,
            'position'     => TabsX::POS_ABOVE,
            'encodeLabels' => false,
            'pluginEvents' => [
                "tabsX.click" => "function() {

                               console.log($('a[data-toggle=tab]'));

                               }",
            ],
        ]
    );
    ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?= Html::a('Редактировать', ['update', 'product_id' => $model->product_id], ['class' => 'pull-right btn btn-xs btn-warning']) ?>
        </div>
    </div>


    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#decription" data-toggle="tab">Основная</a></li>
        <li><a href="#details" data-toggle="tab">Технические характеристики</a></li>
        <li><a href="#photos" data-toggle="tab">Фотографии</a></li>


    </ul>
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="decription" style="padding-top:30px;min-height:300px;">

            <?php
            // print_r($model->viewproduct->name);

            ?>
            <?php
            echo DetailView::widget(
                [
                    'model'      => $model,
                    'attributes' => [
                        'product_id',
                        [
                            'label' => $model->getAttributeLabel('catalog_id'),
                            'value' => $model->catalog->name,
                        ],
                        'name',
                        'precontent:ntext',
                        'content:html',
                        'comment:ntext',
                        // 'source',
                        // 'count',
                        // 'price',
                        // 'popular',
                        [
                            'format' => 'raw',
                            'label'  => $model->getAttributeLabel('popular'),
                            'value'  => Html::activeCheckbox(
                                $model, 'popular',
                                [
                                    'label'    => '',
                                    'disabled' => true,
                                ]
                            ),
                        ],
                        // 'versions_data:ntext',
                    ],
                ]
            );


            ?>


        </div>
        <div class="tab-pane" id="details" style="padding-top:30px;min-height:300px;">

            <?php
            // echo GridView::widget([
            // 'dataProvider' => $model->characteristicsValues,
            // 'layout' => "{items}",
            // 'columns' => [
            //     // [
            //     // 'class' => 'yii\grid\SerialColumn',
            //     // 'header' =>'№',
            //     // ],
            //     // Simple columns defined by the data contained in $dataProvider.
            //     // More complex one.
            //         [
            //         'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            //         'label' => 'Характеристика',
            //         'value' => function ($data) {
            //         return $data['name']; // $data['name'] for array data, e.g. using SqlDataProvider.
            //         },
            //         ],
            //         [
            //         'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            //         'label' => 'Значение',
            //         'value' => function ($data) {
            //         return $data['values_name']; // $data['name'] for array data, e.g. using SqlDataProvider.
            //         },
            //         ],
            //     ],

            // ]);
            ?>
        </div>


        <div class="tab-pane" id="photos" style="padding-top:30px;min-height:300px;">


            <?php
            $fotorama = \metalguardian\fotorama\Fotorama::begin(
                [
                    'options'     => [
                        'allowfullscreen' => true,
                        'nav'             => 'thumbs',
                        'thumbmargin'     => 10,
                        // 'data-thumbfit' => 'scaledown',
                        'height'          => 300,
                        'navposition'     => 'top',
                        'ratio'           => '800/600',

                    ],
                    'spinner'     => [
                        'lines' => 20,
                    ],
                    'tagName'     => 'div',
                    'useHtmlData' => false,
                    'htmlOptions' => [
                        'class' => 'custom-class',
                        'id'    => 'custom-id',
                    ],
                ]
            );
            ?>

            <?php
            // foreach ($model->photos as $photo) {
            //     echo Html::img($photo->url);
            // }


            ?>

            <?php $fotorama->end(); ?>

        </div>


    </div>


    <?= Html::a(
        'Delete', ['delete', 'id' => $model->id], [
        'class' => 'pull-right btn btn-xs btn-danger',
        'data'  => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method'  => 'post',
        ],
    ]
    ) ?>
</div>
