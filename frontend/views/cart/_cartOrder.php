<?php 
use yii\helpers\Html;
use yii\helpers\Url; 
use yii\bootstrap\Button;
use yii\widgets\ActiveForm;
?>

<?php 
	echo Html::beginTag('div',['class'=>'panel-basic panel-basic-default row','style'=>'//height:325px;']);

		// panel heading
		echo Html::tag(
			'div',
			'Офорление заказа',
			[
			'class'=>'panel-basic-heading',
			'style'=>'background-color:#fff;font-weight:bold;'
			]

			);
		// panel heading

		// panel body
		echo Html::beginTag(
				'div',
				[
				'class'=>'panel-body',
				// 'style'=>'height:187px;text-align:center;'
				]
				);
				
				//acive form

 	$form = ActiveForm::begin([
        // 'action' => ['/catalogs/view'],
        // 'method' => 'get',
        // 'enableAjaxValidation'=>true,
        'id' => 'filter_form',
        'options'=>['class' => 'form-horizontal', 'style'=>'margin-bottom:15px;'],
        
    ]); 
    


   		echo $form->field($order,'name',
   				[
   				'template'=>'{label}<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{input}</div>',
   				'labelOptions'=>['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label'],
   				'options'=>['class'=>'form-group'],
   				'inputOptions'=>['class'=>'form-control','placeholder'=>'Иванов Иван']
   				
   				]
   				
   				);

   		echo $form->field($order,'email',
   				[
   				'template'=>'{label}<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{input}</div>',
   				'labelOptions'=>['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label'],
   				'options'=>['class'=>'form-group'],
   				'inputOptions'=>['class'=>'form-control','placeholder'=>'ivanov@mail.ru']
   				
   				]
   				
   				);

   		 

   		

   		echo $form->field($order,'phone',
   				[
   				'template'=>'{label}<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{input}</div>',
   				'labelOptions'=>['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label'],
   				'options'=>['class'=>'form-group'],
   				'inputOptions'=>['class'=>'form-control','placeholder'=>'89123456789']
   				]
   				
   				);

   		echo HTML::Tag(
   			'div',
   			HTML::tag(
				'span',
					'Email и телефон не учавствует в рассылке спама.'
				),
   			[
   			'class'=>'col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2',
   			'style'=>'padding-left:7px;'
   			]
   			);

		

			
		echo HTML::tag('hr');

		echo $form->field($order,'comment',
   				[
   				'template'=>'{label}<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">{input}</div>',
   				'labelOptions'=>['class'=>'col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label'],
   				'options'=>['class'=>'form-group'],
   				'inputOptions'=>['class'=>'form-control','placeholder'=>'Дополнительные пожелания к заказу']
   				]
   				
   				)->textarea();

				

				

		echo Html::tag(
			'div',
			
			Html::tag(
				'div',
				Html::submitButton(
					'Оформить заказ',
					[
					'class' => 'btn btn-success',
					'style' => 'border-radius: 0px;'
					]   				
					),
				[
				'class'=>'col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xs-10 col-sm-10 col-md-10 col-lg-10'
				]
			),
			['class'=>'form-group']

		);

		
		ActiveForm::end();


		//acive form

		echo HTML::endTag('div');
		// panel body



	echo HTML::endTag('div');
 ?>
<div class="col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
	
</div>