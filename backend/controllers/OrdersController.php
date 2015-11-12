<?php

namespace backend\controllers;

use Yii;
use common\models\orders\Orders;

use backend\models\orders\OrdersAdminSearch;
use backend\models\orders\OrdersProductsAdminSearch;
use common\models\orders\OrdersProducts;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;

class OrdersController extends Controller
{
    

    public function actionIndex()
    {

        $searchModel = new OrdersAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($order_id)
    {
        $searchModel = new OrdersProductsAdminSearch();
        $dataProvider = $searchModel->search($order_id);
        
        $query = OrdersProducts::find()->where(['order_id' => $order_id]);
        $total = $query->sum('quantity');

        $model = Orders::findOne($order_id);
        if ($model === null) {
            throw new NotFoundHttpException;
        }

        return $this->render('view', [
            'model' => $model,
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            'total'=>$total,
        ]);
    }

    public function actionUpdate($order_id) {

        $model = $this->findModel($order_id);

        $searchModel = new OrdersAdminSearch();

        $searchModelProducts = new OrdersProductsAdminSearch();
        $dataProvider = $searchModelProducts->search($order_id);
        $query = OrdersProducts::find()->where(['order_id' => $order_id]);
        $total = $query->sum('quantity');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([ 'view', 'order_id' => $model->order_id ]);
        }
        else {
            return $this->render(
                'update', [
                    'model' => $model,
                    'dataProvider'=>$dataProvider,
                    'total'=>$total,
                ]
            );
        }


    }

    public function actionDelete($order_id) {

        $this->findModel($order_id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($pk) {

        if ( ($model = Orders::findOne($pk)) !== null )
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSaveOrderFtp($order_id) {

        $order = $this->findModel($order_id);
        $order->saveOrderFtp();


    }

    public function actionMailOrder($order_id) {

        $model = $this->findModel($order_id);
        $model->sentOrderMail();

//            return $this->render(
//                'mail-template', [
//                    'model' => $model,
//                ]
//            );



    }




}
