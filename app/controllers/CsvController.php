<?php

namespace app\controllers;

use \League\Csv\Reader;
use \League\Csv\Statement;
use app\models\CsvModel;
use core\Controller;
use app\controllers\TelefonesController;
use ZipArchive;

//require_once '../vendor/autoload.php';

class CsvController extends Controller
{
    function uploadCsv()
    {
        $mensagem = '';
        $i = 0;
        if (!empty($_FILES['arquivo']['name'][0])) {
            foreach (glob(__DIR__ . '/../../anexos/csv/*.zip') as $file) {
                $nome = explode('/', $file);
                if ($nome[5] == $_FILES['arquivo']['name'][0]) {
                    $i = 1;
                }
            }
        }
        if (!empty($_FILES['arquivo']['name'][0])) {
            if ($i == 0) {
                $file_name = $_FILES['arquivo']['name'];
                $array = explode(".", $file_name[0]);
                $ext = $array[1];
                if ($ext == 'zip') {
                    $path = $_SERVER['DOCUMENT_ROOT'].'\\sgt\\anexos\\csv\\';
                    $location = $path . $file_name[0];
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'][0], $location)) {
                        $zip = new ZipArchive;
                        if ($zip->open($location)) {
                            $zip->extractTo($path);
                            $zip->close();
                        }
                        $mensagem = "Arquivo enviado.";
                        unset($_POST);
                        $this->openCsv();
                        TelefonesController::sincLinhas();
                    } else {
                        $mensagem = "error";
                    }
                } else {
                    $mensagem = "Formato não suportado.";
                }
            } else {
                $mensagem = "Arquivo já importado.";
            }
        } else {
            $mensagem = "";
        }
        $this->view('FormUpload', ['mensagem' => $mensagem]);
    }

    function openCsv()
    {
        foreach (glob(__DIR__ . '/../../anexos/csv/*.csv') as $file) {
            $pointer = fopen($file, 'r');
            $arquivo = explode('_', $file);
            list($a, $b, $c, $d, $e, $date) = explode('/', $file);
            $date = substr($date, 0, 6);
            $stream = $pointer;
            $csv = Reader::createFromStream($stream);
            $csv->setDelimiter(";");
            $csv->setHeaderOffset(0);
            $stmt = (new Statement());
            $registros = $stmt->process($csv);
            $import = new csvModel();
            if (!empty($arquivo[4])) {
                if ($arquivo[4] == "chamada.csv") {
                    $import->importCsvChamada($arquivo[2], $date, $registros);
                    unlink($file);
                }
            }
            if ($arquivo[2] == "resumo.csv") {
                $import->importCsvResumo($registros);
                unlink($file);
            }
            if (!empty($arquivo[3])) {
                if ($arquivo[3] == "linha.csv") {
                    $import->importCsvLinha($registros);
                    unlink($file);
                }
            }
        }
    }
}