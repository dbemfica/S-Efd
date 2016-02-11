<?php
namespace SEfd\Efd\BlocoH;


class H005
{
    /*
     * Texto fixo contendo "H005"
     * @param string
     */
    private $REG = "H005";

    /*
     * Data do inventário
     * @param float
     */
    private $DT_INV;

    /*
     * Valor total do estoque
     * @param float
     */
    private $VL_INV;

    /*
     * Informe o motivo do Inventário:
     * 01 – No final no período;
     * 02 – Na mudança de forma de tributação da mercadoria (ICMS);
     * 03 – Na solicitação da baixa cadastral, paralisação temporária e outras situações;
     * 04 – Na alteração de regime de pagamento – condição do contribuinte;
     * 05 – Por determinação dos fiscos.
     * @param string
     */
    private $MOT_INV;

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
                if( $this->REG === 'H001' ){
                    throw new \InvalidArgumentException("O campo 'REG' tem que ter o valor 'H005'");
                }
                break;
            case 'DT_INV':
                if( strlen($valor) > 8 ){
                    throw new \InvalidArgumentException("O campo 'DT_INV' não pode ter mais que 8 carácter");
                }
                break;

            case 'VL_INV':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo 'VL_INV' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo 'VL_INV' não pode ter um decimal maior que 2");
                }
                break;

            case 'MOT_INV':
                if( $valor != '01' && $valor != '02' && $valor != '03' && $valor != '04' && $valor != '05' ){
                    throw new \InvalidArgumentException("O campo 'MOT_INV' está com o valor invalido");
                }
                break;
        }
    }
}