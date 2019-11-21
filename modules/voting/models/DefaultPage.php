<?php

namespace app\modules\voting\models;

use yii\base\Model;
use yii\db\Query;

class DefaultPage extends Model
{

    public function getUserIdsByRole($role)
    {
        return (new Query())
            ->select('username')
            ->from('user')
            ->innerJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where('auth_assignment.item_name=:role',[':role' => $role])
            ->all();
    }

}