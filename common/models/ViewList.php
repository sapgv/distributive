<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\Controller;
use yii\web\Cookie;

class ViewList extends Model
{
    
    public static function getViewList()
    {
      
         $cookielist = Yii::$app->getRequest()->getCookies()->getValue('viewList');
         if (!isset($cookielist)) {
         
         $cookie = new Cookie([
         'name' => 'viewList',
         'value' => 'list',
         'expire' => time() + 86400 * 365,
         // 'domain' => '.example.com' // <<<=== HERE
         ]);
         Yii::$app->getResponse()->getCookies()->add($cookie);
         
         }
         
         return $cookielist;
    }
    public static function setViewList($value)
    {
        $cookie = new Cookie([
        'name' => 'viewList',
        'value' => $value,
        'expire' => time() + 86400 * 365,
        // 'domain' => '.example.com' // <<<=== HERE
        ]);
        Yii::$app->getResponse()->getCookies()->add($cookie);
    }

    
   
    
}
