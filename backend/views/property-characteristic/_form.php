<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\property\Property */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>
    <div class="box">

        <div class="box-header">

            <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            <div class="box-tools">
                <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-sm btn-success' : 'btn btn-sm btn-success']) ?>
            </div>
        </div>

        <div class="box-body">


            <?= $form->field(
                $model, 'property_owner',

                [
                    'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                    'labelOptions' => ['class' => 'control-label col-sm-2'],
                    'inputOptions' => ['class' => 'form-control'],

                ]
            )->dropDownList($model->getOwners(), ['prompt' => 'Выберите владельца ...']);
            ?>

            <?= $form->field(
                $model, 'name',
                [
                    'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                    'labelOptions' => ['class' => 'control-label col-sm-2'],
                    'inputOptions' => ['class' => 'form-control', 'placeholder' => $model->name],

                ]
            )->textInput() ?>


            <?= $form->field(
                $model, 'type_value',

                [
                    'template'     => "{label}\n<div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
                    'labelOptions' => ['class' => 'control-label col-sm-2'],
                    'inputOptions' => ['class' => 'form-control'],

                ]
            )->dropDownList($model->getTypeValues(), ['prompt' => 'Выберите тип значения ...']);
            ?>


        </div>
    </div>
<?php ActiveForm::end(); ?>