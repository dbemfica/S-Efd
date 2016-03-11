<?php
namespace SEfd\Efd\BlocoC;

class BlocoC
{
    public $C001;
    public $C990;

    public function addC001(\SEfd\Efd\BlocoC\C001 $C001)
    {
        $this->C001 = $C001;
    }

    /*
     * Essa função monta o registro H990
     */
    public function makeC990()
    {
        $QTD_LIN_C = 1;
        if( !empty($this->C001) ) $QTD_LIN_C++;
        $c990 = new C990();
        $c990->QTD_LIN_C = $QTD_LIN_C;
        $this->C990 = $c990;
    }
}