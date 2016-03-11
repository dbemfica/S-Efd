<?php
namespace SEfd\Efd\BlocoD;

use SEfd\Efd\Tabelas\T431;
use SEfd\Efd\Tabelas\T441;

class D510
{
    /*
     * Texto fixo contendo "D510"
     * @param string
     */
    private $REG = "D510";

    /*
     * Número sequencial do item no documento fiscal
     * @param string
     */
    private $NUM_ITEM;

    /*
     * Código do item (campo 02 do Registro 0200)
     * @param string
     */
    private $COD_ITEM;

    /*
     * Código de classificação do item do serviço de comunicação ou de telecomunicação, conforme a Tabela 4.4.1
     * @param string
     */
    private $COD_CLASS;

    /*
     * Quantidade do item
     * @param float
     */
    private $QTD;

    /*
     * Unidade do item (Campo 02 do registro 0190)
     * @param string
     */
    private $UNID;

    /*
     * Valor do item
     * @param float
     */
    private $VL_ITEM;

    /*
     * Valor total do desconto
     * @param float
     */
    private $VL_DESC;

    /*
     * Código da Situação Tributária, conforme a Tabela indicada no item 4.3.1
     * @param string
     */
    private $CST_ICMS;

    /*
     * Código Fiscal de Operação e Prestação
     * @param string
     */
    private $CFOP;

    /*
     * Valor da base de cálculo do ICMS
     * @param float
     */
    private $VL_BC_ICMS;

    /*
     * Alíquota do ICMS
     * @param float
     */
    private $ALIQ_ICMS;

    /*
     * Valor do ICMS creditado/debitado
     * @param float
     */
    private $VL_ICMS;

    /*
     * Valor da base de cálculo do ICMS de outras UFs
     * @param float
     */
    private $VL_BC_ICMS_UF;

    /*
     * Valor do ICMS de outras UFs
     * @param float
     */
    private $VL_ICMS_UF;

    /*
     * Indicador do tipo de receita:
     * 0- Receita própria - serviços prestados;
     * 1- Receita própria - cobrança de débitos;
     * 2- Receita própria - venda de mercadorias;
     * 3- Receita própria - venda de serviço pré-pago;
     * 3- Receita própria - venda de serviço pré-pago;
     * 4- Outras receitas próprias;
     * 5- Receitas de terceiros (co-faturamento);
     * 9- Outras receitas de terceiros
     * @param int
     */
    private $IND_REC;

    /*
     * Código do participante (campo 02 do Registro 0150) receptor da receita, terceiro da operação, se houver.
     * @param string
     */
    private $COD_PART;

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
     * @param string
     */
    private $COD_CTA;

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
                if( $this->REG === 'D510' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'D510'");
                }
                break;
            case 'NUM_ITEM':
                if( strlen($valor) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 3 carácter");
                }
                break;

            case 'COD_ITEM':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 carácter");
                }
                break;

            case 'COD_CLASS':
                if( !T441::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor inavlido");
                }
                break;

            case 'QTD':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'UNID':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 6 carácter");
                }
                break;

            case 'VL_ITEM':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'CST_ICMS':
                if( !T431::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'CFOP':
                if( strlen($valor) > 4 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 4 carácter");
                }
                break;

            case 'IND_REC':
                if( $valor !== 0 && $valor !== 1 && $valor !== 2 && $valor !== 3 && $valor !== 4 && $valor !== 5 && $valor !== 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0,1,2,3,4,5,9");
                }
                break;
        }
    }
}