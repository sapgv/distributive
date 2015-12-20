<?php

namespace common\models\catalogs;

use Imagine\Image\ImageInterface;
use Yii;
use common\models\products\Products;
use creocoder\nestedsets\NestedSetsBehavior;
use sapgv\yii2\imageAttachment\ImageAttachmentBehavior;
use yii\db\ActiveRecord;

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
class Catalogs extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'catalogs';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // [['id_parent', 'name', 'expanded', 'root', 'lft', 'rgt', 'level'], 'required'],
            // [['id_parent', 'expanded', 'root', 'lft', 'rgt', 'level'], 'integer'],
            // [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'catalog_id' => 'Код',
            'id_parent'  => 'Код родителя',
            'name'       => 'Наименование',
            'expanded'   => 'Expanded',
            'root'       => 'Root',
            'lft'        => 'Lft',
            'rgt'        => 'Rgt',
            'level'      => 'Level',
        ];
    }

    public function behaviors() {
        return [
            [
                'class'          => NestedSetsBehavior::className(),
                'depthAttribute' => 'level',
            ],
            // 'image' => [
            //     'class' => 'rico\yii2images\behaviors\ImageBehave',
            // ],
            'coverBehavior' => [
                'class'         => ImageAttachmentBehavior::className(),
                // type name for model
                'type'          => 'catalogs',
                // image dimmentions for preview in widget
                'previewHeight' => 200,
                'previewWidth'  => 200,
                // extension for images saving
                'extension'     => 'png',
                // path to location where to save images
                'directory'     => Yii::getAlias('@imagesroot') . '/catalogs/gallery',
                'url'           => Yii::getAlias('@images') . '/catalogs/gallery',
                // additional image versions
                'versions'      => [

                    'original' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->resize($img->getSize());
                    },

                ],
            ],
        ];
    }

    public function getProducts() {
        return $this->hasMany(Products::className(), [ 'catalog_id' => 'catalog_id' ]);
    }


}
