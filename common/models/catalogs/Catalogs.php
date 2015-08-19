<?php

namespace common\models\catalogs;

use Yii;
use common\models\products\Products;
use creocoder\nestedsets\NestedSetsBehavior;
use \yii2mod\ftp\FtpClient;
use zxbodya\yii2\imageAttachment\ImageAttachmentBehavior;
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
class Catalogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'catalogs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id_parent', 'name', 'expanded', 'root', 'lft', 'rgt', 'level'], 'required'],
            // [['id_parent', 'expanded', 'root', 'lft', 'rgt', 'level'], 'integer'],
            // [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_parent' => 'Id Parent',
            'name' => 'Name',
            'expanded' => 'Expanded',
            'root' => 'Root',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
        ];
    }

     public function behaviors()
    {
        return [
            [
                'class' => NestedSetsBehavior::className(),
                'depthAttribute' => 'level',
            ],
            // 'image' => [
            //     'class' => 'rico\yii2images\behaviors\ImageBehave',
            // ],
            'coverBehavior' => [
            'class' => ImageAttachmentBehavior::className(),
            // type name for model
            'type' => 'catalogs',
            // image dimmentions for preview in widget
            'previewHeight' => 200,
            'previewWidth' => 440,
            // extension for images saving
            'extension' => 'png',
            // path to location where to save images
            'directory' => Yii::getAlias('@webroot') . '/images',
            'url' => Yii::getAlias('@web') . '/images',
            // additional image versions
            'versions' => [

                'original' => function ($img) {
                    /** @var ImageInterface $img */
                    return $img
                        ->copy()
                        ->resize($img->getSize());
                },

                // 'catalog' => function ($img) {
                //     /** @var ImageInterface $img */

                //     return $img
                //         ->copy();
                //         // ->resize($img->getSize()->widen(200));
                // },

                // 'small' => function ($img) {
                //     /** @var ImageInterface $img */
                //     return $img
                //         ->copy()
                //         ->resize($img->getSize()->widen(200));
                // },
                // 'medium' => function ($img) {
                //     /** @var ImageInterface $img */
                //     $dstSize = $img->getSize();
                //     $maxWidth = 800;
                //     if ($dstSize->getWidth() > $maxWidth) {
                //         $dstSize = $dstSize->widen($maxWidth);
                //     }
                //     return $img
                //         ->copy()
                //         ->resize($dstSize);
                // },
            ]
        ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new CatalogsQuery(get_called_class());
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['catalog_id' => 'catalog_id']);
    }




}
