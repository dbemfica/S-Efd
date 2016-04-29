<?php
namespace SEfd\Efd\BlocoE;

use SEfd\Efd\Efd;
use SEfd\Efd\Tabelas\TCodMunicipio;
use SEfd\Efd\Tabelas\TReceitasRecolher;

class BlocoE
{
    public $E001;
    public $E100;
    public $E110;
    public $E116;
    public $E200 = array();
    public $E990;

    public function addE001(E001 $e001)
    {
        $this->E001 = $e001;
    }
    public function addE100(E100 $e100)
    {
        $this->E100 = $e100;
    }
    public function addE110(E110 $e110)
    {
        $this->E110 = $e110;
    }
    public function addE116(E116 $e116)
    {
        $this->E116 = $e116;
    }
    public function addE200(E200 $e200)
    {
        $this->E200[] = $e200;
    }
    public function addE210(E210 $e210)
    {
        $this->E200[(count( $this->E200)-1)]->E210[] = $e210;
    }
    public function addE220(E220 $e220)
    {
        $this->E200[(count( $this->E200)-1)]->E210[count($this->E200[(count( $this->E200)-1)]->E210)]->E220[] = $e220;
    }

    /*
     * Essa função monta o registro E100
     */
    public function makeE100(Efd $efd)
    {
        $bloco0 = $efd->bloco0;

        $e100 = new E100();
        $e100->DT_INI = $bloco0->_0000->DT_INI;
        $e100->DT_FIN = $bloco0->_0000->DT_FIN;
        $this->addE100($e100);
        $this->makeE110($efd);
        return true;
    }

    /*
     * Essa função monta o registro E110
     */
    public function makeE110(Efd $efd)
    {
        $e110 = new E110();

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //02 - VL_TOT_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_TOT_DEBITOS = 0;

        //BLOCO C - C100
        if (!empty($efd->blocoC->C100)) {
            foreach ($efd->blocoC->C100 as $c100) {
                if ( $c100->IND_OPER === 1 && ($c100->COD_SIT != '01' && $c100->COD_SIT != '07') ) {
                    if (!empty($c100->C190)) {
                        foreach ($c100->C190 as $c190) {
                            if( $c190->CFOP != '5605' ){
                                $VL_TOT_DEBITOS += $c190->VL_OPR;
                                break;
                            }
                        }
                    }
                }
            }
        }

        //BLOCO D - D500
        if (!empty($efd->blocoD->D500)) {
            foreach ($efd->blocoD->D500 as $d500) {
                if ( $d500->IND_OPER === 1 && ($d500->COD_SIT != '01' && $d500->COD_SIT != '07') ) {
                    if (!empty($d500->D590)) {
                        foreach ($d500->D590 as $d590) {
                            if( $d590->CFOP != '5605' ){
                                $VL_TOT_DEBITOS += $d590->VL_OPR;
                                break;
                            }
                        }
                    }
                }
            }
        }

        $e110->VL_TOT_DEBITOS = $VL_TOT_DEBITOS;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //03 - VL_AJ_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_AJ_DEBITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //04 - VL_TOT_AJ_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_AJ_DEBITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //05 - VL_ESTORNOS_CRED
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ESTORNOS_CRED = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //06 - VL_TOT_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_TOT_CREDITOS = 0;

        //BLOCO C - C100
        if (!empty($efd->blocoC->C100)) {
            foreach ($efd->blocoC->C100 as $c100) {
                if ( $c100->IND_OPER === 0 && $c100->COD_SIT != '01' && $c100->COD_SIT != '07' ) {
                    if (!empty($c100->C190)) {
                        foreach ($c100->C190 as $c190) {
                            if( substr($c190->CFOP,0,1) == '1' || substr($c190->CFOP,0,1) == '2' || substr($c190->CFOP,0,1) == '3' && $c190->CFOP != '1605' ){
                                $VL_TOT_CREDITOS += $c190->VL_ICMS;
                            }
                        }
                    }
                }
            }
        }

        //BLOCO D - D500
        if (!empty($efd->blocoD->D500)) {
            foreach ($efd->blocoD->D500 as $d500) {
                if ( $d500->IND_OPER === 0 && ($d500->COD_SIT != '01' && $d500->COD_SIT != '07') ) {
                    if (!empty($d500->D590)) {
                        foreach ($d500->D590 as $d590) {
                            if( (substr($d590->CFOP,0,1) == '1' || substr($d590->CFOP,0,1) == '2' || substr($d590->CFOP,0,1) == '3') && ($d590->CFOP != '5605' && $d590->CFOP != '1605') ){
                                $VL_TOT_CREDITOS += $d590->VL_ICMS;
                            }
                        }
                    }
                }
            }
        }

        $e110->VL_TOT_CREDITOS = $VL_TOT_CREDITOS;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //07 - VL_AJ_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_AJ_CREDITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //08 - VL_TOT_AJ_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_AJ_CREDITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //09 - VL_ESTORNOS_DEB
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ESTORNOS_DEB = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //10 - VL_SLD_CREDOR_ANT
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_SLD_CREDOR_ANT = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //11 - VL_SLD_APURADO
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $espressao = ($e110->VL_TOT_DEBITOS + $e110->VL_AJ_DEBITOS + $e110->VL_TOT_AJ_DEBITOS + $e110->VL_ESTORNOS_CRED - $e110->VL_TOT_CREDITOS - $e110->VL_AJ_CREDITOS - $e110->VL_TOT_AJ_CREDITOS - $e110->VL_ESTORNOS_DEB - $e110->VL_SLD_CREDOR_ANT );

        if ( $espressao >= 0 ) {
            $e110->VL_SLD_APURADO = $espressao;
        }else{
            $e110->VL_SLD_APURADO = 0;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //12 - VL_TOT_DED
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_DED = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //13 - VL_ICMS_RECOLHER
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ICMS_RECOLHER = $e110->VL_SLD_APURADO - $e110->VL_TOT_DED;
        if ($e110->VL_ICMS_RECOLHER < 0) {
            $e110->VL_ICMS_RECOLHER = 0;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //14 - VL_SLD_CREDOR_TRANSPORTAR
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $espressao = ($e110->VL_TOT_DEBITOS + $e110->VL_AJ_DEBITOS + $e110->VL_TOT_AJ_DEBITOS + $e110->VL_ESTORNOS_CRED - $e110->VL_TOT_CREDITOS - $e110->VL_AJ_CREDITOS - $e110->VL_TOT_AJ_CREDITOS - $e110->VL_ESTORNOS_DEB - $e110->VL_SLD_CREDOR_ANT );

        if ( $espressao > 0 ) {
            $e110->VL_SLD_CREDOR_TRANSPORTAR = 0;
        }else{
            $e110->VL_SLD_CREDOR_TRANSPORTAR = $espressao*-1;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //15 - DEB_ESP
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->DEB_ESP = 0;

        $this->addE110($e110);
    }

    /*
     * Essa função monta o registro E116
     */
    public function makeE116(Efd $efd, $COD_OR = '000', $DT_VCTO = NULL, $MES_REF = NULL)
    {
        if ($DT_VCTO === NULL) {
            $DT_VCTO = $efd->bloco0->_0000->DT_FIN;
        }
        if ($MES_REF === NULL) {
            $MES_REF = substr($efd->bloco0->_0000->DT_FIN,2,6);
        }
        if ($efd->blocoD->D500->codigoObrigacoesICMS != '') {
            $COD_REC = $efd->blocoD->D500->codigoObrigacoesICMS;
        }

        $e116 = new E116();
        $e116->COD_OR = $COD_OR;
        $e116->VL_OR = $efd->blocoE->E110->VL_ICMS_RECOLHER + $efd->blocoE->E110->DEB_ESP;
        $e116->DT_VCTO = $DT_VCTO;
        $e116->COD_REC = NULL;
        $e116->NUM_PROC = NULL;
        $e116->IND_PROC = NULL;
        $e116->PROC = NULL;
        $e116->TXT_COMPL = NULL;
        $e116->MES_REF = $MES_REF;

        if($this->validadeE116($efd, $e116)){
            $this->addE116($e116);
        }
    }

    /*
     * Essa função monta o registro E200
     */
    public function makeE200(Efd $efd)
    {
        $bloco0 = $efd->bloco0;
        $blocoC = $efd->blocoC;

        if ( !empty($blocoC->C100) ) {
            foreach ($blocoC->C100 as $c100) {
                $codParticipanete = $c100->COD_PART;

                foreach ( $bloco0->_0150 as $_0150 ) {
                    if ( $_0150->COD_PART == $codParticipanete ) {
                        $codMunicipio = $_0150->COD_MUN;
                        break;
                    }
                }

                $municipio = TCodMunicipio::buscaMunicipio($codMunicipio);
                $uf = $municipio['uf'];

                $vetor[$uf]['DT_INI'] = $bloco0->_0000->DT_INI;
                $vetor[$uf]['DT_FIN'] = $bloco0->_0000->DT_FIN;
            }
        }
        if ( !empty($vetor) ) {
            foreach ( $vetor as $uf => $valor ) {
                $e200 = new E200();
                $e200->UF = $uf;
                $e200->DT_INI = $valor['DT_INI'];
                $e200->DT_FIN = $valor['DT_FIN'];
                $this->addE200($e200);
                $this->makeE210($efd, $e200);
            }
            return true;
        }
        return false;
    }

    /*
     * Essa função monta o registro E210
     */
    public function makeE210(Efd $efd, E200 $e200)
    {
        $bloco0 = $efd->bloco0;
        $blocoC = $efd->blocoC;
        $vC190 = array();

        if ( !empty($blocoC->C100) ) {
            foreach ($blocoC->C100 as $c100) {
                $codParticipanete = $c100->COD_PART;
                foreach ( $bloco0->_0150 as $_0150 ) {
                    if ( $_0150->COD_PART == $codParticipanete ) {
                        $codMunicipio = $_0150->COD_MUN;
                        break;
                    }
                }
                $municipio = TCodMunicipio::buscaMunicipio($codMunicipio);

                if ( $e200->UF == $municipio['uf'] ) {
                    foreach ( $c100->C190 as $c190 ) {
                        $vC190[] = $c190;
                    }
                }
            }
        }

        $e210 = new E210();
        $e210->IND_MOV_ST = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //04 - VL_DEVOL_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_DEVOL_ST = 0;
        if ( !empty($vC190) ) {
            foreach ( $vC190 as $c190 ) {
                switch ($c190->CFOP) {
                    case "1410":
                    case "1411":
                    case "1414":
                    case "1415":
                    case "1660":
                    case "1661":
                    case "1662":
                    case "2410":
                    case "2411":
                    case "2414":
                    case "2415":
                    case "2660":
                    case "2661":
                    case "2662":
                        $VL_DEVOL_ST += $c190->VL_ICMS_ST;
                        break;
                }
            }
        }
        $e210->VL_DEVOL_ST = $VL_DEVOL_ST;

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //05 - VL_RESSARC_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_RESSARC_ST = 0;
        if ( !empty($vC190) ) {
            foreach ( $vC190 as $c190 ) {
                switch ($c190->CFOP) {
                    case "1603":
                    case "2603":
                        $VL_RESSARC_ST += $c190->VL_ICMS_ST;
                        break;
                }
            }
        }
        $e210->VL_RESSARC_ST = $VL_RESSARC_ST;

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //06 - VL_OUT_CRED_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_OUT_CRED_ST = 0;
        if ( !empty($vC190) ) {
            foreach ( $vC190 as $c190 ) {
                $cfop = substr($c190->CFOP,0,1);
                switch ($cfop) {
                    case 1:
                    case 2:
                        if ( $c190->CFOP != '1410' &&
                            $c190->CFOP != '1411' &&
                            $c190->CFOP != '1414' &&
                            $c190->CFOP != '1415' &&
                            $c190->CFOP != '1660' &&
                            $c190->CFOP != '1661' &&
                            $c190->CFOP != '1662' &&
                            $c190->CFOP != '2410' &&
                            $c190->CFOP != '2411' &&
                            $c190->CFOP != '2414' &&
                            $c190->CFOP != '2415' &&
                            $c190->CFOP != '2660' &&
                            $c190->CFOP != '2661' &&
                            $c190->CFOP != '2662') {

                            $VL_OUT_CRED_ST += $c190->VL_ICMS_ST;
                        }
                        break;
                }
            }
        }
        $e210->VL_OUT_CRED_ST = $VL_OUT_CRED_ST;

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //07 - VL_OUT_CRED_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_AJ_CREDITOS_ST = 0;
        $e210->VL_AJ_CREDITOS_ST = $VL_AJ_CREDITOS_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //08 - VL_RETENÇAO_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_RETENCAO_ST = 0;
        $e210->VL_RETENCAO_ST = $VL_RETENCAO_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //09 - VL_OUT_DEB_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_OUT_DEB_ST = 0;
        $e210->VL_OUT_DEB_ST = $VL_OUT_DEB_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //10 - VL_AJ_DEBITOS_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_AJ_DEBITOS_ST = 0;
        $e210->VL_AJ_DEBITOS_ST = $VL_AJ_DEBITOS_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //11 - VL_SLD_DEV_ANT_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_SLD_DEV_ANT_ST = 0;
        $e210->VL_SLD_DEV_ANT_ST = $VL_SLD_DEV_ANT_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //12 - VL_DEDUÇÕES_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_DEDUCOES_ST = 0;
        $e210->VL_DEDUCOES_ST = $VL_DEDUCOES_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //13 - VL_ICMS_RECOL_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_ICMS_RECOL_ST = 0;
        $e210->VL_ICMS_RECOL_ST = $VL_ICMS_RECOL_ST;


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //14 - VL_ICMS_RECOL_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_SLD_CRED_ST_TRANSPORTAR = 0;
        $e210->VL_SLD_CRED_ST_TRANSPORTAR = $VL_SLD_CRED_ST_TRANSPORTAR;

        $espressao = ($e210->VL_RETENCAO_ST + $e210->VL_OUT_DEB_ST + $e210->VL_AJ_DEBITOS_ST - $e210->VL_SLD_CRED_ANT_ST - $e210->VL_DEVOL_ST - $e210->VL_RESSARC_ST - $e210->VL_OUT_CRED_ST - $e210->VL_AJ_CREDITOS_ST );

        if ( $espressao >= 0 ) {
            $e210->VL_SLD_CRED_ST_TRANSPORTAR = 0;
        }else{
            $e210->VL_SLD_CRED_ST_TRANSPORTAR = $espressao*-1;
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //15 - DEB_ESP_ST
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $DEB_ESP_ST = 0;
        $e210->DEB_ESP_ST = $DEB_ESP_ST;


        $this->addE210($e210);
    }

    /*
     * Essa função monta o registro E220
     */
    public function makeE220(Efd $efd)
    {
        $bloco0 = $efd->bloco0;

        $e220 = new E220();
        $e220->COD_AJ_APUR = $bloco0->_0000->DT_INI;
        $e220->DESCR_COMPL_AJ = "";
        $e220->VL_AJ_APUR = "";
        $this->addE220($e220);
    }

    /*
     * Essa função monta o registro E990
     */
    public function makeE990()
    {
        $QTD_LIN_E = 1;
        if( !empty($this->E001) ) $QTD_LIN_E++;
        if( !empty($this->E100) ) $QTD_LIN_E++;
        if( !empty($this->E110) ) $QTD_LIN_E++;
        if( !empty($this->E116) ) $QTD_LIN_E++;
        if( !empty($this->E200) ){
            $QTD_LIN_E += count($this->E200);
            for( $i = 0; $i < count($this->E200); $i++ ){
                $QTD_LIN_E += count($this->E200[$i]->E210);
            }
        }
        $e990 = new E990();
        $e990->QTD_LIN_E = $QTD_LIN_E;
        $this->E990 = $e990;
    }

    /*
     * Essa função valida o registro E116
     */
    private function validadeE116(Efd $efd, E116 $e116)
    {
        if ($e116->NUM_PROC != '') {
            if ($e116->IND_PROC == '') {
                throw new \InvalidArgumentException("O campo 'IND_PROC' não pode estar vazio");
            }
            if ($e116->PROC == '') {
                throw new \InvalidArgumentException("O campo 'PROC' não pode estar vazio");
            }
        }
//        if (!TReceitasRecolher::isCodigo($efd->bloco0->_0000->UF, $e116->COD_REC)) {
//            throw new \InvalidArgumentException("O campo 'COD_REC' está com um valor invalido");
//        }
        return true;
    }
}