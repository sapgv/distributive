<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */


?>
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script type="text/javascript">

    ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
            center: [56.84536232,60.64396504,],
            zoom: 17,
            // Обратите внимание, что в API 2.1 по умолчанию карта создается с элементами управления.
            // Если вам не нужно их добавлять на карту, в ее параметрах передайте пустой массив в поле controls.
            controls: ['smallMapDefaultSet']
        });

        var myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            balloonContentBody: [
                '<address>',
                '<strong>ДИСТРИБУТИВ</strong>',
                '<br/>',
                '<i>магазин программного обеспечения</i>',
                '<br/>',
                'Адрес: ул. Первомайская, 82',
                '<br/>',
                // 'Подробнее: <a href="http://company.yandex.ru/">http://company.yandex.ru</a>',
                '</address>'
            ].join('')
        }, {
            preset: 'islands#blueDotIcon'
        });

        myMap.geoObjects.add(myPlacemark);
    });
    // alert('12');
</script>
<div class="panel-basic panel-basic-default ">

    <div class="panel-basic-heading" style="padding-bottom:0px;border:none;background-color:#fff;font-weight:bold">
        <h4>Контакты</h4>
        <hr style="margin:7px 0px 7px;">
    </div>


    <div class="panel-basic-body">

        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <address>
                    <strong>Адрес</strong><br>
                    г. Екатеринбург<br>
                    ул. Первомайская 82<br>
                </address>

                <address>
                    <strong>Телефон</strong><br>
                    +7 908 634 2685<br>
                </address>

                <address>
                    <strong>Адрес электронной почты</strong><br>
                    <a href="mailto:#">info@distributive.pro</a>
                </address>
            </div>

            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div id="map" style="min-height:300px;"></div>
            </div>
        </div>


        <hr style="margin:20px 0px 7px;">


        <div class="row">



            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h4>Задать вопрос</h4>

                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'contact-form',
                        'layout' => 'horizontal',
                        'fieldConfig' => [
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}",
                            // 'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-3',
                                'offset' => 'col-sm-offset-4',
                                'wrapper' => 'col-sm-9',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]
                ); ?>
                <?= $form->field($model, 'name',['inputOptions'=>['placeholder'=>'Иванов Иван']]) ?>
                <?= $form->field($model, 'email',['inputOptions'=>['placeholder'=>'ivanov@mail.ru']]) ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6,'placeholder'=>'Ваше сообщение']) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    'options'=>['class'=>'form-control','placeholder'=>'Введите проверочный код'],
                ]) ?>
                <div class="form-group">

                    <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-xs-9 col-sm-10 col-md-10 col-lg-10">


                        <?= Html::submitButton('Отправить',
                                               [
                                                   'class' => 'btn btn-primary',
                                                   'style' => 'border-radius:0px;',
                                                   'name' => 'contact-button'
                                               ]) ?>



                    </div>

                </div>
                <?php ActiveForm::end(); ?>

            </div>


        </div>
    </div>

</div>

<div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">

</div>