<?php

namespace app\modules\voting\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
 * @property int $time_voting
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

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'member_id'], 'required'],
            [['user_id', 'member_id', 'result_id', 'type_id', 'status_student_id', 'active'], 'integer'],
            [['time_voted'], 'date', 'message' => 'Дата'],
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
            'time_voted' => 'Time Voting',
        ];
    }

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

}
