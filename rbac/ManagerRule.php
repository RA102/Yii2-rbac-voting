<?php

namespace app\rbac;

use yii\rbac\Item;
use yii\rbac\Rule;


/**
 * Class ManagerRule
 * @package app\rbac
 */
class ManagerRule extends Rule
{


    /**
     * @param int|string $user
     * @param Item $item
     * @param array $params
     * @return bool|void
     */
    public function execute($user, $item, $params)
    {
        if(!\Yii::$app->user->isGuest) {

        }
    }


}