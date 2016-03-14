<?php
namespace SEfd\Efd\BlocoE;

use SEfd\Efd\Tabelas\T54;

class E116
{
    /*
     * Texto fixo contendo "E116"
     * @param string
     */
    private $REG = "E116";

    /*
     * Código da obrigação a recolher, conforme a Tabela 5.4
     * @param string
     */
    private $COD_OR;

    /*
     * Valor da obrigação a recolher
     * @param float
     */
    private $VL_OR;

    /*
     * Data de vencimento da obrigação
     * Exemplo: 01/01/2015 => 01012015
     * @param string
     */
    private $DT_VCTO;

    /*
     * Código de receita referente à obrigação, próprio da unidade da federação,
     * conforme legislação estadual.
     * @param string
     */
    private $COD_REC;

    /*
     * Número do processo ou auto de infração ao qual a obrigação está vinculada, se houver.
     * @param string
     */
    private $NUM_PROC;

    /*
     * Indicador da origem do processo:
     * 0- SEFAZ;
     * 1- Justiça Federal;
     * 2- Justiça Estadual;
     * 9- Outros
     * @param int
     */
    private $IND_PROC;

    /*
     * Descrição resumida do processo que embasou o lançamento
     * @param string
     */
    private $PROC;

    /*
     * Descrição complementar das obrigações a recolher.
     * @param string
     */
    private $TXT_COMPL;

    /*
     * Informe o mês de referência no formato “mmaaaa”
     * Exemplo: 01/2015 => 012015
     * @param string
     */
    private $MES_REF;

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
                if( $this->REG === 'E116' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor 'E116'");
                }
                break;

            case 'COD_OR':
                if( !T54::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;
            case 'VL_OR':
                if( !is_numeric($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' precisa ser um número");
                }
                $v = explode(".",$valor);
                if( isset($v[1]) && strlen($v[1]) > 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter um decimal maior que 3");
                }
                break;

            case 'DT_VCTO':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'NUM_PROC':
                if( strlen($valor) > 15 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 3 caracteres");
                }
                break;

            case 'IND_PROC':
                if( $valor !== 0 && $valor !== 1 && $valor !== 2 && $valor !== 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0,1,2 ou 9");
                }
                break;

            case 'MES_REF':
                if( strlen($valor) != 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 6 caracteres");
                }
                break;
        }
    }
}