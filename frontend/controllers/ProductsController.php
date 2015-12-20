<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\products\Products;
use yii\web\NotFoundHttpException;


class ProductsController extends Controller
{
    

    public function actionView($product_id)
    {
        $model = Products::findOne($product_id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    
}
