<?php
require_once "../vendor/autoload.php";

$h001 = new \SEfd\BlocoH\H001();
$h001->IND_MOV = 0;

$bloco = new \SEfd\BlocoH\BlocoH();
$bloco->addH001($h001);
$bloco->printTXT();

//Se quiser fazer o download comente o metodo print e descomente este aqui
//$bloco->saveTXT();