<?php
namespace SEfd\Writer;

class BlocoCItens extends Item
{
    /*
     * Número sequencial do item no documento fiscal
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param int
     */
    private $numeroItem;

    /*
     * Quantidade do item
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param float
     */
    private $quantidade;

    /*
     * Unidade do item (Campo 02 do registro 0190)
     * Atributo (Obrigatório)
     * @param string
     */
    private $unidade;

    /*
     * Descricao da unidade do item (Campo 02 do registro 0190)
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param string
     */
    private $unidadeDescricao;

    /*
     * Valor do item
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param float
     */
    private $valor;

    /*
     * Valor total do desconto
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorDesconto;

    /*
     * Movimentação física do ITEM/PRODUTO:
     * 0. SIM
     * 1. NÃO
     * @param int
     */
    private $indicadorMovimento;

    /*
     * Código da Situação Tributária, conforme a Tabela indicada no item 4.3.1
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param string
     */
    private $codigoSituacaoTributaria;

    /*
     * Código Fiscal de Operação e Prestação
     * Atributo (Obrigatório) na Entrada
     * Atributo (Obrigatório) na Saida
     * @param string
     */
    private $cfop;

    /*
     * Código da natureza da operação (campo 02 do Registro 0400)
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoNatureza;

    /*
     * Valor da base de cálculo do ICMS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorBaseCalculo;

    /*
     * Alíquota do ICMS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotaICMS;

    /*
     * Valor do ICMS creditado/debitado
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorICMS;

    /*
     * Valor da base de cálculo referente à substituição tributária
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorBaseCalculoST;

    /*
     * Alíquota do ICMS da substituição tributária na unidade da federação de destino
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotaICMSST;

    /*
     * Valor do ICMS referente à substituição tributária
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorICMSST;

    /*
     * Indicador de período de apuração do IPI:
     * 0 - Mensal;
     * 1 - Decendial
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param int
     */
    private $indicadorApuracao;

    /*
     * Código da Situação Tributária referente ao IPI, conforme a Tabela indicada no item 4.3.2.
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoSituacaoIPI;

    /*
     * Código de enquadramento legal do IPI, conforme tabela indicada no item 4.5.3.
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoEnquadramentoIPI;

    /*
     * Valor da base de cálculo do IPI
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorBaseCalculoIPI;

    /*
     * Alíquota do IPI
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotoIPI;

    /*
     * Valor do IPI creditado/debitado
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorIPI;

    /*
     * Código da Situação Tributária referente ao PIS.
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoSituacaoPIS;

    /*
     * Valor da base de cálculo do PIS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorBaseCalculoPIS;

    /*
     * Alíquota do PIS (em percentual)
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotoPercentualPIS;

    /*
     * Quantidade – Base de cálculo PIS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $quantidadeBaseCalculoPIS;

    /*
     * Alíquota do PIS (em reais)
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotoRealPIS;

    /*
     * Valor do PIS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorPIS;

    /*
     * Código da Situação Tributária referente ao COFINS.
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoSituacaoCOFINS;

    /*
     * Valor da base de cálculo da COFINS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorBaseCalculoCOFINS;

    /*
     * Alíquota do COFINS (em percentual)
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotoPercentualCOFINS;

    /*
     * Quantidade – Base de cálculo COFINS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $quantidadeBaseCalculoCOFINS;

    /*
     * Alíquota da COFINS (em reais)
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $aliquotoRealCOFINS;

    /*
     * Valor da COFINS
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param float
     */
    private $valorCOFINS;

    /*
     * Valor de outras despesas acessórias
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorOperacao;

    /*
     * Código da conta analítica contábil debitada/creditada
     * Atributo (Opcional) na Entrada
     * Atributo (Opcional) na Saida
     * @param string
     */
    private $codigoContabil;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}