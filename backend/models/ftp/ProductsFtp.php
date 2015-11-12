<?php

namespace backend\models\ftp;

use Yii;
use common\models\products\Products;
use yii2mod\ftp\FtpClient;
use yii\helpers\Json;


class ProductsFtp extends Products {

    // ftp function

    public static function getFiles() {

        $host = Yii::$app->params[ 'ftp' ][ 'host' ];
        $name = Yii::$app->params[ 'ftp' ][ 'name' ];
        $pass = Yii::$app->params[ 'ftp' ][ 'pass' ];
        $ftp = new FtpClient();
        $ftp->connect($host);

        $ftp->login($name, $pass);

        $remote_file = Yii::getAlias('@ftpXml') . DIRECTORY_SEPARATOR . "products.xml";
        $local_file = Yii::getAlias('@localXml') . DIRECTORY_SEPARATOR . "products.xml";

        $ftp->get($local_file, $remote_file, $mode = FTP_ASCII);

        self::parseProducts($local_file);

    }


    public static function parseProducts($local_file) {
        //сначала удалим весь каталог
        Products::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);

            foreach ($xml->product as $productXML) {
                self::SaveProduct($productXML);
            }
        }
        else {
            exit('Не удалось открыть файл products.xml.');
        }
    }


    public static function SaveProduct($productXML) {

        $product_id = (int)$productXML->product_id;
        $product = Products::findOne($product_id);

        if (is_null($product)) {

            // создаем запись
            $product = new Products;
            $product->product_id = (int)$productXML->product_id;
            $product->catalog_id = (int)$productXML->catalog_id;
            $product->gallery_id = (int)$productXML->gallery_id;
            $product->name = (string)$productXML->name;
            $product->precontent = (string)$productXML->precontent;
//          $product->content = (string) $productXML->content;
            $product->popular = (int)$productXML->popular;
            $product->price = (int)$productXML->price;
//          $product->count = (int) $productXML->count;

            $product->save(false);
        }
        else {

            // обновляем запись 
            $product->product_id = (int)$productXML->product_id;
            $product->catalog_id = (int)$productXML->catalog_id;
            $product->gallery_id = (int)$productXML->gallery_id;
            $product->name = (string)$productXML->name;
            $product->precontent = (string)$productXML->precontent;
//            $product->content = (string) $productXML->content;
            $product->popular = (int)$productXML->popular;
            $product->price = (int)$productXML->price;
//            $product->count = (int) $productXML->count;
            $product->save(false);

        }

    }


}
