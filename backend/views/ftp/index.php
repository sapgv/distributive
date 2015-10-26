<?php 
use yii\helpers\Html;


 ?>

<h3>Загрузка данных по фтп</h3>

<?= Html::a('Загрузить каталог', ['upload-catalogs'], ['class' => 'btn btn-success']) ?>
<?= Html::a('Загрузить товары', ['upload-products'], ['class' => 'btn btn-success']) ?>
<?//= Html::a('Загрузить значения характеристик', ['upload-characteristics'], ['class' => 'btn btn-success']) ?>
<?= Html::a('Загрузить картинки', ['upload-images'], ['class' => 'btn btn-success']) ?>
