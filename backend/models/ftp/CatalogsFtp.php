<?php

namespace backend\models\ftp;

use Yii;
use common\models\catalogs\Catalogs;
use yii2mod\ftp\FtpClient;


/**
 * This is the model class for table "catalogs".
 *
 * @property integer $id
 * @property integer $id_parent
 * @property string $name
 * @property integer $expanded
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 */
class CatalogsFtp extends Catalogs {

    // ftp function

    public static function getFiles() {
        $host = Yii::$app->params[ 'ftp' ][ 'host' ];
        $name = Yii::$app->params[ 'ftp' ][ 'name' ];
        $pass = Yii::$app->params[ 'ftp' ][ 'pass' ];
        $ftp = new FtpClient();
        $ftp->connect($host);

        $ftp->login($name, $pass);

        $remote_file = Yii::getAlias('@ftpXml') . DIRECTORY_SEPARATOR . "catalogs.xml";
        $local_file = Yii::getAlias('@localXml') . DIRECTORY_SEPARATOR . "catalogs.xml";

        $ftp->get($local_file, $remote_file, $mode = FTP_ASCII);

        self::parseCatalog($local_file);

    }

    public static function getImages() {

        $host = Yii::$app->params[ 'ftp' ][ 'host' ];
        $name = Yii::$app->params[ 'ftp' ][ 'name' ];
        $pass = Yii::$app->params[ 'ftp' ][ 'pass' ];
        $ftp = new FtpClient();
        $ftp->connect($host);

        $ftp->login($name, $pass);

        $files = $ftp->scanDir(Yii::getAlias('@ftpCatalogsImg'), false);

        foreach ($files as $file) {

            $local_file = Yii::getAlias('@localCatalogsImg') . DIRECTORY_SEPARATOR . $file[ 'name' ];
            $remote_file = Yii::getAlias('@ftpCatalogsImg') . DIRECTORY_SEPARATOR . $file[ 'name' ];

            $ftp->get($local_file, $remote_file, $mode = FTP_ASCII);

        }


    }

    public static function parseCatalog($local_file) {
        //сначала удалим весь каталог
        Catalogs::deleteAll();

        if (file_exists($local_file)) {
            $xml = simplexml_load_file($local_file);

            foreach ($xml as $catalogXML) {
                self::SaveCatalog($catalogXML);
            }

            // обновим индексы lft rgt level
            self::updateIndex();

        }
        else {
            exit('Не удалось открыть файл catalog.xml.');
        }
    }

    public static function SaveCatalog($catalogXML) {

        $catalog = Catalogs::findOne($catalogXML[ 'id' ]);

        if (is_null($catalog)) {
            // создаем запись каталога
            $catalog = new Catalogs;

            $catalog->detachBehaviors();

            $catalog->catalog_id = $catalogXML[ 'id' ];
            $catalog->id_parent = $catalogXML[ 'id_parent' ];
            $catalog->name = $catalogXML[ 'name' ];
            $catalog->description = $catalogXML[ 'description' ];
            $catalog->level = $catalogXML[ 'level' ];
            // $catalog->root = $catalogXML['root'];

            $catalog->save(false);
        }
        else {
            // обновляем запись каталога
            $catalog->detachBehaviors();

            $catalog->catalog_id = $catalogXML[ 'id' ];
            $catalog->id_parent = $catalogXML[ 'id_parent' ];
            $catalog->name = $catalogXML[ 'name' ];
            $catalog->description = $catalogXML[ 'description' ];
            $catalog->level = $catalogXML[ 'level' ];
            // $catalog->root = $catalogXML['root'];

            $catalog->save(false);
        }

    }

    public static function updateIndex() {

        mysql_connect('localhost', 'root', '') or die(mysql_error());
        mysql_select_db('distributive') or die(mysql_error());
        $s_query = "SELECT `catalog_id`,`id_parent` FROM `catalogs`";
        $i_result = mysql_query($s_query);
        $a_rows = [ ];
        while ($a_rows[] = mysql_fetch_assoc($i_result)) ;
        $a_link = [ ];
        foreach ($a_rows as $a_row) {
            $i_father_id = $a_row[ 'id_parent' ];
            $i_child_id = $a_row[ 'catalog_id' ];
            // if ($i_child_id =="") {
            // continue;
            // }
            // echo "__".$i_child_id."\n" ;

            if (!array_key_exists($i_father_id, $a_link)) {
                $a_link[ $i_father_id ] = [ ];
            }
            $a_link[ $i_father_id ][] = $i_child_id;
        }


        $o_tree_transformer = new Tree($a_link);
        $o_tree_transformer->traverse(0);
    }

}
