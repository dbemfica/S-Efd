<?php
namespace SEfd\Efd\Bloco0;

/*
* Abertura, Identificação e Referências
*/
class Bloco0
{
    public $_0000;
    public $_0001;
    public $_0005;
    public $_0015;
    public $_0190 = array();
    public $_0200 = array();
    public $_0990;

    public function add0000(\SEfd\Efd\Bloco0\_0000 $_0000)
    {
        $this->_0000 = $_0000;
    }
    public function add0001(\SEfd\Efd\Bloco0\_0001 $_0001)
    {
        $this->_0001 = $_0001;
    }
    public function add0005(\SEfd\Efd\Bloco0\_0005 $_0005)
    {
        $this->_0005 = $_0005;
    }
    public function add0015(\SEfd\Efd\Bloco0\_0015 $_0015)
    {
        $this->_0015 = $_0015;
    }
    public function add0200(\SEfd\Efd\Bloco0\_0200 $_0200)
    {
        $this->_0200[] = $_0200;
    }
    public function add0190(\SEfd\Efd\Bloco0\_0190 $_0190)
    {
        if(!in_array($_0190, $this->_0190)){
            $this->_0190[] = $_0190;
        }
    }

    /*
     * Essa função monta o registro H990
     */
    public function make0990()
    {
        $QTD_LIN_0 = 1;
        if( !empty($this->_0000) ) $QTD_LIN_0++;
        if( !empty($this->_0001) ) $QTD_LIN_0++;
        if( !empty($this->_0005) ) $QTD_LIN_0++;
        $_0990 = new _0990();
        $_0990->QTD_LIN_0 = $QTD_LIN_0;
        $this->_0990 = $_0990;


    }
}