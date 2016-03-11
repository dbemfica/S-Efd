<?php
/**
 * Created by PhpStorm.
 * User: Desenv02
 * Date: 11/03/2016
 * Time: 13:40
 */

namespace SEfd\Efd\Bloco0;


class _0460
{
    /*
     * Texto fixo contendo "0460"
     * @param string
     */
    private $REG = "0460";

    /*
     * Código da Observação do lançamento fiscal.
     * @param int
     */
    private $COD_OBS;

    /*
     * Descrição da observação vinculada ao lançamento fiscal
     * @param int
     */
    private $TXT;

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
                if( $this->REG === '0460' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0460'");
                }
                break;
            case 'COD_OBS':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 6 caracteres");
                }
                break;
        }
    }
}