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
    public $_0100;
    public $_0150 = array();
    public $_0190 = array();
    public $_0200 = array();
    public $_0450 = array();
    public $_0460 = array();
    public $_0990;


    public function add0000(_0000 $_0000)
    {
        $this->_0000 = $_0000;
    }
    public function add0001(_0001 $_0001)
    {
        $this->_0001 = $_0001;
    }
    public function add0005(_0005 $_0005)
    {
        $this->_0005 = $_0005;
    }
    public function add0015(_0015 $_0015)
    {
        $this->_0015 = $_0015;
    }
    public function add0100(_0100 $_0100)
    {
        $this->_0100 = $_0100;
    }
    public function add0150(_0150 $_0150)
    {
        if( $this->validate0150($_0150) ){
            $this->_0150[] = $_0150;
        }
    }
    public function add0200(_0200 $_0200)
    {
        $this->_0200[] = $_0200;
    }
    public function add0190(_0190 $_0190)
    {
        if(!in_array($_0190, $this->_0190)){
            $this->_0190[] = $_0190;
        }
    }
    public function add0450(_0450 $_0450)
    {
        $this->_0450[] = $_0450;
    }
    public function add0460(_0460 $_0460)
    {
        $this->_0460[] = $_0460;
    }

    /*
     * Essa função monta o registro 0150
     */
    public function make0150(\SEfd\Writer\DocumentoFiscal $bloco)
    {
        $_0150 = new _0150();
        $_0150->COD_PART = $bloco->codigoParticipanete;
        $_0150->NOME = $bloco->nome;
        $_0150->COD_PAIS = $bloco->codigoPais;
        $_0150->CNPJ = $bloco->CNPJ;
        $_0150->CPF = $bloco->CPF;
        $_0150->CPF = $bloco->CPF;
        $_0150->IE = $bloco->inscricaoEstadual;
        $_0150->COD_MUN = $bloco->codigoMunicipio;
        $_0150->COD_MUN = $bloco->codigoMunicipio;
        $_0150->SUFRAMA = $bloco->suframa;
        $_0150->END = $bloco->endereco;
        $_0150->NUM = $bloco->numero;
        $_0150->COMPL = $bloco->completo;
        $_0150->BAIRRO = $bloco->bairro;
        $this->add0150($_0150);
    }

    /*
     * Essa função monta o registro 0190
     */
    public function make0190($unidade, $descricao)
    {
        if(empty($unidade) ){
            throw new \InvalidArgumentException("O unidade não pode estar vazio");
        }

        $_0190 = new _0190();
        $_0190->UNID = $unidade;
        $_0190->DESCR = $descricao;
        $this->add0190($_0190);
    }

    /*
     * Essa função monta o registro 0450
     */
    public function make0450($codigo, $descricao)
    {
        if(empty($codigo) ){
            throw new \InvalidArgumentException("O COD_INF não pode estar vazio");
        }

        $_0450 = new _0450();
        $_0450->COD_INF = $codigo;
        $_0450->TXT = $descricao;
        $this->add0450($_0450);
    }

    /*
     * Essa função monta o registro 0460
     */
    public function make0460($codigo = NULL, $descricao)
    {
        if( empty($codigo) ){
            $codigo = count($this->_0460)+1;
        }
        $_0460 = new _0460();
        $_0460->COD_OBS = $codigo;
        $_0460->TXT = $descricao;
        $this->add0460($_0460);
        return $codigo;
    }

    /*
     * Essa função monta o registro 0990
     */
    public function make0990()
    {
        $QTD_LIN_0 = 1;
        if( !empty($this->_0000) ) $QTD_LIN_0++;
        if( !empty($this->_0001) ) $QTD_LIN_0++;
        if( !empty($this->_0005) ) $QTD_LIN_0++;
        if( !empty($this->_0015) ) $QTD_LIN_0++;
        if( !empty($this->_0100) ) $QTD_LIN_0++;
        if( !empty($this->_0150) ) $QTD_LIN_0 += count($this->_0150);
        if( !empty($this->_0190) ) $QTD_LIN_0 += count($this->_0190);
        if( !empty($this->_0200) ) $QTD_LIN_0 += count($this->_0200);
        if( !empty($this->_0450) ) $QTD_LIN_0 += count($this->_0450);
        if( !empty($this->_0460) ) $QTD_LIN_0 += count($this->_0460);

        $_0990 = new _0990();
        $_0990->QTD_LIN_0 = $QTD_LIN_0;
        $this->_0990 = $_0990;


    }

    /*
     * Esse metodo valida as informações presentes no Registro 0150
     */
    public function validate0150(_0150 $_0510)
    {
        if( $_0510->COD_PAIS != 1058 && !empty($_0510->CNPJ) ){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o CNPJ deve ficar vazio");
        }

        if( $_0510->COD_PAIS != 1058 && !empty($_0510->CPF) ){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o CPF deve ficar vazio");
        }

        if( $_0510->COD_PAIS != 1058 && !empty($_0510->COD_MUN) ){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o codigoMunicipio deve ficar vazio ou com o valor '9999999”.'");
        }
        return true;
    }
}