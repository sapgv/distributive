<?php


use common\models\products\Products;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    //            NavBar::begin([
    //                'brandLabel' => 'My Company',
    //                'brandUrl' => Yii::$app->homeUrl,
    //                'options' => [
    //                    'class' => 'navbar-inverse navbar-fixed-top',
    //                ],
    //            ]);
    //            $menuItems = [
    //                ['label' => 'Home', 'url' => ['/site/index']],
    //                ['label' => 'About', 'url' => ['/site/about']],
    //                ['label' => 'Contact', 'url' => ['/site/contact']],
    //            ];
    //            if (Yii::$app->user->isGuest) {
    //                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    //                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    //            } else {
    //                $menuItems[] = [
    //                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
    //                    'url' => ['/site/logout'],
    //                    'linkOptions' => ['data-method' => 'post']
    //                ];
    //            }
    //            echo Nav::widget([
    //                'options' => ['class' => 'navbar-nav navbar-right'],
    //                'items' => $menuItems,
    //            ]);
    //            NavBar::end();
    ?>


    <div class="container">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel-basic panel-basic-default" style="padding:15px 15px 0px 15px;">


                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <?php
                        echo Html::a(
                            '<h3 style="margin:0px 0px 5px;letter-spacing: 2.2px;font-weight:bold;">ДИСТРИТБУТИВ</h3><p class="text-muted" style="font-size:13px;">магазин программного обеспечения</p>',
                            ['site/index'],
                            ['class' => 'logo']

                        );

                        ?>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <!-- <h3 class="text-muted"> <span class="glyphicon glyphicon-phone-alt" style="color:#34495e;"></span> +7 908 634 2685</h3> -->
                        <dl class="dl-horizontal">
                            <dt style="width:30px;"><span class="glyphicon glyphicon-phone-alt"
                                                          style="color:#34495e;"></span></dt>
                            <dd class="text-muted" style="margin-left:50px;">+7 908 634 2685</dd>
                            <dt style="width:30px;"><span class="glyphicon glyphicon-map-marker"
                                                          style="color:#34495e;"></span></dt>
                            <dd class="text-muted" style="margin-left:50px;">ул. Первомайская 82</dd>

                        </dl>

                    </div>

                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <dl>
                            <dt style="color:#34495e;"><span class="glyphicon glyphicon-time"></span> Время работы</dt>
                            <dd class="text-muted" style="margin-left:18px;">пн—пт: 09:00 — 18:00</dd>
                        </dl>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"
                         style="color:#5492BF;font-weight:bold;//margin-top: 15px;//margin-left: 90px;">
                        <a href="<?php echo Url::toRoute('/cart/index') ?>">
                            <div class="cartContent pull-right"
                                 style="font-size:20px;background-color: #F1F2F2;padding: 15px 20px 15px 20px;">
                                <?php echo Products::getCartContent(); ?>
                            </div>
                        </a>


                    </div>


                </div>


                <hr style="margin:15px 0px 0px;">

                <?php
                NavBar::begin(
                    [
                        // 'brandLabel' => 'SOFT',
                        // 'brandUrl' => Yii::$app->homeUrl,
                        'containerOptions' => ['style' => 'margin-left: -30px;margin-right: -30px;'],
                        'options'          => [
                            'class' => 'navbar',
                            // 'style' => 'margin-top: 30px;',
                        ],
                    ]
                );

                echo Nav::widget(
                    [
                        'options'      => ['class' => 'navbar-nav navbar-left'],
                        'encodeLabels' => false,
                        'items'        => [
                            ['label' => '<span>Главная</span>', 'url' => ['/site/index']],
                            ['label' => '<span>Доставка</span>', 'url' => ['/site/delivery']],
                            ['label' => '<span>Контакты</span>', 'url' => ['/site/contact']],
                        ],

                    ]
                );


                NavBar::end();
                ?>


            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <?= $this->render(
                '_cat',
                [
                    'catalog' => $catalog,
                ]
            ) ?>
        </div>
        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

            <?= Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>
            <?= Alert::widget() ?>

            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
