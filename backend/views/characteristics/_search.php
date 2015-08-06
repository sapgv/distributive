<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\characteristics\CharacteristicsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characteristics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'characteristic_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'view_product_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
