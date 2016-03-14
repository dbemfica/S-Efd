<?php
namespace SEfd\Writer;

class BlocoH extends Item
{
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


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}