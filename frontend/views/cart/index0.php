<?php 

use yii\helpers\Html;
use yii\bootstrap\Button;
use yii\helpers\Url; 
 ?>

<div class="row">
	
<div class="col-md-12">

<div class="panel panel-default">
	<div class="panel-body" id="cart_flash">
	
<span class="h4">Корзина заказов</span>
  <?php 
  if (empty($products)):
   ?>
	<div class="row">
    <div class="col-md-12">
      

      <?php if(Yii::app()->user->hasFlash('order')): ?>
  <?php 
  $params = Yii::app()->user->getFlash('order');

   ?>
   <p class="bg-success" style="padding:15px;margin-top:15px;">
   <?php echo "Уважаемый "?><strong><?php echo $params['name'].", " ?></strong><?php echo "заказ "?><strong>№<?php echo $params['id']; ?></strong><?php echo " успешно оформлен ! Копия заказа отправлена на почту " ?><strong><?php echo $params['email']?></strong>
   </p>

  <?php else: ?>

<p class="bg-warning" style="padding:15px;margin-top:15px;">Ваша корзина пуста</p>

<?php endif; ?>
    </div>
    
  </div>
		<?php endif; ?>
	</div>
  <?php 
  if (!empty($products)):
   ?>

 
	<table class="table table-bordered" id="cart_table">
        <thead>
          <tr>
            <th>№</th>
            <th colspan="2">Наименование</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
            
            <th class="text-center"><i class="fa fa-trash"></i></th>
          </tr>
        </thead>
        <tbody>
        <?php
         $i = 1;
         foreach ($products as $product):  

        //  	$cs=Yii::app()->getClientScript();
        //     $cs->registerScript('Yii.CTreeView#'.$i,"jQuery(\"#q{$i}\").TouchSpin({
        //         min: 1,
        //         verticalbuttons: true,
        //         verticalupclass: 'glyphicon glyphicon-plus',
        //         verticaldownclass: 'glyphicon glyphicon-minus'
        //     });

            

        //     jQuery(\"#q{$i}\").on('change', function () {


                

              
        //       // var product_id = this.product_id;
        //       // console.log(\"$product->id;\");
        //       jQuery.ajax(
        //         {
        //         'type':'POST',
        //         'data':{'product_id':\"$product->id;\",'quantity':this.value},
        //         // 'data': JSON.stringify({ 'product_id': this.product_id }),
        //         // 'data':{product_id : this.product_id},
        //         'dataType':'json',
        //         'success':function(data){
        //                 $('.cart_cost').html(data.cart_cost);
        //                 $('#cart_quantity').html(data.cart_quantity);
                        
        //                 $('#position_cost_$product->id').html(data.position_cost);

        // },
        //         'url':'/cart/changequantity/',
        //         'cache':false
        //       });
               
        //   });

        //     ");
            ?>
          <tr id="product_<?php echo $product->id;?>">
            <td class="text-center" style="padding-top:15px!important;"><?php echo $i; ?></td>
            <td><?php 
      $mainPhoto = $product->mainPhoto;
      echo Html::img($mainPhoto->url,['class'=>'img-responsive','style'=>'max-height:120px;']);
      ?></td>
            <td style="padding-top:15px!important;width:300px;"><?php echo Html::a($product->name, array('catalog/product','catalog_id'=>$product->id_catalog,'product_id'=>$product->id), array('optionName'=>optionValue)); ?></td>
            <td style="padding-top:15px!important;">
            <div class="row">
            	<div class="col-md-8 text-right"><?php echo number_format($product->price, 2, '.', ' '); ?></div>
            	<div class="col-md-4"><i class="fa fa-rub"></i></div>
            </div>
             </td>
            <td style="max-width:100px!important;">
            <?php 
            echo Html::tag('input', 
              array(
                'id'=>'q'.$i,
                'product_id'=>$product->id,
                'class'=>'',
                'type'=>'text',
                'value'=>$product->getQuantity()),
                false,
                true);
             ?>
            
            </td>
            <td class="text-danger" style="padding-top:15px!important;">
            	<div class="col-md-9 text-right" id="position_cost_<?php echo $product->id ?>"><?php echo number_format($product->getSumPrice(), 2, '.', ' '); ?></div>
            	<div class="col-md-1"><i class="fa fa-rub"></i></div>
            </td>
            <td>
              <?php 
              echo Html::ajaxLink('&times;',
                                    Yii::app()->createUrl('cart/remove/'),
                                    array(
                                      'type' => 'POST',
                                      'data'=>array('id'=>$product->id),
                                      'dataType'=>'json',
                                      'success'=>"function(data){
                                        // alert(data.kolvo);
                                        if (data.cart_quantity > 0) {
                                          $(\"#product_{$product->id}\").html('');

                                          $('.cart_cost').html(data.cart_cost);
                                          $('#cart_quantity').html(data.cart_quantity);
                                        }
                                        else {
                                          $(\"#product_{$product->id}\").html('');
                                          $('.cart_cost').html(data.cart_cost); 
                                          $('#cart_table').html('');
                                          $('#cart_order').html('');
                                          $('#cart_flash').append(\"<p class='bg-warning' style='padding:15px;margin-top:15px;'>Ваша корзина пуста</p>\");
                                          
                                         
                                          
                                        }
                                      }",
                                      ),
                                    array('class'=>'close')
                                    ); 
              ?>            
            </td>
             
          </tr>
          <?php
          $i = $i + 1;
          endforeach; ?>
          <tr>
            <td colspan="3"></td>
            <td class="h4 text-right">Итого</td>
            <td class="h4">
            <div class="col-md-12" id="cart_quantity"><?php echo Yii::app()->shoppingCart->getItemsCount(); ?></div>
            </td>
            
            
            
            <td class="h4 text-danger">
            	<div class="col-md-9 text-right cart_cost"><?php echo number_format(Yii::app()->shoppingCart->getCost(), 2, '.', ' '); ?></div>
            	<div class="col-md-1"><i class="fa fa-rub"></i></div>
            </td>
            <td>
            <?php 
              echo Html::ajaxLink('&times;',
                                    Yii::app()->createUrl('cart/clear/'),
                                    array(
                                      'type' => 'POST',
                                      'dataType'=>'json',
                                      'success'=>"function(data){
                                            
                                          $('.cart_cost').html(data.cart_cost);                      
                                          $('#cart_table').html('');
                                          $('#cart_order').html('');
                                          $('#cart_flash').append(\"<p class='bg-warning' style='padding:15px;margin-top:15px;'>Ваша корзина пуста</p>\");
                                          
                                        
                                      }",
                                      ),
                                    array('class'=>'close')
                                    ); 
              ?></td>
             
          </tr>
        </tbody>
      </table>
	   <?php 
     endif; ?>
	</div>

</div>


</div>

<?php 
  if (!empty($products)):
   ?>
<?php 
  $this->renderPartial('_order',array(
  'model'=>$model,
  ));

 ?>
<?php 
     endif; ?>
