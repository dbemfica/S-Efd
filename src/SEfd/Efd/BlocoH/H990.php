<?php
namespace SEfd\Efd\BlocoH;


class H990
{
    /*
     * Texto fixo contendo "H990"
     * @param string
     */
    private $REG = "H990";

    /*
     * Quantidade total de linhas do Bloco H
     * @param int
     */
    private $QTD_LIN_H;

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
                if( $this->REG === 'H990' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor 'H990'");
                }
                break;

            case 'QTD_LIN_H':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo 'QTD_LIN_H' tem que ser inteiro");
                }
                break;
        }
    }
}