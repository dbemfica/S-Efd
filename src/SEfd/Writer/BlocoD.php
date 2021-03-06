<?php
namespace SEfd\Writer;

class BlocoD extends DocumentoFiscal
{

    /*
     * Série do documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $serie;

    /*
     * Subsérie do documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $subserie;

    /*
     * Número do documento fiscal
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $numeroDocumento;

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
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * Formato: 01/01/2016 => 01012016
     * @param string
     */
    private $dataEntradaSaida;

    /*
     * Valor total do documento fiscal
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorDocumento;

    /*
     * Valor total do desconto
     * Atributo (Opcional) para Entrada
     * @param float
     */
    private $valorDesconto;

    /*
     * Valor da prestação de serviços
     * Atributo (Obrigatório) para Entrada
     * @param float
     */
    private $valorServico;

    /*
     * Valor total dos serviços não-tributados pelo ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorServicoNaoTributado;

    /*
     * Valores cobrados em nome de terceiros
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorTerceiros;

    /*
     * Valor de outras despesas indicadas no documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorOutrasDespesas;

    /*
     * Valor da base de cálculo do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorBaseCalculoICMS;

    /*
     * Valor do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param float
     */
    private $valorICMS;

    /*
     * Código da informação complementar (campo 02 do Registro 0450)
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $codigoInformacaoComplementar;

    /*
     * Informação complementar (campo 02 do Registro 0450)
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $informacaoComplementar;

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
     * Código da conta analítica contábil debitada/creditada
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $codigoContaContabil;

    /*
     * Código do Tipo de Assinante:
     * 1 - Comercial/Industrial
     * 2 - Poder Público
     * 3 - Residencial/Pessoa física
     * 4 - Público
     * 5 - Semi-Público
     * 6 - Outros
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $codigoTipoAssinante;

    /*
     * Código da Observação do lançamento fiscal.
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param int
     */
    private $codigoObservacao;

    /*
     * Descrição da observação vinculada ao lançamento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $observacao;

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

    public function addBlocoItens(BlocoDItens $blocoDItens)
    {
        $this->itens[] = $blocoDItens;
    }
}