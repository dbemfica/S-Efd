<?php
namespace SEfd\Efd\BlocoE;


class E110
{
    /*
     * Texto fixo contendo "E100"
     * @param string
     */
    private $REG = "E110";

    /*
     * Valor total dos débitos por "Saídas e prestações com débito do imposto"
     * @param float
     */
    private $VL_TOT_DEBITOS;

    /*
     * Valor total dos ajustes a débito decorrentes do documento fiscal.
     * @param float
     */
    private $VL_AJ_DEBITOS;

    /*
     * Valor total de "Ajustes a débito"
     * @param float
     */
    private $VL_TOT_AJ_DEBITOS;

    /*
     * Valor total dos créditos por "Entradas e aquisições com crédito do imposto"
     * @param float
     */
    private $VL_TOT_CREDITOS;

    /*
     * Valor total de "Ajustes a crédito"
     * @param float
     */
    private $VL_TOT_AJ_CREDITOS;

    /*
     * Valor total de Ajustes “Estornos de Débitos”
     * @param float
     */
    private $VL_ESTORNOS_DEB;

    /*
     * Valor total de "Saldo credor do período anterior"
     * @param float
     */
    private $VL_SLD_CREDOR_ANT;

    /*
     * Valor do saldo devedor apurado
     * @param float
     */
    private $VL_SLD_APURADO;

    /*
     * Valor total de "Deduções"
     * @param float
     */
    private $VL_TOT_DED;

    /*
     * Valor total de "ICMS a recolher (11-12)
     * @param float
     */
    private $VL_ICMS_RECOLHER;

    /*
     * Valor total de "Saldo credor a transportar para o período seguinte”
     * @param float
     */
    private $VL_SLD_CREDOR_TRANSPORTAR;

    /*
     * Valores recolhidos ou a recolher, extraapuração.
     * @param float
     */
    private $DEB_ESP;

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
                if( $this->REG === 'E110' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E110'");
                }
                break;
            case 'VL_TOT_DEBITOS':
            case 'VL_AJ_DEBITOS':
            case 'VL_TOT_AJ_DEBITOS':
            case 'VL_ESTORNOS_CRED':
            case 'VL_TOT_CREDITOS':
            case 'VL_AJ_CREDITOS':
            case 'VL_TOT_AJ_CREDITOS':
            case 'VL_ESTORNOS_DEB':
            case 'VL_SLD_CREDOR_ANT':
            case 'VL_SLD_APURADO':
            case 'VL_TOT_DED':
            case 'VL_ICMS_RECOLHER':
            case 'VL_SLD_CREDOR_TRANSPORTAR':
            case 'DEB_ESP':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
            break;
        }
    }
}