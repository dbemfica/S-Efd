<?php
namespace SEfd\Efd\BlocoG;

class BlocoG
{
    public $G001;
    public $G990;

    public function addG001(\SEfd\Efd\BlocoG\G001 $g001)
    {
        $this->G001 = $g001;
    }

    /*
     * Essa função monta o registro G990
     */
    public function makeG990()
    {
        $QTD_LIN_G = 1;
        if( !empty($this->G001) ) $QTD_LIN_G++;
        $g990 = new G990();
        $g990->QTD_LIN_G = $QTD_LIN_G;
        $this->G990 = $g990;
    }
}