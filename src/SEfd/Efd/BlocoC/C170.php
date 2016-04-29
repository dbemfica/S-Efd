<?php
namespace SEfd\Efd\BlocoC;

use SEfd\Efd\Tabelas\T422;
use SEfd\Efd\Tabelas\T431;
use SEfd\Efd\Tabelas\T432;
use SEfd\Efd\Tabelas\T453;
use SEfd\Efd\Tabelas\TSituacaoTributariaCOFINS;

class C170
{
    /*
     * Texto fixo contendo "C170"
     * @param string
     */
    private $REG = "C170";

    /*
     * Número sequencial do item no documento fiscal
     * @param string
     */
    private $NUM_ITEM;

    /*
     * Código do item (campo 02 do Registro 0200)
     * @param string
     */
    private $COD_ITEM;

    /*
     * Descrição complementar do item como adotado no documento fiscal
     * @param string
     */
    private $DESCR_COMPL;

    /*
     * Quantidade do item
     * @param float
     */
    private $QTD;

    /*
     * Unidade do item (Campo 02 do registro 0190)
     * @param string
     */
    private $UNID;

    /*
     * Valor total do item (mercadorias ou serviços)
     * @param float
     */
    private $VL_ITEM;

    /*
     * Valor do desconto comercial
     * @param float
     */
    private $VL_DESC;

    /*
     * Movimentação física do ITEM/PRODUTO:
     * 0. SIM
     * 1. NÃO
     * @param string
     */
    private $IND_MOV;

    /*
     * Código da Situação Tributária referente ao ICMS, conforme a Tabela indicada no item 4.3.1
     * @param string
     */
    private $CST_ICMS;

    /*
     * Código Fiscal de Operação e Prestação
     * @param string
     */
    private $CFOP;

    /*
     * Código da natureza da operação (campo 02 do Registro 0400)
     * @param string
     */
    private $COD_NAT;

    /*
     * Valor da base de cálculo do ICMS
     * @param float
     */
    private $VL_BC_ICMS;

    /*
     * Alíquota do ICMS
     * @param float
     */
    private $ALIQ_ICMS;

    /*
     * Valor do ICMS creditado/debitado
     * @param float
     */
    private $VL_ICMS;

    /*
     * Valor da base de cálculo referente à substituição tributária
     * @param float
     */
    private $VL_BC_ICMS_ST;

    /*
     * Alíquota do ICMS da substituição tributária na unidade da federação de destino
     * @param float
     */
    private $ALIQ_ST;

    /*
     * Valor do ICMS referente à substituição tributária
     * @param float
     */
    private $VL_ICMS_ST;

    /*
     * Indicador de período de apuração do IPI:
     * 0 - Mensal;
     * 1 - Decendial
     * @param int
     */
    private $IND_APUR;

    /*
     * Código da Situação Tributária referente ao IPI, conforme a Tabela indicada no item 4.3.2.
     * 0 - Mensal;
     * 1 - Decendial
     * @param string
     */
    private $CST_IPI;

    /*
     * Código de enquadramento legal do IPI, conforme tabela indicada no item 4.5.3.
     * @param string
     */
    private $COD_ENQ;

    /*
     * Valor da base de cálculo do IPI
     * @param float
     */
    private $VL_BC_IPI;

    /*
     * Alíquota do IPI
     * @param float
     */
    private $ALIQ_IPI;

    /*
     * Valor do IPI creditado/debitado
     * @param float
     */
    private $VL_IPI;

    /*
     * Código da Situação Tributária referente ao PIS.
     * @param string
     */
    private $CST_PIS;

    /*
     * Valor da base de cálculo do PIS
     * @param float
     */
    private $VL_BC_PIS;

    /*
     * Alíquota do PIS (em percentual)
     * @param float
     */
    private $ALIQ_PIS_P;

    /*
     * Quantidade – Base de cálculo PIS
     * @param float
     */
    private $QUANT_BC_PIS;

    /*
     * Alíquota do PIS (em reais)
     * @param float
     */
    private $ALIQ_PIS_R;

    /*
     * Valor do PIS
     * @param float
     */
    private $VL_PIS;

    /*
     * Código da Situação Tributária referente ao COFINS.
     * @param float
     */
    private $CST_COFINS;

    /*
     * Valor da base de cálculo da COFINS
     * @param float
     */
    private $VL_BC_COFINS;

    /*
     * Alíquota do COFINS (em percentual)
     * @param float
     */
    private $ALIQ_COFINS_P;

    /*
     * Quantidade – Base de cálculo COFINS
     * @param float
     */
    private $QUANT_BC_COFINS;

    /*
     * Alíquota da COFINS (em reais)
     * @param float
     */
    private $ALIQ_COFINS_R;

    /*
     * Valor da COFINS
     * @param float
     */
    private $VL_COFINS;

    /*
     * Código da conta analítica contábil debitada/creditada
     * @param string
     */
    private $COD_CTA;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        try{
            $this->validar($atributo, $valor);
            $this->$atributo = $valor;
            return true;
        }catch(\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }

    /*
     * Este metodo faz a validação dos sets para os atributos deste registro
     */
    private function validar($atributo, $valor)
    {
        switch($atributo){
            case 'REG':
                if( $this->REG === 'C170' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'C170'");
                }
                break;
            case 'NUM_ITEM':
                if( strlen($valor) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 3 carácter");
                }
                break;

            case 'COD_ITEM':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 carácter");
                }
                break;

            case 'QTD':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                if( $valor < 0 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ter valor maior que zero");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 5 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 5");
                }
                break;

            case 'UNID':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 6 carácter");
                }
                break;

            case 'VL_ITEM':
            case 'VL_DESC':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'IND_MOV':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;

            case 'CST_ICMS':
                if( !T431::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'CFOP':
                if(!empty($valor)){
                    if( !t422::isCodigo($valor) ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' está com '{$valor}' que é um valor invalido");
                    }
                }
                break;

            case 'COD_NAT':
                if( strlen($valor) > 10 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 10 carácter");
                }
                break;

            case 'VL_BC_ICMS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'ALIQ_ICMS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[0]) && strlen($v[0]) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um valor maior que 6");
                }
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'VL_ICMS':
            case 'VL_BC_ICMS_ST':
            case 'ALIQ_ST':
            case 'VL_ICMS_ST':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'IND_APUR':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;

            case 'CST_IPI':
                if(!empty($valor)){
                    if( !T432::isCodigo($valor) ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                    }
                }
                break;

            case 'COD_ENQ':
//                if( !T453::isCodigo($valor) ){
//                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
//                }
                break;

            case 'VL_BC_IPI':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'ALIQ_IPI':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[0]) && strlen($v[0]) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um valor maior que 6");
                }
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'VL_IPI':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'CST_PIS':
                if( strlen($valor) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 2 carácter");
                }
                break;

            case 'VL_BC_PIS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'ALIQ_PIS_P':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[0]) && strlen($v[0]) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um valor maior que 8");
                }
                if( isset($v[1]) && strlen($v[1]) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 4");
                }
                break;

            case 'QUANT_BC_PIS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'ALIQ_PIS_R':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'VL_PIS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'CST_COFINS':
                if(!empty($valor)) {
                    if (!TSituacaoTributariaCOFINS::isCodigo($valor)) {
                        throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor '{$valor}' e é invalido");
                    }
                }
                break;

            case 'VL_BC_COFINS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'ALIQ_COFINS_P':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[0]) && strlen($v[0]) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um valor maior que 8");
                }
                if( isset($v[1]) && strlen($v[1]) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 4");
                }
                break;

            case 'QUANT_BC_COFINS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'ALIQ_COFINS_R':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 4");
                }
                break;

            case 'VL_COFINS':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 4");
                }
                break;
        }
    }
}