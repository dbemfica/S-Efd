<?php
namespace SEfd\Efd\BlocoD;


use SEfd\Efd\Tabelas\T411;
use SEfd\Efd\Tabelas\T412;

class D500
{
    /*
     * Texto fixo contendo "D500"
     * @param string
     */
    private $REG = "D500";

    /*
     * Indicador do tipo de operação:
     * 0- Aquisição;
     * 1- Prestação
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
     * - do prestador do serviço, no caso de aquisição;
     * - do tomador do serviço, no caso de prestação.
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
     * Subsérie do documento fiscal
     * @param string
     */
    private $SUB;

    /*
     * Número do documento fiscal
     * @param string
     */
    private $NUM_DOC;

    /*
     * Data da emissão do documento fiscal
     * @param string
     */
    private $DT_DOC;

    /*
     * Data da entrada (aquisição) ou da saída (prestação do serviço)
     * @param string
     */
    private $DT_A_P;

    /*
     * Valor total do documento fiscal
     * @param float
     */
    private $VL_DOC;

    /*
     * Valor total do desconto
     * @param float
     */
    private $VL_DESC;

    /*
     * Valor da prestação de serviços
     * @param float
     */
    private $VL_SERV;

    /*
     * Valor total dos serviços não-tributados pelo ICMS
     * @param float
     */
    private $VL_SERV_NT;

    /*
     * Valores cobrados em nome de terceiros
     * @param float
     */
    private $VL_TERC;

    /*
     * Valor de outras despesas indicadas no documento fiscal
     * @param float
     */
    private $VL_DA;

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
     * Código da informação complementar (campo 02 do Registro 0450)
     * @param float
     */
    private $COD_INF;

    /*
     * Valor do PIS
     * @param float
     */
    private $VL_PIS;

    /*
     * Valor da COFINS
     * @param float
     */
    private $VL_COFINS;

    /*
     * Código da conta analítica contábil debitada/creditada
     * @param float
     */
    private $COD_CTA;

    /*
     * Código do Tipo de Assinante:
     * 1 - Comercial/Industrial
     * 2 - Poder Público
     * 3 - Residencial/Pessoa física
     * 4 - Público
     * 5 - Semi-Público
     * 6 - Outros
     * @param float
     */
    private $TP_ASSINANTE;

    /*
     * Vetor com os D510
     * @param D510
     */
    public $D510 = array();

    /*
     * Vetor com os D510
     * @param D590
     */
    public $D590 = array();

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
                if( $this->REG === 'D500' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'D500'");
                }
                break;

            case 'IND_OPER':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;

            case 'IND_EMIT':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;

            case 'COD_PART':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 carácter");
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
                if( strlen($valor) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 4 carácter");
                }
                break;

            case 'SUB':
                if( strlen($valor) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 4 carácter");
                }
                break;

            case 'NUM_DOC':
                if( $valor > 0 ){
                    throw new \InvalidArgumentException("'NUM_DOC' o valor informado no campo deve ser maior que “0”");
                }
                if( strlen($valor) > 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 9 carácter");
                }
                break;

            case 'DT_DOC':
            case 'DT_A_P':
                if( strlen($valor) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 8 carácter");
                }
                break;

            case 'VL_DOC':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'VL_DESC':
                if( !empty($valor) ){
                    if( !is_numeric($valor) ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                    }
                    $v = explode(".",$valor);
                    if( isset($v[1]) && strlen($v[1]) > 2 ){
                        throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                    }
                }
                break;

            case 'VL_SERV':
            case 'VL_SERV_NT':
            case 'VL_TERC':
            case 'VL_DA':
            case 'VL_BC_ICMS':
            case 'VL_ICMS':
            case 'VL_PIS':
            case 'VL_COFINS':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }
                break;

            case 'COD_INF':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 6 carácter");
                }
                break;

            case 'TP_ASSINANTE':
                if( $valor !== 1 && $valor !== 2 && $valor !== 3 && $valor !== 4 && $valor !== 5 && $valor !== 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 1,2,3,4,5 ou 6");
                }
                break;
        }
    }
}