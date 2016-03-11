<?php
namespace SEfd\Writer;

class DocumentoFiscal
{
    /*
     * Código de identificação do participante no arquivo.
     * Atributo (Obrigatório)
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
    public $completo;

    /*
     * Bairro em que o imóvel está situado
     * Atributo (Opcional)
     * @param string
     */
    public $bairro;
}