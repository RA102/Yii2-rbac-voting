<?php

namespace app\modules\voting\controllers;

use app\modules\voting\models\Result;
use app\modules\voting\models\User;
use app\modules\voting\models\Vote;
use http\Header;
use Yii;
use app\modules\voting\models\Member;
use app\modules\voting\models\MemberSearch;
use yii\debug\models\timeline\Search;
use yii\helpers\ArrayHelper;
use yii\rbac\BaseManager;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use mdm\admin\models\Assignment;


/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
//            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
//                /* @var $mailer BaseMailer */
//                $this->_oldMailPath = $mailer->getViewPath();
//                $mailer->setViewPath('@mdm/admin/mail');
//            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        return parent::afterAction($action, $result);
    }


    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userIp = Yii::$app->request->getUserIP();
        #var_dump(Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));

        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        // Кнопка голосования "ЗА" "ПРОТИВ" "ВОЗДЕРЖАЛСЯ"

        if(Yii::$app->request->get('type') ) {

            $memberId = Yii::$app->request->get('memberid');
            $userId = Yii::$app->user->getId();
            $model = Result::findOne([
                    'user_id' => $userId,
                    'member_id' => $memberId,
                ]);


            $model->type_id = (int)Yii::$app->request->get('type');
            $model->result_id = ((int)Yii::$app->request->get('type') == 3) ?
                $model->result_id + 1 :
                $model->result_id - 1;
            $model->status_student_id = ($model->result_id >= 0) ? 4 : 3;
            $model->active = 1;

            $model->save(false);
            $member = Member::findOne(Yii::$app->request->get('memberid'));
            $member->status_student_id = ($model->status_student_id) ? $model->status_student_id : 1;

            $member->save(false);

        }

        $model = new Member();
        $allUsersByRoleUser = $model->getUserIdsByRole('user');


        /*
         * Кнопка "Назначить"
         * User - Manager
         * ID - 2
         */

        if(Yii::$app->request->get('active')) {

            // получить id пользователя со Статусом 'Active' = 2 до изменения
            // ? может не пригодится

            $memberIsActive = Result::find()
                ->where(['active' => 2])
                ->all();
            // echo "<pre>"; print_r($memberIsActive);die;


            if (!empty($memberIsActive)) {
                foreach ($memberIsActive as $item) {
                    if($item->type_id == 0) {
                        $item->type_id = 2;
                    }
                    $item->active = 1;
                    $item->save(false);
                }
            }




            // Получить всех Member у кого Active = 2
            $model = Member::find()
                ->where(['active' => 2])
                ->all();

            // Установить всем Member из массива Active = 1
            foreach ($model as $item) {
                $item->active = 1;
                $item->save(false);
            }

            // Установить Member'у по id из кнопки Active = 2
            $model = Member::findOne(Yii::$app->request->get('memberid'));
            $model->status_student_id = (int)Yii::$app->request->get('active');
            $model->active = (int)Yii::$app->request->get('active');
            $model->save(false);

            /*  Создание полей по кол-ву членов комиссии
             *  в таблице Result
             */
            foreach ($allUsersByRoleUser as $item) {
                $createResult = new Result();
                $createResult->user_id = $item['user_id'];
                $createResult->member_id = (integer)Yii::$app->request->get('memberid');
                $createResult->save(false);
            }

            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionIndex2()
    {
//        $searchModel = new MemberSearch();
//        $activeUser = $searchModel->search(Yii::$app->request->queryParams);
        $activeUser = Member::find()->where(['active' => 2])->one();


        return $this->render('index2', [ 'activeUser' => $activeUser ]);
    }


    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Member();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}