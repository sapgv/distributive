<?php

namespace backend\controllers;

use Yii;
use common\models\Catalogs;
use backend\models\ftp\CatalogsFtp;
use backend\models\ftp\ProductsFtp;
use backend\models\ftp\ValuesFtp;
use backend\models\ftp\PropertiesFtp;
use backend\models\ftp\ProductsPropertiesFtp;
use backend\models\ftp\ProductsTechCharAssignmentFtp;
use backend\models\ftp\TechcharValuesAssignmentFtp;
use backend\models\ftp\GalleryPhotoFtp;


use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * FtpController implements the CRUD actions for Ftp model.
 */
class FtpController extends Controller
{
    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUploadCatalogs()
    {
        CatalogsFtp::getFiles();
        CatalogsFtp::getImages();

        \Yii::$app->getSession()->setFlash('success', 'Каталог успешно загружен');
        return $this->redirect('index');
    }

    public function actionUploadProducts()
    {
        ProductsFtp::getFiles();
        ProductsFtp::getContentImages();

        GalleryPhotoFtp::getFiles();
        GalleryPhotoFtp::getImages();

        \Yii::$app->getSession()->setFlash('success', 'Товары успешно загружены');
        return $this->redirect('index');
    }

    public function actionUploadCharacteristics()
    {
        ValuesFtp::getFiles(); //значения характеристик
        PropertiesFtp::getFiles();//свойства
        ProductsPropertiesFtp::getFiles(); //свойства номенклатуры

        \Yii::$app->getSession()->setFlash('success', 'Характеристики загружены');
        return $this->redirect('index');

//        TechcharFtp::getFiles(); //Технические характеристики
//        ProductsTechCharAssignmentFtp::getFiles(); //Товары - технические характеристики
//        TechcharValuesAssignmentFtp::getFiles(); //Технические характеристики
    }

}

