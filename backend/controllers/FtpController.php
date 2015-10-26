<?php

namespace backend\controllers;

use Yii;
use common\models\Catalogs;
use backend\models\ftp\CatalogsFtp;
use backend\models\ftp\ProductsFtp;
use backend\models\ftp\ValuesFtp;
use backend\models\ftp\CharacteristicsFtp;
use backend\models\ftp\TechcharFtp;
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
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploadCatalogs()
    {
        CatalogsFtp::getFiles(); 

        CatalogsFtp::getImages();
    }

    public function actionUploadProducts()
    {
        ProductsFtp::getFiles(); 
    }

    public function actionUploadCharacteristics()
    {
        ValuesFtp::getFiles(); //значения характеристик
        CharacteristicsFtp::getFiles(); //имена характеристик
        TechcharFtp::getFiles(); //Технические характеристики
        ProductsTechCharAssignmentFtp::getFiles(); //Товары - технические характеристики
        TechcharValuesAssignmentFtp::getFiles(); //Технические характеристики
    }

    public function actionUploadImages()
    {
        GalleryPhotoFtp::getFiles();

        GalleryPhotoFtp::getImages(); 
    }


    
}

