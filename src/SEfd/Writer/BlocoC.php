<?php
namespace SEfd\Writer;

class BlocoC extends DocumentoFiscal
{
    /*
     * Série do documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $serie;

    /*
     * Número do documento fiscal
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $numeroDocumento;

    /*
     * Chave da Nota Fiscal Eletrônica
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $chaveNFE;

    /*
     * Data da emissão do documento fiscal
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * Formato: 01/01/2016 => 01012016
     * @param string
     */
    private $dataEmissao;

    /*
     * Data da entrada (aquisição) ou da saída (prestação do serviço)
     * Atributo (Obrigatório) para Entrada
     * Atributo (Opcional) para Saida
     * Formato: 01/01/2016 => 01012016
     * @param string
     */
    private $dataEntradaSaida;

    /*
     * Valor total do documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorDocumento;

    /*
     * Indicador do tipo de pagamento
     * 0- À vista;
     * 1- A prazo;
     * 2 - Outros
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param int
     */
    private $indicadorPagamento;

    /*
     * Valor total do desconto
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorDesconto;

    /*
     * Abatimento não tributado e não comercial Ex. desconto ICMS nas remessas para ZFM.
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorAbatimentoNaoTributado;

    /*
     * Valor total das mercadorias e serviços
     * Atributo (Obrigatório) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorMercadoria;

    /*
     * Indicador do tipo do frete:
     * 0- Por conta do emitente;
     * 1- Por conta do destinatário/remetente;
     * 2- Por conta de terceiros;
     * 9- Sem cobrança de frete.
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param int
     */
    private $indicadorFrete;

    /*
     * Valor do frete indicado no documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorFrete;

    /*
     * Valor do seguro indicado no documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorSeguro;

    /*
     * Valor de outras despesas acessórias
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorOutrasDespesas;

    /*
     * Valor da base de cálculo do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorBaseCalculoICMS;

    /*
     * Valor do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorICMS;

    /*
     * Valor da base de cálculo do ICMS ST
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorBaseCalculoICMSST;

    /*
     * Valor do ICMS ST
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorICMSST;

    /*
     * Valor total do IPI
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorIPI;

    /*
     * Valor do PIS
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorPIS;

    /*
     * Valor da COFINS
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorCOFINS;

    /*
     * Valor do PIS ST
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorPISST;

    /*
     * Valor da COFINS ST
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param float
     */
    private $valorCOFINSST;

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //ITENS
    public $itens = array();

    public function addBlocoItens(BlocoCItens $blocoCItens)
    {
        $this->itens[] = $blocoCItens;
    }
}