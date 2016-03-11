<?php
namespace SEfd\Efd\BlocoE;

class E990
{
    /*
     * Texto fixo contendo "E990"
     * @param string
     */
    private $REG = "E990";

    /*
     * Quantidade total de linhas do Bloco E
     * @param int
     */
    private $QTD_LIN_E;

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
                if( $this->REG === 'E990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E990'");
                }
                break;

            case 'QTD_LIN_E':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}