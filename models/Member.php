<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $name
 * @property string $faculty
 * @property string $department
 * @property string $specialty
 * @property string $theme
 * @property int $active
 * @property int $status_student_id
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'faculty', 'department', 'specialty', 'theme'], 'required'],
//            [['active', 'status_student_id'], 'integer'],
            [['data'], 'date', 'format' => 'php: Y-m-d'],
            [['name', 'faculty', 'department', 'specialty', 'theme'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'faculty' => 'Faculty',
            'department' => 'Department',
            'specialty' => 'Specialty',
            'theme' => 'Theme',
            'active' => 'Active',
            'status_student_id' => 'Status Student ID',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusStudent::className(), ['id' => 'status_student_id']);
    }
}
