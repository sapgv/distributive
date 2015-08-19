<?php
/**
 * Created by PhpStorm.
 * User: Гриша
 * Date: 19.08.2015
 * Time: 22:31
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\orders\Orders */

$this->title = $model->name . ' ' .'(Редактирование)'  ;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'order_id' => $model->order_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">

    <!--    <h3 style="margin-top:0px;">--><?//= Html::encode($this->title) ?><!--</h3>-->

    <?= $this->render('_form', [
        'model' => $model,
        'dataProvider' => $dataProvider,
        'total'=>$total,

    ]) ?>

</div>