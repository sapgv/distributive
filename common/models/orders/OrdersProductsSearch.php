<?php
/**
 * Created by PhpStorm.
 * User: Гриша
 * Date: 04.11.2015
 * Time: 22:05
 */

namespace common\models\orders;

use Yii;
use yii\data\ActiveDataProvider;

class OrdersProductsSearch extends OrdersProducts {

    public function search($order_id) {
        $query = OrdersProducts::find()->where([ 'order_id' => $order_id ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}



