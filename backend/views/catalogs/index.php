<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ButtonGroup;
use yii\helpers\Url;
use common\models\catalogs\Catalogs;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\catalogs\CatalogsAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Каталог';
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
                            'создать каталог', Url::to(['/catalogs/create']),
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
                'columns' => [

                    [
                        'label'=>'Код',
                        'contentOptions'=>['style'=>'max-width: 30px;'],
                        'value'=>function ($model) {
                            return $model->catalog_id;
                        },
                    ],
                    [
                        'label'=>'<i class="fa fa-picture-o"></i>',
                        'encodeLabel'=>false,
                        'format'=>'raw',
                        'contentOptions'=>['style'=>'max-width: 30px;'],
                        'value'=>function ($model) {

                            if ($model->getBehavior('coverBehavior')->hasImage()) {
//                                return Html::img($model->getBehavior('coverBehavior')->getUrl('original'),['class'=>'img-responsive','style'=>'max-width:50px;']);
//                                $mainPhoto = $model->MainPhoto;
                                return Html::a(
                                    Html::img($model->getBehavior('coverBehavior')->getUrl('original'),['class'=>'img-responsive','style'=>'']),
                                    ['products/view','catalog_id'=>$model->catalog_id],['style'=>'display:block;']);
                            }
                            else {
                                return ' ';
                            }


                        },

                    ],
                    'name',
                    [
                        'label'=>'Родитель',
                        'filter' => Html::activeDropDownList($searchModel, 'id_parent', ArrayHelper::map(Catalogs::find()->where(['not',['catalog_id'=>$model->catalog_id]])->andWhere(['not',['name'=>'ROOT']])->all(), 'catalog_id', 'name'),['class'=>'form-control','prompt' => '']),
                        'value'=>function ($model) {
                            $parent = $model->parents(1)->one();
                            if ($parent->name == 'ROOT') {
                                return '';
                            }
                            else {
                                return $parent->name;
                            }
                        },
                    ],
                    [
                        'class'      => 'yii\grid\ActionColumn',
                        'urlCreator' => function ($action, $model, $key, $index)
                        {

                            return [$action, 'catalog_id' => $model->catalog_id];
                        },
                    ],
                ],
            ]
        ); ?>

    </div>


</div>