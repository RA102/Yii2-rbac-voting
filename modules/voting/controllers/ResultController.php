<?php

namespace app\modules\voting\controllers;

use app\modules\voting\models\User;
use Faker\Provider\DateTime;
use phpDocumentor\Reflection\Types\Integer;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\JcTable;
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

        // Создание документа Word
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->getDefaultFontSize(14);
        $sectionStyle = [
            'orientation' => 'landscape',
        ];

        $section = $phpWord->addSection($sectionStyle);
        // Получение списка комиссии
        $object = new Result();
        $allNameUsersByRoleUser = ArrayHelper::getColumn($object->getUserIdsByRole('user'), 'username');

        $tableStyle = array(
        );

        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);

        // 1. Basic table

        $table = $section->addTable($tableStyle);
        $table->addRow(Converter::cmToTwip(1));
        $table->addCell(Converter::cmToTwip(15), array('borderSize' => 1, 'borderColor' => '000000'))->addText("ФИО", array('size' => 14), array('spaceBefore' => Converter::cmToTwip(0.2), 'align' => 'center'));
        $table->addCell(Converter::cmToTwip(5), array('borderSize' => 1, 'borderColor' => '000000'))->addText("Подпись", array('size' => 14), array('spaceBefore' => Converter::cmToTwip(.2), 'align' => 'center'));
        $table->addCell(Converter::cmToTwip(5), ['borderSize' => 1, 'borderColor' => '000000'])->addText("Примечание", array('size' => 14), array('spaceBefore' => Converter::cmToTwip(.2), 'align' => 'center'));

        for ($r = 0; $r < count($allNameUsersByRoleUser); $r++) {
            $table->addRow(Converter::cmToTwip(1));
            $table->addCell(null, ['borderSize' => 1, 'borderColor' => '000000'])->addText(htmlspecialchars($allNameUsersByRoleUser[$r]), array('size' => 14), ['spaceBefore' => Converter::cmToTwip(.2)]);
            $table->addCell(null, ['borderSize' => 1, 'borderColor' => '000000']);
            $table->addCell(null, ['borderSize' => 1, 'borderColor' => '000000']);
        }

        $date = date('d-m-Y', time());



        $section->addText('_______________ ', null, ['align' => 'right', 'spaceBefore' => Converter::cmToTwip(2)]);
        $section->addText($date, null, ['align' => 'right', 'spaceBefore' => Converter::cmToTwip(.3)]);

        // Создание документа
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        // cохраняеться в /web
        $objWriter->save('doc.docx');

        // вывод на экран
        // $objWriter->save("php://output");

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

    public function printListCommissions()
    {
        return ;
    }

}
