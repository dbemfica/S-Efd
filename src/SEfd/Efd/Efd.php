<?php
namespace SEfd\Efd;

class Efd
{
    public $bloco0;
    private $blocoC;
    private $blocoD;
    private $blocoE;
    private $blocoG;
    private $blocoH;
    private $blocoK;
    private $bloco1;
    private $bloco9;
    private $_9999;
    private $file;

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
        $bloco0->add0000($_0000);

        $_0001 = new \SEfd\Efd\Bloco0\_0001();
        $_0001->IND_MOV = 0;
        $bloco0->add0001($_0001);

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
        $bloco0->add0005($_0005);

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
        $bloco0->add0100($_0100);

        $this->bloco0 = $bloco0;
    }

    /*
     * Esse metodo cria o Bloco C
     */
    private function makeBlocoC(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoC) ){
            $blocoC = new \SEfd\Efd\BlocoC\BlocoC();

            $c001 = new \SEfd\Efd\BlocoC\C001();
            $c001->IND_MOV = 1;
            $blocoC->addC001($c001);

            $blocoC->makeC990();
            $this->blocoC = $blocoC;

        }
    }

    /*
     * Esse metodo cria o Bloco D
     */
    private function makeBlocoD(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoD) ){
            $blocoD = new \SEfd\Efd\BlocoD\BlocoD();

            $d001 = new \SEfd\Efd\BlocoD\D001();
            $d001->IND_MOV = 1;
            $blocoD->addD001($d001);

            $blocoD->makeD990();
            $this->blocoD = $blocoD;

        }else{
            $blocoD = new \SEfd\Efd\BlocoD\BlocoD();

            $d001 = new \SEfd\Efd\BlocoD\D001();
            $d001->IND_MOV = 0;
            $blocoD->addD001($d001);

            //MODELO
            $blocos = $sefd->blocoD;

            foreach( $blocos as $bloco){
                //MODELO 21
                if( $bloco->codigoModelo == '21' ){
                    $d500 = new \SEfd\Efd\BlocoD\D500();
                    $d500->IND_OPER = $bloco->indicadorOperacao;
                    $d500->IND_EMIT = $bloco->indicadorEmitente;
                    $d500->COD_PART = $bloco->codigoParitcipante;
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
                    try{
                        if( $bloco->codigoInformacaoComplementar != '' ){
                            $this->bloco0->make0450($bloco->codigoInformacaoComplementar, $bloco->informacaoComplementar);
                        }
                        if( $blocoD->validateD500($this, $d500) ){
                            $blocoD->addD500($d500);
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
                                $this->bloco0->make0190($item->unidade, $item->unidadeDescricao);
                            }catch(\Exception $e){
                                exit( $e->getMessage() );
                            }

                            try{
                                if( $item->codigoParticipante != '' ){
                                    $this->bloco0->make0150($bloco);
                                }
                                if( $blocoD->validateD510($this, $d510) ){
                                    $blocoD->addD510($d510);
                                }
                            }catch(\Exception $e){
                                exit( $e->getMessage() );
                            }
                        }
                    }

                    //REGISTRO D590
                    $COD_OBS = $this->bloco0->make0460($bloco->codigoObservacao, $bloco->observacao);
                    $blocoD->makeD590($COD_OBS);
                }
            }

            $blocoD->makeD990();
            $this->blocoD = $blocoD;
        }
    }

    /*
     * Esse metodo cria o Bloco E
     */
    private function makeBlocoE(\SEfd\SEfd $sefd)
    {
        if( empty($sefd->blocoE) ){
            $blocoE = new \SEfd\Efd\BlocoE\BlocoE();

            $e001 = new \SEfd\Efd\BlocoE\E001();
            $e001->IND_MOV = 1;
            $blocoE->addE001($e001);

            $blocoE->makeE990();
            $this->blocoE = $blocoE;

        }
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
            $blocoH = new \SEfd\Efd\BlocoH\BlocoH();

            $h001 = new \SEfd\Efd\BlocoH\H001();
            $h001->IND_MOV = 1;
            $blocoH->addH001($h001);

            $blocoH->makeH990();
            $this->blocoH = $blocoH;

        }else {
            $bloco0 = $this->bloco0;
            $blocoH = new \SEfd\Efd\BlocoH\BlocoH();

            $h001 = new \SEfd\Efd\BlocoH\H001();
            $h001->IND_MOV = 0;
            $blocoH->addH001($h001);

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
                    $blocoH->addH010($h010);
                }catch(\Exception $e){
                    exit( $e->getMessage() );
                }

                $_0200 = new \SEfd\Efd\Bloco0\_0200();
                $_0200->COD_ITEM = $bloco->codigoItem;
                $_0200->DESCR_ITEM = $bloco->textoComplementar;
                $_0200->COD_BARRA = $bloco->codigoBarra;
                $_0200->COD_ANT_ITEM = $bloco->codigoAnteriorItem;
                $_0200->UNID_INV = $bloco->unidadeInventario;
                $_0200->TIPO_ITEM = $bloco->tipoItem;
                $_0200->COD_NCM = $bloco->codigoNcm;
                $_0200->EX_IPI = $bloco->codigoExcecaoNcm;
                $_0200->COD_GEN = $bloco->codigoGeneroItem;
                $_0200->COD_LST = $bloco->codigoServico;
                $_0200->ALIQ_ICMS = $bloco->aliquotaIcms;
                $bloco0->add0200($_0200);

                $bloco0->make0990();
                $this->bloco0 = $bloco0;
            }

            try{
                $bloco0->make0190($bloco->unidade, $bloco->unidadeDescricao);
            }catch(\Exception $e){
                exit( $e->getMessage() );
            }

            try{
                $blocoH->makeH005(null, $sefd->motivoInventario);
            }catch(\Exception $e){
                exit( $e->getMessage() );
            }

            try{
                $blocoH->makeH990();
            }catch(\Exception $e){
                exit( $e->getMessage() );
            }
            $this->blocoH = $blocoH;
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
            $bloco1 = new \SEfd\Efd\Bloco1\Bloco1();

            $_1001 = new \SEfd\Efd\Bloco1\_1001();
            $_1001->IND_MOV = 1;
            $bloco1->add1001($_1001);

            $bloco1->make1990();
            $this->bloco1 = $bloco1;

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
        $blocos = get_object_vars($this);
        unset($blocos['file']);
        foreach( $blocos as $bloco ){
            if( !empty($bloco) ){
                foreach( $bloco as $chave => $registro ){
                    if( !empty($registro) ){
                        if( is_object($registro) ){
                            $_9900 = new \SEfd\Efd\Bloco9\_9900();
                            $_9900->REG_BLC = $registro->REG;
                            $_9900->QTD_REG_BLC = count($registro);
                            $bloco9->add9900($_9900);
                        }
                        if( is_array($registro) ){
                            $_9900 = new \SEfd\Efd\Bloco9\_9900();
                            $_9900->REG_BLC = $registro[0]->REG;
                            $_9900->QTD_REG_BLC = count($registro);
                            $bloco9->add9900($_9900);
                        }
                    }
                }
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
//        $blocos = get_object_vars($this);
//        unset($blocos['file']);
//        $QTD_LIN = 1;
//        foreach( $blocos as $bloco ){
//            if( !empty($bloco) ){
//                foreach( $bloco as $chave => $registro ){
//                    if( !empty($registro) ){
//                        if( is_object($registro) ){
//                            $QTD_LIN++;
//                        }
//                        if( is_array($registro) ){
//                            $QTD_LIN += count($registro);
//                        }
//                    }
//                }
//            }
//        }
        echo "<pre>";
        $QTD_LIN = 0;
        //BLOCO 0
        foreach( $this->bloco0 as $bloco ){
            print_r($bloco);
            $QTD_LIN++;
        }

        $_9999 = new \SEfd\Efd\_9999();
        $_9999->QTD_LIN = $QTD_LIN;
        print_r($_9999);
        echo "</pre>";
        exit();
        $this->_9999 = $_9999;
    }

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
        if( !empty($this->blocoH) ){
            //REGISTRO C001
            $this->file .= "|{$this->blocoC->C001->REG}";
            $this->file .= "|{$this->blocoC->C001->IND_MOV}";
            $this->file .= "|\r\n";

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
}