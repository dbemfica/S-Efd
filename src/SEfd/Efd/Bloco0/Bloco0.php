<?php
namespace SEfd\Efd\Bloco0;

use \SEfd\Writer\DocumentoFiscal;
use \SEfd\Writer\Item;
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
    public $_0400 = array();
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
    public function add0190(_0190 $_0190)
    {
        foreach ($this->_0190 as $u) {
            $UNID[] = $u->UNID;
        }
        if(@!in_array($_0190->UNID, $UNID)){
            if ( $this->validate0190($_0190) ) {
                $this->_0190[] = $_0190;
            }
        }
    }
    public function add0200(_0200 $_0200)
    {
        if( $this->validate0200($_0200) ){
            $this->_0200[] = $_0200;
        }
    }
    public function add0400(_0400 $_0400)
    {
        $this->_0400[] = $_0400;
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
    public function make0150(DocumentoFiscal $bloco)
    {
        $_0150 = new _0150();
        $_0150->COD_PART = $bloco->codigoParticipante;
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
        $_0190->UNID = strtoupper($unidade);
        $_0190->DESCR = strtoupper($descricao);
        $this->add0190($_0190);
    }

    /*
     * Essa função monta o registro 0200
     */
    public function make0200(Item $item)
    {
        $_0200 = new _0200();
        $_0200->COD_ITEM = $item->codigoItem;
        $_0200->DESCR_ITEM = $item->descricaoItem;
        $_0200->COD_BARRA = $item->codigoBarra;
        $_0200->COD_ANT_ITEM = $item->codigoAnteriorItem;
        $_0200->UNID_INV = $item->unidade;
        $_0200->TIPO_ITEM = $item->tipoItem;
        $_0200->COD_NCM = $item->codigoNcm;
        $_0200->EX_IPI = $item->codigoExcecaoNcm;
        $_0200->COD_GEN = $item->codigoGeneroItem;
        $_0200->COD_LST = $item->codigoServico;
        $_0200->ALIQ_ICMS = $item->aliquotaIcms;
        $this->add0200($_0200);
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
    public function validate0150(_0150 $_0150)
    {
        //VERIFICA A DUBLICIDADE DO COD_PART
        foreach ($this->_0150 as $registro) {
            $COD_PART[] = $registro->COD_PART;
        }
        if (!empty($COD_PART)) {
            if (in_array($_0150->COD_PART,$COD_PART)) {
                return false;
            }
        }

        if ($_0150->COD_PART == '') {
            throw new \InvalidArgumentException("O 'codigoParticipante' não pode ser vazio");
        }

        if($_0150->COD_PAIS != 1058 && $_0150->CNPJ != ''){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o CNPJ deve ficar vazio");
        }

        if($_0150->COD_PAIS != 1058 && $_0150->CPF != ''){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o CPF deve ficar vazio");
        }

        if($_0150->COD_PAIS != 1058 && $_0150->COD_MUN != ''){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é diferente de Brasil o codigoMunicipio deve ficar vazio ou com o valor '9999999”.'");
        }

        if($_0150->COD_PAIS == 1058 && $_0150->COD_MUN == ''){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é igual o Brasil o codigoMunicipio não pode ficar vazio");
        }

        if($_0150->COD_PAIS == 1058 && $_0150->CNPJ == '' && $_0150->CPF == ''){
            throw new \InvalidArgumentException("Quando o 'codigoPais' é igual o Brasil o CNPJ ou CPF devem ser preenchidos");
        }

        if($_0150->NOME == ''){
            throw new \InvalidArgumentException("O campo Nome deve ser preenchidos");
        }

        if($_0150->END == ''){
            throw new \InvalidArgumentException("O campo Endereco deve ser preenchidos");
        }
        return true;
    }

    /*
     * Esse metodo valida as informações presentes no Registro 0190
     */
    public function validate0190(_0190 $_0190)
    {
        if ( $_0190-UNID == $_0190->DESCR ) {
            throw new \InvalidArgumentException("A Descrição da Unidade não pode ser igual ao seu código");
        }
        return true;
    }

    /*
     * Esse metodo valida as informações presentes no Registro 0200
     */
    public function validate0200(_0200 $_0200)
    {
        //VERIFICA A DUBLICIDADE DO COD_PART
        foreach ($this->_0200 as $registro) {
            $COD_ITEM[] = $registro->COD_ITEM;
        }
        if (!empty($COD_ITEM)) {
            if (in_array($_0200->COD_ITEM,$COD_ITEM)) {
                return false;
            }
        }

        if($_0200->DESCR_ITEM == ''){
            throw new \InvalidArgumentException("A 'descricaoItem' não pode estar vazia");
        }

        if($_0200->UNID_INV == ''){
            throw new \InvalidArgumentException("A 'unidadeInventario' não pode estar vazia");
        }

        if($_0200->TIPO_ITEM == ''){
            throw new \InvalidArgumentException("A 'tipoItem' não pode estar vazia");
        }

        return true;
    }
}