<?php

namespace app\modules\voting\controllers;

use app\modules\voting\models\User;
use Cassandra\Date;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
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

        // Создание документа

        $phpWord = new PhpWord();

        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->getDefaultFontSize(14);


//        $section = $phpWord->addSection($sectionStyle);

        // Получение списка комиссии

        $object = new Result();
        $allNameUsersByRoleUser = ArrayHelper::getColumn($object->getUserIdsByRole('user'), 'username');

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

        $tableStyle = array(
          'alignment' => JcTable::CENTER,
          'cellSpacing' => 50
        );

        $phpWord->addTableStyle(null, $tableStyle);



        $section = $phpWord->addSection($sectionStyle);
        $header = array('size' => 16, 'bold' => true, 'align' => 'both');

        // 1. Basic table
        $section->addText('Комиссия', $header);
        $table = $section->addTable();
        $table->addRow();
        $table->addCell(Converter::pixelToTwip(400), ['valign' => 'both', 'borderSize' => 1, 'borderColor' => '000000', ])->addText("ФИО", ['size' => 16, 'bold' => true, 'valign' => 'both']);
        $table->addCell(Converter::pixelToTwip(300), ['valign' => 'center', 'borderSize' => 1, 'borderColor' => '000000'])->addText("Подпись");
        $table->addCell(Converter::pixelToTwip(200), ['valign' => 'center', 'borderSize' => 1, 'borderColor' => '000000'])->addText("Примечание");

        for ($r = 0; $r < count($allNameUsersByRoleUser); $r++) {
            $table->addRow();
            $table->addCell(1750, ['valign' => 'center', 'borderSize' => 1, 'borderColor' => '000000'])->addText("$allNameUsersByRoleUser[$r]");
            $table->addCell(1750, ['valign' => 'center', 'borderSize' => 1, 'borderColor' => '000000']);
            $table->addCell(1750, ['valign' => 'center', 'borderSize' => 1, 'borderColor' => '000000']);
        }



//        $temp = User::findByUsername('admin');
//        $date =  Yii::$app->formatter->asDatetime($temp->updated_at, 'd-m-Y H:m'); -> формат Дата/Время
//        echo "<pre>";
//        var_dump($allNameUsersByRoleUser);


//        $fontStyle = array('name' => 'Arial', 'size' => 36, 'color' => 075776, 'bold' => TRUE, 'italic' => TRUE);
//        $parStyle = array('align' => 'right', 'spaceBefore' => 10);
//
//        foreach ($allNameUsersByRoleUser as $item) {
//            //$text = $item;
//            $section->addText(htmlspecialchars($item), $fontStyle, $parStyle);
//        }


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
}
