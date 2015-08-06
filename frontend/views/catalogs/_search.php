<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

use common\models\products\Products;
use common\models\products\ProductsCatalogSearch;
use frontend\controllers\CookieController;
/* @var $this yii\web\View */
/* @var $model app\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['/catalogs/view','catalog_id'=>$catalog->catalog_id],
        'method' => 'get',
        'id' => 'filter_form',
        'options'=>['class' => 'form-inline', 'style'=>'margin-bottom:15px;'],
        // 'enableClientValidation' =>true,
    ]); ?>


   <div class="fordm-group">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:15px;margin-bottom:15px;">
            <?
            echo $form->field(
            $model,
            'price_min'
            )->input(
                'text',
                [
                'id'=>'price_min',
                'class'=>'hidden',
                'value'=>$model->price_min
                ]
                    )->label(false);

             echo $form->field(
            $model,
            'price_max'
            )->input(
                'text',
                [
                'id'=>'price_max',
                'class'=>'hidden',
                'value'=>$model->price_max
                ]
                    )->label(false);





                     ?>
            <?php 
             echo Html::label(
                'Цена',
                'slider',
                [
                'style'=>'margin-left:-15px;margin-right:20px;'
                ]
                 );
            echo Html::input(
                'text',
                'null',
                null,
                [
                'id'=>'slider',

                ]


                );

             ?>
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
    
    
    <?php 

    echo $form->field($model, 'count', 
        [
        'template'=>'{input}',
        ]
    )->radioList([
        'Все' => ProductsCatalogSearch::ALL,
        'В наличии' => ProductsCatalogSearch::AVAILABLE,
        'Под заказ' => ProductsCatalogSearch::NOT_AVAILABLE,
        
    ],
    [
        'id' => 'status',
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        
        'unselect' => null, // remove hidden field
        'item' => function ($index, $label, $name, $checked, $value) {
            
            if ($value == ProductsCatalogSearch::ALL) {
//                if ($_GET['ProductsCatalogSearch']['count']==ProductsCatalogSearch::ALL or !isset($_GET['ProductsCatalogSearch']['count'])) {
//                   $checked = true;
//                }
               
               return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">
               <div style="margin:6px 6px 0px 0px;float:left;border-radius: 50%;    width: 8px;height: 8px;background-color:#999999;"></div>
               ' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'popular-btn']) . $label . '</label>';
            }
            elseif ($value == ProductsCatalogSearch::AVAILABLE) {
//                $checked = $_GET['ProductsCatalogSearch']['count']==ProductsCatalogSearch::AVAILABLE;
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">
                <div style="margin:6px 6px 0px 0px;float:left;border-radius: 50%;   width: 8px;height: 8px;background-color:#5cb85c;"></div>
                ' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'popular-btn']) . $label . '</label>';
            }
            elseif ($value == ProductsCatalogSearch::NOT_AVAILABLE) {
//                $checked = $_GET['ProductsCatalogSearch']['count']==ProductsCatalogSearch::NOT_AVAILABLE;
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">
                <div style="margin:6px 6px 0px 0px;float:left;border-radius: 50%;   width: 8px;height: 8px;background-color:#f1c40f;"></div>
                ' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'popular-btn']) . $label . '</label>';
            }
            
            
        },
    ]
    )->label(false);

     ?>

     <div class="form-group pull-right">
        <?php 

     echo Html::radioList(
       'listView',
       'null',
       [
       'list'=>'<i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>',
       'panel'=>'<i class="glyphicon glyphicon-th" aria-hidden="true"></i>',
       ],
       [
       'id'=>'viewList',
       'class' => 'btn-group',
       'data-toggle' => 'buttons',

       'item' => function ($index, $label, $name, $checked, $value) {
               
        $viewList = CookieController::getViewList();
        if ($viewList == $value) {
            $active = true;
        }
        elseif (!isset($viewList) and $value == 'list') {
            $active = true;
        }
        else {
            $active = false;
        }
        return '<label class="btn btn-default' . ($active ? ' active' : '') . '">               
               ' .
                Html::radio($name, false, ['value' => $value]) . $label . '</label>';
       }
       ]

        );

       ?>  
    </div>
     


    <?php ActiveForm::end(); ?>

</div>

<?php 

// slider js
$jsSlider = <<<JS

var mySlider = $("#slider").slider(
        { 
            id: "slider12c",
            tooltip: "always",
            tooltip_split: true,
            min: $price_min,
            max: $price_max,
            range: true,
            value: [$price_min_val, $price_max_val]
        }
             )
    .on('change',function (event) {
        $('#price_min').val($('#slider').data('slider').getValue()[0]);
        $('#price_max').val($('#slider').data('slider').getValue()[1]);
    })
    ;    
JS;
 
$this->registerJs($jsSlider, \yii\web\View::POS_READY, 'jsSlider');
 ?>

<?php 
$viewListUrl = Url::toRoute('/cookie/set-view-list');
$jsViewList = <<<JS


$('#viewList').find('label').click(function(e) {
    e.preventDefault();

   console.log($(this).find('input').attr('value'));
    
    $.ajax({
    type     :'GET',
    cache    : false,
    async    : false,
    url  : '{$viewListUrl}',
    data: {viewList: $(this).find('input').attr('value')},
    success  : function(response) {
        
        $('#filter_form').submit();
    }
    });

    

});
JS;
 
$this->registerJs($jsViewList, \yii\web\View::POS_READY, 'ViewList');


      ?>

    <?php 

   $projectsUrl = Url::to('');
$js = <<<JS

/* form should not be submitted by button */
$('#filter_form').bind('submit', function(e) {
    // e.preventDefault();
    // e.stopPropagation();
});
 
/* bind clicks on the labels */
$('#status').find('label').click(function(e) {
    e.preventDefault();

    /* uncheck all buttons */
    $('.project-status-btn').prop('checked', false);
    /* and check radiobutton under the current label */
    $(this).find('input').prop('checked', true);
    inp = $(this).find('input');
    // alert(inp.val());
    this.form.submit();
    /* send request on the server */
    // $.get('{$projectsUrl}', { filter: $('input[name="ProjectFilterForm[status]"]:checked').val() }, function(res) {
    //     console.log(res);
    // });
});
JS;
 
$this->registerJs($js, \yii\web\View::POS_READY, 'projects-filter-form-script');

     ?>