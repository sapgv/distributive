<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
// use dosamigos\datepicker\DateRangePicker;
// use dosamigos\datepicker\DatePicker;
// use dosamigos\datetimepicker\DateTimePicker;
// use kartik\datetime\DateTimePicker;
// use kartik\daterange\DateRangePicker;
// use kartik\widgets\ActiveForm;
// use brussens\datetimepicker\Widget as DateTimePicker;
use maddoger\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['/orders'],
        'method' => 'get',
        'id' => 'filter_form',
        'options'=>['class' => 'form-inline', 'style'=>'margin-bottom:15px;'],
        // 'enableClientValidation' =>true,
    ]); ?>

    <div class="form-group">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         


       <?php 
       // echo $form->field($model, 'create_time')->widget(DateTimePicker::className(),
//        echo DateTimePicker::widget(
//         [
//         'name'=>'date_from',
//         'value'=>Yii::$app->request->queryParams['date_from'],
//           'clientOptions'=>[
          
//               'locale'=>'ru',
//               'inline'=>false,
//               'showTodayButton'=>true,
//               'format'=>'DD.MM.YYYY HH:mm:ss',
//               'useCurrent'=>false,
//               'showClose'=>true,
//               'widgetPositioning'=>['horizontal'=>'left']
//           ],
//         ]
//         );
// echo Html::label('по');

// echo DateTimePicker::widget(
//         [
//         'name'=>'date_to',
//         'value'=>Yii::$app->request->queryParams['date_to'],
//           'clientOptions'=>[
          
//               'locale'=>'ru',
//               'inline'=>false,
//               'showTodayButton'=>true,
//               'format'=>'DD.MM.YYYY HH:mm:ss',
//               'useCurrent'=>false,
//               'showClose'=>true,
//               'widgetPositioning'=>['horizontal'=>'right']
//           ],
//         ]
//         );


             ?>

    
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php 
           echo DateTimePicker::widget(
          [
        'name'=>'date_from',
        'value'=>Yii::$app->request->queryParams['date_from'],
        'addonBefore'=>false,
          'clientOptions'=>[
          
              'locale'=>'ru',
              'inline'=>false,
              'showTodayButton'=>true,
              'format'=>'DD.MM.YYYY',
//              'originalFormat' => 'DD.MM.YYYY',
              'useCurrent'=>false,
              'showClose'=>true,
              'widgetPositioning'=>['horizontal'=>'right']
          ],
        ]
          );
echo Html::label('по',null,['style'=>'margin: 0px 15px 0px 15px;']);
        echo DateTimePicker::widget(
          [
        'name'=>'date_to',
        'value'=>Yii::$app->request->queryParams['date_to'],
        'addonBefore'=>false,
          'clientOptions'=>[
          
              'locale'=>'ru',
              'inline'=>false,
              'showTodayButton'=>true,
              'format'=>'DD.MM.YYYY',
              'useCurrent'=>false,
              'showClose'=>true,
              'widgetPositioning'=>['horizontal'=>'right']
          ],
        ]
          );
           ?>
        </div>
    </div>
   <div class="form-group">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
           
            

             <?php 
             echo Html::submitButton(
                'Показать',
                [
                'class'=>'btn btn-primary',
                'style'=>'margin-left:30px;border-radius:0px;'
                ]

                );
              ?>
             <!-- <input id="slider" type="text"/><br/> -->
        </div>
        
    </div>
    
    
    

     
     


    <?php ActiveForm::end(); ?>

</div>


    