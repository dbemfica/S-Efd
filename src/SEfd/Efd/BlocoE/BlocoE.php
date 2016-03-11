<?php
namespace SEfd\Efd\BlocoE;

class BlocoE
{
    public $E001;
    public $E990;

    public function addE001(\SEfd\Efd\BlocoE\E001 $e001)
    {
        $this->E001 = $e001;
    }

    /*
     * Essa função monta o registro E990
     */
    public function makeE990()
    {
        $QTD_LIN_E = 1;
        if( !empty($this->E001) ) $QTD_LIN_E++;
        $e990 = new E990();
        $e990->QTD_LIN_E = $QTD_LIN_E;
        $this->E990 = $e990;
    }
}