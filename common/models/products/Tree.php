<?php 
namespace app\models\products;

use Yii;

class Tree extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tree';
    }    
}

 ?>