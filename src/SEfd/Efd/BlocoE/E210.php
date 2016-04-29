<?php
/**
 * Created by PhpStorm.
 * User: Desenv02
 * Date: 06/04/2016
 * Time: 14:35
 */

namespace SEfd\Efd\BlocoE;


class E210
{
    /*
     * Texto fixo contendo "E100"
     * @param string
     */
    private $REG = "E210";

    /*
     * Indicador de movimento:
     * 0 – Sem operações com ST
     * 1 – Com operações de ST
     * @param int
     */
    private $IND_MOV_ST;

    /*
     * Valor do "Saldo credor de período anterior – Substituição Tributária"
     * @param float
     */
    private $VL_SLD_CRED_ANT_ST;

    /*
     * Valor total do ICMS ST de devolução de mercadorias
     * @param float
     */
    private $VL_DEVOL_ST;

    /*
     * Valor total do ICMS ST de ressarcimentos
     * @param float
     */
    private $VL_RESSARC_ST;

    /*
     * Valor total de Ajustes "Outros créditos ST" e “Estorno de débitos ST”
     * @param float
     */
    private $VL_OUT_CRED_ST;

    /*
     * Valor total dos ajustes a crédito de ICMS ST, provenientes de ajustes do documento fiscal.
     * @param float
     */
    private $VL_AJ_CREDITOS_ST;

    /*
     * Valor Total do ICMS retido por Substituição Tributária
     * @param float
     */
    private $VL_RETENÇAO_ST;

    /*
     * Valor Total dos ajustes "Outros débitos ST" " e “Estorno de créditos ST”
     * @param float
     */
    private $VL_OUT_DEB_ST;

    /*
     * Valor total dos ajustes a débito de ICMS ST, provenientes de ajustes do documento fiscal.
     * @param float
     */
    private $VL_AJ_DEBITOS_ST;

    /*
     * Valor total de Saldo devedor antes das deduções
     * @param float
     */
    private $VL_SLD_DEV_ANT_ST;

    /*
     * Valor total dos ajustes "Deduções ST"
     * @param float
     */
    private $VL_DEDUCOES_ST;

    /*
     * Imposto a recolher ST (11-12)
     * @param float
     */
    private $VL_ICMS_RECOL_ST;

    /*
     * Saldo credor de ST a transportar para o período seguinte [(03+04+05+06+07)– (08+09+10)].
     * @param float
     */
    private $VL_SLD_CRED_ST_TRANSPORTAR;

    /*
     * Valores recolhidos ou a recolher, extraapuração.
     * @param float
     */
    private $DEB_ESP_ST;

    /*
     * Vetor com os E220
     * @param E220
     */
    public $E220 = array();


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
                if( $this->REG === 'E210' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E210'");
                }
                break;

            case 'IND_MOV_ST':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ver 0 ou 1");
                }
                break;

            case 'VL_SLD_CRED_ANT_ST':
            case 'VL_DEVOL_ST':
            case 'VL_RESSARC_ST':
            case 'VL_OUT_CRED_ST':
            case 'VL_AJ_CREDITOS_ST':
            case 'VL_RETENÇAO_ST':
            case 'VL_OUT_DEB_ST':
            case 'VL_AJ_DEBITOS_ST':
            case 'VL_SLD_DEV_ANT_ST':
            case 'VL_DEDUCOES_ST':
            case 'VL_ICMS_RECOL_ST':
            case 'VL_SLD_CRED_ST_TRANSPORTAR':
            case 'DEB_ESP_ST':
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