<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\catalogs\Catalogs;
use common\models\products\ProductsCatalogSearch;
use yii\web\NotFoundHttpException;

class CatalogsController extends Controller
{

    public function actionView($catalog_id)
    {
        $model = Catalogs::findOne($catalog_id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        $searchModel = new ProductsCatalogSearch();
        /** @var Catalogs $model */
        $arrayResult = $searchModel->search(Yii::$app->request->queryParams,$model);



        if ($arrayResult['dataProvider']->count > 0) {
           return $this->render('view', [
            'model' => $model,
            'searchModel'=>$searchModel,
            'dataProvider'=>$arrayResult['dataProvider'],
            'price_min'=>$arrayResult['price_min'],
            'price_max'=>$arrayResult['price_max']
        ]);
        }
        else {
            return $this->render('emptyList', [
            'model' => $model,
            'searchModel'=>$searchModel,
            'dataProvider'=>$arrayResult['dataProvider'],
            'price_min'=>$arrayResult['price_min'],
            'price_max'=>$arrayResult['price_max']
            ]);
        }
        
    }

    
}

