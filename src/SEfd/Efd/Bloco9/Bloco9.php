<?php
namespace SEfd\Efd\Bloco9;

class Bloco9
{
    public $_9001;
    public $_9900 = array();
    public $_9990;

    public function add9001(_9001 $_9001)
    {
        $this->_9001 = $_9001;
    }

    public function add9900(_9900 $_9900)
    {
        $this->_9900[] = $_9900;
    }

    /*
     * Essa função monta o registro _9990
     */
    public function make9990()
    {
        $QTD_LIN_9 = 2;
        if( !empty($this->_9001) ) $QTD_LIN_9++;
        if( !empty($this->_9900) ) $QTD_LIN_9 += count($this->_9900);
        $_9990 = new _9990();
        $_9990->QTD_LIN_9 = $QTD_LIN_9;
        $this->_9990 = $_9990;
    }
}