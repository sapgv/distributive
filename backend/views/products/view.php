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
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Products', 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools">
            <?= Html::a('Редактировать', \yii\helpers\Url::toRoute([ 'update', 'product_id' => $model->product_id ]), [ 'class' => 'btn btn-sm btn-warning' ]) ?>
        </div>

    </div>


    <div class="box-body">
        <?
        echo DetailView::widget([
            'model'      => $model,
            'attributes' => [
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
                'product_id',
                [
                    'label' => $model->getAttributeLabel('catalog_id'),
                    'value' => $model->catalog->name,
                ],
                [
                    'label' => 'Имя',
                    'value' => $model->name,
                ],
                'precontent:ntext',
                'content:html',
                'comment:ntext',

            ],
        ]);

        echo Html::tag('h3', 'Фотографии', [ 'class' => 'page-header' ]);


        $fotorama = \metalguardian\fotorama\Fotorama::begin(
            [
                'options'     => [
                    'allowfullscreen' => true,
                    'nav'             => 'thumbs',
                    'thumbmargin'     => 10,
                    'thumbfit'        => 'scaledown',
                    'fit'             => 'scaledown',
                    'width'           => '500',
                    'height'          => '350',
                    'class'           => 'img-responsive',
                    // 'margin-top'=>'20',
                    // 'ratio' => 1024/768,

                ],
                'spinner'     => [
                    'lines' => 20,
                ],
                'tagName'     => 'div',
                'useHtmlData' => false,
                'htmlOptions' => [
                    'class' => 'custom-class',
                    'id'    => 'custom-id',
                    'style' => 'margin-top:15px;',

                ],
            ]
        );

        foreach ($model->getImages() as $photo) {
            echo Html::img($photo->getUrl('original'));
        }


        ?>

        <?php $fotorama->end(); ?>


    </div>


</div>


