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
$sefd->printTxt();
//
//
//echo "<pre>";
//print_r($sefd);
//echo "</pre>";