<?php

namespace SEfd\Efd\BlocoH;


class H020
{
    /*
     * Texto fixo contendo "H020"
     * @param string
     */
    private $REG = "H020";

    /*
     * Código da Situação Tributária referente ao ICMS, conforme a Tabela indicada no item 4.3.1
     * @param float
     */
    private $CST_ICMS;

    /*
     * Informe a base de cálculo do ICMS
     * @param float
     */
    private $BC_ICMS;

    /*
     * Informe o valor do ICMS a ser debitado ou creditado
     * @param float
     */
    private $VL_ICMS;


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
                if( $this->REG === 'H020' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor 'H020'");
                }
                break;

            case 'CST_ICMS':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'CST_ICMS' precisa ser um número");
                }
                if( strlen($valor) > 3 ){
                    throw new \InvalidArgumentException("O campo 'CST_ICMS' não pode ter mais que 3 carácter");
                }
                break;

            case 'BC_ICMS':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'BC_ICMS' precisa ser um inteiro");
                }
                @$v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo 'BC_ICMS' não pode ter um decimal maior que 6");
                }
                break;

            case 'VL_ICMS':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'VL_ICMS' precisa ser um inteiro");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo 'VL_ICMS' não pode ter um decimal maior que 6");
                }
                break;
        }
    }
}