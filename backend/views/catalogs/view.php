<?php

use common\models\catalogs\Catalogs;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\catalogs\CatalogsAdmin */

$this->title = $model->name . " (Просмотр)";
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Catalogs Admins', 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
//echo Html::beginTag('div',['class'=>'content-header']);
//echo Breadcrumbs::widget([
//    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//]);
//echo Html::endTag('div');
?>

<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools">
            <?= Html::a('Редактировать', \yii\helpers\Url::toRoute([ 'update', 'catalog_id' => $model->catalog_id ]), [ 'class' => 'btn btn-sm btn-warning' ]) ?>
        </div>

    </div>


    <div class="box-body">

        <div class="row">

            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?
                if ($model->getBehavior('coverBehavior')->hasImage()) {
                    echo Html::img($model->getBehavior('coverBehavior')->getUrl('original'));
                }
                ?>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                <?
                echo DetailView::widget([
                    'model'      => $model,
                    'attributes' => [
                        'catalog_id',

                        [
                            'label' => 'Наименование',
                            'value' => $model->name,
                        ],
                        [
                            'label' => 'Родитель',
                            'value' => $model->parents(1)->one()->name == 'ROOT' ? '' : $model->parents(1)->one()->name ,
//                            'value' => $parent = $model->parents(1)->one()->name,

                ],

                        'description',
                    ],
                ]);

                ?>
            </div>
        </div>
        <?




        ?>

    </div>


</div>


