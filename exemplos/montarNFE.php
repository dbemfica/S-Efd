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

$sefd->indentificacaoPerfil = 'A';
$sefd->indicadorAtividade = 1;

$blocoC = new \SEfd\Writer\BlocoC();
$blocoC->indicadorEmitente = 1;
$blocoC->indicadorOperacao = 1;
$blocoC->codigoModelo = '55';
$blocoC->codigoSituacao = '02';
//$blocoC->serie = '1123';
$blocoC->numeroDocumento = '1123';
$blocoC->chaveNFE = '43160392084706000105550010000915641442199707';
//$blocoC->dataEntradaSaida = '22032016';
//$blocoC->valorDesconto = 0;
//$blocoC->valorAbatimentoNaoTributado = 0;
//$blocoC->valorMercadoria = 10.90;

$sefd->addBlocoC($blocoC);
$sefd->printTxt();