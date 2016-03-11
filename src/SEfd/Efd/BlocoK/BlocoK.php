<?php
namespace SEfd\Efd\BlocoK;

class BlocoK
{
    public $K001;
    public $K990;

    public function addK001(\SEfd\Efd\BlocoK\K001 $k001)
    {
        $this->K001 = $k001;
    }

    /*
     * Essa função monta o registro K990
     */
    public function makeK990()
    {
        $QTD_LIN_K = 1;
        if( !empty($this->K001) ) $QTD_LIN_K++;
        $k990 = new K990();
        $k990->QTD_LIN_K = $QTD_LIN_K;
        $this->K990 = $k990;
    }
}