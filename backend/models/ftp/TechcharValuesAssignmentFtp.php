<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;

/**
 * This is the model class for table "techchar_values_assignment".
 *
 * @property integer $techchar_id
 * @property integer $values_id
 *
 * @property Characteristics $techchar
 * @property Values $values
 */
class TechcharValuesAssignmentFtp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'techchar_values_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['techchar_id'], 'required'],
            [['techchar_id', 'values_id'], 'integer']
        ];
    }

    public static function getFiles()
    {
     $host = "localhost";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login("ftp", "ftp");

     $remote_file = "techchar_values_assignment.xml";     
     $local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."techchar_values_assignment.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parse($local_file);
     
    }


    public static function parse($local_file)
    {
        //сначала удалим весь каталог
        TechcharValuesAssignmentFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->techchar_values_assignment as $techchar_values_assignmentXML) {         
                self::SaveModel($techchar_values_assignmentXML);
            }       
        
        } 
        else {
            exit('Не удалось открыть файл techchar_values_assignment.xml.');
        }
    }

  
     public static function SaveModel($techchar_values_assignmentXML)
    {
        
        $model = TechcharValuesAssignmentFtp::find()
                        ->where(
                            [
                            'techchar_id'=>(int) $techchar_values_assignmentXML->techchar_id,
                            'values_id'=>(int) $techchar_values_assignmentXML->values_id
                            ]
                            )
                        ->One();
                        
        

        if ( is_null($model)) {
            // создаем запись 
            $model = new TechcharValuesAssignmentFtp;
            $model->techchar_id = (int) $techchar_values_assignmentXML->techchar_id;
            $model->values_id = (int) $techchar_values_assignmentXML->values_id;
            $model->save();
        }
        else {
            
            // обновляем запись 

            $model->techchar_id = (int) $techchar_values_assignmentXML->techchar_id;
            $model->values_id = (int) $techchar_values_assignmentXML->values_id;
            $model->save();

        }

    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'techchar_id' => 'Techchar ID',
            'values_id' => 'Values ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTechchar()
    {
        return $this->hasOne(Characteristics::className(), ['id' => 'techchar_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasOne(Values::className(), ['id' => 'values_id']);
    }
}
