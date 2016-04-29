<?php
namespace SEfd\Efd\Bloco1;

use \SEfd\Efd\Efd;

class Bloco1
{
    public $_1001;
    public $_1010;
    public $_1990;

    public function add1001(_1001 $_1001)
    {
        $this->_1001 = $_1001;
    }
    public function add1010(_1010 $_1010)
    {
        $this->_1010 = $_1010;
    }
    public function add1990(_1990 $_1990)
    {
        $this->_1990 = $_1990;
    }

    /*
     * Essa função monta o registro _1990
     */
    public function make1010(Efd $efd)
    {;
        $_1010 = new _1010();
        $_1010->IND_EXP = 'N';
        $_1010->IND_CCRF = 'N';
        $_1010->IND_COMB = 'N';
        $_1010->IND_USINA = 'N';
        $_1010->IND_VA = 'N';
        $_1010->IND_EE = 'N';
        $_1010->IND_CART = 'N';
        $_1010->IND_FORM = 'N';
        $_1010->IND_AER = 'N';
        $this->add1010($_1010);
    }

    /*
     * Essa função monta o registro _1990
     */
    public function make1990()
    {
        $QTD_LIN_1 = 1;
        if( !empty($this->_1001) ) $QTD_LIN_1++;
        if( !empty($this->_1010) ) $QTD_LIN_1++;
        $_1990 = new _1990();
        $_1990->QTD_LIN_1 = $QTD_LIN_1;
        $this->add1990($_1990);
    }
}