<?php
namespace SEfd\Efd\BlocoC;

use SEfd\Efd\Tabelas\T431;

class C190
{
    /*
     * Texto fixo contendo "C190"
     * @param string
     */
    private $REG = "C190";

    /*
     * Código da Situação Tributária, conforme a Tabela indicada no item 4.3.1
     * @param string
     */
    private $CST_ICMS;

    /*
     * Código Fiscal de Operação e Prestação do agrupamento de itens
     * @param string
     */
    private $CFOP;

    /*
     * Alíquota do ICMS
     * @param string
     */
    private $ALIQ_ICMS;

    /*
     * Valor da operação na combinação de CST_ICMS,
     * CFOP e alíquota do ICMS, correspondente ao somatório do valor das mercadorias,
     * despesas acessórias (frete, seguros e outras despesas acessórias), ICMS_ST e IPI.
     * @param float
     */
    private $VL_OPR;

    /*
     * Parcela correspondente ao "Valor da base de cálculo do ICMS" referente à combinação de CST_ICMS,
     * CFOP e alíquota do ICMS.
     * @param float
     */
    private $VL_BC_ICMS;

    /*
     * Parcela correspondente ao "Valor do ICMS" referente à combinação de CST_ICMS,
     * CFOP e alíquota do ICMS.
     * @param float
     */
    private $VL_ICMS;

    /*
     * Parcela correspondente ao "Valor da base de cálculo do ICMS" da substituição tributária referente à combinação de CST_ICMS,
     * CFOP e alíquota do ICMS.
     * @param float
     */
    private $VL_BC_ICMS_ST;

    /*
     * VL_ICMS_ST Parcela correspondente ao valor creditado/debitado do ICMS da substituição tributária, referente à combinação de CST_ICMS,
     * CFOP, e alíquota do ICMS.
     * @param float
     */
    private $VL_ICMS_ST;

    /*
     * Valor não tributado em função da redução da base de cálculo do ICMS, referente à combinação de CST_ICMS,
     * CFOP e alíquota do ICMS.
     * @param float
     */
    private $VL_RED_BC;

    /*
     * Parcela correspondente ao "Valor do IPI" referente à combinação CST_ICMS, CFOP e alíquota do ICMS.
     * @param float
     */
    private $VL_IPI;

    /*
     * Código da observação do lançamento fiscal (campo 02 do Registro 0460)
     * @param float
     */
    private $COD_OBS;

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
                if( $this->REG === 'C190' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'C190'");
                }
                break;
            case 'CST_ICMS':
                if( !T431::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'CFOP':
                if( strlen($valor) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 4 carácter");
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

            case 'VL_OPR':
            case 'VL_BC_ICMS':
            case 'VL_ICMS':
            case 'VL_BC_ICMS_ST':
            case 'VL_ICMS_ST':
            case 'VL_RED_BC':
            case 'VL_IPI':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;
        }
    }
}