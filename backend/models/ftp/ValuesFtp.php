<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;
use common\models\properties\Values;

/**
 * This is the model class for table "values".
 *
 * @property integer $id
 * @property string $name
 *
 */
class ValuesFtp extends Values
{

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
        ValuesFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->values as $valuesXML) {
                self::SaveValue($valuesXML);
                }
        
        } 
        else {
            exit('Не удалось открыть файл values.xml.');
        }
    }

  
     public static function SaveValue($valuesXML)
    {
        foreach ($valuesXML as $valueXML) {

            $name = (string) $valueXML->name;
            $value = ValuesFtp::findOne($name);

            if ( is_null($value)) {
                // создаем запись
                $value = new ValuesFtp;
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
