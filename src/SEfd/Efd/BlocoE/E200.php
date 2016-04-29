<?php
/**
 * Created by PhpStorm.
 * User: Desenv02
 * Date: 06/04/2016
 * Time: 11:09
 */

namespace SEfd\Efd\BlocoE;


use SEfd\Efd\Tabelas\TCodMunicipio;

class E200
{
    /*
     * Texto fixo contendo "E200"
     * @param string
     */
    private $REG = "E200";

    /*
     * Sigla da unidade da federação a que se refere a apuração do ICMS ST
     * @param string
     */
    private $UF;

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

    /*
     * Vetor com os E210
     * @param E210
     */
    public $E210 = array();

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        try {
            $this->validar($atributo, $valor);
            $this->$atributo = $valor;
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    private function validar($atributo, $valor)
    {
        switch ($atributo) {
            case 'REG':
                if ($this->REG === 'E200') {
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E200'");
                }
                break;
            case 'UF':
                if ( !TCodMunicipio::isCodigoUF($valor) ) {
                    throw new \InvalidArgumentException("No campo '{$atributo}' o valor {$valor} está com valor invalido");
                }
                break;

            case 'DT_INI':
                if (strlen($valor) != 8) {
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'DT_FIN':
                if (strlen($valor) != 8) {
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;
        }
    }
}
