<?php

use yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonGroup;

use common\models\products\Products;
use common\models\products\ProductsPopularSearch;
use frontend\controllers\CookieController;
/* @var $this yii\web\View */
/* @var $model common\models\ProductsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'filter_form',
        'options'=>['class' => 'form-inline', 'style'=>'margin-bottom:15px;'],
        // 'enableClientValidation' =>true,
    ]); ?>

   
   


    <?php 

    echo $form->field($model, 'count', 
        [
        'template'=>'{input}',
        ]
    )->radioList([
        'Все' => ProductsPopularSearch::ALL,
        'В наличии' => ProductsPopularSearch::AVAILABLE,
        'Под заказ' => ProductsPopularSearch::NOT_AVAILABLE,
        
    ],
    [
        'id' => 'status',
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        
        'unselect' => null, // remove hidden field
        'item' => function ($index, $label, $name, $checked, $value) {
            
            if ($value == ProductsPopularSearch::ALL) {
//                if ($_GET['ProductsPopularSearch']['count']==ProductsPopularSearch::ALL or !isset($_GET['ProductsPopularSearch']['count'])) {
//                   $checked = true;
//                }
               
               return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">
               <div style="margin:6px 6px 0px 0px;float:left;border-radius: 50%;    width: 8px;height: 8px;background-color:#999999;"></div>
               ' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'popular-btn']) . $label . '</label>';
            }
            elseif ($value == ProductsPopularSearch::AVAILABLE) {
//                $checked = $_GET['ProductsPopularSearch']['count']==ProductsPopularSearch::AVAILABLE;
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">
                <div style="margin:6px 6px 0px 0px;float:left;border-radius: 50%;   width: 8px;height: 8px;background-color:#5cb85c;"></div>
                ' .
                Html::radio($name, $checked, ['value' => $value, 'class' => 'popular-btn']) . $label . '</label>';
            }
            elseif ($value == ProductsPopularSearch::NOT_AVAILABLE) {
//                $checked = $_GET['ProductsPopularSearch']['count']==ProductsPopularSearch::NOT_AVAILABLE;
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