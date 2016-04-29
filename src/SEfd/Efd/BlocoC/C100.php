<?php
namespace SEfd\Efd\BlocoC;

use SEfd\Efd\Tabelas\T411;
use SEfd\Efd\Tabelas\T412;

class C100
{
    /*
     * Texto fixo contendo "C100"
     * @param string
     */
    private $REG = "C100";

    /*
     * Indicador do tipo de operação:
     * 0- Entrada;
     * 1- Saída
     * @param int
     */
    private $IND_OPER;

    /*
     * Indicador do emitente do documento fiscal:
     * 0- Emissão própria;
     * 1- Terceiros
     * @param int
     */
    private $IND_EMIT;

    /*
     * Código do participante (campo 02 do Registro 0150):
     * - do emitente do documento ou do remetente das mercadorias, no caso de entradas;
     * - do adquirente, no caso de saídas
     * @param string
     */
    private $COD_PART;

    /*
     * Código do modelo do documento fiscal, conforme a Tabela 4.1.1
     * @param string
     */
    private $COD_MOD;

    /*
     * Código da situação do documento fiscal, conforme a Tabela 4.1.2
     * @param string
     */
    private $COD_SIT;

    /*
     * Série do documento fiscal
     * @param string
     */
    private $SER;

    /*
     * Número do documento fiscal
     * @param string
     */
    private $NUM_DOC;

    /*
     * Chave da Nota Fiscal Eletrônica
     * @param string
     */
    private $CHV_NFE;

    /*
     * Data da emissão do documento fiscal
     * @param string
     */
    private $DT_DOC;

    /*
     * Data da entrada ou da saída
     * @param string
     */
    private $DT_E_S;

    /*
     * Valor total do documento fiscal
     * @param float
     */
    private $VL_DOC;

    /*
     * Indicador do tipo de pagamento:
     * 0- À vista;
     * 1- A prazo;
     * 2 - Outros
     * @param imt
     */
    private $IND_PGTO;

    /*
     * Valor total do desconto
     * @param float
     */
    private $VL_DESC;

    /*
     * Abatimento não tributado e não comercial Ex. desconto ICMS nas remessas para ZFM.
     * @param float
     */
    private $VL_ABAT_NT;

    /*
     * Valor total das mercadorias e serviços
     * @param float
     */
    private $VL_MERC;

    /*
     * Indicador do tipo do frete:
     * 0- Por conta do emitente;
     * 1- Por conta do destinatário/remetente;
     * 2- Por conta de terceiros;
     * 9- Sem cobrança de frete.
     * @param int
     */
    private $IND_FRT;

    /*
     * Valor do frete indicado no documento fiscal
     * @param float
     */
    private $VL_FRT;

    /*
     * Valor do seguro indicado no documento fiscal
     * @param float
     */
    private $VL_SEG;

    /*
     * Valor de outras despesas acessórias
     * @param float
     */
    private $VL_OUT_DA;

    /*
     * Valor da base de cálculo do ICMS
     * @param float
     */
    private $VL_BC_ICMS;

    /*
     * Valor do ICMS
     * @param float
     */
    private $VL_ICMS;

    /*
     * Valor da base de cálculo do ICMS substituição tributária
     * @param float
     */
    private $VL_BC_ICMS_ST;

    /*
     * Valor do ICMS retido por substituição tributária
     * @param float
     */
    private $VL_ICMS_ST;

    /*
     * Valor total do IPI
     * @param float
     */
    private $VL_IPI;

    /*
     * Valor total do PIS
     * @param float
     */
    private $VL_PIS;

    /*
     * Valor total da COFINS
     * @param float
     */
    private $VL_COFINS;

    /*
     * Valor total do PIS retido por substituição tributária
     * @param float
     */
    private $VL_PIS_ST;

    /*
     * Valor total da COFINS retido por substituição tributária
     * @param float
     */
    private $VL_COFINS_ST;

    /*
     * Vetor com os C170
     * @param C170
     */
    public $C170 = array();

    /*
     * Vetor com os C190
     * @param C190
     */
    public $C190 = array();

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
                if( $this->REG === 'C100' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'C100'");
                }
                break;
            case 'IND_OPER':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;
            case 'IND_EMIT':
                if ( !empty($valor)) {
                    if( $valor !== 0 && $valor !== 1 ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                    }
                }
                break;

            case 'COD_MOD':
                if( !T411::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'COD_SIT':
                if( !T412::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'SER':
                if( strlen($valor) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 3 carácter");
                }
                break;

            case 'NUM_DOC':
                if( strlen($valor) > 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 9 carácter");
                }
                break;

            case 'CHV_NFE':
                if( strlen($valor) > 44 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 44 carácter");
                }
                break;

            case 'DT_DOC':
            case 'DT_E_S':
                if( strlen($valor) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 8 carácter");
                }
                break;

            case 'VL_DOC':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'IND_PGTO':
                if ( !empty($valor)) {
                    if( $valor !== 0 && $valor !== 1 && $valor !== 2 ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0,1 ou 2");
                    }
                }
                break;

            case 'VL_DESC':
            case 'VL_ABAT_NT':
            case 'VL_MERC':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'IND_FRT':
                if ( !empty($valor)) {
                    if( $valor !== 0 && $valor !== 1 && $valor !== 2 && $valor !== 9 ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0,1,2 ou 9");
                    }
                }
                break;

            case 'VL_FRT':
            case 'VL_SEG':
            case 'VL_OUT_DA':
            case 'VL_BC_ICMS':
            case 'VL_ICMS':
            case 'VL_BC_ICMS_ST':
            case 'VL_ICMS_ST':
            case 'VL_IPI':
            case 'VL_PIS':
            case 'VL_COFINS':
            case 'VL_PIS_ST':
            case 'VL_COFINS_ST':
                if( !is_numeric($valor) && !empty($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;
        }
    }
}