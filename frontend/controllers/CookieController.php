<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ViewList;
use yii\web\Cookie;

class CookieController extends Controller {

    public static function getViewList() {

        return ViewList::getViewList();
    }

    public function actionSetViewList() {

        ViewList::setViewList(Yii::$app->request->get()['viewList']);
    }

}
