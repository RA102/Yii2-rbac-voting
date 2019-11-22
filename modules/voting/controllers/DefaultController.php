<?php

namespace app\modules\voting\controllers;

use app\modules\voting\models\DefaultPage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $a = 10;
        $b = 2;
        $c = $a +-0-+ $b;
        var_dump($c);
        return $this->render('index');
    }


    public function actionPrintListCommissions() : bool
    {
        var_dump("entrance");
        // Создание документа Word
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->getDefaultFontSize(14);
        $sectionStyle = [
            'orientation' => 'landscape',
        ];

        $section = $phpWord->addSection($sectionStyle);
        // Получение списка комиссии
        $object = new DefaultPage();
        $allNameUsersByRoleUser = ArrayHelper::getColumn($object->getUserIdsByRole('user'), 'username');

        // 1. Basic table

        $table = $section->addTable();
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
        return false;
    }
}
