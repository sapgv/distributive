<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


?>

    <div class="panel-basic panel-basic-default ">
        
    <div class="panel-basic-heading" style="padding-bottom:0px;border:none;background-color:#fff;font-weight:bold">
    <h4>Доставка <span style="color:#d2322d">*</span></h4>
    <hr style="margin:7px 0px 7px;">
    </div>


    <div class="panel-basic-body" style="padding-top:0px;">

    <div class="row">


   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
       <ul class="list-unstyled">
       
       <li>
           <strong>1. Самовывоз</strong>
           <p>Товар можно забрать по адресу г. Екатеринбург ул. Первомайская 82.</p>
       </li>
       <li>
            <strong>2. Доставка курьером</strong>
           <p>Вы оформляете заказ и товар доставляется в удобное для вас время нашим курьером.</p>
           <p><span style="color:#d2322d">*</span> Стоимость доставки составялет <strong style="font-size: 15px;color:#d2322d;"><?php echo number_format(300,0,'.',' '); ?><i class="glyphicon glyphicon-ruble" style="font-size: 12px;" aria-hidden="true"></i></strong>. При оформлении заказа свыше <strong style="font-size: 15px;"><?php echo number_format(3000,0,'.',' '); ?><i class="glyphicon glyphicon-ruble" style="font-size: 12px;" aria-hidden="true"></i></strong> доставка <strong style="color:#65c178">БЕСПЛАТНА</strong></p>
          

       </li>
       
   </ul>
   </div>

    </div>


    <hr style="margin:20px 0px 7px;">


    <div class="row">

        
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4>Оплата</h4>  

            <ul class="list-unstyled">
       
       <li>
       <strong>1. Оплата наличными</strong>
       <p>Оплата производится в момент получения товара.</p>
       </li>
       <li>
       <strong>2. Безналичный расчет <span style="color:#d2322d">**</span></strong>
       <p>При оформлении заказа необходимо указание реквизитов юридического лица.</p>
       <p>После подтверждения заказа на ваш адрес электронной почти приходит счет на оплату.</p>
       <p>Доставка товара осуществляется после зачисления денег на расчетный счет.</p>
       <p><span style="color:#d2322d">**</span> Только для юридических лиц</p>
       </li>
       
   </ul>
        
        </div>

 
    </div>
    </div>

    </div>

<div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
    
</div>