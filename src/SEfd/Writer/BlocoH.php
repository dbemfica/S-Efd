<?php
namespace SEfd\Writer;

class BlocoH
{
    /*
     * Código do item (campo 02 do Registro 0200)
     * Atributo (Obrigatório)
     * @param string
     */
    private $codigoItem;

    /*
     * Código anterior do item com relação à última informação
     * Atributo (Opcional)
     * @param string
     */
    private $codigoAnteriorItem;

    /*
     * Representação alfanumérico do código de barra do produto, se houver
     * Atributo (Opcional)
     * @param string
     */
    private $codigoBarra;

    /*
     * Código da Nomenclatura Comum do Mercosul
     * Atributo (Opcional)
     * @param string
     */
    private $codigoNcm;

    /*
     * Código de Exceção de NCM
     * Atributo (Opcional)
     * @param string
     */
    private $codigoExcecaoNcm;

    /*
     * Código do gênero do item, conforme a Tabela 4.2.1
     * Atributo (Opcional)
     * @param string
     */
    private $codigoGeneroItem;

    /*
     * Código do serviço conforme lista do Anexo I da Lei Complementar Federal nº 116/03.
     * Atributo (Opcional)
     * @param string
     */
    private $codigoServico;


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
    private $tipoItem;

    /*
     * Unidade do item
     * Atributo (Obrigatório)
     * @param string
     */
    private $unidade;

    /*
     * Descrição da unidade de medida
     * Atributo (Obrigatório)
     * @param string
     */
    private $unidadeDescricao;


    /*
     * Unidade de medida utilizada na quantificação de estoques.
     * Atributo (Obrigatório)
     * @param string
     */
    private $unidadeInventario;

    /*
     * Quantidade do item
     * Atributo (Obrigatório)
     * @param float (com 3 decimais)
     */
    private $quantidade;

    /*
     * Valor unitário do item
     * Atributo (Obrigatório)
     * @param float (com 6 decimais)
     */
    private $valorUnitario;

    /*
     * Valor do item
     * Atributo (Obrigatório)
     * @param float (com 2 decimais)
     */
    private $valorItem;

    /*
     * Indicador de propriedade/posse do item:
     * 0- Item de propriedade do informante e em seu poder;
     * 1- Item de propriedade do informante em posse de terceiros;
     * 2- Item de propriedade de terceiros em posse do informante
     * Atributo (Obrigatório)
     * @param int
     */
    private $indicadorPropriedade;

    /*
     * Código do participante (campo 02 do Registro 0150):
     * - proprietário/possuidor que não seja o informante do arquivo
     * Atributo (Opcional)
     * @param string
     */
    private $codigoParticipante;

    /*
     * Descrição complementar.
     * Atributo (Opcional)
     * @param string
     */
    private $textoComplementar;

    /*
     * Código da conta analítica contábil debitada/creditada
     * Atributo (Opcional)
     * @param string
     */
    private $codigoContaAnaliticaContabel;

    /*
     * Valor do item para efeitos do Imposto de Renda.
     * Atributo (Opcional)
     * @param float (com 2 decimais)
     */
    private $valorItemImpostoRenda;

    /*
     * Alíquota de ICMS aplicável ao item nas operações internas
     * Atributo (Opcional)
     * @param string
     */
    private $aliquotaIcms;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}