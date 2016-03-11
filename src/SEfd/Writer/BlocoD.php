<?php
namespace SEfd\Writer;

class BlocoD extends DocumentoFiscal
{
    /*
     * Indicador do tipo de operação:
     * 0- Aquisição;
     * 1- Prestação
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param int
     */
    private $indicadorOperacao;

    /*
     * Indicador do emitente do documento fiscal:
     * 0- Emissão própria;
     * 1- Terceiros
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param int
     */
    private $indicadorEmitente;

    /*
     * Código do participante (campo 02 do Registro 0150):
     * - do prestador do serviço, no caso de aquisição;
     * - do tomador do serviço, no caso de prestação.
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $codigoParitcipante;

    /*
     * Código do modelo do documento fiscal, conforme a Tabela 4.1.1
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $codigoModelo;

    /*
     * Código da situação do documento fiscal, conforme a Tabela 4.1.2
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $codigoSituacao;

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
     * @param string
     */
    private $dataEmissao;

    /*
     * Data da entrada (aquisição) ou da saída (prestação do serviço)
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
     */
    private $dataEntradaSaida;

    /*
     * Valor total do documento fiscal
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $valorDocumento;

    /*
     * Valor total do desconto
     * Atributo (Opcional) para Entrada
     * @param string
     */
    private $valorDesconto;

    /*
     * Valor da prestação de serviços
     * Atributo (Obrigatório) para Entrada
     * @param string
     */
    private $valorServico;

    /*
     * Valor total dos serviços não-tributados pelo ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $valorServicoNaoTributado;

    /*
     * Valores cobrados em nome de terceiros
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $valorTerceiros;

    /*
     * Valor de outras despesas indicadas no documento fiscal
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $valorOutrasDespesas;

    /*
     * Valor da base de cálculo do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    private $valorBaseCalculoICMS;

    /*
     * Valor do ICMS
     * Atributo (Opcional) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
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
     * @param string
     */
    private $valorPIS;

    /*
     * Valor da COFINS
     * Atributo (Opcional) para Entrada
     * Atributo (Opcional) para Saida
     * @param string
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

    public function addBlocoItens(\SEfd\Writer\BlocoDItens $blocoDItens)
    {
        $this->itens[] = $blocoDItens;
    }
}