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
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public static function getFiles()
    {
     $host = "localhost";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login("ftp", "ftp");

     $remote_file = "values.xml";     
     $local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."values.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parseProducts($local_file);
     
    }


    public static function parseProducts($local_file)
    {
        //сначала удалим весь каталог
        ValuesFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->value as $valueXML) {         
                self::SaveValue($valueXML);
                // print_r( (int)$valueXML->id);

                }       
        
        } 
        else {
            exit('Не удалось открыть файл values.xml.');
        }
    }

  
     public static function SaveValue($valueXML)
    {
        
        $value = ValuesFtp::findOne( (int) $valueXML->id);
        

        if ( is_null($value)) {
            // создаем запись 
            $value = new ValuesFtp;
            $value->id = (int) $valueXML->id;
            $value->name = (string) $valueXML->name;
            $value->save();
        }
        else {
            
            // обновляем запись 

            $value->id = (int) $valueXML->id;
            $value->name = (string) $valueXML->name;
            $value->save();

        }

    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicsValuesAssignments()
    {
        return $this->hasMany(CharacteristicsValuesAssignment::className(), ['values_id' => 'id']);
    }
}
