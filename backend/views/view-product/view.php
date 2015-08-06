<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\products\ViewProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'View Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->view_product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->view_product_id], [
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
            'view_product_id',
            'name',
            'common_characteristics',
        ],
    ]) ?>

</div>
