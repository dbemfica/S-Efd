<?php
/**
 * Created by PhpStorm.
 * User: Desenv02
 * Date: 11/04/2016
 * Time: 14:45
 */

namespace SEfd\Efd\BlocoE;


use SEfd\Efd\Tabelas\T511;

class E220
{
    /*
     * Texto fixo contendo "E100"
     * @param string
     */
    private $REG = "E220";

    /*
     * Código do ajuste da apuração e dedução, conforme a Tabela indicada no item 5.1.1
     * @param string
     */
    private $COD_AJ_APUR;

    /*
     * Descrição complementar do ajuste da apuração
     * @param string
     */
    private $DESCR_COMPL_AJ;

    /*
     * Valor do ajuste da apuração
     * @param float
     */
    private $VL_AJ_APUR;

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

    private function validar($atributo, $valor)
    {
        switch($atributo){
            case 'REG':
                if( $this->REG === 'E220' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E220'");
                }
                break;

            case 'COD_AJ_APUR':
                break;
                if( !T511::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'VL_AJ_APUR':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;
        }
    }
}