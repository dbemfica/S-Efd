<?php
namespace SEfd\Writer;

abstract class Item
{
    /*
     * Código do item (campo 02 do Registro 0200)
     * Atributo (Obrigatório)
     * @param string
     */
    public $codigoItem;

    /*
     * Descrição do item
     * Atributo (Obrigatório)
     * @param string
     */
    public $descricaoItem;

    /*
     * Representação alfanumérico do código de barra do produto, se houver
     * Atributo (Opcional)
     * @param string
     */
    public $codigoBarra;

    /*
     * Código anterior do item com relação à última informação
     * Atributo (Opcional)
     * @param string
     */
    public $codigoAnteriorItem;

    /*
     * Tipo do item – Atividades Industriais, Comerciais e Serviços:
     * 00 – Mercadoria para Revenda;
     * 01 – Matéria-Prima;
     * 02 – Embalagem;
     * 03 – Produto em Processo;
     * 04 – Produto Acabado;
     * 05 – Subproduto;
     * 06 – Produto Intermediário;
     * 07 – Material de Uso e Consumo;
     * 08 – Ativo Imobilizado;
     * 09 – Serviços;
     * 10 – Outros insumos;
     * 99 – Outras
     * Atributo (Obrigatório)
     * @param string
     */
    public $tipoItem;

    /*
     * Código da Nomenclatura Comum do Mercosul
     * Atributo (Opcional)
     * @param string
     */
    public $codigoNcm;

    /*
     * Código de Exceção de NCM
     * Atributo (Opcional)
     * @param string
     */
    public $codigoExcecaoNcm;

    /*
     * Código do gênero do item, conforme a Tabela 4.2.1
     * Atributo (Opcional)
     * @param string
     */
    public $codigoGeneroItem;


    /*
     * Código do serviço conforme lista do Anexo I da Lei Complementar Federal nº 116/03.
     * Atributo (Opcional)
     * @param string
     */
    public $codigoServico;

    /*
     * Alíquota de ICMS aplicável ao item nas operações internas
     * Atributo (Opcional)
     * @param string
     */
    public $aliquotaIcms;
}