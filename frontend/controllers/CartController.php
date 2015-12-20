<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use common\models\products\Products;
use common\models\products\ProductsCartSearch;
use common\models\orders\Orders;
use yii\helpers\Json;

class CartController extends Controller {

    public function actionIndex() {

        $products = Yii::$app->cart->getPositions();

        $searchModel = new ProductsCartSearch();
        $dataProvider = $searchModel->search($products);

        $order = new Orders();
        $order->scenario = 'newOrder';

        if (Yii::$app->request->post()) {

            $order->load(Yii::$app->request->post());

            $summa = Yii::$app->cart->getCost();
            $order->summa = $summa;
            $order->status = Orders::STATUS_NEW;


            if ($order->save()) {

                Yii::$app->cart->removeAll();

                Yii::$app->session->setFlash(
                    'order',
                    [
                        'id'    => $order->order_id,
                        'email' => $order->email,
                        'name'  => $order->name,
                    ]
                );
                return Yii::$app->getResponse()->refresh();
            }
        }

        return $this->render(
            'index',
            [
                'products'     => $products,
                'dataProvider' => $dataProvider,
                'order'        => $order,
            ]
        );
    }

    //добавляем товар в корзину
    public function actionPut() {

        $id = $_POST[ 'id' ];

        $product = Products::findOne($id);

        Yii::$app->cart->put($product, 1);

        $arr = [
            'kolvo'       => Yii::$app->cart->getCount(),
            'summa'       => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent' => $this->getCartContent(),
        ];

        return Json::Encode($arr);
    }

    //изменим количество
    public function actionChangeQuantity() {

        $id = $_POST[ 'product_id' ];
        $quantity = $_POST[ 'quantity' ];

        $product = Products::findOne($id);
        Yii::$app->cart->update($product, $quantity);

        $cart = $this->CartCost($product);

        echo Json::Encode($cart);

    }

    //узнаем стоимость корзины
    public function CartCost($product) {

        $cart = [
            'position_quantity' => Yii::$app->cart->getPositionById($product->id)->getQuantity(),
            'position_cost'     => number_format(Yii::$app->cart->getPositionById($product->id)->getCost(), 0, '.', ' '),
            'cart_cost'         => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cart_quantity'     => number_format(Yii::$app->cart->getCount(), 0, '.', ' '),
            'cartContent'       => self::getCartContent(),
        ];

        return $cart;
    }

    //удалим товар из корзины
    public function actionRemove() {

        $id = $_POST[ 'id' ];

        $product = Products::findOne($id);
        Yii::$app->cart->remove($product);

        $arr = [
            'cart_quantity' => Yii::$app->cart->getCount(),
            'cart_cost'     => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent'   => self::getCartContent(),
        ];
        echo Json::Encode($arr);

    }

    //очистим корзину
    public function actionClear() {

        Yii::$app->cart->removeAll();

        $arr = [
            'cart_quantity' => Yii::$app->cart->getCount(),
            'cart_cost'     => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent'   => Products::getCartContent(),
        ];
        echo Json::Encode($arr);
    }

    //получим html представление для корзины
    public static function getCartContent() {
        if (\Yii::$app->cart->getCount() >= 100) {
            $cartBadge = "cart-100";
            $cartCost = "cart-cost-100";
        }
        elseif (\Yii::$app->cart->getCount() >= 10) {
            $cartBadge = "cart-10";
            $cartCost = "cart-cost-10";
        }
        else {
            $cartBadge = "cart-1";
            $cartCost = "cart-cost-1";
        }
        $cartContent = '';
        $cartContent .=
            (\Yii::$app->cart->getCount() > 0) ?
                Html::tag(
                    'span',
                    Html::tag(
                        'span', \Yii::$app->cart->getCount(), [ 'class' => 'badge badge-cart ' . $cartBadge ]),
                    [ 'class' => 'glyphicon glyphicon-shopping-cart',
                      'style' => 'color:#34495e;',
                    ]
                )
                .
                Html::tag(
                    'span',
                    number_format(\Yii::$app->cart->getCost(), 0, '.', ' '),
                    [ 'class' => $cartCost,
                      'style' => 'color:#34495e;',
                    ]
                )
                . " " .
                Html::tag(
                    'span',
                    null,
                    [
                        'class' => 'glyphicon glyphicon-ruble',
                        'style' => 'font-size: 18px;color:#34495e;',
                    ]
                )

                :

                Html::tag(
                    'span',

                    Html::tag(
                        'span', "<span style='font-weight: bold;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;'> КОРЗИНА</span>"),

                    [ 'class' => 'glyphicon glyphicon-shopping-cart',
                      'style' => 'color:#34495e;//margin-right:15px;',
                    ]
                );

        return $cartContent;
    }


}

