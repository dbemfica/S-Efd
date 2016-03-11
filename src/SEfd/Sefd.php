<?php
namespace SEfd;

class SEfd
{
    //ENTIDADE
    /*
     * Código da versão do leiaute conforme a tabela indicada no Ato COTEPE.
     * Verificar na Tabela Versão (http://www1.receita.fazenda.gov.br/sistemas/spedfiscal/tabelas-de-codigos.htm)
     * Campo Obrigatório
     * @param string
     */
    private $versaoLeiaute;

    /*
     * Código da finalidade do arquivo:
     * 0 - Remessa do arquivo original;
     * 1 - Remessa do arquivo substituto.
     * Campo Obrigatório
     * @param int
     */
    private $codigoFinalidade;

    /*
     * Data inicial das informações contidas no arquivo.
     * (MMAAAA) Mês e Ano
     * Campo Obrigatório
     */
    private $dataInicial;

    /*
     * Data inicial das informações contidas no arquivo.
     * (MMAAAA) Mês e Ano
     * Campo Obrigatório
     */
    private $dataFinal;

    /*
     * Nome empresarial da entidade.
     * Campo Obrigatório
     */
    private $nomeEntidade;

    /*
     * Número de inscrição da entidade no CNPJ.
     * Campo Opcional
     */
    private $cnpjEntidade;

    /*
     * Número de inscrição da entidade no CPF.
     * Campo Opcional
     */
    private $cpfEntidade;

    /*
     * Sigla da unidade da federação da entidade.
     * Campo Opcional
     */
    private $ufEntidade;

    /*
     * Inscrição Estadual da entidade.
     * Campo Opcional
     */
    private $ieEntidade;

    /*
     * Código do município do domicílio fiscal da entidade, conforme a tabela IBGE
     * Campo Opcional
     */
    private $codMunEntidade;

    /*
     * Inscrição Municipal da entidade.
     * Campo Opcional
     */
    private $imEntidade;

    /*
     * Código de Endereçamento Postal.
     * Campo Obrigatório
     */
    private $cepEntidade;

    /*
     * Logradouro e endereço do imóvel.
     * Campo Obrigatório
     */
    private $enderecoEntidade;

    /*
     * Número do imóvel.
     * Campo Opcional
     */
    private $enderecoNumeroEntidade;

    /*
     * Dados complementares do endereço.
     * Campo Opcional
     */
    private $complementoEntidade;

    /*
     * Bairro em que o imóvel está situado.
     * Campo Obrigatório
     */
    private $bairroEntidade;

    /*
     * Número do telefone (DDD+FONE).
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     */
    private $telefoneEntidade;

    /*
     * Número do fax.
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     */
    private $faxEntidade;

    /*
     * Endereço do correio eletrônico.
     * Campo Opcional
     */
    private $emailEntidade;

    /*
     * Inscrição da entidade na SUFRAMA
     * Campo Opcional
     */
    private $suframaEntidade;

    /*
     * Perfil de apresentação do arquivo fiscal;
     * A – Perfil A;
     * B – Perfil B.;
     * C – Perfil C.
     * Campo Obrigatório
     */
    private $indentificacaoPerfil;

    /*
     * Indicador de tipo de atividade:
     * 0 – Industrial ou equiparado a industrial;
     * 1 – Outros.
     * Campo Obrigatório
     */
    private $indicadorAtividade;

    //CONTABILISTA

    /*
     * Nome do contabilista.
     * Campo Obrigatório
     */
    private $nomeContabilista;

    /*
     * Número de inscrição do contabilista no CPF.
     * Exemplo: 999.999.999-99 -> 99999999999
     * Campo Obrigatório
     */
    private $cpfContabilista;

    /*
     * Número de inscrição do contabilista no Conselho Regional de Contabilidade.
     * Campo Obrigatório
     */
    private $crcContabilista;

    /*
     * Número de inscrição do escritório de contabilidade no CNPJ, se houver.
     * Exemplo: 99.999.999/9999-99 -> 99999999999999
     * Campo Opcional
     */
    private $cnpjContabilista;

    /*
     * Código de Endereçamento Postal.
     * Exemplo: 99999-999 -> 99999999
     * Campo Opcional
     */
    private $cepContabilista;

    /*
     * Logradouro e endereço do imóvel.
     * Campo Opcional
     */
    private $enderecoContabilista;

    /*
     * Número do imóvel.
     * Campo Opcional
     */
    private $enderecoNumeroContabilista;

    /*
     * Dados complementares do endereço.
     * Campo Opcional
     */
    private $complementoContabilista;

    /*
     * Bairro em que o imóvel está situado.
     * Campo Opcional
     */
    private $bairroContabilista;

    /*
     * Bairro em que o imóvel está situado.
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     */
    private $telefoneContabilista;

    /*
     * Bairro em que o imóvel está situado.
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     */
    private $faxContabilista;

    /*
     * Endereço do correio eletrônico.
     * Campo Obrigatório
     */
    private $emailContabilista;

    /*
     * Código do município, conforme tabela IBGE.
     * Campo Obrigatório
     */
    private $codMunicipioContabilista;


    //BLOCOS
    public $blocoD = array();
    public $blocoH = array();

    /*
     * Informe o motivo do Inventário:
     * 01 – No final no período;
     * 02 – Na mudança de forma de tributação da mercadoria (ICMS);
     * 03 – Na solicitação da baixa cadastral, paralisação temporária e outras situações;
     * 04 – Na alteração de regime de pagamento – condição do contribuinte;
     * 05 – Por determinação dos fiscos.
     * Esse atributo só deve ser setado se for criar o BLOCO H
     * @param string
     */
    private $motivoInventario;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function addBlocoD(\SEfd\Writer\BlocoD $blocoD)
    {
        $this->blocoD[] = $blocoD;
    }

    public function addBlocoH(\SEfd\Writer\BlocoH $blocoH)
    {
        $this->blocoH[] = $blocoH;
    }

    /*
     * Esse metodo faz a impressão do arquivo no formato TXT
     */
    public function printTxt()
    {
        $efd = new Efd\Efd();
        $efd->makeEfd($this);
        $efd->printTxt();
    }
}