<?php

namespace app\modules\voting\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "result".
 *
 * @property int $id
 * @property int $user_id
 * @property int $member_id
 * @property int $result_id
 * @property int $type_id
 * @property int $status_student_id
 * @property int $active
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'member_id'], 'required'],
            [['user_id', 'member_id', 'result_id', 'type_id', 'status_student_id', 'active'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'member_id' => 'Member ID',
            'result_id' => 'Result ID',
            'type_id' => 'Type ID',
            'status_student_id' => 'Status Student ID',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
    public function getStatusStudent()
    {
        return $this->hasOne(StatusStudent::className(), ['id' => 'status_student_id']);
    }

    public function getUserIdsByRole($role)
    {
        return (new Query())
            ->select('username')
            ->from('user')
            ->innerJoin('auth_assignment', 'auth_assignment.user_id = user.id')
            ->where('auth_assignment.item_name=:role',[':role' => $role])
            ->all();
    }

//    public function getNumberVotes()
//    {
//        return (new Query())
//            ->select(count())
//    }

}
