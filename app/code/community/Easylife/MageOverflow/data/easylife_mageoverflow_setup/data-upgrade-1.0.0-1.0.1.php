<?php
$users = array(
    'cristi' => array(
        'userid' => 16755,
        'avatar' => 'https://www.gravatar.com/avatar/8c1f18f1e4975261be9444357ea0aaf8?s=128&d=identicon&r=PG'
    )
);
foreach ($users as $code=>$settings) {
    $model = Mage::getModel('easylife_mageoverflow/overflowuser')->setData($settings)->save();
}

$update = array(
    '146' => 'http://i.stack.imgur.com/ylEg4.png?s=128&g=1',
);
foreach ($update as $id=>$avatar) {
    $user = Mage::getModel('easylife_mageoverflow/overflowuser')->load($id, 'userid');
    if ($user->getId()) {
        $user->setAvatar($avatar);
        $user->save();
    }
}
