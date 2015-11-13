<?php
/**
 * Created by PhpStorm.
 * User: Гриша
 * Date: 13.11.2015
 * Time: 0:01
 */

namespace app\common\models\properties;


class Value {

}


<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;

/**
 * This is the model class for table "values".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CharacteristicsValuesAssignment[] $characteristicsValuesAssignments
 */
class ValuesFtp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value_id', 'name'], 'required'],
            [['value_id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

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


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'value_id' => 'Код',
            'name' => 'Наименование',
        ];
    }


}
