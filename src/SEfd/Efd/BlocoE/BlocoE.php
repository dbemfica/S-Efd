<?php
namespace SEfd\Efd\BlocoE;

use SEfd\Efd\Efd;
use SEfd\Efd\Tabelas\TReceitasRecolher;

class BlocoE
{
    public $E001;
    public $E100;
    public $E110;
    public $E116;
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
        $e990 = new E990();
        $e990->QTD_LIN_E = $QTD_LIN_E;
        $this->E990 = $e990;
    }

    /*
     * Essa função monta o registro E100
     */
    public function makeE100($DT_INI, $DT_FIN)
    {
        $e100 = new E100();
        $e100->DT_INI = $DT_INI;
        $e100->DT_FIN = $DT_FIN;
        $this->addE100($e100);
    }

    /*
     * Essa função monta o registro E110
     */
    public function makeE110(Efd $efd)
    {
        $e110 = new E110();

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_TOT_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $VL_TOT_DEBITOS = array();

        //BLOCO D - D590
        if (!empty($efd->blocoD->D500)) {
            foreach ($efd->blocoD->D500 as $d500) {
                if (!empty($d500->D590)) {
                    foreach ($d500->D590 as $d590) {
                        $VL_TOT_DEBITOS[] = $d590->VL_ICMS;
                    }
                }
            }
        }
        $e110->VL_TOT_DEBITOS = array_sum($VL_TOT_DEBITOS);

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_AJ_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_AJ_DEBITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_TOT_AJ_DEBITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_AJ_DEBITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_ESTORNOS_CRED
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ESTORNOS_CRED = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_TOT_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_CREDITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_AJ_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_AJ_CREDITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_TOT_AJ_CREDITOS
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_AJ_CREDITOS = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_ESTORNOS_DEB
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ESTORNOS_DEB = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_SLD_CREDOR_ANT
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_SLD_CREDOR_ANT = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_SLD_APURADO
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_SLD_APURADO = $e110->VL_TOT_DEBITOS + ($e110->VL_AJ_DEBITOS + VL_TOT_AJ_DEBITOS) + $e110->VL_ESTORNOS_CRED;
        $e110->VL_SLD_APURADO -= $e110->VL_TOT_CREDITOS + ($e110->VL_AJ_CREDITOS + $e110->VL_TOT_AJ_CREDITOS) + $e110->VL_ESTORNOS_DEB;
        $e110->VL_SLD_APURADO += $e110->VL_ESTORNOS_DEB + $e110->VL_SLD_CREDOR_ANT;
        if ($e110->VL_SLD_APURADO >= 0) {
            $e110->VL_SLD_CREDOR_TRANSPORTAR = 0;
        }else{
            $e110->VL_SLD_CREDOR_TRANSPORTAR = $e110->VL_SLD_APURADO;
            $e110->VL_SLD_APURADO = 0;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_TOT_DED
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_TOT_DED = 0;

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //VL_ICMS_RECOLHER
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        $e110->VL_ICMS_RECOLHER = $e110->VL_SLD_APURADO - $e110->VL_TOT_DED;
        if ($e110->VL_ICMS_RECOLHER < 0) {
            $e110->VL_ICMS_RECOLHER = 0;
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        //DEB_ESP
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
//        if ($efd->blocoD->D500->codigoObrigacoesICMS != '') {
//            $COD_REC = $efd->blocoD->D500->codigoObrigacoesICMS;
//        }

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