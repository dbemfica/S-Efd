<?php
namespace SEfd\Efd\Bloco0;


class _0015
{
    /*
     * Texto fixo contendo "0015"
     * @param string
     */
    private $REG = "0015";

    /*
     * Sigla da unidade da federação do contribuinte substituído
     * ou unidade de federação do consumidor final não
     * contribuinte - ICMS Destino EC 87/15.
     * @param string
     */
    private $UF_ST;

    /*
     * Inscrição Estadual do contribuinte substituto na unidade
     * da federação do contribuinte substituído ou unidade de
     * federação do consumidor final não contribuinte - ICMS Destino EC 87/15.
     * @param string
     */
    private $IE_ST;

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
                if( $this->REG === '0001' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0001'");
                }
                break;

            case 'UF_ST':
                if( strlen($valor) != 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 2 caracteres");
                }
                break;

            case 'IE_ST':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 14 caracteres");
                }
                break;
        }
    }
}