<?php

namespace app\modules\voting\models;

use Yii;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'member_id'], 'required'],
            [['user_id', 'member_id', 'result_id', 'type_id', 'status_student_id', 'active'], 'integer'],
            [['time_voting'], 'date'],
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
            'time_voting' => 'Time Voting',
        ];
    }
}
