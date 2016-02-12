<?php
namespace SEfd\Efd\Bloco0;

class _0190
{
    /*
     * Texto fixo contendo "0190"
     * @param string
     */
    private $REG = "0190";

    /*
     * Código da unidade de medida
     * @param string
     */
    private $UNID;

    /*
     * Descrição da unidade de medida
     * @param string
     */
    private $DESCR;

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
                if( $this->REG === '0190' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0190'");
                }
                break;
            case 'UNID':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 6 caracteres");
                }
                break;
        }
    }
}