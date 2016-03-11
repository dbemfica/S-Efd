<?php
namespace SEfd\Efd\BlocoC;


class C990
{
    /*
     * Texto fixo contendo "C990"
     * @param string
     */
    private $REG = "C990";

    /*
     * Quantidade total de linhas do Bloco C
     * @param int
     */
    private $QTD_LIN_C;

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
                if( $this->REG === 'C990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'C990'");
                }
                break;

            case 'QTD_LIN_H':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}