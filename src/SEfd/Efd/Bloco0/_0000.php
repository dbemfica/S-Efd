<?php
namespace SEfd\Efd\Bloco0;

class _0000
{
    /*
     * Texto fixo contendo "0000"
     * @param string
     */
    private $REG = "0000";

    /*
     * Código da versão do leiaute conforme a tabela indicada no Ato COTEPE.
     * Verificar na Tabela Versão (http://www1.receita.fazenda.gov.br/sistemas/spedfiscal/tabelas-de-codigos.htm)
     * @param string
     */
    private $COD_VER;

    /*
     * Código da finalidade do arquivo:
     * 0 - Remessa do arquivo original;
     * 1 - Remessa do arquivo substituto.
     * @param int
     */
    private $COD_FIN;

    /*
     * Data inicial das informações contidas no arquivo.
     * Exemplo: 01/01/2015 => 01012015
     * @param string
     */
    private $DT_INI;

    /*
     * Data final das informações contidas no arquivo.
     * Exemplo: 01/01/2015 => 01012015
     * @param string
     */
    private $DT_FIN;

    /*
     * Nome empresarial da entidade.
     * @param string
     */
    private $NOME;

    /*
     * Número de inscrição da entidade no CNPJ.
     * @param string
     */
    private $CNPJ;

    /*
     * Número de inscrição da entidade no CPF.
     * @param string
     */
    private $CPF;

    /*
     * Sigla da unidade da federação da entidade.
     * @param string
     */
    private $UF;

    /*
     * Inscrição Estadual da entidade.
     * @param string
     */
    private $IE;

    /*
     * Código do município do domicílio fiscal da entidade, conforme a tabela IBGE
     * @param string
     */
    private $COD_MUN;

    /*
     * Inscrição Municipal da entidade.
     * @param string
     */
    private $IM;

    /*
     * Inscrição da entidade na SUFRAMA.
     * @param string
     */
    private $SUFRAMA;

    /*
     * Perfil de apresentação do arquivo fiscal;
     * A – Perfil A;
     * B – Perfil B.;
     * C – Perfil C.
     * @param string
     */
    private $IND_PERFIL;

    /*
     * Indicador de tipo de atividade:
     * 0 – Industrial ou equiparado a industrial;
     * 1 – Outros.
     * @param string
     */
    private $IND_ATIV;

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
                if( $this->REG === '0000' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0000'");
                }
                break;

            case 'COD_FIN':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;

            case 'DT_INI':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'DT_FIN':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'NOME':
                if( strlen($valor) > 100 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 100 caracteres");
                }
                break;

            case 'UF':
                if( strlen($valor) != 2 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 2 caracteres");
                }
                break;

            case 'IE':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 14 caracteres");
                }
                break;

            case 'COD_MUN':
                if( strlen($valor) > 7 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 7 caracteres");
                }
                break;

            case 'SUFRAMA':
                if( strlen($valor) > 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 9 caracteres");
                }
                break;

            case 'IND_PERFIL':
                if( $valor != 'A' && $valor != 'B' && $valor != 'C' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores A,B ou C");
                }
                break;

            case 'IND_ATIV':
                if( $valor !== 0 && $valor !== 1 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter valores 0 ou 1");
                }
                break;
        }
    }

}