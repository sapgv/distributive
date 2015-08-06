<?php 

   Yii::app()->clientScript->registerScriptFile(
        Yii::app()->request->baseUrl . '/scripts/js/delivery.js',
  CClientScript::POS_HEAD
  );

 ?>


<div class="row" id="cart_order">
  <div class="col-md-12">
    
    <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Оформление заказа</h3>
        </div>
        <div class="panel-body">

          <!-- <span class="h4">Заказать</span> -->
          <div class="clearfix"></div>
          <?php 
             $form = $this->beginWidget('CActiveForm', array(
            'id'=>'',
            'htmlOptions'=>array('class'=>'form-horizontal'),
            'enableClientValidation'=>true,
            'clientOptions'=>array(
              'validateOnSubmit'=>true,
            ),
          )); 
          ?>
          <?php echo CHtml::errorSummary($model,null,null,array('class'=>'alert alert-border alert-block alert-danger')); ?>
          <div class="form-group">
          
          <?php echo $form->label($model,'name',array('class'=>'col-md-2 control-label')); ?>
          <div class="col-md-10">
          <?php echo $form->textField($model,'name',array('class'=>'form-control','placeholder'=>'')); ?>
          </div>

          </div>

          <div class="form-group">
          
          <?php echo $form->label($model,'phone',array('class'=>'col-md-2 control-label')); ?>
          <div class="col-md-10">
          <?php echo $form->textField($model,'phone',array('class'=>'form-control','placeholder'=>'')); ?>
          </div>

          </div>

          <div class="form-group">
          
          <?php echo $form->label($model,'email',array('class'=>'col-md-2 control-label')); ?>
          <div class="col-md-10">
          <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'')); ?>
          </div>

          </div>

          <div class="form-group">

          <hr class="shop">
          <h4 class="col-md-2 col-md-offset-1">Доставка</h4>
          <div class="col-md-11 col-md-offset-1">
              <label class="radio-inline">
              <?php 
              echo $form->radioButton($model, 'delivery', array(
              'value'=>'Самовывоз',
              'uncheckValue'=>null,
              'checked'=>true,
              'id'=>'selfdelivery'
              ));
              ?><i class="fa fa-cube"></i> Самовывоз
              </label>
              <label class="radio-inline">
              <?php
              echo $form->radioButton($model, 'delivery', array(
              'value'=>'Доставка',
              'uncheckValue'=>null,
              'id'=>'companydelivery'
              ));
              
              
              ?><i class="fa fa-truck"></i> Доставка
              </label>
              <br>
             
          
            <!--  <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked><i class="fa fa-cube"></i> Самовывоз
             </label>
             <label class="radio-inline">
             <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"><i class="fa fa-truck"></i> Доставка
             </label> -->

          </div>
          
          </div>

          <div class="form-group">

          <div class="col-md-10 col-md-offset-2 selfdelivery hide" style="margin-top:10px;" >
          <p class="form-control-static bg-info" style="padding-left:7px;">Пункт самовывоза: г. Екатеринбург ул. Первомайская 82</p>
          </div>
          <div class="col-md-10 col-md-offset-2 companydelivery hide" style="margin-top:10px;" >
          <?php echo $form->textField($model,'address',array('class'=>'form-control','placeholder'=>'Адрес доставки')); ?>
          </div>

          
          </div>
          <div class="form-group">

          <hr class="shop">
          
          </div>
          <div class="form-group">
          
          <?php echo $form->label($model,'comment',array('class'=>'col-md-2 control-label')); ?>
          <div class="col-md-10">
          <?php echo $form->textArea($model,'comment',array('class'=>'form-control','placeholder'=>'Дополнительная информация')); ?>
          </div>

          </div>

          <div class="form-group">
          
          
          <div class="col-md-10 col-md-offset-2">
          <?php echo CHtml::submitButton('Оформить заказ',array('class'=>'btn btn-success')); ?>
          </div>

          </div>
          <?php $this->endWidget(); ?>
          
        </div>
    </div>
  </div>
</div>