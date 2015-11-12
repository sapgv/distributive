<?php
/**
 * Created by PhpStorm.
 * User: sapgv
 * Date: 13.11.2015
 * Time: 0:20
 */

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;
use common\models\properties\Properties;

class PropertiesFtp extends Properties {

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
        Properties::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);


            foreach ($xml->properties as $propertiesXML) {
                self::SaveValue($propertiesXML);
            }

        }
        else {
            exit('Не удалось открыть файл values.xml.');
        }
    }


    public static function SaveValue($propertiesXML)
    {
        foreach ($propertiesXML as $property) {

            $name = (string) $property->name;
            $value = Properties::findOne($name);

            if ( is_null($value)) {
                // создаем запись
                $value = new Properties();
                $value->name = $name;
                $value->save(false);
            }
            else {

                // обновляем запись
                $value->name = $name;
                $value->save(false);

            }

        }


    }

}