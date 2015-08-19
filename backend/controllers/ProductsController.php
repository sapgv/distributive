<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\products\Products;
use backend\models\products\ProductsAdminSearch;
use backend\models\products\ProductsCatalogSearch;


use yii\db\Query;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// use app\models\CharacteristicsSearch;
// use app\models\CharacteristicsValuesAssignmentSearch;

use sapgv\yii2\imageAttachment\ImageAttachmentAction;
use sapgv\yii2\galleryManager\GalleryManagerAction;


use common\models\characteristics\Characteristics;
use common\models\characteristics\CharacteristicsSearch;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller {

    public function behaviors() {

        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }


    public function actions() {
        return [
            'galleryApi' => [
                'class' => GalleryManagerAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'products' => Products::className()
                ]
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex() {

        $searchModel = new ProductsAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render(
            'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]
        );
    }

    /**
     * Displays a single Products model.
     * @param integer $product_id
     * @return mixed
     */
    public function actionView($product_id) {

        return $this->render(
            'view', [
            'model' => $this->findModel($product_id),
        ]
        );
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {

        $model = new Products();

        if ( $model->load(Yii::$app->request->post()) && $model->save() )
        {
            return $this->redirect(['view', 'product_id' => $model->product_id]);
        }
        else
        {
            return $this->render(
                'create', [
                'model' => $model,
            ]
            );
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @return mixed
     */
    public function actionUpdate($product_id) {

        $model = $this->findModel($product_id);

        $searchModel = new CharacteristicsSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model);


        if ( $model->load(Yii::$app->request->post()) && $model->save() )
        {
            return $this->redirect(['view', 'product_id' => $model->product_id]);

        }
        else
        {
            return $this->render(
                'update', [
                'model' => $model,
                                'characteristicsSearchModel' => $searchModel,
                                'characteristicsDataProvider' => $dataProvider,
            ]
            );
        }


    }


    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @return mixed
     */
    public function actionDelete($product_id) {

        $this->findModel($product_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id) {

        if ( ($model = Products::findOne($product_id)) !== null )
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionManage() {

        $params = static::getPostData();
        Yii::$app->response->format = Response::FORMAT_JSON;
        // print_r($params['product_id']);
        $searchModel = new ProductsCatalogSearch();
        $dataProvider = $searchModel->search($params);

        return $this->renderAjax(
            'manage', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]
        );
    }

    // if ($isInvalid === null) {
    // $isInvalid = !Yii::$app->request->isAjax || !Yii::$app->request->isPost;
    // }
    // if ($isInvalid) {
    // throw new InvalidCallException(Yii::t('kvtree', 'This operation is not allowed.'));
    // }

    protected static function getPostData() {

        if ( empty($_POST) )
        {
            return [];
        }
        $out = [];
        foreach ($_POST as $key => $value)
        {
            $out[ $key ] = $value;
        }

        return $out;
    }
}
