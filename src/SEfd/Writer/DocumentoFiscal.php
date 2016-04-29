<?php
namespace SEfd\Writer;

class DocumentoFiscal
{

    /*
     * Indicador do tipo de operação:
     * 0- Aquisição;
     * 1- Prestação
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param int
     */
    public $indicadorOperacao;

    /*
     * Indicador do emitente do documento fiscal:
     * 0- Emissão própria;
     * 1- Terceiros
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param int
     */
    public $indicadorEmitente;

    /*
     * Código do modelo do documento fiscal, conforme a Tabela 4.1.1
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    public $codigoModelo;

    /*
     * Código da situação do documento fiscal, conforme a Tabela 4.1.2
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    public $codigoSituacao;



    /*
     * Código do participante (campo 02 do Registro 0150):
     * - do prestador do serviço, no caso de aquisição;
     * - do tomador do serviço, no caso de prestação.
     * Atributo (Obrigatório) para Entrada
     * Atributo (Obrigatório) para Saida
     * @param string
     */
    public $codigoParticipanete;

    /*
     * Nome pessoal ou empresarial do participante.
     * Atributo (Obrigatório)
     * @param string
     */
    public $nome;

    /*
     * Código do país do participante, conforme a tabela indicada no item 3.2.1
     * Atributo (Obrigatório)
     * @param string
     */
    public $codigoPais;

    /*
     * CNPJ do participante.
     * Exemplo: 99.999.999/9999-99 -> 99999999999999
     * Atributo (Opcional)
     * @param string
     */
    public $CNPJ;

    /*
     * CPF do participante.
     * Exemplo: 999.999.999/99 -> 99999999999
     * Atributo (Opcional)
     * @param string
     */
    public $CPF;

    /*
     * Inscrição Estadual do participante.
     * Atributo (Opcional)
     * @param string
     */
    public $inscricaoEstadual;

    /*
     * Código do município, conforme a tabela IBGE
     * Atributo (Opcional)
     * @param string
     */
    public $codigoMunicipio;

    /*
     * Número de inscrição do participante na SUFRAMA.
     * Atributo (Opcional)
     * @param string
     */
    public $suframa;

    /*
     * Logradouro e endereço do imóvel
     * Atributo (Obrigatório)
     * @param string
     */
    public $endereco;

    /*
     * Número do imóvel
     * Atributo (Opcional)
     * @param string
     */
    public $numero;

    /*
     * Dados complementares do endereço
     * Atributo (Opcional)
     * @param string
     */
    public $complemento;

    /*
     * Bairro em que o imóvel está situado
     * Atributo (Opcional)
     * @param string
     */
    public $bairro;

    /*
     * Código da obrigação a recolher, conforme a Tabela 5.4
     */
    public $codigoObrigacoesICMS;
}