<?php
namespace SEfd\Efd\BlocoE;

use SEfd\Efd\Efd;

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
}