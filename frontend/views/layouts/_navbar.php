<?php 

use yii\helpers\Html;

 ?>

<!-- <ul id="w3" class="navbar-nav navbar-left nav">
<li class="dropdown open"><a class="dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="true">Dropdown <b class="caret"></b></a>

<ul id="w4" class="dropdown-menu" style="width:260px;"><li><a href="#" tabindex="-1" class="">Level 1 - Dropdown A</a></li>

<li class="divider"></li>
<li class="dropdown-header">Dropdown Header</li>
<li><a href="#" tabindex="-1" class="">Level 1 - Dropdown B</a></li>
</ul>
</li>


</ul> -->

<ul class="navbar-nav navbar-left nav">

<li class="dropdown <?php echo (Yii::$app->controller->id == "site") ? "open" : ""; ?>"><a class="dropdown-toggle" href="#" data-toggle="<?php echo (Yii::$app->controller->id == "site") ? "" : "dropdown"; ?>" aria-expanded="true">Каталог 
<?php if (Yii::$app->controller->id !== "site"): ?>
<b class="caret"></b>	
<?php endif ?>

</a>

<ul class="dropdown-menu menu" role="menu" 
style="padding-top:20px;width:260px;border-top: 1px solid #F1F2F2!important;top:102%;box-shadow:none;-webkit-box-shadow:none;border:none;border-radius: 0px;">

<?php foreach ($nodes as $catalog): ?>

<li data-submenu-id="catalog_<?php echo $catalog->id; ?>">
<?php echo Html::a($catalog->name, ['catalogs/view','catalog_id'=>$catalog->id]);?>
<div id="catalog_<?php echo $catalog->id; ?>" class="popover" style="border-radius:0px;min-width:850px;min-height: 465px; z-index:999;cursor:default;">

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<h4 style="margin-top: 15px;"><?php echo $catalog->name; ?></h4>
<hr style="margin-top:7px;margin-bottom:7px;">


<?= $this->render('_catalog',
[
'catalog'=>$catalog
]
) ?>


</div>



</div>
</li>
<?php endforeach; ?>


<!-- <li data-submenu-id="submenu-patas">
<a href="#">Patas</a>

<div id="submenu-patas" class="popover">
<h3 class="popover-title">Patas</h3>
<div class="popover-content"><img src="img/patas.png"></div>
</div>
</li> -->


</ul>


</li>

</ul>