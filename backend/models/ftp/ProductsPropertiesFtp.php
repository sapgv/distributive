<?php
/**
 * Created by PhpStorm.
 * User: sapgv
 * Date: 13.11.2015
 * Time: 0:26
 */

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;
use common\models\properties\ProductsProperties;

class ProductsPropertiesFtp extends ProductsProperties {

    public static function getFiles()
    {
        $host = Yii::$app->params[ 'ftp' ][ 'host' ];
        $name = Yii::$app->params[ 'ftp' ][ 'name' ];
        $pass = Yii::$app->params[ 'ftp' ][ 'pass' ];
        $ftp = new FtpClient();
        $ftp->connect($host);

        $ftp->login($name, $pass);

        $remote_file = Yii::getAlias('@ftpXml') . DIRECTORY_SEPARATOR . "properties.xml";
        $local_file = Yii::getAlias('@localXml') . DIRECTORY_SEPARATOR . "properties.xml";

        $ftp->get($local_file, $remote_file, $mode = FTP_ASCII);

        self::parseValues($local_file);
    }


    public static function parseValues($local_file)
    {
        //сначала удалим весь каталог
        ProductsProperties::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);


            foreach ($xml->products_properties as $products_propertiesXML) {
                self::SaveValue($products_propertiesXML);
            }

        }
        else {
            exit('Не удалось открыть файл values.xml.');
        }
    }


    public static function SaveValue($products_propertiesXML)
    {
        foreach ($products_propertiesXML as $products_property) {

            $product_id = (int) $products_property->product_id;
            $name = (string) $products_property->property_name;
            $value = (string) $products_property->value_name;

//            $value = ProductsProperties::findOne($name);
//
//            if ( is_null($value)) {
                // создаем запись
                $model = new ProductsProperties();
                $model->product_id = $product_id;
                $model->property_name = $name;
                $model->value_name = $value;
                $model->save(false);
//            }
//            else {
//
//                // обновляем запись
//                $value->product_id = $product_id;
//                $value->property_name = $name;
//                $value->value_name = $value;
//                $value->save(false);
//
//            }

        }


    }

}