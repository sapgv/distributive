<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;

/**
 * This is the model class for table "products_characteristics_assignment".
 *
 * @property integer $products_id
 * @property integer $techchar_id
 *
 * @property Products $products
 */
class ProductsTechCharAssignmentFtp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_techchar_assignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['products_id', 'techchar_id'], 'required'],
            [['products_id', 'techchar_id'], 'integer']
        ];
    }

    public static function getFiles()
    {
     $host = "localhost";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login("ftp", "ftp");

     $remote_file = "products_techchar_assignment.xml";     
     $local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."products_techchar_assignment.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parse($local_file);
     
    }


    public static function parse($local_file)
    {
        //сначала удалим весь каталог
        ProductsTechCharAssignmentFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->products_techchar_assignment as $products_techchar_assignmentXML) {         
                self::SaveModel($products_techchar_assignmentXML);
            }       
        
        } 
        else {
            exit('Не удалось открыть файл products_techchar_assignment.xml.');
        }
    }

  
     public static function SaveModel($products_techchar_assignmentXML)
    {
        
        $characteristic = ProductsTechCharAssignmentFtp::find()
                        ->where(
                            [
                            'products_id'=>(int) $products_techchar_assignmentXML->products_id,
                            'techchar_id'=>(int) $products_techchar_assignmentXML->techchar_id
                            ]
                            )
                        ->One();
                        
        

        if ( is_null($characteristic)) {
            // создаем запись 
            $characteristic = new ProductsTechCharAssignmentFtp;
            $characteristic->products_id = (int) $products_techchar_assignmentXML->products_id;
            $characteristic->techchar_id = (int) $products_techchar_assignmentXML->techchar_id;
            $characteristic->save();
        }
        else {
            
            // обновляем запись 

            $characteristic->products_id = (int) $products_techchar_assignmentXML->products_id;
            $characteristic->techchar_id = (int) $products_techchar_assignmentXML->techchar_id;
            $characteristic->save();

        }

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'products_id' => 'Products ID',
            'techchar_id' => 'Techchar ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['id' => 'products_id']);
    }
}
