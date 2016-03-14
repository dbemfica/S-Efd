<?php
namespace SEfd\Efd\BlocoE;


class E100
{
    /*
     * Texto fixo contendo "E100"
     * @param string
     */
    private $REG = "E100";

    /*
     * Data inicial das informações contidas no arquivo.
     * Exemplo: 01/01/2015 => 01012015
     * @param string
     */
    private $DT_INI;

    /*
     * Data final das informações contidas no arquivo.
     * Exemplo: 01/01/2015 => 01012015
     * @param string
     */
    private $DT_FIN;

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
                if( $this->REG === 'E100' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E100'");
                }
                break;
            case 'DT_INI':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'DT_FIN':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;
        }
    }
}