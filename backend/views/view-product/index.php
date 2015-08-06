<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ViewProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="view-product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create View Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'view_product_id',
            'name',
            'common_characteristics',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
