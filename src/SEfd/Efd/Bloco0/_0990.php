<?php
namespace SEfd\Efd\Bloco0;

class _0990
{
    /*
     * Texto fixo contendo "0990"
     * @param string
     */
    private $REG = "0990";

    /*
     * Quantidade total de linhas do Bloco 0
     * @param int
     */
    private $QTD_LIN_0;

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
                if( $this->REG === '0990' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor '0990'");
                }
                break;
            case 'QTD_LIN_0':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo 'QTD_LIN_0' só pode ter valores inteiros");
                }
                break;
        }
    }
}