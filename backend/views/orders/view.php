<?php 
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Html;
use common\models\products\Products;
$this->title = 'Заказ №'. $model->order_id;
$this->params['breadcrumbs'][] = $this->title;
 ?>


<div class="box">
	<div class="box-header with-border">

		<h3 class="box-title"><?= Html::encode($this->title) ?> от <?php echo Yii::$app->formatter->asDate($model->create_time); ?></h3>

		<div class="box-tools">
			<?= Html::a('Редактировать',\yii\helpers\Url::toRoute(['update', 'order_id' => $model->order_id]),['class' => 'btn btn-sm btn-warning'])?>
			<?= Html::a('Сохранить на FTP',\yii\helpers\Url::toRoute(['save-order-ftp', 'order_id' => $model->order_id]),['class' => 'btn btn-sm btn-default'])?>
		</div>

	</div>
<?
//print_r(\DateTime::createFromFormat('Y-m-d H:i:s', $model->create_time)->format('d.m.Y'));

//print_r( date("d.m.Y",  strtotime($model->create_time)) );

//echo print_r(strtotime($model->create_time));
//echo print_r($model);

//echo new yii\db\Expression('NOW()');
?>


	<div class="box-body">
		<?
		echo DetailView::widget([
			'model' => $model,
			'attributes' => [
				// 'id',
				// 'create_time:date', // creation date formatted as datetime
				[
					'label' => 'Имя',
					'value' => $model->name,
				],
				'phone',
				'email',
				[
					'label' => 'Статус',
					'format'=>'raw',
					'value' => Html::label($model->getStatusText(),null,['class'=>$model->getStatusClass()]),
				],
				'address',
				'summa',




			],
		]);

		echo Html::tag('h3','Товары',['class'=>'page-header']);

		echo GridView::widget([
			'dataProvider' => $dataProvider,
			'tableOptions' => ['class'=>'table table-bordered table-hover'],
			'layout' => "{items}",
			'showFooter'=>true,
			'columns' => [

				[
					'label'=>'<i class="fa fa-picture-o"></i>',
					'encodeLabel'=>false,
					'format'=>'raw',
					'value'=>function ($model) {
						$product = Products::findOne($model->product_id);

						if ($product <> null) {
							$mainPhoto = $product->getMainPhoto();
							return Html::a(
								Html::img($mainPhoto->getUrl('original'), [ 'class' => 'img-responsive', 'style' => 'max-height:120px;' ]),
								[ 'products/view','product_id'=>$model->product_id],['style'=>'display:block;']);
						}
					},

				],
				[
					'label'=>'Наименование',
					'value'=>function ($model) {
						return $model->name;
					},
					'footer'=>'<strong class="pull-right">Итого</strong>',
				],
				// 'quantity',
				[
					'label'=>'Количество',
					'value'=>function ($model) {
						return $model->quantity;
					},
					'footer'=>Yii::$app->formatter->asInteger($total),
				],
				// 'price',
				[
					'label'=>'Цена',
					'enableSorting'=>false,
					'value'=>function ($model) {
						return $model->price;
					},
				],
				// 'summa',
				[
					'label'=>'Сумма',
					'value'=>function ($model) {
						return $model->summa;
					},
					'footer'=>$model->summa,
				]

			],
		]);
		?>

	</div>


</div>

 	





