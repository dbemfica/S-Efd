<?php
namespace SEfd\Efd\BlocoD;


class D990
{
    /*
     * Texto fixo contendo "D990"
     * @param string
     */
    private $REG = "D990";

    /*
     * Quantidade total de linhas do Bloco D
     * @param int
     */
    private $QTD_LIN_D;

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
                if( $this->REG === 'D990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'D990'");
                }
                break;

            case 'QTD_LIN_D':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}