<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;

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
 * @property int $data
 */
class Member extends \yii\db\ActiveRecord
{

    /**
     * @var
     */
    static protected $result;


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
            [['active', 'status_student_id'], 'integer'],
//            [['data'], 'string'],
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


    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
//        $this->data = Yii::$app->formatter->asDate($this->data, 'php: d-m-Y');
    }


    public function getData()
    {
        return date('d-m-Y', $this->data);
    }

    public function setData($value)
    {
        $this->data = strtotime($value);
    }

    public static function setUser()
    {
        return User::find()->asArray()->all();

    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(StatusStudent::className(), ['id' => 'status_student_id']);
    }

    /**
     * ?  Для названия
     */
    public function getStatusName()
    {
        return $this->status->status;
    }

    public function getResult()
    {
        return Result::find()->where(['user_id'=>Yii::$app->user->id,'member_id'=>$this->id])->one();
    }

    public function getUserIdsByRole($role)
    {

        return (new Query())
            ->select('user_id')
            ->from('auth_assignment')
            ->where('auth_assignment.item_name=:role',[':role' => $role])
            ->all();
    }

    public function getMemberIdByActive()
    {
        return Member::find()->where(['active' => 2]);
    }

    public function getMember($userId, $memberId)
    {
        return Result::find()->where(['user_id' => $userId, 'memberId' => $memberId]);
    }


}
