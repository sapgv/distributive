<?php

// namespace app\models;

// use Yii;

use frontend\controllers\CookieController;

use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\widgets\LinkPager;

?>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default">
    <h4>Популярные товары</h4>
    <hr>
    <?
    echo $this->render('_search', [
        'model' => $searchModel,
    ])
    ?>
</div>
<?php

$viewList = CookieController::getViewList();

if ($dataProvider->count > 0) {
    if ($viewList == 'list' OR !isset($viewList)) {

        echo $this->render('_list',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }
    elseif ($viewList == 'panel') {
        echo $this->render('_panel',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    echo LinkPager::widget([
        'pagination' => $dataProvider->pagination,
    ]);

}

else {
    echo $this->render('emptyList', [
        'model' => $model,
    ]);

}
?>

<?php


?>

