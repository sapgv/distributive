<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\products\Products;
use common\models\products\ProductsCartSearch;
use common\models\orders\Orders;

use yii\helpers\Json;
use yii\data\ActiveDataProvider;

class CartController extends Controller {

    public function actionIndex() {


        $products = Yii::$app->cart->getPositions();

        $searchModel = new ProductsCartSearch();
        $dataProvider = $searchModel->search($products);

        $order = new Orders;
        $order->scenario = 'newOrder';

        if ( Yii::$app->request->post() )
        {

            $order->load(Yii::$app->request->post());

            $summa = Yii::$app->cart->getCost();
            $order->summa = $summa;
            $order->status = Orders::STATUS_NEW;


            if ( $order->save() )
            {

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

    public function actionPut() {

        $id = $_POST['id'];

        $product = Products::findOne($id);

        Yii::$app->cart->put($product, 1);

        $arr = [
            'kolvo'       => Yii::$app->cart->getCount(),
            'summa'       => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent' => $product->getCartContent(),
        ];

        return Json::Encode($arr);
    }


    public function actionChangeQuantity($value = '') {

        $id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $product = Products::findOne($id);
        Yii::$app->cart->update($product, $quantity);

        $cart = $this->CartCost($product);

        echo Json::Encode($cart);

    }

    public function CartCost($product) {

        $cart = [
            'position_quantity' => Yii::$app->cart->getPositionById($product->id)->getQuantity(),
            'position_cost'     => number_format(Yii::$app->cart->getPositionById($product->id)->getCost(), 0, '.', ' '),
            'cart_cost'         => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cart_quantity'     => number_format(Yii::$app->cart->getCount(), 0, '.', ' '),
            'cartContent'       => Products::getCartContent(),
        ];

        return $cart;
    }

    public function actionRemove() {

        $id = $_POST['id'];

        $product = Products::findOne($id);
        Yii::$app->cart->remove($product);

        $arr = [
            'cart_quantity' => Yii::$app->cart->getCount(),
            'cart_cost'     => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent'   => Products::getCartContent(),
        ];
        echo Json::Encode($arr);

    }


    public function actionClear() {

        Yii::$app->cart->removeAll();

        $arr = [
            'cart_quantity' => Yii::$app->cart->getCount(),
            'cart_cost'     => number_format(Yii::$app->cart->getCost(), 0, '.', ' '),
            'cartContent'   => Products::getCartContent(),
        ];
        echo Json::Encode($arr);
    }


}

