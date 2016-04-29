<?php
namespace SEfd\Efd\Bloco1;

class _1010
{
    /*
     * Texto fixo contendo "0400"
     * @param string
     */
    private $REG = "1010";

    /*
     * Reg. 1100 - Ocorreu averbação (conclusão) de exportação no período:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_EXP;

    /*
     * IReg 1200 – Existem informações acerca de créditos de ICMS a serem controlados, definidos pela Sefaz:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_CCRF;

    /*
     * Reg. 1300 – É comercio varejista de combustíveis com movimentação e/ou estoque no período:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_COMB;

    /*
     * Reg. 1390 – Usinas de açúcar e/álcool – O estabelecimento é produtor de açúcar e/ou álcool carburante com movimentação e/ou estoque no período:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_USINA;

    /*
     * Reg 1400 – Sendo o registro obrigatório em sua Unidade de Federação, existem informações a serem prestadas neste registro:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_VA;

    /*
     * Reg 1500 - A empresa é distribuidora de energia e ocorreu fornecimento de energia elétrica para consumidores de outra UF:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_EE;

    /*
     * Reg 1600 - Realizou vendas com Cartão de Crédito ou de débito:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_CART;

    /*
     * Reg. 1700 – Foram emitidos documentos fiscais em papel no período em unidade da federação que exija o controle de utilização de documentos fiscais:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_FORM;

    /*
     * Reg 1800 – A empresa prestou serviços de transporte aéreo de cargas e de passageiros:
     * S – Sim
     * N - Não
     * @param string
     */
    private $IND_AER;

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
                if( $this->REG === '1010' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '1010'");
                }
                break;
            case 'IND_EXP':
            case 'IND_CCRF':
            case 'IND_COMB':
            case 'IND_USINA':
            case 'IND_VA':
            case 'IND_EE':
            case 'IND_CART':
            case 'IND_FORM':
            case 'IND_AER':
                if( $valor != 'S' && $valor != 'N' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só aceita 'S' ou 'N'");
                }
                break;
        }
    }
}