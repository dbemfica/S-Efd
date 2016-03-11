<?php
namespace SEfd\Efd\Bloco9;

class _9900
{
    /*
     * Texto fixo contendo "9900"
     * @param string
     */
    private $REG = "9900";

    /*
     * Registro que será totalizado no próximo campo.
     * @param string
     */
    private $REG_BLC;

    /*
     * Total de registros do tipo informado no campo anterior.
     * @param int
     */
    private $QTD_REG_BLC;

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
                if( $this->REG === '9900' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '9900'");
                }
                break;
            case 'REG_BLC':
                if( strlen($valor) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 4 caracteres");
                }
                break;

            case 'QTD_REG_BLC':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ter u, valor inteiro");
                }
                break;
        }
    }
}