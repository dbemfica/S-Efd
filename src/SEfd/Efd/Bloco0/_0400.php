<?php
namespace SEfd\Efd\Bloco0;

class _0400
{
    /*
     * Texto fixo contendo "0400"
     * @param string
     */
    private $REG = "0400";

    /*
     * Código da natureza da operação/prestação
     * @param string
     */
    private $COD_NAT;

    /*
     * Descrição da natureza da operação/prestação
     * @param string
     */
    private $DESCR_NAT;

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
                if( $this->REG === '0400' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0400'");
                }
                break;
            case 'COD_NAT':
                if( strlen($valor) > 10 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 10 caracteres");
                }
                break;
        }
    }
}