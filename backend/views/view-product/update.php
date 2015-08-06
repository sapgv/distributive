<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\products\ViewProduct */

$this->title = 'Update View Product: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'View Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->view_product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="view-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
