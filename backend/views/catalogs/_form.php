<?php

use common\models\catalogs\Catalogs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\imageAttachment\ImageAttachmentWidget;
/* @var $this yii\web\View */
/* @var $model backend\models\catalogs\CatalogsAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="box">
    <div class="box-header with-border">

        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

        <div class="box-tools">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-sm btn-warning' : 'btn btn-sm btn-success']) ?>
        </div>

    </div>


    <div class="box-body">

        <div class="row">


            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <?
                echo ImageAttachmentWidget::widget(
                    [
                        'model' => $model,
                        'behaviorName' => 'coverBehavior',
                        'apiRoute' => '/catalogs/imgAttachApi',
                    ]
                )

                ?>
            </div>
            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

                <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

                <?
                $catalogList = ArrayHelper::map(Catalogs::find()
                ->where(['not',['catalog_id'=>$model->catalog_id]])
                ->andWhere(['not',['catalog_id'=>$model->leaves()->asArray()->all()]])
                ->all(), 'catalog_id', 'name');

                $key = array_search('ROOT',$catalogList);
                $catalogList[$key] = 'Корень';
                ?>

                <?= $form->field($model, 'id_parent')
                ->dropDownList($catalogList) ?>


                <?= $form->field($model, 'description')->textArea() ?>





            </div>
        </div>


    </div>


</div>
<?php ActiveForm::end(); ?>


