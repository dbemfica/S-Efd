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

$blocoD = new \SEfd\Writer\BlocoD();
$blocoD->codigoModelo = '21';
$blocoD->codigoObrigacoesICMS = '0057';
$blocoD->codigoParticipante = '1';
$blocoD->numeroDocumento = 1;
$blocoD->indicadorOperacao = 1;
$blocoD->indicadorEmitente = 1;
$blocoD->codigoSituacao = '00';
$blocoD->valorDocumento = 10.90;
$blocoD->valorServico = 10.90;
$blocoD->valorServicoNaoTributado = 10.90;
$blocoD->valorTerceiros = 10.90;
$blocoD->valorOutrasDespesas = 10.90;
$blocoD->valorOutrasDespesas = 10.90;
$blocoD->valorBaseCalculoICMS = 10.90;
$blocoD->valorICMS = 10.90;
$blocoD->valorPIS = 10.90;
$blocoD->valorCOFINS = 10.90;
$blocoD->valorCOFINS = 10.90;
$blocoD->codigoTipoAssinante = 1;
$blocoD->dataEmissao = "09032016";
$blocoD->dataEntradaSaida = "09032016";

$blocoD->codigoParticipante = '1';
$blocoD->nome = 'Diogo';
$blocoD->CPF = '02282347005';
$blocoD->endereco = 'Rua a';
$blocoD->codigoMunicipio = 4317608;
$blocoD->codigoPais = '1058';
$blocoD->codigoInformacaoComplementar = '452';
$blocoD->informacaoComplementar = 'Teste para a descricao da nota';

$itens = new \SEfd\Writer\BlocoDItens();
$itens->numeroItem = '1';
$itens->codigoItem = '1';
$itens->descricaoItem = 'Produto 1';
$itens->codigoParticipante = '1';
$itens->codigoClassificacao = '1004';
$itens->quantidade = '1';
$itens->unidade = 'UN';
$itens->unidadeDescricao = 'Unidade';
$itens->valor = 10.90;
$itens->valorICMS = 10.90;
$itens->valorBaseCalculo = 10.90;
$itens->valorDesconto = 3.6;
$itens->cfop = '5122';
$itens->codigoSituacaoTributaria = '000';
$itens->indicadorReceita = 0;
$itens->tipoItem = '09';
$blocoD->addBlocoItens($itens);

$itens = new \SEfd\Writer\BlocoDItens();
$itens->numeroItem = '2';
$itens->codigoItem = '2';
$itens->descricaoItem = 'Produto 2';
$itens->codigoParticipante = '1';
$itens->codigoClassificacao = '1004';
$itens->quantidade = '1';
$itens->unidade = 'UN';
$itens->unidadeDescricao = 'Unidade';
$itens->valor = 10.90;
$itens->valorICMS = 10.90;
$itens->valorBaseCalculo = 10.90;
$itens->cfop = '5122';
$itens->codigoSituacaoTributaria = '000';
$itens->indicadorReceita = 0;
$itens->tipoItem = '09';
$blocoD->addBlocoItens($itens);

$itens = new \SEfd\Writer\BlocoDItens();
$itens->numeroItem = '3';
$itens->codigoItem = '2';
$itens->descricaoItem = 'Produto 2';
$itens->codigoParticipante = '1';
$itens->codigoClassificacao = '1004';
$itens->quantidade = '1';
$itens->unidade = 'UN';
$itens->unidadeDescricao = 'Unidade';
$itens->valor = 10.90;
$itens->valorICMS = 10.90;
$itens->valorBaseCalculo = 10.90;
$itens->cfop = '5122';
$itens->codigoSituacaoTributaria = '000';
$itens->indicadorReceita = 0;
$itens->tipoItem = '09';
$blocoD->addBlocoItens($itens);

$sefd->addBlocoD($blocoD);

//echo "<pre>";
//print_r($sefd);
//echo "</pre>";
//exit();

$sefd->printTxt();
//
//
//echo "<pre>";
//print_r($sefd);
//echo "</pre>";