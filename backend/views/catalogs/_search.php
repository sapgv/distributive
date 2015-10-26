<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\ButtonGroup ;
use yii\bootstrap\Button ;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CatalogsAdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalogs-admin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php 

   echo ButtonGroup::widget([
    'buttons' => [
        Button::widget(['label' => 'A']),
        ['label' => 'B'],
    ]
]);
     ?>
        </div>
    </div>
   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
