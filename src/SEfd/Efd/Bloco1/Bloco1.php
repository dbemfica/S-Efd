<?php
namespace SEfd\Efd\Bloco1;

class Bloco1
{
    public $_1001;
    public $_1990;

    public function add1001(\SEfd\Efd\Bloco1\_1001 $_1001)
    {
        $this->_1001 = $_1001;
    }

    /*
     * Essa função monta o registro _1990
     */
    public function make1990()
    {
        $QTD_LIN_1 = 1;
        if( !empty($this->_1001) ) $QTD_LIN_1++;
        $_1990 = new _1990();
        $_1990->QTD_LIN_1 = $QTD_LIN_1;
        $this->_1990 = $_1990;
    }
}