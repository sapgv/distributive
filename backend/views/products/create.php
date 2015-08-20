<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Create Products';
?>
<div class="products-create">

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>
