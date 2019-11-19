<?php

namespace app\modules\voting\controllers;

use app\modules\voting\models\User;
use Cassandra\Date;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use Yii;
use app\modules\voting\models\Result;
use app\modules\voting\models\ResultSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResultController implements the CRUD actions for Result model.
 */
class ResultController extends Controller
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
     * Lists all Result models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $date = new \DateTime();
//        var_dump($date);

        // Создание документа
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->getDefaultFontSize(14);
        // Свойства
        $properties = $phpWord->getDocInfo();
        $properties->setCreated('Name');
        $properties->setCompany('Company');
        $properties->setTitle('Title');
        $properties->setCreated('30-12-2019');
        //
        $sectionStyle = array(
            'orientation' => 'landscape',
            'marginTop' => Converter::pixelToTwip(10),
            'marginLeft' => 600,
            'marginRight' => 600,
            'colsNum' => 1,
            'pageNumberingStart' => 1,
            'borderBottomSize' => 100,
            'borderBottomColor' => 'C0C0C0'
        );

        $section = $phpWord->addSection($sectionStyle);

        // Текст

        $object = new Result();
        $allNameUsersByRoleUser = ArrayHelper::getColumn($object->getUserIdsByRole('user'), 'username');

//        $temp = User::findByUsername('admin');
//        $date =  Yii::$app->formatter->asDatetime($temp->updated_at, 'd-m-Y H:m'); -> формат Дата/Время
//        echo "<pre>";
//        var_dump($allNameUsersByRoleUser);


        $fontStyle = array('name' => 'Arial', 'size' => 36, 'color' => 075776, 'bold' => TRUE, 'italic' => TRUE);
        $parStyle = array('align' => 'right', 'spaceBefore' => 10);

        foreach ($allNameUsersByRoleUser as $item) {
            //$text = $item;
            $section->addText(htmlspecialchars($item), $fontStyle, $parStyle);
        }


        // Создание документа
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('doc.docx');  // cохраняеться в /web

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Result model.
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
     * Creates a new Result model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Result();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Result model.
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
     * Deletes an existing Result model.
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
     * Finds the Result model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Result the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Result::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
