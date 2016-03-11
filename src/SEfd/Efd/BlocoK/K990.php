<?php
namespace SEfd\Efd\BlocoK;


class K990
{
    /*
     * Texto fixo contendo "K990"
     * @param string
     */
    private $REG = "K990";

    /*
     * Quantidade total de linhas do Bloco K
     * @param int
     */
    private $QTD_LIN_K;

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
                if( $this->REG === 'K990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'K990'");
                }
                break;

            case 'QTD_LIN_K':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}