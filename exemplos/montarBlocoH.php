<?php
require_once "../vendor/autoload.php";


$sefd = new SEfd\Sefd();
$sefd->versaoLeiaute = '010';
$sefd->codigoFinalidade = 0;
$sefd->dataInicial = '01032016';
$sefd->dataFinal = '31032016';
$sefd->nomeEntidade = 'Empresa teste para a Efd';
$sefd->cnpjEntidade = '05556927000126';
$sefd->ieEntidade = '1140072550';
$sefd->cpfEntidade = '';
$sefd->ufEntidade = 'RS';
$sefd->codMunEntidade = '4317608';
$sefd->imEntidade = '';
$sefd->cepEntidade = '95500000';
$sefd->enderecoEntidade = 'Rua Central';
$sefd->bairroEntidade = 'Centro';
$sefd->suframaEntidade = '';

$sefd->nomeContabilista = 'Diogo Bemfica';
$sefd->cpfContabilista = '02282347005';
$sefd->crcContabilista = '145325';
$sefd->emailContabilista = 'diogo.fragabemfica@yahoo.com.br';
$sefd->codMunicipioContabilista = '4317608';

$sefd->indentificacaoPerfil = 'C';
$sefd->indicadorAtividade = 1;
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
$blocoH->indicadorPropriedade = 0;
$blocoH->tipoItem = '01';
$blocoH->descricaoItem = 'Produto 1';
$sefd->addBlocoH($blocoH);

$blocoH = new \SEfd\Writer\BlocoH();
$blocoH->codigoItem = '2';
$blocoH->unidade = 'UN';
$blocoH->unidadeDescricao = 'Unidade';
$blocoH->unidadeInventario = 'UN';
$blocoH->quantidade = 10.000;
$blocoH->valorUnitario = 9.900000;
$blocoH->valorItem = 99.90;
$blocoH->indicadorPropriedade = 0;
$blocoH->tipoItem = '01';
$blocoH->descricaoItem = 'Produto 2';
$sefd->addBlocoH($blocoH);

$blocoH = new \SEfd\Writer\BlocoH();
$blocoH->codigoItem = '3';
$blocoH->unidade = 'PC';
$blocoH->unidadeDescricao = 'Peca';
$blocoH->unidadeInventario = 'PC';
$blocoH->quantidade = 10.000;
$blocoH->valorUnitario = 9.900000;
$blocoH->valorItem = 99.90;
$blocoH->indicadorPropriedade = 0;
$blocoH->tipoItem = '01';
$blocoH->descricaoItem = 'Produto 3';
$sefd->addBlocoH($blocoH);



$sefd->printTxt();
//
//
//echo "<pre>";
//print_r($sefd);
//echo "</pre>";