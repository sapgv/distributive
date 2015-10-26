<?php
/**
 * Created by PhpStorm.
 * User: Гриша
 * Date: 19.08.2015
 * Time: 22:35
 */



use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sapgv\yii2\galleryManager\GalleryManagerWidget;
use yii\grid\GridView;
use common\models\products\Products;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Заказ №'. $model->order_id;
?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
<div class="box">

    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?> от <?php echo Yii::$app->formatter->asDate($model->create_time); ?></h3>

        <div class="box-tools">
            <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
        </div>
    </div>

    <div class="box-body">
        <?= $form->field(
            $model, 'order_id',
            [
                'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label col-sm-2'],
                'inputOptions' => ['class' => 'form-control', 'disabled' => true],

            ]
        )->textInput() ?>

        <?= $form->field(
            $model, 'name',
            [
                'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label col-sm-2'],
                'inputOptions' => ['class' => 'form-control'],

            ]
        )->textInput() ?>

        <?= $form->field(
            $model, 'phone',
            [
                'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label col-sm-2'],
                'inputOptions' => ['class' => 'form-control'],

            ]
        )->textInput() ?>

        <?= $form->field(
        $model, 'email',
        [
        'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
        'labelOptions' => ['class' => 'control-label col-sm-2'],
        'inputOptions' => ['class' => 'form-control'],

        ]
        )->textInput() ?>


        <?= $form->field(
            $model, 'status',

            [
                'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label col-sm-2'],
                'inputOptions' => ['class' => 'form-control'],

            ]
        )->dropDownList($model->getStatuses(), ['prompt' => 'Выберите статус ...']) ?>


        <?= $form->field(
            $model, 'address',
            [
                'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                'labelOptions' => ['class' => 'control-label col-sm-2'],
                'inputOptions' => ['class' => 'form-control'],

            ]
        )->textarea() ?>
        <?

        echo Html::tag('h3','Товары',['class'=>'page-header']);

        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class'=>'table table-bordered table-hover'],
            'layout' => "{items}",
            'showFooter'=>true,
            'columns' => [

                [
                    'label'=>'<i class="fa fa-picture-o"></i>',
                    'encodeLabel'=>false,
                    'format'=>'raw',
                    'value'=>function ($model) {

                        $product = Products::findOne($model->product_id);

                        if ($product <> null) {
                            $mainPhoto = $product->getMainPhoto();
                            return Html::a(
                                Html::img($mainPhoto->getUrl('original'), [ 'class' => 'img-responsive', 'style' => 'max-height:120px;' ]),
                                [ 'products/view','product_id'=>$model->product_id],['style'=>'display:block;']);
                        }
//
                    },

                ],
                [
                    'label'=>'Наименование',
                    'value'=>function ($model) {
                        return $model->name;
                    },
                    'footer'=>'<strong class="pull-right">Итого</strong>',
                ],
                // 'quantity',
                [
                    'label'=>'Количество',
                    'value'=>function ($model) {
                        return $model->quantity;
                    },
                    'footer'=>Yii::$app->formatter->asInteger($total),
                ],
                // 'price',
                [
                    'label'=>'Цена',
                    'enableSorting'=>false,
                    'value'=>function ($model) {
                        return $model->price;
                    },
                ],
                // 'summa',
                [
                    'label'=>'Сумма',
                    'value'=>function ($model) {
                        return $model->summa;
                    },
                    'footer'=>$model->summa,
                ]

            ],
        ]);

        ?>
    </div>



</div>
<?php ActiveForm::end(); ?>



