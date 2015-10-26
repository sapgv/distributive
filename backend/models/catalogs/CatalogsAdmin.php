<?php

namespace backend\models\catalogs;

use Yii;
use common\models\catalogs\Catalogs;

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
class CatalogsAdmin extends Catalogs {
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
        [ [ 'id_parent', 'name', 'description' ], 'required' ],
        [ [ 'id_parent', 'expanded', 'root', 'lft', 'rgt', 'level' ], 'integer' ],
        [ [ 'name' ], 'string', 'max' => 255 ]
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
        'catalog_id' => 'Код',
        'id_parent' => 'Родитель',
        'name' => 'Наименование',
        'description'=>'Описание',
        'expanded' => 'Expanded',
        'root' => 'Root',
        'lft' => 'Lft',
        'rgt' => 'Rgt',
        'level' => 'Level',
    ];
  }

}
