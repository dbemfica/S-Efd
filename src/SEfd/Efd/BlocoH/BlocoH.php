<?php
namespace SEfd\Efd\BlocoH;

/*
* Inventário Físico
*/
use SEfd\Efd\Efd;

class BlocoH
{
    public $H001;
    public $H005;
    public $H010 = array();
    public $H020;
    public $H990;

    public function addH001(H001 $h001)
    {
        $this->H001 = $h001;
    }
    public function addH005(H005 $h005)
    {
        $this->H005 = $h005;
    }
    public function addH010(H010 $h010)
    {
        $this->H010[] = $h010;
    }
    public function addH020(H020 $h020)
    {
        $this->H020 = $h020;
    }

    /*
     * Essa função monta o registro H005
     */
    public function makeH005( $dt_inv = NULL, $mot_inv = NULL )
    {
        if( empty($this->H010[0]) ){
            throw new \Exception("Para usar a 'makeH005' o precisa existir intens no registro H010");
        }
        $VL_INV = 0;
        foreach( $this->H010 as $h010 ){
            $VL_INV += $h010->VL_ITEM;
        }

        $DT_INV = ( $dt_inv !== NULL )? $dt_inv: date("dmY");
        $MOT_INV = ( $mot_inv !== NULL )? $mot_inv: '01';

        $h005 = new H005();
        $h005->DT_INV = $DT_INV;
        $h005->VL_INV = number_format($VL_INV, 2, ".", "");
        $h005->MOT_INV = $MOT_INV;
        $this->addH005($h005);
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

    public function validadeH010(Efd $efd, H010 $h010)
    {
        //VALIDACAO DO IND_PROP
        if ($h010->IND_PROP === 1 || $h010->IND_PROP === 2 && empty($h010->COD_PART)) {
            throw new \InvalidArgumentException("Se indicadorPropriedade for preenchido com valor 1 ou 2 (propriedade de terceiros), o campo codigoParticipante será obrigatório.");
        }
        if ($efd->bloco0->_0000->IND_PERFIL === 'A' || $efd->bloco0->_0000->IND_PERFIL === 'B' ) {
            if ($h010->COD_CTA == '') {
                throw new \InvalidArgumentException("Se Perfil for A ou B o campo 'codigoContaAnaliticaContabel' não pode estar vazio");
            }
        }
        return true;
    }
}