<?php
namespace SEfd\Efd\Bloco9;

class _9001
{
    /*
     * Texto fixo contendo "9001"
     * @param string
     */
    private $REG = "9001";

    /*
     * Indicador de movimento:
     * 0- Bloco com dados informados;
     * 1- Bloco sem dados informados
     * Campo Obrigatório
     * @param int
     */
    private $IND_MOV;

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
                if( $this->REG === '9001' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '9001'");
                }
                break;
            case 'IND_MOV':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;
        }
    }
}