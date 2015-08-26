<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use common\models\catalogs\Catalogs;

use sapgv\yii2\galleryManager\GalleryManagerWidget;
use sapgv\yii2\galleryManager\GalleryManager;
//use dosamigos\tinymce\TinyMce;
//use zxbodya\TinyMce;
use yii\grid\GridView;
use common\models\products\ViewProduct;
use zxbodya\yii2\elfinder\TinyMceElFinder;
use zxbodya\yii2\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([ 'options' => [ 'class' => 'form-horizontal' ] ]); ?>
<div class="box">

    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools">
            <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', [ 'class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success' ]) ?>
        </div>
    </div>

    <div class="box-body">
        <div class="nav-tabs-custom">


            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#decription" data-toggle="tab">Основная</a></li>
<!--                <li><a href="#details" data-toggle="tab">Технические характеристики</a></li>-->
                <li><a href="#photos" data-toggle="tab">Фотографии</a></li>


            </ul>

            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="decription" style="padding-top:15px;min-height:300px;">


                    <?= $form->field(
                        $model, 'popular',
                        [
                            'template'     => "<div class='col-sm-offset-2 col-sm-10'>{input}</div>",
                            // 'labelOptions'=>['class'=>'control-label col-sm-2'],
                            'inputOptions' => [ 'class' => 'form-control' ],
                        ]
                    )->checkbox() ?>

                    <?= $form->field(
                        $model, 'product_id',
                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => [ 'class' => 'control-label col-sm-2' ],
                            'inputOptions' => [ 'class' => 'form-control', 'disabled' => true ],

                        ]
                    )->textInput() ?>

                    <?
                    $catalogList = ArrayHelper::map(Catalogs::find()
                        ->where(['not',['name'=>'ROOT']])
                        ->all(), 'catalog_id', 'name');

                    echo $form->field(
                        $model, 'catalog_id',

                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => [ 'class' => 'control-label col-sm-2' ],
                            'inputOptions' => [ 'class' => 'form-control' ],

                        ]
                    )->dropDownList($catalogList, [ 'prompt' => 'Выберите каталог ...' ]);
                    ?>


                    <?= $form->field(
                        $model, 'view_product_id',

                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => [ 'class' => 'control-label col-sm-2' ],
                            'inputOptions' => [ 'class' => 'form-control' ],

                        ]
                    )->dropDownList(ArrayHelper::map(ViewProduct::find()->all(), 'view_product_id', 'name'), [ 'prompt' => 'Выберите вид номенклатуры ...' ]) ?>

                    <?= $form->field(
                        $model, 'name',
                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => [ 'class' => 'control-label col-sm-2' ],
                            'inputOptions' => [ 'class' => 'form-control', 'placeholder' => $model->name ],

                        ]
                    )->textInput() ?>



                    <?= $form->field($model, 'precontent')->textarea([ 'rows' => 6, 'placeholder' => $model->precontent ]) ?>



                    <?= $form->field($model, 'content')->widget(
                        TinyMce::className(),
                        [
                            'fileManager' => [
                                'class' => TinyMceElFinder::className(),
                                'connectorRoute' => 'el-finder/connector',
                            ],
                        ]
                    ); ?>

                    <?= $form->field($model, 'comment')->textarea([ 'rows' => 6, 'placeholder' => $model->comment ]) ?>


                </div>
<!--                <div class="tab-pane" id="details" style="min-height:300px;">-->
<!---->
<!--                    <div class="box" style="border: none">-->
<!---->
<!--                        <div class="box-header">-->
<!---->
<!---->
<!--                            <div class="box-title pull-right">-->
<!--                                --><?//= Html::a('Новая характеристика', [ '/characteristics/create', 'product_id' => $model->id ], [ 'class' => 'btn btn-sm btn-warning' ]) ?>
<!---->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!---->
<!---->
<!--                        --><?//
//                        echo GridView::widget(
//                            [
//                                'dataProvider' => $characteristicsDataProvider,
//                                'filterModel'  => $characteristicsSearchModel,
//                                'summary'      => '',
//                                'columns'      => [
//                                    [ 'class' => 'yii\grid\SerialColumn' ],
//
//                                    'characteristic_id',
//                                    'name',
//
//                                    [ 'class' => 'yii\grid\ActionColumn' ],
//                                    //                                    [
//                                    //                                        'class'      => 'yii\grid\ActionColumn',
//                                    //                                        'urlCreator' => function ($action, $model, $key, $index)
//                                    //                                        {
//                                    //
//                                    //                                            return [
//                                    //                                                '/characteristics/view', 'id' => $model->characteristic_id,
//                                    //                                                '/characteristics/update', 'id' => $model->characteristic_id,
//                                    //
//                                    //                                            ];
//                                    //                                        },
//                                    //                                    ],
//                                ],
//                            ]
//                        );
//                        ?>
<!---->
<!--                    </div>-->
<!--                </div>-->


                <div class="tab-pane" id="photos" style="padding-top:30px;min-height:300px;">
                    <?php

                    if ($model->isNewRecord) {
                        echo 'Can not upload images for new record';
                    }
                    else {
                        echo GalleryManager::widget(
                            [
                                'model'        => $model,
                                'behaviorName' => 'galleryBehavior',
                                'apiRoute'     => '/products/galleryApi',
                            ]
                        );
                    }

                    ?>
                </div>


            </div>


        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>
