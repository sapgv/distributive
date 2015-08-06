<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\products\ViewProduct */

$this->title = 'Create View Product';
$this->params['breadcrumbs'][] = ['label' => 'View Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
