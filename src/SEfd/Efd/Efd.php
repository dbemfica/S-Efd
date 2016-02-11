<?php
namespace SEfd\Efd;

use SEfd\Efd\Bloco0\_0000;
use SEfd\Efd\Bloco0\_0001;
use SEfd\Efd\Bloco0\Bloco0;

class Efd
{
    private $bloco0;
    private $blocoH;
    private $file;

    public function addBloco0(\SEfd\Efd\Bloco0\Bloco0 $bloco0)
    {
        $this->bloco0 = $bloco0;
    }

    public function makeBloco0(\SEfd\SEfd $sefd)
    {
        //MONTA AS DATA INICIAL E FINAL
        $mes = substr($sefd->periodoInformacao,0,2);
        $ano = substr($sefd->periodoInformacao,2,4);
        $DT_INI = '01'.$mes.$ano;
        $DT_FIN = cal_days_in_month(CAL_GREGORIAN, (int)$mes, (int)$ano).$mes.$ano;

        $_0000 = new _0000();
        $_0000->COD_VER = $sefd->versaoLeiaute;
        $_0000->COD_FIN = $sefd->codigoFinalidade;
        $_0000->DT_INI = $DT_INI;
        $_0000->DT_FIN = $DT_FIN;
        $_0000->NOME = $sefd->nomeEntidade;
        $_0000->CNPJ = $sefd->cnpjEntidade;
        $_0000->CPF = $sefd->cpfEntidade;
        $_0000->UF = $sefd->ufEntidade;
        $_0000->IE = $sefd->ieEntidade;
        $_0000->COD_MUN = $sefd->codMunEntidade;
        $_0000->IM = $sefd->imEntidade;
        $_0000->SUFRAMA = $sefd->suframaEntidade;
        $_0000->IND_PERFIL = $sefd->indentificacaoPerfil;
        $_0000->IND_ATIV = $sefd->indicadorAtividade;

        $_0001 = new _0001();
        $_0001->IND_MOV = $sefd->indicadorMovimento;


        $bloco0 = new Bloco0();
        $bloco0->add0000($_0000);
        $bloco0->add0001($_0001);
        $bloco0->make0990();
        $this->addBloco0($bloco0);
    }

    public function addBlocoH(\SEfd\Efd\BlocoH\BlocoH $blocoH)
    {
        $this->blocoH = $blocoH;
        if( empty($this->blocoH->H005) ){
            $this->blocoH->makeH005();
        }
        $this->blocoH->makeH990();
    }

    public function montar()
    {
        if( !empty($this->bloco0) ){
            $this->file .= "|{$this->bloco0->_0000->REG}";
            $this->file .= "|{$this->bloco0->_0000->COD_VER}";
            $this->file .= "|{$this->bloco0->_0000->COD_FIN}";
            $this->file .= "|{$this->bloco0->_0000->DT_INI}";
            $this->file .= "|{$this->bloco0->_0000->DT_FIN}";
            $this->file .= "|{$this->bloco0->_0000->NOME}";
            $this->file .= "|{$this->bloco0->_0000->CNPJ}";
            $this->file .= "|{$this->bloco0->_0000->CPF}";
            $this->file .= "|{$this->bloco0->_0000->UF}";
            $this->file .= "|{$this->bloco0->_0000->IE}";
            $this->file .= "|{$this->bloco0->_0000->COD_MUN}";
            $this->file .= "|{$this->bloco0->_0000->IM}";
            $this->file .= "|{$this->bloco0->_0000->SUFRAMA}";
            $this->file .= "|{$this->bloco0->_0000->IND_PERFIL}";
            $this->file .= "|{$this->bloco0->_0000->IND_ATIV}";
            $this->file .= "|\r\n";

            $this->file .= "|{$this->bloco0->_0001->REG}";
            $this->file .= "|{$this->bloco0->_0001->IND_MOV}";
            $this->file .= "|\r\n";

            $this->file .= "|{$this->bloco0->_0990->REG}";
            $this->file .= "|{$this->bloco0->_0990->QTD_LIN_0}";
            $this->file .= "|\r\n";


            //$this->file .= "|{$this->bloco0->_0001->REG}|{$this->bloco0->_0001->IND_MOV}|\r\n";
            //$this->file .= "|{$this->bloco0->_0001->REG}|{$this->bloco0->_0001->IND_MOV}|\r\n";
            //$this->file .= "|{$this->bloco0->_0005->REG}|{$this->bloco0->_0005->FANTASIA}|\r\n";
        }
        /*
        if( !empty($this->blocoH) ){
            $this->file .= "|{$this->blocoH->H001->REG}|{$this->blocoH->H001->IND_MOV}|\r\n";
            $this->file .= "|{$this->blocoH->H005->REG}|{$this->blocoH->H005->DT_INV}|{$this->blocoH->H005->VL_INV}|{$this->blocoH->H005->MOT_INV}|\r\n";
            foreach( $this->blocoH->H010 as $h010 ){
                $this->file .= "|{$h010->REG}";
                $this->file .= "|{$h010->COD_ITEM}";
                $this->file .= "|{$h010->UNID}";
                $this->file .= "|{$h010->QTD}";
                $this->file .= "|{$h010->VL_UNIT}";
                $this->file .= "|{$h010->VL_ITEM}";
                $this->file .= "|{$h010->IND_PROP}";
                if(!empty($h010->COD_PART)) $this->file .= "|{$h010->COD_PART}";
                if(!empty($h010->TXT_COMPL)) $this->file .= "|{$h010->TXT_COMPL}";
                if(!empty($h010->COD_CTA)) $this->file .= "|{$h010->COD_CTA}";
                if(!empty($h010->VL_ITEM_IR)) $this->file .= "|{$h010->VL_ITEM_IR}";
                $this->file .= "|\r\n";
            }
            if( $this->blocoH->H005->MOT_INV ){

            }
            $this->file .= "|{$this->blocoH->H990->REG}|{$this->blocoH->H990->QTD_LIN_H}|\r\n";
        }
        */
    }

    /*
     * Esse metodo faz a impressão do arquivo no formato TXT
     */
    public function printTxt()
    {
        $this->montar();
        header('Content-type: text/plain');
        echo $this->file;
    }
}