<?php

namespace SEfd\Efd\BlocoH;


class H010
{
    /*
     * Texto fixo contendo "H010"
     * @param string
     */
    private $REG = "H010";

    /*
     * Código do item (campo 02 do Registro 0200)
     * @param string
     */
    private $COD_ITEM;

    /*
     * Unidade do item
     * @param string
     */
    private $UNID;

    /*
     * Quantidade do item
     * @param float
     */
    private $QTD;

    /*
     * Valor unitário do item
     * @param float
     */
    private $VL_UNIT;

    /*
     * Valor do item
     * @param float
     */
    private $VL_ITEM;

    /*
     * Indicador de propriedade/posse do item:
     * 0- Item de propriedade do informante e em seu poder;
     * 1- Item de propriedade do informante em posse de terceiros;
     * 2- Item de propriedade de terceiros em posse do informante
     * @param string
     */
    private $IND_PROP;

    /*
     * Código do participante (campo 02 do Registro 0150):
     * - proprietário/possuidor que não seja o informante do arquivo
     * @param string
     */
    private $COD_PART;

    /*
     * Descrição complementar.
     * @param string
     */
    private $TXT_COMPL;

    /*
     * Código da conta analítica contábil debitada/creditada
     * @param string
     */
    private $COD_CTA;

    /*
     * Valor do item para efeitos do Imposto de Renda.
     * @param float
     */
    private $VL_ITEM_IR;


    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        try{
            $this->validar($atributo, $valor);
            $this->$atributo = $valor;
            return true;
        }catch(\Exception $e){
            echo $e->getMessage();
            exit();
        }
    }

    /*
     * Este metodo faz a validação dos sets para os atributos deste registro
     */
    private function validar($atributo, $valor)
    {
        switch($atributo){
            case 'REG':
                if( $this->REG === 'H010' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor 'H010'");
                }
                break;

            case 'COD_ITEM':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo 'COD_ITEM' não pode ter mais que 60 carácter");
                }
                break;

            case 'UNID':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo 'UNID' não pode ter mais que 6 carácter");
                }
                break;

            case 'QTD':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'QTD' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 3 ){
                    throw new \InvalidArgumentException("O campo 'QTD' não pode ter um decimal maior que 3");
                }
                break;

            case 'VL_UNIT':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'VL_UNIT' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 6 ){
                    throw new \InvalidArgumentException("O campo 'VL_UNIT' não pode ter um decimal maior que 6");
                }
                break;

            case 'VL_ITEM':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'VL_ITEM' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo 'VL_ITEM' não pode ter um decimal maior que 2");
                }
                break;

            case 'IND_PROP':
                if( $valor !== 0 && $valor !== 1 && $valor !== 2 ){
                    throw new \InvalidArgumentException("O campo 'IND_PROP' está com o valor invalido");
                }
                break;

            case 'COD_PART':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo 'COD_PART' não pode ter mais que 60 carácter");
                }
                break;

            case 'VL_ITEM_IR':
                if( $valor !== NULL && !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'VL_ITEM_IR' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo 'VL_ITEM_IR' não pode ter um decimal maior que 2");
                }
                break;
        }
    }
}