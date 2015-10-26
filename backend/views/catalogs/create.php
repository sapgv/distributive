<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CatalogsAdmin */

$this->title = 'Создать новый каталог';
$this->params['breadcrumbs'][] = ['label' => 'Catalogs Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogs-admin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
