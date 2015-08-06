<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\characteristics\Characteristics */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->characteristic_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->characteristic_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'characteristic_id',
            'name',
            'product_id',
            'view_product_id',
        ],
    ]) ?>

</div>
