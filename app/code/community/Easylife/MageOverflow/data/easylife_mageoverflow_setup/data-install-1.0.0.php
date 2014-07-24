<?php
$users = array(
    'philwinkle' => array(
        'userid' => 336,
        'avatar' => 'https://www.gravatar.com/avatar/341518c6f0ba9e0bbb97a793cd9800c3?s=128&d=identicon&r=PG'
    ),
    'Marius' => array(
        'userid' => 146,
        'avatar' => 'https://www.gravatar.com/avatar/409b67b94a358c8b61ecd06aba6627e7?s=128&d=identicon&r=PG'
    )
);
foreach ($users as $code=>$settings) {
    $model = Mage::getModel('easylife_mageoverflow/overflowuser')->setData($settings)->save();
}
