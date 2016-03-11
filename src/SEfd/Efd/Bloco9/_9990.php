<?php
namespace SEfd\Efd\Bloco9;


class _9990
{
    /*
     * Texto fixo contendo "9990"
     * @param string
     */
    private $REG = "9990";

    /*
     * Quantidade total de linhas do Bloco 9
     * @param int
     */
    private $QTD_LIN_9;

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
                if( $this->REG === '9990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '9990'");
                }
                break;

            case 'QTD_LIN_9':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}