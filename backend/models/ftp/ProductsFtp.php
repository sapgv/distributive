<?php

namespace backend\models\ftp;

use Yii;
use common\models\products\Products;
use yii2mod\ftp\FtpClient;
use yii\helpers\Json;


class ProductsFtp extends Products
{
    
    // ftp function

    public static function getFiles()
    {
     $host = "192.168.129.128";
     $ftp = new FtpClient();
     $ftp->connect($host);
     $ftp->login();

     $remote_file = "products.xml";     
     //$local_file = Yii::getAlias('@app').DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR."products.xml";
     $local_file = Yii::getAlias('@localGoodsImg').DIRECTORY_SEPARATOR."products.xml";

     $ftp->get( $local_file,  $remote_file, $mode=FTP_ASCII);

     self::parseProducts($local_file);
     
    }


    public static function parseProducts($local_file)
    {
        //сначала удалим весь каталог
        Products::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);

//            print_r($xml);

            // $json = json_encode($xml);
            // $array = json_decode($json,TRUE);
            // print_r($array['product']);
            foreach ($xml->product as $productXML) {
                self::SaveProduct($productXML);
//                 print_r( (int) $productXML->product_id);

                }
        
        } 
        else {
            exit('Не удалось открыть файл products.xml.');
        }
    }

  
     public static function SaveProduct($productXML)
    {

        $product_id = (int) $productXML->product_id;
        $product = Products::findOne( $product_id);

        if ( is_null($product)) {

            // создаем запись
            $product = new Products;
            $product->product_id = (int) $productXML->product_id;
            $product->catalog_id = (int) $productXML->catalog_id;
            $product->gallery_id = (int) $productXML->gallery_id;
            $product->name = (string) $productXML->name;
            $product->precontent = (string) $productXML->precontent;
//            $product->content = (string) $productXML->content;
            $product->popular = (int) $productXML->popular;
            $product->price = (int) $productXML->price;
//            $product->count = (int) $productXML->count;

            $product->save(false);
        }
        else {
            
            // обновляем запись 

            $product->product_id = (int) $productXML->product_id;
            $product->catalog_id = (int) $productXML->catalog_id;
            $product->gallery_id = (int) $productXML->gallery_id;
            $product->name = (string) $productXML->name;
            $product->precontent = (string) $productXML->precontent;
//            $product->content = (string) $productXML->content;
            $product->popular = (int) $productXML->popular;
            $product->price = (int) $productXML->price;
//            $product->count = (int) $productXML->count;

            $product->save(false);

        }

    }

    
    
}
