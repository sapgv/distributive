<?php
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>


<!-- <div class="row"> -->

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-basic panel-basic-default">

    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
        <div style="min-height:300px;">

            <?php
            $fotorama = \metalguardian\fotorama\Fotorama::begin(
                [
                    'options'     => [
                        'allowfullscreen' => true,
                        'nav'             => 'thumbs',
                        'thumbmargin'     => 10,
                        'thumbfit'        => 'scaledown',
                        'fit'             => 'scaledown',
                        'width'           => '500',
                        'height'          => '350',
                        'class'           => 'img-responsive',
                        // 'margin-top'=>'20',
                        // 'ratio' => 1024/768,

                    ],
                    'spinner'     => [
                        'lines' => 20,
                    ],
                    'tagName'     => 'div',
                    'useHtmlData' => false,
                    'htmlOptions' => [
                        'class' => 'custom-class',
                        'id'    => 'custom-id',
                        'style' => 'margin-top:15px;',

                    ],
                ]
            );
            ?>

            <?php

            foreach ($model->getImages() as $photo) {
                echo Html::img($photo->getUrl('original'));
            }


            ?>

            <?php $fotorama->end(); ?>
        </div>


    </div>

    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="background:#F1F2F2;margin-top:15px;">
        <div>
            <h4><?php
                echo $model->name;
                ?></h4>
        </div>

        <div style="padding:15px;margin:0 -15px 0 -15px;background:#ddd">
            <!-- <h4><?php
            echo $model->price . " P";
            ?></h4> -->
            <span class="h3" style="color:#d2322d;"><?php echo number_format($model->price, 0, '.', ' '); ?><i
                    class="glyphicon glyphicon-ruble" style="font-size: 18px;" aria-hidden="true"></i></span>
        </div>

        <div style="padding:15px 0 15px 0;">
            <!-- <button type="button" class="btn btn-success">В Корзину</button> -->
            <?
            echo Html::Button(
                'Купить',
                [
                    'id'    => "put" . $model->id,
                    'class' => 'btn btn-success put',
                    'style' => 'border-radius: 0px;',
                ]

            );


            ?>
            <?php
            $url = Url::toRoute('/cart/put/');
            $jsCartPut = <<<JS

			$("#put$model->id").on('click',


				function() {

					$.ajax({
					type     :'POST',
					dataType :'json',
					cache    : false,
					async    : false,
					url  : '{$url}',
					data: {id: $model->id},
					success  : function(data) {
					
					// $(".cart").html(data.summa);
					$(".cartContent").html(data.cartContent);
					}
					});

				}
				);

			
  
JS;

            $this->registerJs($jsCartPut, \yii\web\View::POS_READY, $model->id);
            ?>


        </div>

    </div>

    <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-top:15px;">
        <ul id="tabs" class="nav-shop nav-shop-tabs" data-tabs="tabs">
            <li class="active"><a href="#decription" data-toggle="tab" class="text-muted">Описание</a></li>
            <li><a href="#details" data-toggle="tab" class="text-muted">Характеристики</a></li>


        </ul>
        <div id="my-tab-content" class="tab-content">
            <div class="tab-pane active" id="decription" style="padding-top:30px;min-height:300px;">

                <p class="text-muted"><?php echo $model->precontent; ?></p>


            </div>
            <div class="tab-pane" id="details" style="padding-top:30px;min-height:300px;">

                <?


                //				print_r($dataProvider);

                echo GridView::widget([
                    'dataProvider' => $model->properties,
                    'layout'       => "{items}",
                    'columns'      => [


                        [
                            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                            'label' => 'Характеристика',
                            'value' => function ($data) {
                                return $data[ 'property_name' ]; // $data['name'] for array data, e.g. using SqlDataProvider.
                            },
                        ],

                        [
                            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                            'label' => 'Значение',
                            'value' => function ($data) {
                                return $data[ 'value_name' ]; // $data['name'] for array data, e.g. using SqlDataProvider.
                            },
                        ],

                    ],

                ]);
                ?>

            </div>


        </div>
    </div>


</div>

<!-- </div> -->