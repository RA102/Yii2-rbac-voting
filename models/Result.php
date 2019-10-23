<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property int $id
 * @property int $user_id
 * @property int $member_id
 * @property int $result_id
 * @property int $type_id
 *
 * @property User $member
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
            [['user_id', 'member_id', 'result_id', 'type_id'], 'required'],
            [['user_id', 'member_id', 'result_id', 'type_id'], 'integer'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member_id' => 'id']],
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
}
