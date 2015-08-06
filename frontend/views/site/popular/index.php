<?php 

// namespace app\models;

// use Yii;
use yii\helpers\Html;

use frontend\controllers\CookieController;

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;

 ?>


<!-- <div class="row"> -->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default">
        <h4>Популярные товары</h4>
        <hr>
        <?
echo $this->render('_search', [
        'model' => $searchModel,
    ])
     ?>
    </div>
<!-- </div> -->

<!-- <div class="row"> -->
    <?php 
    
    $viewList = CookieController::getViewList();
    
    if ($viewList =='list' OR !isset($viewList)) {
        echo $this->render('_list',
            [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]
            );
    }
    elseif ($viewList =='panel') {
        echo $this->render('_panel',
             [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            ]
            );
    }

 ?>
<!-- </div> -->


<!-- <div class="row"> -->
    
    <?php 

    echo LinkPager::widget([
    'pagination'=>$dataProvider->pagination,
    ]);
     ?>

<!-- </div> -->

