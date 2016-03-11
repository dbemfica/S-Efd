<?php
namespace SEfd\Efd;

class _9999
{
    /*
     * Texto fixo contendo "9999"
     * @param string
     */
    private $REG = "9999";

    /*
     * Quantidade total de linhas do Arquivo EFD
     * @param int
     */
    private $QTD_LIN;

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
                if( $this->REG === '9999' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '9999'");
                }
                break;

            case 'QTD_LIN':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}