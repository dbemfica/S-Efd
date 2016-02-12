<?php
namespace SEfd\Efd\Bloco0;

class _0200
{
    /*
     * Texto fixo contendo "0200"
     * @param string
     */
    private $REG = "0200";

    /*
     * Código do item
     * @param string
     */
    private $COD_ITEM;

    /*
     * Descrição do item
     * @param string
     */
    private $DESCR_ITEM;

    /*
     * Representação alfanumérico do código de barra do produto, se houver
     * @param string
     */
    private $COD_BARRA;

    /*
     * Código anterior do item com relação à última informação apresentada.
     * @param string
     */
    private $COD_ANT_ITEM;

    /*
     * Unidade de medida utilizada na quantificação de estoques.
     * @param string
     */
    private $UNID_INV;

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
     * @param string
     */
    private $TIPO_ITEM;

    /*
     * Código da Nomenclatura Comum do Mercosul
     * @param string
     */
    private $COD_NCM;

    /*
     * Código EX, conforme a TIPI
     * @param string
     */
    private $EX_IPI;

    /*
     * Código do gênero do item, conforme a Tabela 4.2.1
     * @param string
     */
    private $COD_GEN;

    /*
     * Código do serviço conforme lista do Anexo I da Lei Complementar Federal nº 116/03.
     * @param string
     */
    private $COD_LST;

    /*
     * Alíquota de ICMS aplicável ao item nas operações internas
     * @param float
     */
    private $ALIQ_ICMS;

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

    private function validar($atributo, $valor)
    {
        switch($atributo){
            case 'REG':
                if( $this->REG === '0200' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0001'");
                }
                break;

            case 'COD_ITEM':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'COD_ANT_ITEM':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'UNID_INV':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'TIPO_ITEM':
                $validar = ['00','01','02','03','04','05','06','07','08','09','10','99'];
                if(!in_array($valor, $validar)){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'COD_NCM':
                if( strlen($valor) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 8 caracteres");
                }
                break;

            case 'EX_IPI':
                if( strlen($valor) > 3 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 3 caracteres");
                }
                break;

            case 'COD_GEN':
                if( strlen($valor) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 2 caracteres");
                }
                break;

            case 'COD_LST':
                if( strlen($valor) > 5 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 5 caracteres");
                }
                break;

            case 'ALIQ_ICMS':
                if( $valor !== NULL && !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 2");
                }

                break;
        }
    }
}