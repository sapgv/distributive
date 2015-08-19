<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\CatalogsAdmin */

$this->title = $model->name;
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Catalogs Admins', 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="catalogs-admin-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Update', [ 'update', 'id' => $model->catalog_id ], [ 'class' => 'btn btn-primary' ]) ?>
    <?= Html::a('Delete', [ 'delete', 'id' => $model->catalog_id ], [
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
          'catalog_id',
          'id_parent',
          'name',
          'description',

      ],
  ]) ?>

</div>
