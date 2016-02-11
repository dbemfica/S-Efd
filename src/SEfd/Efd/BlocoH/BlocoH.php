<?php
namespace SEfd\Efd\BlocoH;

/*
* Inventário Físico
*/
class BlocoH
{
    public $H001;
    public $H005;
    public $H010 = array();
    public $H020;
    public $H990;

    public function addH001(\SEfd\Efd\BlocoH\H001 $H001)
    {
        $this->H001 = $H001;
    }

    public function addH005(\SEfd\Efd\BlocoH\H005 $H005)
    {
        $this->H005 = $H005;
    }

    public function makeH005()
    {
        $VL_INV = 0;
        foreach( $this->H010 as $h010 ){
            $VL_INV += $h010->VL_ITEM;
        }
        $h005 = new H005();
        $h005->DT_INV = date("dmY");
        $h005->VL_INV = $VL_INV;
        $h005->MOT_INV = '01';
        $this->addH005($h005);
    }

    public function addH010(\SEfd\Efd\BlocoH\H010 $H010)
    {
        $this->H010[] = $H010;
    }

    public function addH020(\SEfd\Efd\BlocoH\H020 $H020)
    {
        $this->H020 = $H020;
    }

    /*
     * Essa função monta o registro H990
     */
    public function makeH990()
    {
        $QTD_LIN_H = 1;
        if( !empty($this->H001) ) $QTD_LIN_H++;
        if( !empty($this->H005) ) $QTD_LIN_H++;
        if( !empty($this->H010) ) $QTD_LIN_H += count($this->H010);
        if( !empty($this->H020) ) $QTD_LIN_H++;
        $h990 = new H990();
        $h990->QTD_LIN_H = $QTD_LIN_H;
        $this->H990 = $h990;


    }
}