<?php
namespace SEfd\Efd;

use SEfd\Efd\Bloco0\Bloco0;
use SEfd\Efd\BlocoC\BlocoC;
use SEfd\Efd\BlocoD\BlocoD;
use SEfd\Efd\BlocoE\BlocoE;
use SEfd\Efd\BlocoG\BlocoG;
use SEfd\Efd\BlocoH\BlocoH;
use SEfd\Efd\BlocoK\BlocoK;
use SEfd\Efd\Bloco1\Bloco1;
use SEfd\Efd\Bloco9\Bloco9;
use SEfd\SEfd;

class Efd
{
    public $bloco0;
    public $blocoC;
    public $blocoD;
    public $blocoE;
    public $blocoG;
    public $blocoH;
    public $blocoK;
    public $bloco1;
    public $bloco9;
    private $_9999;
    private $file;

    function __construct()
    {
        $this->bloco0 = new Bloco0();
        $this->blocoC = new BlocoC();
        $this->blocoD = new BlocoD();
        $this->blocoE = new BlocoE();
        $this->blocoG = new BlocoG();
        $this->blocoH = new BlocoH();
        $this->blocoK = new BlocoK();
        $this->bloco1 = new Bloco1();
        $this->bloco9 = new Bloco9();
    }

    /*
     * Inicia a montagem dos Blocos e Registros
     */
    public function makeEfd(\SEfd\SEfd $sefd)
    {
        $this->makeBloco0($sefd);
        $this->makeBlocoC($sefd);
        $this->makeBlocoD($sefd);
        $this->makeBlocoE($sefd);
        $this->makeBlocoG($sefd);
        $this->makeBlocoH($sefd);
        $this->makeBlocoK($sefd);
        $this->makeBloco1($sefd);
        $this->bloco0->make0990();
        $this->makeBloco9($sefd);
        $this->bloco0->make0990();
        $this->make9999();
    }

    /*
     * Esse metodo cria o Bloco 0
     */
    private function makeBloco0(\SEfd\SEfd $sefd)
    {
        $bloco0 = new \SEfd\Efd\Bloco0\Bloco0();

        $_0000 = new \SEfd\Efd\Bloco0\_0000();
        $_0000->COD_VER = $sefd->versaoLeiaute;
        $_0000->COD_FIN = $sefd->codigoFinalidade;
        $_0000->DT_INI = $sefd->dataInicial;
        $_0000->DT_FIN = $sefd->dataFinal;
        $_0000->NOME = $sefd->nomeEntidade;
        $_0000->CNPJ = $sefd->cnpjEntidade;
        $_0000->CPF = $sefd->cpfEntidade;
        $_0000->UF = $sefd->ufEntidade;
        $_0000->IE = $sefd->ieEntidade;
        $_0000->COD_MUN = $sefd->codMunEntidade;
        $_0000->IM = $sefd->imEntidade;
        $_0000->SUFRAMA = $sefd->suframaEntidade;
        $_0000->IND_PERFIL = $sefd->indentificacaoPerfil;
        $_0000->IND_ATIV = $sefd->indicadorAtividade;
        $this->bloco0->add0000($_0000);

        $_0001 = new \SEfd\Efd\Bloco0\_0001();
        $_0001->IND_MOV = 0;
        $this->bloco0->add0001($_0001);

        $_0005 = new \SEfd\Efd\Bloco0\_0005();
        $_0005->FANTASIA = $sefd->nomeEntidade;
        $_0005->CEP = $sefd->cepEntidade;
        $_0005->END = $sefd->enderecoEntidade;
        $_0005->NUM = $sefd->enderecoNumeroEntidade;
        $_0005->COMPL = $sefd->complementoEntidade;
        $_0005->BAIRRO = $sefd->bairroEntidade;
        $_0005->FONE = $sefd->telefoneEntidade;
        $_0005->FAX = $sefd->faxEntidade;
        $_0005->EMAIL = $sefd->emailEntidade;
        $this->bloco0->add0005($_0005);

        $_0100 = new \SEfd\Efd\Bloco0\_0100();
        $_0100->NOME = $sefd->nomeContabilista;
        $_0100->CPF = $sefd->cpfContabilista;
        $_0100->CRC = $sefd->crcContabilista;
        $_0100->CNPJ = $sefd->cnpjContabilista;
        $_0100->CEP = $sefd->cepContabilista;
        $_0100->END = $sefd->enderecoContabilista;
        $_0100->NUM = $sefd->enderecoNumeroContabilista;
        $_0100->COMPL = $sefd->complementoContabilista;
        $_0100->BAIRRO = $sefd->bairroContabilista;
        $_0100->FONE = $sefd->telefoneContabilista;
        $_0100->FAX = $sefd->faxContabilista;
        $_0100->EMAIL = $sefd->emailContabilista;
        $_0100->COD_MUN = $sefd->codMunicipioContabilista;
        $this->bloco0->add0100($_0100);
    }

    /*
     * Esse metodo cria o Bloco C
     */
    private function makeBlocoC(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoC) ){
            $c001 = new \SEfd\Efd\BlocoC\C001();
            $c001->IND_MOV = 1;
            $this->blocoC->addC001($c001);

            $this->blocoC->makeC990();
        }else{
            $c001 = new \SEfd\Efd\BlocoC\C001();
            $c001->IND_MOV = 0;
            $this->blocoC->addC001($c001);

            //MODELO
            $blocos = $sefd->blocoC;

            foreach( $blocos as $bloco){
                $c100 = new \SEfd\Efd\BlocoC\C100();
                $c100->IND_OPER = $bloco->indicadorOperacao;
                $c100->IND_EMIT = $bloco->indicadorEmitente;
                $c100->COD_PART = $bloco->codigoParticipante;
                $c100->COD_MOD = $bloco->codigoModelo;
                $c100->COD_SIT = $bloco->codigoSituacao;
                $c100->SER = $bloco->serie;
                $c100->NUM_DOC = $bloco->numeroDocumento;
                $c100->CHV_NFE = $bloco->chaveNFE;
                $c100->DT_DOC = $bloco->dataEmissao;
                $c100->DT_E_S = $bloco->dataEntradaSaida;
                $c100->VL_DOC = $bloco->valorDocumento;
                $c100->IND_PGTO = $bloco->indicadorPagamento;
                $c100->VL_DESC = $bloco->valorDesconto;
                $c100->VL_ABAT_NT = $bloco->valorAbatimentoNaoTributado;
                $c100->VL_MERC = $bloco->valorMercadoria;
                $c100->IND_FRT = $bloco->indicadorFrete;
                $c100->VL_FRT = $bloco->valorFrete;
                $c100->VL_SEG = $bloco->valorSeguro;
                $c100->VL_OUT_DA = $bloco->valorOutrasDespesas;
                $c100->VL_BC_ICMS = $bloco->valorBaseCalculoICMS;
                $c100->VL_ICMS = $bloco->valorICMS;
                $c100->VL_BC_ICMS_ST = $bloco->valorBaseCalculoICMSST;
                $c100->VL_ICMS_ST = $bloco->valorICMSST;
                $c100->VL_IPI = $bloco->valorIPI;
                $c100->VL_PIS = $bloco->valorPIS;
                $c100->VL_COFINS = $bloco->valorCOFINS;
                $c100->VL_PIS_ST = $bloco->valorPISST;
                $c100->VL_COFINS_ST = $bloco->valorCOFINSST;

                try{
                    if( $bloco->codigoParticipante != '' ){
                        $this->bloco0->make0150($bloco);
                    }
//                    if( $this->blocoD->validateD500($this, $d500) ){
                        $this->blocoC->addC100($c100);
//                    }
                }catch(\Exception $e){
                    exit( $e->getMessage() );
                }

                if( !empty($bloco->itens) ){
                    foreach( $bloco->itens as $item ){
                        $c170 = new \SEfd\Efd\BlocoC\C170();
                        $c170->NUM_ITEM = $item->numeroItem;
                        $c170->COD_ITEM = $item->codigoItem;
                        $c170->DESCR_COMPL = $item->descricaoItem;
                        $c170->QTD = $item->quantidade;
                        $c170->UNID = $item->unidade;
                        $c170->VL_ITEM = $item->valor;
                        $c170->VL_DESC = $item->valorDesconto;
                        $c170->IND_MOV = $item->indicadorMovimento;
                        $c170->CST_ICMS = $item->codigoSituacaoTributaria;
                        $c170->CFOP = $item->cfop;
                        $c170->COD_NAT = $item->codigoNatureza;
                        $c170->VL_BC_ICMS = $item->valorBaseCalculo;
                        $c170->ALIQ_ICMS = $item->aliquotaICMS;
                        $c170->VL_ICMS = $item->valorICMS;
                        $c170->VL_BC_ICMS_ST = $item->valorBaseCalculoST;
                        $c170->ALIQ_ST = $item->aliquotaICMSST;
                        $c170->VL_ICMS_ST = $item->valorICMSST;
                        $c170->IND_APUR = $item->indicadorApuracao;
                        $c170->CST_IPI = $item->codigoSituacaoIPI;
                        $c170->COD_ENQ = $item->codigoEnquadramentoIPI;
                        $c170->VL_BC_IPI = $item->valorBaseCalculoIPI;
                        $c170->ALIQ_IPI = $item->aliquotoIPI;
                        $c170->VL_IPI = $item->valorIPI;
                        $c170->CST_PIS = $item->codigoSituacaoPIS;
                        $c170->VL_BC_PIS = $item->valorBaseCalculoPIS;
                        $c170->ALIQ_PIS_P = $item->aliquotoPercentualPIS;
                        $c170->QUANT_BC_PIS = $item->quantidadeBaseCalculoPIS;
                        $c170->ALIQ_PIS_R = $item->aliquotoRealPIS;
                        $c170->VL_PIS = $item->valorPIS;
                        $c170->CST_COFINS = $item->codigoSituacaoCOFINS;
                        $c170->VL_BC_COFINS = $item->valorBaseCalculoCOFINS;
                        $c170->ALIQ_COFINS_P = $item->aliquotoPercentualCOFINS;
                        $c170->QUANT_BC_COFINS = $item->quantidadeBaseCalculoCOFINS;
                        $c170->ALIQ_COFINS_R = $item->aliquotoRealCOFINS;
                        $c170->VL_COFINS = $item->valorCOFINS;
                        $c170->VL_OPR = $item->valorOperacao;
                        $c170->COD_CTA = $item->codigoContabil;

                        try{
                            try{
                                $this->bloco0->make0190($item->unidade, $item->unidadeDescricao);
                            }catch(\Exception $e){
                                exit( $e->getMessage() );
                            }

                            if ( $c100->IND_OPER == 1 || $c100->IND_EMIT == 1 ) {
                                try{
                                    $this->bloco0->make0200($item);
                                }catch(\Exception $e){
                                    exit( $e->getMessage() );
                                }
                            }


                            if ($bloco->codigoParticipante != '') {
                                $this->bloco0->make0150($bloco);
                            }elseif ($item->codigoParticipante != '') {
                                $this->bloco0->make0150($bloco);
                            }

                            if( $this->blocoC->validateC170($this, $c170) ){
                                $this->blocoC->addC170($c170);
                            }
                        }catch(\Exception $e){
                            exit( $e->getMessage() );
                        }
                    }
                }

                //REGISTRO C190
                if ($bloco->codigoObservacao != '') {
                    $COD_OBS = $this->bloco0->make0460($bloco->codigoObservacao, $bloco->observacao);
                }
                $this->blocoC->makeC190($COD_OBS);
            }
            $this->blocoC->makeC990();
        }
    }

    /*
     * Esse metodo cria o Bloco D
     */
    private function makeBlocoD(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoD) ){
            $d001 = new \SEfd\Efd\BlocoD\D001();
            $d001->IND_MOV = 1;
            $this->blocoD->addD001($d001);
            $this->blocoD->makeD990();

        }else{
            $d001 = new \SEfd\Efd\BlocoD\D001();
            $d001->IND_MOV = 0;
            $this->blocoD->addD001($d001);

            //MODELO
            $blocos = $sefd->blocoD;

            foreach( $blocos as $bloco){
                //MODELO 21
                if( $bloco->codigoModelo == '21' ){
                    $d500 = new \SEfd\Efd\BlocoD\D500();
                    $d500->IND_OPER = $bloco->indicadorOperacao;
                    $d500->IND_EMIT = $bloco->indicadorEmitente;
                    $d500->COD_PART = $bloco->codigoParticipante;
                    $d500->COD_MOD = $bloco->codigoModelo;
                    $d500->COD_SIT = $bloco->codigoSituacao;
                    $d500->SER = $bloco->serie;
                    $d500->SUB = $bloco->subserie;
                    $d500->NUM_DOC = $bloco->numeroDocumento;
                    $d500->DT_DOC = $bloco->dataEmissao;
                    $d500->DT_A_P = $bloco->dataEntradaSaida;
                    $d500->VL_DOC = $bloco->valorDocumento;
                    $d500->VL_DESC = $bloco->valorDesconto;
                    $d500->VL_SERV = $bloco->valorServico;
                    $d500->VL_SERV_NT = $bloco->valorServicoNaoTributado;
                    $d500->VL_TERC = $bloco->valorTerceiros;
                    $d500->VL_DA = $bloco->valorOutrasDespesas;
                    $d500->VL_BC_ICMS = $bloco->valorBaseCalculoICMS;
                    $d500->VL_ICMS = $bloco->valorICMS;
                    $d500->COD_INF = $bloco->codigoInformacaoComplementar;
                    $d500->VL_PIS = $bloco->valorPIS;
                    $d500->VL_COFINS = $bloco->valorCOFINS;
                    $d500->COD_CTA = $bloco->codigoContaContabil;
                    $d500->TP_ASSINANTE = $bloco->codigoTipoAssinante;

                    $d500->codigoObrigacoesICMS = $bloco->codigoObrigacoesICMS;
                    try{
                        if( $bloco->codigoInformacaoComplementar != '' ){
                            $this->bloco0->make0450($bloco->codigoInformacaoComplementar, $bloco->informacaoComplementar);
                        }
                        if( $this->blocoD->validateD500($this, $d500) ){
                            $this->blocoD->addD500($d500);
                        }
                    }catch(\Exception $e){
                        exit( $e->getMessage() );
                    }

                    if( !empty($bloco->itens) ){
                        foreach( $bloco->itens as $item ){
                            $d510 = new \SEfd\Efd\BlocoD\D510();
                            $d510->NUM_ITEM = $item->numeroItem;
                            $d510->COD_ITEM = $item->codigoItem;
                            $d510->COD_CLASS = $item->codigoClassificacao;
                            $d510->QTD = $item->quantidade;
                            $d510->UNID = $item->unidade;
                            $d510->VL_ITEM = $item->valor;
                            $d510->VL_DESC = $item->valorDesconto;
                            $d510->CST_ICMS = $item->codigoSituacaoTributaria;
                            $d510->CFOP = $item->cfop;
                            $d510->VL_BC_ICMS = $item->valorBaseCalculo;
                            $d510->ALIQ_ICMS = $item->aliquotaICMS;
                            $d510->VL_ICMS = $item->valorICMS;
                            $d510->VL_BC_ICMS_UF = $item->valorBaseCalculoUF;
                            $d510->VL_ICMS_UF = $item->valorICMSUF;
                            $d510->IND_REC = $item->indicadorReceita;
                            $d510->COD_PART = $item->codigoParticipante;
                            $d510->VL_PIS = $item->valorPIS;
                            $d510->VL_COFINS = $item->valorCOFINS;
                            $d510->COD_CTA = $item->codigoContabil;

                            try{
                                try{
                                    $this->bloco0->make0190($item->unidade, $item->unidadeDescricao);
                                }catch(\Exception $e){
                                    exit( $e->getMessage() );
                                }

                                try{
                                    $this->bloco0->make0200($item);
                                }catch(\Exception $e){
                                    exit( $e->getMessage() );
                                }

                                if ($bloco->codigoParticipante != '') {
                                    $this->bloco0->make0150($bloco);
                                }elseif ($item->codigoParticipante != '') {
                                    $this->bloco0->make0150($bloco);
                                }

                                if( $this->blocoD->validateD510($this, $d510) ){
                                    $this->blocoD->addD510($d510);
                                }
                            }catch(\Exception $e){
                                exit( $e->getMessage() );
                            }
                        }
                    }

                    //REGISTRO D590
                    if ($bloco->codigoObservacao != '') {
                        $COD_OBS = $this->bloco0->make0460($bloco->codigoObservacao, $bloco->observacao);
                    }
                    $this->blocoD->makeD590($COD_OBS);
                }
            }
            $this->blocoD->makeD990();
        }
    }

    /*
     * Esse metodo cria o Bloco E
     */
    private function makeBlocoE(\SEfd\SEfd $sefd)
    {
//        if( empty($sefd->blocoE) ){
//            $e001 = new \SEfd\Efd\BlocoE\E001();
//            $e001->IND_MOV = 1;
//            $this->blocoE->addE001($e001);
//            $this->blocoE->makeE116($this);
//            $this->blocoE->makeE990();
//        }

        $e001 = new \SEfd\Efd\BlocoE\E001();
        $e001->IND_MOV = 1;
        $this->blocoE->addE001($e001);

        //E100
        if ( $this->blocoE->makeE100($this) ) {
            $this->blocoE->E001->IND_MOV = 0;
        }

        //E200
        if ( $this->blocoE->makeE200($this) ) {
            $this->blocoE->E001->IND_MOV = 0;
        }

        $this->blocoE->makeE990();
    }

    /*
     * Esse metodo cria o Bloco G
     */
    private function makeBlocoG(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoG) ){
            $blocoG = new \SEfd\Efd\BlocoG\BlocoG();

            $g001 = new \SEfd\Efd\BlocoG\G001();
            $g001->IND_MOV = 1;
            $blocoG->addG001($g001);

            $blocoG->makeG990();
            $this->blocoG = $blocoG;

        }
    }

    /*
     * Esse metodo cria o Bloco H
     */
    private function makeBlocoH(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoH) ){
            $h001 = new \SEfd\Efd\BlocoH\H001();
            $h001->IND_MOV = 1;
            $this->blocoH->addH001($h001);
            $this->blocoH->makeH990();

        }else {
            $h001 = new \SEfd\Efd\BlocoH\H001();
            $h001->IND_MOV = 0;
            $this->blocoH->addH001($h001);

            $blocos = $sefd->blocoH;

            foreach( $blocos as $bloco ) {
                $h010 = new \SEfd\Efd\BlocoH\H010();
                $h010->COD_ITEM = $bloco->codigoItem;
                $h010->UNID = $bloco->unidade;
                $h010->QTD = $bloco->quantidade;
                $h010->VL_UNIT = $bloco->valorUnitario;
                $h010->VL_ITEM = $bloco->valorItem;
                $h010->IND_PROP = $bloco->indicadorPropriedade;
                $h010->COD_PART = $bloco->codigoParticipante;
                $h010->TXT_COMPL = $bloco->textoComplementar;
                $h010->COD_CTA = $bloco->codigoContaAnaliticaContabel;
                $h010->VL_ITEM_IR = $bloco->valorItemImpostoRenda;
                try{
                    if ($this->blocoH->validadeH010($this,$h010)) {
                        $this->blocoH->addH010($h010);
                    }
                }catch(\Exception $e){
                    exit( $e->getMessage() );
                }

                try{
                    $this->bloco0->make0190($bloco->unidade, $bloco->unidadeDescricao);
                }catch(\Exception $e){
                    exit( $e->getMessage() );
                }

                try{
                    $this->bloco0->make0200($bloco);
                }catch(\Exception $e){
                    exit( $e->getMessage() );
                }
            }



            try{
                $this->blocoH->makeH005($sefd->blocoH[0]->dataInvervalo, $sefd->motivoInventario);
            }catch(\Exception $e){
                exit( $e->getMessage() );
            }

            try{
                $this->blocoH->makeH990();
            }catch(\Exception $e){
                exit( $e->getMessage() );
            }
        }
    }

    /*
     * Esse metodo cria o Bloco K
     */
    private function makeBlocoK(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoK) ){
            $blocoK = new \SEfd\Efd\BlocoK\BlocoK();

            $k001 = new \SEfd\Efd\BlocoK\K001();
            $k001->IND_MOV = 1;
            $blocoK->addK001($k001);

            $blocoK->makeK990();
            $this->blocoK = $blocoK;

        }
    }

    /*
     * Esse metodo cria o Bloco 1
     */
    private function makeBloco1(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->bloco1) ){
            $_1001 = new \SEfd\Efd\Bloco1\_1001();
            $_1001->IND_MOV = 0;
            $this->bloco1->add1001($_1001);

            $this->bloco1->make1010($this);

            $this->bloco1->make1990();
        }
    }

    /*
     * Esse metodo cria o Bloco 9
     */
    private function makeBloco9()
    {
        $bloco9 = new \SEfd\Efd\Bloco9\Bloco9();

        $_9001 = new \SEfd\Efd\Bloco9\_9001();
        $_9001->IND_MOV = 0;
        $bloco9->add9001($_9001);

        //MONTA O REGITRO 9900

        //BLOCO 0
        if( !empty($this->bloco0) ){
            if( !empty($this->bloco0->_0000) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0000';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0000);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0001';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0005) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0005';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0005);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0015) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0015';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0015);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0100) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0100';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0100);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0150) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0150';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0150);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0190) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0190';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0190);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0200) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0200';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0200);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0400) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '_0400';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0400);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0450) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0450';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0450);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0460) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0460';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0460);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco0->_0990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '0990';
                $_9900->QTD_REG_BLC = count($this->bloco0->_0990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO C
        if( !empty($this->blocoC) ){
            if( !empty($this->blocoC->C001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'C001';
                $_9900->QTD_REG_BLC = count($this->blocoC->C001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoC->C100) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'C100';
                $_9900->QTD_REG_BLC = count($this->blocoC->C100);
                $bloco9->add9900($_9900);

                $C170 = 0;
                $C190 = 0;
                for( $i = 0; $i < count($this->blocoC->C100); $i++ ){
                    if ( $this->blocoC->C100[$i]->IND_OPER == 1 || $this->blocoC->C100[$i]->IND_EMIT == 1 && $this->blocoC->C100[$i]->COD_SIT != '06' ) {
                        $C170 += count($this->blocoC->C100[$i]->C170);
                    }
                    $C190 += count($this->blocoC->C100[$i]->C190);
                }

                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'C170';
                $_9900->QTD_REG_BLC = $C170;
                $bloco9->add9900($_9900);

                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'C190';
                $_9900->QTD_REG_BLC = $C190;
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoC->C990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'C990';
                $_9900->QTD_REG_BLC = count($this->blocoC->C990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO D
        if( !empty($this->blocoD) ){

            if( !empty($this->blocoD->D001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'D001';
                $_9900->QTD_REG_BLC = count($this->blocoD->D001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoD->D500) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'D500';
                $_9900->QTD_REG_BLC = count($this->blocoD->D500);
                $bloco9->add9900($_9900);

                $D510 = 0;
                $D590 = 0;
                for( $i = 0; $i < count($this->blocoD->D500); $i++ ){
                    $D510 += count($this->blocoD->D500[$i]->D510);
                    $D590 += count($this->blocoD->D500[$i]->D590);
                }

                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'D510';
                $_9900->QTD_REG_BLC = $D510;
                $bloco9->add9900($_9900);

                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'D590';
                $_9900->QTD_REG_BLC = $D590;
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoD->D990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'D990';
                $_9900->QTD_REG_BLC = count($this->blocoD->D990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO E
        if( !empty($this->blocoE) ){
            if( !empty($this->blocoE->E001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E001';
                $_9900->QTD_REG_BLC = count($this->blocoE->E001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoE->E100) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E100';
                $_9900->QTD_REG_BLC = count($this->blocoE->E100);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoE->E110) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E110';
                $_9900->QTD_REG_BLC = count($this->blocoE->E110);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoE->E116) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E116';
                $_9900->QTD_REG_BLC = count($this->blocoE->E116);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoE->E200) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E200';
                $_9900->QTD_REG_BLC = count($this->blocoE->E200);
                $bloco9->add9900($_9900);

                $E210 = 0;
                for( $i = 0; $i < count($this->blocoE->E200); $i++ ){
                    $E210 += count($this->blocoE->E200[$i]->E210);
                }

                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E210';
                $_9900->QTD_REG_BLC = $E210;
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoE->E990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'E990';
                $_9900->QTD_REG_BLC = count($this->blocoE->E990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO G
        if( !empty($this->blocoG) ){
            if( !empty($this->blocoG->G001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'G001';
                $_9900->QTD_REG_BLC = count($this->blocoG->G001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoG->G990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'G990';
                $_9900->QTD_REG_BLC = count($this->blocoG->G990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO H
        if( !empty($this->blocoH) ){
            if( !empty($this->blocoH->H001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'H001';
                $_9900->QTD_REG_BLC = count($this->blocoH->H001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoH->H005) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'H005';
                $_9900->QTD_REG_BLC = count($this->blocoH->H005);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoH->H010) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'H010';
                $_9900->QTD_REG_BLC = count($this->blocoH->H010);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoH->H020) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'H020';
                $_9900->QTD_REG_BLC = count($this->blocoH->H020);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoH->H990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'H990';
                $_9900->QTD_REG_BLC = count($this->blocoH->H990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO K
        if( !empty($this->blocoK) ){
            if( !empty($this->blocoK->K001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'K001';
                $_9900->QTD_REG_BLC = count($this->blocoK->K001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->blocoK->K990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = 'K990';
                $_9900->QTD_REG_BLC = count($this->blocoK->K990);
                $bloco9->add9900($_9900);
            }
        }

        //BLOCO 1
        if( !empty($this->bloco1) ){
            if( !empty($this->bloco1->_1001) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '1001';
                $_9900->QTD_REG_BLC = count($this->bloco1->_1001);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco1->_1010) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '1010';
                $_9900->QTD_REG_BLC = count($this->bloco1->_1010);
                $bloco9->add9900($_9900);
            }
            if( !empty($this->bloco1->_1990) ){
                $_9900 = new \SEfd\Efd\Bloco9\_9900();
                $_9900->REG_BLC = '1990';
                $_9900->QTD_REG_BLC = count($this->bloco1->_1990);
                $bloco9->add9900($_9900);
            }
        }

        $_9900 = new \SEfd\Efd\Bloco9\_9900();
        $_9900->REG_BLC = '9001';
        $_9900->QTD_REG_BLC = 1;
        $bloco9->add9900($_9900);

        $_9900 = new \SEfd\Efd\Bloco9\_9900();
        $_9900->REG_BLC = '9900';
        $_9900->QTD_REG_BLC = count($bloco9->_9900)+3;
        $bloco9->add9900($_9900);

        $_9900 = new \SEfd\Efd\Bloco9\_9900();
        $_9900->REG_BLC = '9990';
        $_9900->QTD_REG_BLC = 1;
        $bloco9->add9900($_9900);

        $_9900 = new \SEfd\Efd\Bloco9\_9900();
        $_9900->REG_BLC = '9999';
        $_9900->QTD_REG_BLC = 1;
        $bloco9->add9900($_9900);

        $bloco9->make9990();
        $this->bloco9 = $bloco9;
    }

    /*
     * Esse metodo cria o Registro 999
     */
    private function make9999()
    {
        $QTD_LIN = 1;
        //BLOCO 0
        if( !empty($this->bloco0) ){
            if( !empty($this->bloco0->_0000) ){ $QTD_LIN++; }
            if( !empty($this->bloco0->_0001) ){ $QTD_LIN++; }
            if( !empty($this->bloco0->_0005) ){ $QTD_LIN++; }
            if( !empty($this->bloco0->_0015) ){ $QTD_LIN++; }
            if( !empty($this->bloco0->_0100) ){ $QTD_LIN++; }
            if( !empty($this->bloco0->_0150) ){ $QTD_LIN += count($this->bloco0->_0150); }
            if( !empty($this->bloco0->_0190) ){ $QTD_LIN += count($this->bloco0->_0190); }
            if( !empty($this->bloco0->_0200) ){ $QTD_LIN += count($this->bloco0->_0200); }
            if( !empty($this->bloco0->_0400) ){ $QTD_LIN += count($this->bloco0->_0400); }
            if( !empty($this->bloco0->_0450) ){ $QTD_LIN += count($this->bloco0->_0450); }
            if( !empty($this->bloco0->_0460) ){ $QTD_LIN += count($this->bloco0->_0460); }
            if( !empty($this->bloco0->_0990) ){ $QTD_LIN++; }
        }

        //BLOCO C
        if( !empty($this->blocoC) ){
            if( !empty($this->blocoC->C001) ){ $QTD_LIN++; }
            if( !empty($this->blocoC->C100) ){
                $QTD_LIN += count($this->blocoC->C100);
                for( $i = 0; $i < count($this->blocoC->C100); $i++ ){
                    if ( $this->blocoC->C100[$i]->IND_OPER == 1 || $this->blocoC->C100[$i]->IND_EMIT == 1 && $this->blocoC->C100[$i]->COD_SIT != '06' ) {
                        $QTD_LIN += count($this->blocoC->C100[$i]->C170);
                    }
                    $QTD_LIN += count($this->blocoC->C100[$i]->C190);
                }
            }
            if( !empty($this->blocoC->C990) ){ $QTD_LIN++; }
        }

        //BLOCO D
        if( !empty($this->blocoD) ){
            if( !empty($this->blocoD->D001) ){ $QTD_LIN++; }
            if( !empty($this->blocoD->D500) ){
                $QTD_LIN += count($this->blocoD->D500);
                for( $i = 0; $i < count($this->blocoD->D500); $i++ ){
                    $QTD_LIN += count($this->blocoD->D500[$i]->D510);
                    $QTD_LIN += count($this->blocoD->D500[$i]->D590);
                }
            }
            if( !empty($this->blocoD->D990) ){ $QTD_LIN++; }
        }

        //BLOCO E
        if( !empty($this->blocoE) ){
            if( !empty($this->blocoE->E001) ){ $QTD_LIN++; }
            if( !empty($this->blocoE->E100) ){ $QTD_LIN++; }
            if( !empty($this->blocoE->E110) ){ $QTD_LIN++; }
            if( !empty($this->blocoE->E116) ){ $QTD_LIN++; }
            if( !empty($this->blocoE->E200) ){
                $QTD_LIN += count($this->blocoE->E200);
                for( $i = 0; $i < count($this->blocoE->E200); $i++ ){
                    $QTD_LIN += count($this->blocoE->E200[$i]->E210);
                }
            }
            if( !empty($this->blocoE->E990) ){ $QTD_LIN++; }
        }

        //BLOCO G
        if( !empty($this->blocoG) ){
            if( !empty($this->blocoG->G001) ){ $QTD_LIN++; }
            if( !empty($this->blocoG->G990) ){ $QTD_LIN++; }
        }

        //BLOCO H
        if( !empty($this->blocoH) ){
            if( !empty($this->blocoH->H001) ){ $QTD_LIN++; }
            if( !empty($this->blocoH->H005) ){ $QTD_LIN++; }
            if( !empty($this->blocoH->H010) ){ $QTD_LIN += count($this->blocoH->H010); }
            if( !empty($this->blocoH->H020) ){ $QTD_LIN++; }
            if( !empty($this->blocoH->H990) ){ $QTD_LIN++; }
        }

        //BLOCO K
        if( !empty($this->blocoK) ){
            if( !empty($this->blocoK->K001) ){ $QTD_LIN++; }
            if( !empty($this->blocoK->K990) ){ $QTD_LIN++; }
        }

        //BLOCO 1
        if( !empty($this->bloco1) ){
            if( !empty($this->bloco1->_1001) ){ $QTD_LIN++; }
            if( !empty($this->bloco1->_1010) ){ $QTD_LIN++; }
            if( !empty($this->bloco1->_1990) ){ $QTD_LIN++; }
        }

        //BLOCO 9
        if( !empty($this->bloco9) ){
            if( !empty($this->bloco9->_9001) ){ $QTD_LIN++; }
            if( !empty($this->bloco9->_9900) ){ $QTD_LIN += count($this->bloco9->_9900); }
            if( !empty($this->bloco9->_9990) ){ $QTD_LIN++; }
        }

        $_9999 = new \SEfd\Efd\_9999();
        $_9999->QTD_LIN = $QTD_LIN;
        $this->_9999 = $_9999;
    }

    /*
     * Esse metodo monta o arquivo TXT
     */
    public function montarEfd()
    {
        // BLOCO 0
        if( !empty($this->bloco0) ){
            //REGISTRO 0000
            $this->file .= "|{$this->bloco0->_0000->REG}";
            $this->file .= "|{$this->bloco0->_0000->COD_VER}";
            $this->file .= "|{$this->bloco0->_0000->COD_FIN}";
            $this->file .= "|{$this->bloco0->_0000->DT_INI}";
            $this->file .= "|{$this->bloco0->_0000->DT_FIN}";
            $this->file .= "|{$this->bloco0->_0000->NOME}";
            $this->file .= "|{$this->bloco0->_0000->CNPJ}";
            $this->file .= "|{$this->bloco0->_0000->CPF}";
            $this->file .= "|{$this->bloco0->_0000->UF}";
            $this->file .= "|{$this->bloco0->_0000->IE}";
            $this->file .= "|{$this->bloco0->_0000->COD_MUN}";
            $this->file .= "|{$this->bloco0->_0000->IM}";
            $this->file .= "|{$this->bloco0->_0000->SUFRAMA}";
            $this->file .= "|{$this->bloco0->_0000->IND_PERFIL}";
            $this->file .= "|{$this->bloco0->_0000->IND_ATIV}";
            $this->file .= "|\r\n";

            //REGISTRO 0001
            $this->file .= "|{$this->bloco0->_0001->REG}";
            $this->file .= "|{$this->bloco0->_0001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO 0005
            $this->file .= "|{$this->bloco0->_0005->REG}";
            $this->file .= "|{$this->bloco0->_0005->FANTASIA}";
            $this->file .= "|{$this->bloco0->_0005->CEP}";
            $this->file .= "|{$this->bloco0->_0005->END}";
            $this->file .= "|{$this->bloco0->_0005->NUM}";
            $this->file .= "|{$this->bloco0->_0005->COMPL}";
            $this->file .= "|{$this->bloco0->_0005->BAIRRO}";
            $this->file .= "|{$this->bloco0->_0005->FONE}";
            $this->file .= "|{$this->bloco0->_0005->FAX}";
            $this->file .= "|{$this->bloco0->_0005->EMAIL}";
            $this->file .= "|\r\n";

            //REGISTRO 0100
            $this->file .= "|{$this->bloco0->_0100->REG}";
            $this->file .= "|{$this->bloco0->_0100->NOME}";
            $this->file .= "|{$this->bloco0->_0100->CPF}";
            $this->file .= "|{$this->bloco0->_0100->CRC}";
            $this->file .= "|{$this->bloco0->_0100->CNPJ}";
            $this->file .= "|{$this->bloco0->_0100->CEP}";
            $this->file .= "|{$this->bloco0->_0100->END}";
            $this->file .= "|{$this->bloco0->_0100->NUM}";
            $this->file .= "|{$this->bloco0->_0100->COMPL}";
            $this->file .= "|{$this->bloco0->_0100->BAIRRO}";
            $this->file .= "|{$this->bloco0->_0100->FONE}";
            $this->file .= "|{$this->bloco0->_0100->FAX}";
            $this->file .= "|{$this->bloco0->_0100->EMAIL}";
            $this->file .= "|{$this->bloco0->_0100->COD_MUN}";
            $this->file .= "|\r\n";

            //REGISTRO 0150
            if( !empty($this->bloco0->_0150) ){
                foreach( $this->bloco0->_0150 as $_0150 ){
                    $this->file .= "|{$_0150->REG}";
                    $this->file .= "|{$_0150->COD_PART}";
                    $this->file .= "|{$_0150->NOME}";
                    $this->file .= "|{$_0150->COD_PAIS}";
                    $this->file .= "|{$_0150->CNPJ}";
                    $this->file .= "|{$_0150->CPF}";
                    $this->file .= "|{$_0150->IE}";
                    $this->file .= "|{$_0150->COD_MUN}";
                    $this->file .= "|{$_0150->SUFRAMA}";
                    $this->file .= "|{$_0150->END}";
                    $this->file .= "|{$_0150->NUM}";
                    $this->file .= "|{$_0150->COMPL}";
                    $this->file .= "|{$_0150->BAIRRO}";
                    $this->file .= "|\r\n";
                }
            }

            //REGISTRO 0190
            foreach( $this->bloco0->_0190 as $_0190 ){
                $this->file .= "|{$_0190->REG}";
                $this->file .= "|{$_0190->UNID}";
                $this->file .= "|{$_0190->DESCR}";
                $this->file .= "|\r\n";
            }

            //REGISTRO 0200
            foreach( $this->bloco0->_0200 as $_0200 ){
                $this->file .= "|{$_0200->REG}";
                $this->file .= "|{$_0200->COD_ITEM}";
                $this->file .= "|{$_0200->DESCR_ITEM}";
                $this->file .= "|{$_0200->COD_BARRA}";
                $this->file .= "|{$_0200->COD_ANT_ITEM}";
                $this->file .= "|{$_0200->UNID_INV}";
                $this->file .= "|{$_0200->TIPO_ITEM}";
                $this->file .= "|{$_0200->COD_NCM}";
                $this->file .= "|{$_0200->EX_IPI}";
                $this->file .= "|{$_0200->COD_GEN}";
                $this->file .= "|{$_0200->COD_LST}";
                $this->file .= "|{$_0200->ALIQ_ICMS}";
                $this->file .= "|\r\n";
            }

            //REGISTRO 0400
            foreach( $this->bloco0->_0400 as $_0400 ){
                $this->file .= "|{$_0400->REG}";
                $this->file .= "|{$_0400->COD_NAT}";
                $this->file .= "|{$_0400->DESCR_NAT}";
                $this->file .= "|\r\n";
            }

            //REGISTRO 0450
            if( !empty($this->bloco0->_0450) ){
                foreach( $this->bloco0->_0450 as $_0450 ){
                    $this->file .= "|{$_0450->REG}";
                    $this->file .= "|{$_0450->COD_INF}";
                    $this->file .= "|{$_0450->TXT}";
                    $this->file .= "|\r\n";
                }
            }

            //REGISTRO 0460
            if( !empty($this->bloco0->_0460) ){
                foreach( $this->bloco0->_0460 as $_0460 ){
                    $this->file .= "|{$_0460->REG}";
                    $this->file .= "|{$_0460->COD_OBS}";
                    $this->file .= "|{$_0460->TXT}";
                    $this->file .= "|\r\n";
                }
            }

            //REGISTRO 0990
            $this->file .= "|{$this->bloco0->_0990->REG}";
            $this->file .= "|{$this->bloco0->_0990->QTD_LIN_0}";
            $this->file .= "|\r\n";

        }

        // BLOCO C
        if( !empty($this->blocoC) ){
            //REGISTRO C001
            $this->file .= "|{$this->blocoC->C001->REG}";
            $this->file .= "|{$this->blocoC->C001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO C100
            if( !empty($this->blocoC->C100) ) {
                foreach ($this->blocoC->C100 as $c100) {
                    $this->file .= "|{$c100->REG}";
                    $this->file .= "|{$c100->IND_OPER}";
                    $this->file .= "|{$c100->IND_EMIT}";
                    $this->file .= "|{$c100->COD_PART}";
                    $this->file .= "|{$c100->COD_MOD}";
                    $this->file .= "|{$c100->COD_SIT}";
                    $this->file .= "|{$c100->SER}";
                    $this->file .= "|{$c100->NUM_DOC}";
                    $this->file .= "|{$c100->CHV_NFE}";
                    $this->file .= "|{$c100->DT_DOC}";
                    $this->file .= "|{$c100->DT_E_S}";
                    if ( $c100->VL_DOC !== NULL ) { $this->file .= "|". number_format($c100->VL_DOC, 2, ",", "") ."";}else{ $this->file .= "|";}
                    $this->file .= "|{$c100->IND_PGTO}";
                    if ( $c100->VL_DESC !== NULL ) { $this->file .= "|". number_format($c100->VL_DESC, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_ABAT_NT !== NULL ) { $this->file .= "|". number_format($c100->VL_ABAT_NT, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_MERC !== NULL ) { $this->file .= "|". number_format($c100->VL_MERC, 2, ",", "") ."";}else{ $this->file .= "|";}
                    $this->file .= "|{$c100->IND_FRT}";
                    if ( $c100->VL_FRT !== NULL ) { $this->file .= "|". number_format($c100->VL_FRT, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_SEG !== NULL ) { $this->file .= "|". number_format($c100->VL_SEG, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_OUT_DA !== NULL ) { $this->file .= "|". number_format($c100->VL_OUT_DA, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_BC_ICMS !== NULL ) { $this->file .= "|". number_format($c100->VL_BC_ICMS, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_ICMS !== NULL ) { $this->file .= "|". number_format($c100->VL_ICMS, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_BC_ICMS_ST !== NULL ) { $this->file .= "|". number_format($c100->VL_BC_ICMS_ST, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_ICMS_ST !== NULL ) { $this->file .= "|". number_format($c100->VL_ICMS_ST, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_IPI !== NULL ) { $this->file .= "|". number_format($c100->VL_IPI, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_PIS !== NULL ) { $this->file .= "|". number_format($c100->VL_PIS, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_COFINS !== NULL ) { $this->file .= "|". number_format($c100->VL_COFINS, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_PIS_ST !== NULL ) { $this->file .= "|". number_format($c100->VL_PIS_ST, 2, ",", "") ."";}else{ $this->file .= "|";}
                    if ( $c100->VL_COFINS_ST !== NULL ) { $this->file .= "|". number_format($c100->VL_COFINS_ST, 2, ",", "") ."";}else{ $this->file .= "|";}
                    $this->file .= "|\r\n";

                    //REGISTRO C170
                    if( !empty($c100->C170) && ($c100->IND_OPER == 1 || $c100->IND_EMIT == 1) && $c100->COD_SIT != '06' ) {
                        foreach ($c100->C170 as $c170) {
                            $this->file .= "|{$c170->REG}";
                            $this->file .= "|{$c170->NUM_ITEM}";
                            $this->file .= "|{$c170->COD_ITEM}";
                            $this->file .= "|{$c170->DESCR_COMPL}";
                            $this->file .= "|". number_format($c170->QTD, 5, ",", "") ."";
                            $this->file .= "|{$c170->UNID}";
                            $this->file .= "|". number_format($c170->VL_ITEM, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_DESC, 2, ",", "") ."";
                            $this->file .= "|{$c170->IND_MOV}";
                            $this->file .= "|{$c170->CST_ICMS}";
                            $this->file .= "|{$c170->CFOP}";
                            $this->file .= "|{$c170->COD_NAT}";
                            $this->file .= "|". number_format($c170->VL_BC_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_BC_ICMS_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_ICMS_ST, 2, ",", "") ."";
                            $this->file .= "|{$c170->IND_APUR}";
                            $this->file .= "|{$c170->CST_IPI}";
                            $this->file .= "|{$c170->COD_ENQ}";
                            $this->file .= "|". number_format($c170->VL_BC_IPI, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_IPI, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_IPI, 2, ",", "") ."";
                            $this->file .= "|{$c170->CST_PIS}";
                            $this->file .= "|". number_format($c170->VL_BC_PIS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_PIS_P, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->QUANT_BC_PIS, 3, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_PIS_R, 4, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_PIS, 2, ",", "") ."";
                            $this->file .= "|{$c170->CST_COFINS}";
                            $this->file .= "|". number_format($c170->VL_BC_COFINS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_COFINS_P, 4, ",", "") ."";
                            $this->file .= "|". number_format($c170->QUANT_BC_COFINS, 3, ",", "") ."";
                            $this->file .= "|". number_format($c170->ALIQ_COFINS_R, 4, ",", "") ."";
                            $this->file .= "|". number_format($c170->VL_COFINS, 2, ",", "") ."";
                            $this->file .= "|{$c170->COD_CTA}";
                            $this->file .= "|\r\n";
                        }
                    }

                    //REGISTRO C190
                    if( !empty($c100->C190) ) {
                        foreach ($c100->C190 as $c190) {
                            $this->file .= "|{$c190->REG}";
                            $this->file .= "|{$c190->CST_ICMS}";
                            $this->file .= "|{$c190->CFOP}";
                            $this->file .= "|". number_format($c190->ALIQ_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_OPR, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_BC_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_BC_ICMS_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_ICMS_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_RED_BC, 2, ",", "") ."";
                            $this->file .= "|". number_format($c190->VL_IPI, 2, ",", "") ."";
                            $this->file .= "|{$c190->COD_OBS}";
                            $this->file .= "|\r\n";
                        }
                    }
                }
            }

            //REGISTRO C990
            $this->file .= "|{$this->blocoC->C990->REG}";
            $this->file .= "|{$this->blocoC->C990->QTD_LIN_C}";
            $this->file .= "|\r\n";
        }

        // BLOCO D
        if( !empty($this->blocoD) ){
            //REGISTRO D001
            $this->file .= "|{$this->blocoD->D001->REG}";
            $this->file .= "|{$this->blocoD->D001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO D500
            if( !empty($this->blocoD->D500) ) {
                foreach ($this->blocoD->D500 as $d500) {
                    $this->file .= "|{$d500->REG}";
                    $this->file .= "|{$d500->IND_OPER}";
                    $this->file .= "|{$d500->IND_EMIT}";
                    $this->file .= "|{$d500->COD_PART}";
                    $this->file .= "|{$d500->COD_MOD}";
                    $this->file .= "|{$d500->COD_SIT}";
                    $this->file .= "|{$d500->SER}";
                    $this->file .= "|{$d500->SUB}";
                    $this->file .= "|{$d500->NUM_DOC}";
                    $this->file .= "|{$d500->DT_DOC}";
                    $this->file .= "|{$d500->DT_A_P}";
                    $this->file .= "|". number_format($d500->VL_DOC, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_DESC, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_SERV, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_SERV_NT, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_TERC, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_DA, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_BC_ICMS, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_ICMS, 2, ",", "") ."";
                    $this->file .= "|{$d500->COD_INF}";
                    $this->file .= "|". number_format($d500->VL_PIS, 2, ",", "") ."";
                    $this->file .= "|". number_format($d500->VL_COFINS, 2, ",", "") ."";
                    $this->file .= "|{$d500->COD_CTA}";
                    $this->file .= "|{$d500->TP_ASSINANTE}";
                    $this->file .= "|\r\n";

                    //REGISTRO D510
                    if( !empty($d500->D510) ) {
                        foreach ($d500->D510 as $d510) {
                            $this->file .= "|{$d510->REG}";
                            $this->file .= "|{$d510->NUM_ITEM}";
                            $this->file .= "|{$d510->COD_ITEM}";
                            $this->file .= "|{$d510->COD_CLASS}";
                            $this->file .= "|". number_format($d510->QTD, 3, ",", "") ."";
                            $this->file .= "|{$d510->UNID}";
                            $this->file .= "|". number_format($d510->VL_ITEM, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->VL_DESC, 2, ",", "") ."";
                            $this->file .= "|{$d510->CST_ICMS}";
                            $this->file .= "|{$d510->CFOP}";
                            $this->file .= "|". number_format($d510->VL_BC_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->ALIQ_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->VL_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->VL_BC_ICMS_UF, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->VL_ICMS_UF, 2, ",", "") ."";
                            $this->file .= "|{$d510->IND_REC}";
                            $this->file .= "|{$d510->COD_PART}";
                            $this->file .= "|". number_format($d510->VL_PIS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d510->VL_COFINS, 2, ",", "") ."";
                            $this->file .= "|{$d510->COD_CTA}";
                            $this->file .= "|\r\n";
                        }
                    }

                    //REGISTRO D590
                    if( !empty($d500->D590) ) {
                        foreach ($d500->D590 as $d590) {
                            $this->file .= "|{$d590->REG}";
                            $this->file .= "|{$d590->CST_ICMS}";
                            $this->file .= "|{$d590->CFOP}";
                            $this->file .= "|". number_format($d590->ALIQ_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_OPR, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_BC_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_ICMS, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_BC_ICMS_UF, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_ICMS_UF, 2, ",", "") ."";
                            $this->file .= "|". number_format($d590->VL_RED_BC, 2, ",", "") ."";
                            $this->file .= "|{$d590->COD_OBS}";
                            $this->file .= "|\r\n";
                        }
                    }
                }
            }

            //REGISTRO D990
            $this->file .= "|{$this->blocoD->D990->REG}";
            $this->file .= "|{$this->blocoD->D990->QTD_LIN_D}";
            $this->file .= "|\r\n";
        }

        // BLOCO E
        if( !empty($this->blocoE) ){
            //REGISTRO E001
            $this->file .= "|{$this->blocoE->E001->REG}";
            $this->file .= "|{$this->blocoE->E001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO E100
            if (!empty($this->blocoE->E100)) {
                $this->file .= "|{$this->blocoE->E100->REG}";
                $this->file .= "|{$this->blocoE->E100->DT_INI}";
                $this->file .= "|{$this->blocoE->E100->DT_FIN}";
                $this->file .= "|\r\n";
            }

            //REGISTRO E110
            if (!empty($this->blocoE->E110)) {
                $this->file .= "|{$this->blocoE->E110->REG}";
                $this->file .= "|". number_format($this->blocoE->E110->VL_TOT_DEBITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_AJ_DEBITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_TOT_AJ_DEBITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_ESTORNOS_CRED, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_TOT_CREDITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_AJ_CREDITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_TOT_AJ_CREDITOS, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_ESTORNOS_DEB, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_SLD_CREDOR_ANT, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_SLD_APURADO, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_TOT_DED, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_ICMS_RECOLHER, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->VL_SLD_CREDOR_TRANSPORTAR, 2, ",", "") ."";
                $this->file .= "|". number_format($this->blocoE->E110->DEB_ESP, 2, ",", "") ."";
                $this->file .= "|\r\n";
            }

            //REGISTRO E116
            if (!empty($this->blocoE->E116)) {
                $this->file .= "|{$this->blocoE->E116->REG}";
                $this->file .= "|{$this->blocoE->E116->COD_OR}";
                $this->file .= "|". number_format($this->blocoE->E116->VL_OR, 2, ",", "") ."";
                $this->file .= "|{$this->blocoE->E116->DT_VCTO}";
                $this->file .= "|{$this->blocoE->E116->COD_REC}";
                $this->file .= "|{$this->blocoE->E116->NUM_PROC}";
                $this->file .= "|{$this->blocoE->E116->IND_PROC}";
                $this->file .= "|{$this->blocoE->E116->PROC}";
                $this->file .= "|{$this->blocoE->E116->TXT_COMPL}";
                $this->file .= "|{$this->blocoE->E116->MES_REF}";
                $this->file .= "|\r\n";
            }

            //REGISTRO E200
            if (!empty($this->blocoE->E200)) {
                foreach ($this->blocoE->E200 as $e200) {
                    $this->file .= "|{$e200->REG}";
                    $this->file .= "|{$e200->UF}";
                    $this->file .= "|{$e200->DT_INI}";
                    $this->file .= "|{$e200->DT_FIN}";
                    $this->file .= "|\r\n";

                    //REGISTRO E210
                    if( !empty($e200->E210) ) {
                        foreach ($e200->E210 as $e210) {
                            $this->file .= "|{$e210->REG}";
                            $this->file .= "|{$e210->IND_MOV_ST}";
                            $this->file .= "|". number_format($e210->VL_SLD_CRED_ANT_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_DEVOL_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_RESSARC_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_OUT_CRED_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_AJ_CREDITOS_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_RETENÇAO_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_OUT_DEB_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_AJ_DEBITOS_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_SLD_DEV_ANT_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_DEDUCOES_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_ICMS_RECOL_ST, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->VL_SLD_CRED_ST_TRANSPORTAR, 2, ",", "") ."";
                            $this->file .= "|". number_format($e210->DEB_ESP_ST, 2, ",", "") ."";
                            $this->file .= "|\r\n";
                        }
                    }
                }
            }

            //REGISTRO E990
            $this->file .= "|{$this->blocoE->E990->REG}";
            $this->file .= "|{$this->blocoE->E990->QTD_LIN_E}";
            $this->file .= "|\r\n";
        }

        // BLOCO G
        if( !empty($this->blocoG) ){
            //REGISTRO G001
            $this->file .= "|{$this->blocoG->G001->REG}";
            $this->file .= "|{$this->blocoG->G001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO G990
            $this->file .= "|{$this->blocoG->G990->REG}";
            $this->file .= "|{$this->blocoG->G990->QTD_LIN_G}";
            $this->file .= "|\r\n";
        }

        // BLOCO H
        if( !empty($this->blocoH) ){
            //REGISTRO H001
            $this->file .= "|{$this->blocoH->H001->REG}";
            $this->file .= "|{$this->blocoH->H001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO H005
            if( !empty($this->blocoH->H005) ){
                $this->file .= "|{$this->blocoH->H005->REG}";
                $this->file .= "|{$this->blocoH->H005->DT_INV}";
                $this->file .= "|".number_format($this->blocoH->H005->VL_INV, 2, ",", "")."";
                $this->file .= "|{$this->blocoH->H005->MOT_INV}";
                $this->file .= "|\r\n";
            }

            //REGISTRO H010
            if( !empty($this->blocoH->H010) ) {
                foreach ($this->blocoH->H010 as $h010) {
                    $this->file .= "|{$h010->REG}";
                    $this->file .= "|{$h010->COD_ITEM}";
                    $this->file .= "|{$h010->UNID}";
                    $this->file .= "|" . number_format($h010->QTD, 3, ",", "") . "";
                    $this->file .= "|" . number_format($h010->VL_UNIT, 6, ",", "") . "";
                    $this->file .= "|" . number_format($h010->VL_ITEM, 2, ",", "") . "";
                    $this->file .= "|{$h010->IND_PROP}";
                    $this->file .= "|{$h010->COD_PART}";
                    $this->file .= "|{$h010->TXT_COMPL}";
                    $this->file .= "|{$h010->COD_CTA}";
                    $this->file .= "|{$h010->VL_ITEM_IR}";
                    $this->file .= "|\r\n";
                }
            }

            //REGISTRO H990
            $this->file .= "|{$this->blocoH->H990->REG}";
            $this->file .= "|{$this->blocoH->H990->QTD_LIN_H}";
            $this->file .= "|\r\n";
        }

        // BLOCO K
        if( !empty($this->blocoK) ){
            //REGISTRO K001
            $this->file .= "|{$this->blocoK->K001->REG}";
            $this->file .= "|{$this->blocoK->K001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO K990
            $this->file .= "|{$this->blocoK->K990->REG}";
            $this->file .= "|{$this->blocoK->K990->QTD_LIN_K}";
            $this->file .= "|\r\n";
        }

        // BLOCO 1
        if( !empty($this->bloco1) ){
            //REGISTRO 1001
            $this->file .= "|{$this->bloco1->_1001->REG}";
            $this->file .= "|{$this->bloco1->_1001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO 1010
            if (!empty($this->bloco1->_1010)) {
                $this->file .= "|{$this->bloco1->_1010->REG}";
                $this->file .= "|{$this->bloco1->_1010->IND_EXP}";
                $this->file .= "|{$this->bloco1->_1010->IND_CCRF}";
                $this->file .= "|{$this->bloco1->_1010->IND_COMB}";
                $this->file .= "|{$this->bloco1->_1010->IND_USINA}";
                $this->file .= "|{$this->bloco1->_1010->IND_VA}";
                $this->file .= "|{$this->bloco1->_1010->IND_EE}";
                $this->file .= "|{$this->bloco1->_1010->IND_CART}";
                $this->file .= "|{$this->bloco1->_1010->IND_FORM}";
                $this->file .= "|{$this->bloco1->_1010->IND_AER}";
                $this->file .= "|\r\n";
            }

            //REGISTRO 1990
            $this->file .= "|{$this->bloco1->_1990->REG}";
            $this->file .= "|{$this->bloco1->_1990->QTD_LIN_1}";
            $this->file .= "|\r\n";
        }

        // BLOCO 9
        if( !empty($this->bloco9) ){
            //REGISTRO 9001
            $this->file .= "|{$this->bloco9->_9001->REG}";
            $this->file .= "|{$this->bloco9->_9001->IND_MOV}";
            $this->file .= "|\r\n";

            //REGISTRO 9900
            foreach( $this->bloco9->_9900 as $_9900 ){
                $this->file .= "|{$_9900->REG}";
                $this->file .= "|{$_9900->REG_BLC}";
                $this->file .= "|{$_9900->QTD_REG_BLC}";
                $this->file .= "|\r\n";
            }

            //REGISTRO 9990
            $this->file .= "|{$this->bloco9->_9990->REG}";
            $this->file .= "|{$this->bloco9->_9990->QTD_LIN_9}";
            $this->file .= "|\r\n";
        }

        // REGISTRO 9999
        if( !empty($this->_9999) ){
            $this->file .= "|{$this->_9999->REG}";
            $this->file .= "|{$this->_9999->QTD_LIN}";
            $this->file .= "|\r\n";
        }
    }

    /*
     * Esse metodo faz a impressão do arquivo no formato TXT
     */
    public function printTxt()
    {
        $this->montarEfd();
        header('Content-type: text/plain');
        echo $this->file;
    }

    /*
     * Esse metodo faz o download do TXT
     */
    public function saveTxt()
    {
        $this->montarEfd();
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="EFD-'.date("Y-m-d H-i-s").'.txt"');
        echo $this->file;
    }
}