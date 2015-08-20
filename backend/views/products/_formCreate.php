<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;
use yii\widgets\DetailView;
use yii\widgets\ListView;

use yii\helpers\ArrayHelper;
use common\models\catalogs\Catalogs;

use zxbodya\yii2\imageAttachment\ImageAttachmentWidget;
use zxbodya\yii2\galleryManager\GalleryManagerWidget;
use zxbodya\yii2\galleryManager\GalleryManager;
use dosamigos\tinymce\TinyMce;
use yii\grid\GridView;
use common\models\products\ViewProduct;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Новый товар';
?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
<div class="box">

    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="box-body">
        <div class="nav-tabs-custom">


            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                <li class="active"><a href="#decription" data-toggle="tab">Основная</a></li>



            </ul>

            <div id="my-tab-content" class="tab-content">
                <div class="tab-pane active" id="decription" style="padding-top:15px;min-height:300px;">


                    <?= $form->field(
                        $model, 'popular',
                        [
                            'template'     => "<div class='col-sm-offset-2 col-sm-10'>{input}</div>",
                            // 'labelOptions'=>['class'=>'control-label col-sm-2'],
                            'inputOptions' => ['class' => 'form-control'],
                        ]
                    )->checkbox() ?>

                    <?

                    echo $form->field(
                        $model, 'catalog_id',

                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => ['class' => 'control-label col-sm-2'],
                            'inputOptions' => ['class' => 'form-control'],

                        ]
                    )->dropDownList(ArrayHelper::map(Catalogs::find()->all(), 'catalog_id', 'name'), ['prompt' => 'Выберите каталог ...']);
                    ?>


                    <?= $form->field(
                        $model, 'view_product_id',

                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => ['class' => 'control-label col-sm-2'],
                            'inputOptions' => ['class' => 'form-control'],

                        ]
                    )->dropDownList(ArrayHelper::map(ViewProduct::find()->all(), 'view_product_id', 'name'), ['prompt' => 'Выберите вид номенклатуры ...']) ?>

                    <?= $form->field(
                        $model, 'name',
                        [
                            'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                            'labelOptions' => ['class' => 'control-label col-sm-2'],
                            'inputOptions' => ['class' => 'form-control', 'placeholder' => $model->name],

                        ]
                    )->textInput() ?>



                    <?= $form->field($model, 'precontent')->textarea(['rows' => 6, 'placeholder' => $model->precontent]) ?>



                    <?= $form->field($model, 'content')->widget(
                        TinyMce::className(), [
                        'options'       => ['rows' => 6],
                        'language'      => 'ru',
                        'clientOptions' => [
                            // 'plugins' => [
                            //     "advlist autolink lists link image charmap print preview anchor",
                            //     "searchreplace visualblocks code fullscreen",
                            //     "insertdatetime media table contextmenu paste"
                            // ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                        ],
                    ]
                    ); ?>

                    <?= $form->field($model, 'comment')->textarea(['rows' => 6, 'placeholder' => $model->comment]) ?>


                    <!--  <?= $form->field($model, 'source')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'popular')->textInput() ?>

    <?= $form->field($model, 'versions_data')->textarea(['rows' => 6]) ?> -->

                    <!--                    <div class="form-group">-->
                    <!--                        --><? //= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <!--                    </div>-->


                </div>


            </div>


        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>
