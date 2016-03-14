<?php
namespace SEfd\Writer;


class BlocoDItens extends Item
{
    /*
     * Número sequencial do item no documento fiscal
     * Atributo (Obrigatório)
     * @param int
     */
    private $numeroItem;

    /*
     * Código de classificação do item do serviço de comunicação ou de telecomunicação, conforme a Tabela 4.4.1
     * Atributo (Obrigatório)
     * @param string
     */
    private $codigoClassificacao;

    /*
     * Quantidade do item
     * Atributo (Obrigatório)
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
     * Atributo (Obrigatório)
     * @param string
     */
    private $unidadeDescricao;

    /*
     * Valor do item
     * Atributo (Obrigatório)
     * @param float
     */
    private $valor;

    /*
     * Valor total do desconto
     * Atributo (Opcional)
     * @param float
     */
    private $valorDesconto;

    /*
     * Código da Situação Tributária, conforme a Tabela indicada no item 4.3.1
     * Atributo (Obrigatório)
     * @param string
     */
    private $codigoSituacaoTributaria;

    /*
     * Código Fiscal de Operação e Prestação
     * Atributo (Obrigatório)
     * @param string
     */
    private $cfop;

    /*
     * Valor da base de cálculo do ICMS
     * Atributo (Opcional)
     * @param float
     */
    private $valorBaseCalculo;

    /*
     * Alíquota do ICMS
     * Atributo (Opcional)
     * @param float
     */
    private $aliquotaICMS;

    /*
     * Valor do ICMS creditado/debitado
     * Atributo (Opcional)
     * @param float
     */
    private $valorICMS;

    /*
     * Valor da base de cálculo do ICMS de outras UFs
     * Atributo (Opcional)
     * @param float
     */
    private $valorBaseCalculoUF;

    /*
     * Valor do ICMS de outras UFs
     * Atributo (Opcional)
     * @param float
     */
    private $valorICMSUF;

    /*
     * Indicador do tipo de receita:
     * 0- Receita própria - serviços prestados;
     * 1- Receita própria - cobrança de débitos;
     * 2- Receita própria - venda de mercadorias;
     * 3- Receita própria - venda de serviço pré-pago;
     * 4- Outras receitas próprias;
     * 5- Receitas de terceiros (co-faturamento);
     * 9- Outras receitas de terceiros
     * Atributo (Obrigatório)
     * @param int
     */
    private $indicadorReceita;

    /*
     * Código do participante (campo 02 do Registro 0150) receptor da receita, terceiro da operação, se houver.
     * Atributo (Opcional)
     * @param string
     */
    private $codigoParticipante;

    /*
     * Valor do PIS
     * Atributo (Obrigatório)
     * @param float
     */
    private $valorPIS;

    /*
     * Valor da COFINS
     * Atributo (Opcional)
     * @param float
     */
    private $valorCOFINS;

    /*
     * Código da conta analítica contábil debitada/creditada
     * Atributo (Opcional)
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