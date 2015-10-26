<?php

namespace backend\controllers;

use Yii;
use common\models\catalogs\Catalogs;
use backend\models\catalogs\CatalogsAdmin;
use backend\models\catalogs\CatalogsAdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use zxbodya\yii2\imageAttachment\ImageAttachmentAction;

/**
 * CatalogsController implements the CRUD actions for CatalogsAdmin model.
 */
class CatalogsController extends Controller {

    public function actions() {
        return [
            'imgAttachApi' => [
                'class' => ImageAttachmentAction::className(),
                // mappings between type names and model classes (should be the same as in behaviour)
                'types' => [
                    'catalogs' => Catalogs::className()
                ]
            ],
        ];
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    /**
     * Lists all CatalogsAdmin models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CatalogsAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatalogsAdmin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($catalog_id) {
        return $this->render('view', [
            'model' => $this->findModel($catalog_id),
        ]);
    }

    /**
     * Creates a new CatalogsAdmin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new CatalogsAdmin();

        if ($model->load(Yii::$app->request->post()) ) {

            $id_parent = Yii::$app->request->post('CatalogsAdmin')['id_parent'];
            $parent = Catalogs::find()->where(['catalog_id'=>$id_parent])->one();
            $model->prependTo($parent);

            if ($model->save()) {
                return $this->redirect([ 'view', 'catalog_id' => $model->catalog_id ]);
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CatalogsAdmin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($catalog_id) {
        $model = $this->findModel($catalog_id);

        if ($model->load(Yii::$app->request->post())) {

            $id_parent = Yii::$app->request->post('CatalogsAdmin')[ 'id_parent' ];
            $parent = Catalogs::find()->where([ 'catalog_id' => $id_parent ])->one();
            $model->prependTo($parent);

            if ($model->save()) {
                return $this->redirect([ 'view', 'catalog_id' => $model->catalog_id ]);
            }
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CatalogsAdmin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($catalog_id) {
        $this->findModel($catalog_id)->delete();

        return $this->redirect([ 'index' ]);
    }

    /**
     * Finds the CatalogsAdmin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogsAdmin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = CatalogsAdmin::findOne($id)) !== null) {
            return $model;
        }
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
