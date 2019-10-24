<?php

namespace app\controllers;

use app\models\Result;
use app\rbac\ManagerRule;
use Yii;
use app\models\Member;
use app\models\MemberSearch;
use yii\helpers\VarDumper;
use yii\mail\BaseMailer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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
//        if ($this->_oldMailPath !== null) {
//            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
//        }
        return parent::afterAction($action, $result);
    }


    /**
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        //var_dump($_GET['type']);die;
//        if (isset($_GET['type'])) {
        if(Yii::$app->request->get('type')) {
            $model = Result::find()->where(['member_id' => Yii::$app->request->get('memberid')])->exists() ? Result::find()->where(['member_id' => Yii::$app->request->get('memberid')])->one() : new Result();
            $model->user_id = (int)Yii::$app->user->getId();
            $model->member_id = (int)Yii::$app->request->get('memberid');
            $model->result_id = (int)Yii::$app->request->get('type');
            $model->type_id = (int)Yii::$app->request->get('type');
            $model->save(false);
//            return $this->redirect(['index']);
        }


        if(Yii::$app->request->get('status')) {
            $model = Member::findOne(Yii::$app->request->get('memberid'));
            $model->status_student_id = (int)Yii::$app->request->get('status');
            $model->save();
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


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
