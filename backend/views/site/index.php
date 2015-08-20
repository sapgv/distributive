<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';
?>

<div class="row">

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?=$countOrders?></h3>
                <p>Заказы</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
<!--            <a href="#" class="small-box-footer">Перейти <i class="fa fa-arrow-circle-right"></i></a>-->
            <?=Html::a('Перейти <i class="fa fa-arrow-circle-right"></i>',Url::toRoute('/orders/index'),['class'=>'small-box-footer'])?>
        </div>
    </div>

</div>