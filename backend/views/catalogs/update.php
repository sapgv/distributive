<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\catalogs\CatalogsAdmin */

$this->title = $model->name . " (Редактирование)";

?>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


