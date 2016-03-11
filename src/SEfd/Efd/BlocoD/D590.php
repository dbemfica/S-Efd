<?php
namespace SEfd\Efd\BlocoD;

use SEfd\Efd\Tabelas\T431;
use SEfd\Efd\Tabelas\T422;

class D590
{
    /*
     * Texto fixo contendo "D590"
     * @param string
     */
    private $REG = "D590";

    /*
     * Código da Situação Tributária, conforme a tabela indicada no item 4.3.1
     * @param string
     */
    private $CST_ICMS;

    /*
     * Código Fiscal de Operação e Prestação, conforme a tabela indicada no item 4.2.2
     * @param string
     */
    private $CFOP;

    /*
     * Alíquota do ICMS
     * @param string
     */
    private $ALIQ_ICMS;

    /*
     * Valor da operação correspondente à combinação de CST_ICMS, CFOP, e alíquota do ICMS,
     * incluídas as despesas acessórias e acréscimos
     * @param string
     */
    private $VL_OPR;

    /*
     * Parcela correspondente ao "Valor da base de cálculo do ICMS" referente à combinação
     * CST_ICMS, CFOP, e alíquota do ICMS
     * @param string
     */
    private $VL_BC_ICMS;

    /*
     * Parcela correspondente ao "Valor do ICMS" referente à combinação CST_ICMS, CFOP, e alíquota do ICMS
     * CST_ICMS, CFOP, e alíquota do ICMS
     * @param string
     */
    private $VL_ICMS;

    /*
     * Parcela correspondente ao valor da base de cálculo do ICMS de outras UFs,
     * referente à combinação de CST_ICMS, CFOP e alíquota do ICMS.
     * @param string
     */
    private $VL_BC_ICMS_UF;

    /*
     * Parcela correspondente ao valor do ICMS de outras UFs,
     * referente à combinação de CST_ICMS, CFOP, e alíquota do ICMS.
     * @param string
     */
    private $VL_ICMS_UF;

    /*
     * Valor não tributado em função da redução da base de cálculo do ICMS,
     * referente à combinação de CST_ICMS, CFOP e alíquota do ICMS
     * @param string
     */
    private $VL_RED_BC;

    /*
     * Código da observação (campo 02 do Registro 0460)
     * @param string
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
                if( $this->REG === 'D590' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'D590'");
                }
                break;

            case 'CST_ICMS':
                if( !T431::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'CFOP':
                if( !T422::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'VL_OPR':
            case 'VL_BC_ICMS':
            case 'VL_ICMS':
            case 'VL_BC_ICMS_UF':
            case 'VL_ICMS_UF':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;
        }
    }
}