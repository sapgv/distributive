<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\characteristics\CharacteristicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Characteristics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristics-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Characteristics', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'characteristic_id',
            'name',
            'product_id',
            'view_product_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
