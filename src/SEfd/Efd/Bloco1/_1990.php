<?php
namespace SEfd\Efd\Bloco1;


class _1990
{
    /*
     * Texto fixo contendo "1990"
     * @param string
     */
    private $REG = "1990";

    /*
     * Quantidade total de linhas do Bloco 1
     * @param int
     */
    private $QTD_LIN_1;

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
                if( $this->REG === '1990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '1990'");
                }
                break;

            case 'QTD_LIN_1':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}