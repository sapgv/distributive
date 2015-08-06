<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name . ' ' .'(Редактирование)'  ;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

<!--    <h3 style="margin-top:0px;">--><?//= Html::encode($this->title) ?><!--</h3>-->

    <?= $this->render('_form', [
        'model' => $model,
        'characteristicsSearchModel' => $characteristicsSearchModel,
        'characteristicsDataProvider' => $characteristicsDataProvider,
    ]) ?>

</div>
