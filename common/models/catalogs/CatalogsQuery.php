<?php 

namespace common\models\catalogs;

// use Yii;
use creocoder\nestedsets\NestedSetsQueryBehavior;

	class CatalogsQuery extends \yii\db\ActiveQuery
	{
	public function behaviors() {
	return [
	[
	'class' => NestedSetsQueryBehavior::className(),
	],
	];
	}
	}

 ?>