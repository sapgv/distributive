<?php 

use yii\helpers\Html;
use common\models\catalogs\Catalogs;
use common\models\catalogs\CatalogsFtp;

 ?>

<?php 
$root = Catalogs::findOne(['name' => 'ROOT']);
$nodes = $root->children(1)
->all();
 ?>



<div class="panel-basic panel-basic-primary">
        <div class="panel-basic-heading">
                  <h3 class="panel-basic-title">Каталог</h3>
        </div>
        <div class="panel-basic-body" style="padding:0px;">
                  
            <ul class="dropdown-menuu menu" role="menu" 
            style="display:block!important;border-radius: 0px;">
            
            <?php foreach ($nodes as $catalog): ?>
            
            <li data-submenu-id="catalog_<?php echo $catalog->catalog_id; ?>">
            <?php echo Html::a($catalog->name, ['catalogs/view','catalog_id'=>$catalog->catalog_id]);?>
            <div id="catalog_<?php echo $catalog->catalog_id; ?>" class="popover" style="border-radius:0px;min-width:850px;min-height: 465px; z-index:9999;cursor:default;">
            
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
            
            
            
            
            
            </ul>


        </div>
</div>
      



