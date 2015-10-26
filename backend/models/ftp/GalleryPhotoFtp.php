<?php

namespace backend\models\ftp;

use Yii;
use yii2mod\ftp\FtpClient;
use sapgv\yii2\galleryManager\GalleryImage;
/**
 * This is the model class for table "models".
 *
 * @property integer $id
 * @property string $name
 *
 * @property CharacteristicsmodelsAssignment[] $characteristicsmodelsAssignments
 */
class GalleryPhotoFtp extends GalleryImage
{
    

   

    public static function getFiles()
    {
     $host = "192.168.129.128";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login();

     $remote_file = Yii::getAlias('@ftpGoodsImg')."/images.xml";     
     $local_file = Yii::getAlias('@localGoodsImg').DIRECTORY_SEPARATOR."images.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parseModel($local_file);
     
    }

    public static function getImages()
    {
     $host = "192.168.129.128";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login();

     $files = $ftp->scanDirWin( Yii::getAlias('@ftpGoodsImg'));

     foreach ($files as $file) {

        $local_file = Yii::getAlias('@localGalleryImg').DIRECTORY_SEPARATOR.$file['name'];
        $remote_file = Yii::getAlias('@ftpGoodsImg').DIRECTORY_SEPARATOR.$file['name'];

        $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     }
     

     
    }

    public static function deleteImages () {
        $db = \Yii::$app->db;
        $db->createCommand()
            ->delete(
                'gallery_image'
            )->execute();
    }
    public static function parseModel($local_file)
    {
        //сначала удалим весь каталог
        GalleryPhotoFtp::deleteImages();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);

            foreach ($xml->image as $imageXML) {
                self::SaveModel($imageXML);
                }
        }
        else {
            exit('Не удалось открыть файл images.xml.');
        }
    }

  
     public static function SaveModel($imageXML)
    {
        
         $db = \Yii::$app->db;
         $db->createCommand()
             ->insert(
                 'gallery_image',
                 [
                     'id'=>(int) $imageXML->id,
                     'type' => 'products',
                     'ownerId' => $imageXML->product_id,
                     'name'=>$imageXML->name,
                     'main'=>$imageXML->main,
                 ]
             )->execute();

    }


    
}
