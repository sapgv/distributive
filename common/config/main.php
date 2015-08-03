<?php

// an alias of a file path
Yii::setAlias('@imagesroot', '@frontend/web/images');

// an alias of a URL
Yii::setAlias('@images',  'http://distributive/images');

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
            'cartId' => 'my_application_cart',
        ],
    ],
    'name'       => 'Distributive',
];
