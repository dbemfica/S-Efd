<?php
require_once "../vendor/autoload.php";


$sefd = new SEfd\Sefd();
$sefd->versaoLeiaute = '009';
$sefd->codigoFinalidade = 0;
$sefd->periodoInformacao = '022016';
$sefd->nomeEntidade = 'Empresa teste para a Efd';
$sefd->cnpjEntidade = '';
$sefd->cpfEntidade = '';
$sefd->ufEntidade = 'RS';
$sefd->ieEntidade = '';
$sefd->codMunEntidade = '';
$sefd->imEntidade = '';
$sefd->suframaEntidade = '';
$sefd->indentificacaoPerfil = 'A';
$sefd->indicadorAtividade = 1;
$sefd->indicadorMovimento = 0;
$sefd->motivoInventario = '01'; //SE FOR INFORMAR O BLOCO H

//BLOCO H
$blocoH = new \SEfd\Writer\BlocoH();
$blocoH->codigoItem = '1';
$blocoH->unidade = 'UN';
$blocoH->unidadeDescricao = 'Unidade';
$blocoH->unidadeInventario = 'UN';
$blocoH->quantidade = 10.000;
$blocoH->valorUnitario = 9.900000;
$blocoH->valorItem = 99.90;
$blocoH->indicadorPropriedade = 1;
$blocoH->tipoItem = '01';
$sefd->addBlocoH($blocoH);

$blocoH = new \SEfd\Writer\BlocoH();
$blocoH->codigoItem = '1';
$blocoH->unidade = 'UN';
$blocoH->unidadeDescricao = 'Unidade';
$blocoH->unidadeInventario = 'UN';
$blocoH->quantidade = 10.000;
$blocoH->valorUnitario = 9.900000;
$blocoH->valorItem = 99.90;
$blocoH->indicadorPropriedade = 1;
$blocoH->tipoItem = '01';
$sefd->addBlocoH($blocoH);


$sefd->printTxt();
//
//
//echo "<pre>";
//print_r($sefd);
//echo "</pre>";