<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;
/**
 * This is the model class for table "techchar".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Characteristics $name0
 */
class TechcharFtp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'techchar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
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

     $remote_file = "techchar.xml";     
     $local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."techchar.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parse($local_file);
     
    }


    public static function parse($local_file)
    {
        //сначала удалим весь каталог
        TechcharFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->characteristic as $characteristicXML) {         
                self::SaveCharacteristic($characteristicXML);
            }       
        
        } 
        else {
            exit('Не удалось открыть файл techchar.xml.');
        }
    }

  
     public static function SaveCharacteristic($characteristicXML)
    {
        
        $characteristic = TechcharFtp::findOne( (int) $characteristicXML->id);
        

        if ( is_null($characteristic)) {
            // создаем запись 
            $characteristic = new TechcharFtp;
            $characteristic->id = (int) $characteristicXML->id;
            $characteristic->name = (string) $characteristicXML->name;
            $characteristic->save();
        }
        else {
            
            // обновляем запись 

            $characteristic->id = (int) $characteristicXML->id;
            $characteristic->name = (string) $characteristicXML->name;
            $characteristic->save();

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
    public function getName0()
    {
        return $this->hasOne(Characteristics::className(), ['name' => 'name']);
    }
}
