<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;

/**
 * This is the model class for table "characteristics".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CharacteristicsNames $name0
 * @property CharacteristicsValuesAssignment $characteristicsValuesAssignment
 * @property ProductsCharacteristicsAssignment[] $productsCharacteristicsAssignments
 * @property Products[] $products
 */
class CharacteristicsFtp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    public static function getFiles()
    {
     $host = "localhost";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login("ftp", "ftp");

     $remote_file = "characteristics.xml";     
     $local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."characteristics.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parse($local_file);
     
    }


    public static function parse($local_file)
    {
        //сначала удалим весь каталог
        CharacteristicsFtp::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);
            
            
            foreach ($xml->characteristic as $characteristicXML) {         
                self::SaveCharacteristic($characteristicXML);
            }       
        
        } 
        else {
            exit('Не удалось открыть файл characteristics.xml.');
        }
    }

  
     public static function SaveCharacteristic($characteristicXML)
    {
        
        $characteristic = CharacteristicsFtp::findOne( (int) $characteristicXML->id);
        

        if ( is_null($characteristic)) {
            // создаем запись 
            $characteristic = new CharacteristicsFtp;
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
        return $this->hasOne(CharacteristicsNames::className(), ['name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicsValuesAssignment()
    {
        return $this->hasOne(CharacteristicsValuesAssignment::className(), ['characteristics_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsCharacteristicsAssignments()
    {
        return $this->hasMany(ProductsCharacteristicsAssignment::className(), ['characteristics_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['id' => 'products_id'])->viaTable('products_characteristics_assignment', ['characteristics_id' => 'id']);
    }
}
