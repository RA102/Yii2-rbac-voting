<?php

namespace app\models;

use yii\base\Model;
use app\models\temp\User;

class Site extends Model
{
    public function getUser($id)
    {
        return User::findOne($id);
    }

}