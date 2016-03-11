<?php
namespace SEfd\Efd\BlocoG;


class G990
{
    /*
     * Texto fixo contendo "G990"
     * @param string
     */
    private $REG = "G990";

    /*
     * Quantidade total de linhas do Bloco G
     * @param int
     */
    private $QTD_LIN_G;

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
                if( $this->REG === 'G990' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'G990'");
                }
                break;

            case 'QTD_LIN_G':
                if( !is_int($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ser inteiro");
                }
                break;
        }
    }
}