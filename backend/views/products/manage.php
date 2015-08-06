<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\products\Products;
use app\models\Catalogs;
use yii\data\ActiveDataProvider;
use yii\bootstrap\ButtonGroup;
use yii\bootstrap\Button;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
       
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="pull-right">
             <?php 
    echo ButtonGroup::widget([
    'buttons' => [
        Html::a('создать товар',Url::to(['/admin/products/create']),
            [
            'class'=>'btn btn-success'
            ]
            ),
    ],
    // 'options'=>['class'=>'pull-right']
]);
    

     ?>
        </div>
    </div>
        
       


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // [
            // 'class' => 'yii\grid\SerialColumn',
            // 'header' =>'№'
            // ],
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'label' => 'Код',
            'value' => function ($data) {
                return $data['id']; 
                },
            ],
            [
            'class' => 'yii\grid\DataColumn', 
            'label' => 'Аватар',
            'format' => 'html',
            'value' => function ($model, $key, $index, $column) {
                
                // $product = Products::findOne($model->id);

                // $mainPhoto = $product->mainPhoto;
                // return Html::a(
                //     Html::img($mainPhoto->url,['class'=>'img-responsive','style'=>'width:50px;']),
                //     ['products/view','product_id'=>$product->id],['style'=>'display:block;']);

                },
            ],
            [
            'class' => 'yii\grid\DataColumn', 
            'label' => 'Каталог',
            'attribute'=>'name_catalog',
            'value' => function ($data) {
               return $data['name_catalog'];
                },
            ],
            
            [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'label' => 'Наименование',
            'attribute'=>'name',
            'value' => function ($data) {
                return $data['name']; // $data['name'] for array data, e.g. using SqlDataProvider.
                },
            ],

            
            // 'id',
            // 'id_catalog',
            // 'name',
            // 'comment:ntext',
            // 'precontent:ntext',
            // 'content:ntext',
            // 'source',
            // 'count',
            // 'price',
            // 'popular',
            // 'versions_data:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
