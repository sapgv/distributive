<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\characteristics\Characteristics */

$this->title = 'Update Characteristics: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->characteristic_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="characteristics-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
