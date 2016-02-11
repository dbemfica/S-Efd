<?php
namespace SEfd\Efd\BlocoH;


class H001
{
    /*
     * Texto fixo contendo "H001"
     * @param string
     */
    private $REG = "H001";

    /*
     * Indicador de movimento:
     * 0- Bloco com dados informados;
     * 1- Bloco sem dados informados
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
                if( $this->REG === 'H001' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor 'H001'");
                }
                break;
            case 'IND_MOV':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo 'IND_MOV' só pode ter valores 0 ou 1");
                }
                break;
        }
    }
}