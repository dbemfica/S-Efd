<?php
namespace SEfd\Efd\Bloco0;

class _0100
{
    /*
     * Texto fixo contendo "0100"
     * @param string
     */
    private $REG = "0100";

    /*
     * Nome do contabilista.
     * Campo Obrigatório
     * @param string
     */
    private $NOME;

    /*
     * Número de inscrição do contabilista no CPF.
     * Exemplo: 999.999.999-99 -> 99999999999
     * Campo Obrigatório
     * @param string
     */
    private $CPF;

    /*
     * Número de inscrição do contabilista no Conselho Regional de Contabilidade.
     * Campo Obrigatório
     * @param string
     */
    private $CRC;

    /*
     * Número de inscrição do escritório de contabilidade no CNPJ, se houver.
     * Exemplo: 99.999.999/9999-99 -> 99999999999999
     * Campo Opcional
     * @param string
     */
    private $CNPJ;

    /*
     * Código de Endereçamento Postal.
     * Exemplo: 99999-999 -> 99999999
     * Campo Opcional
     * @param string
     */
    private $CEP;

    /*
     * Número do imóvel.
     * Campo Opcional
     * @param string
     */
    private $NUM;

    /*
     * Dados complementares do endereço.
     * Campo Opcional
     * @param string
     */
    private $COMPL;

    /*
     * Bairro em que o imóvel está situado.
     * Campo Opcional
     * @param string
     */
    private $BAIRRO;

    /*
     * Número do telefone (DDD+FONE).
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     * @param string
     */
    private $FONE;

    /*
     * Número do fax.
     * Exemplo: (99)9999-99999 -> 99999999999
     * Campo Opcional
     * @param string
     */
    private $FAX;

    /*
     * Endereço do correio eletrônico.
     * Campo Obrigatório
     * @param string
     */
    private $EMAIL;

    /*
     * Código do município, conforme tabela IBGE.
     * Campo Obrigatório
     * @param string
     */
    private $COD_MUN;

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
                if( $this->REG === '0100' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0100'");
                }
                break;
            case 'NOME':
                if( strlen($valor) > 100 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 100 caracteres");
                }
                break;

            case 'CPF':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'CRC':
                if( strlen($valor) > 15 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 15 caracteres");
                }
                break;

            case 'CNPJ':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 14 caracteres");
                }
                break;

            case 'CEP':
                if( strlen($valor) > 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 8 caracteres");
                }
                break;

            case 'END':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 caracteres");
                }
                break;

            case 'NUM':
                if( strlen($valor) > 10 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 10 caracteres");
                }
                break;

            case 'COMPL':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 caracteres");
                }
                break;

            case 'BAIRRO':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 caracteres");
                }
                break;

            case 'FONE':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'FAX':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'COD_MUN':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 7 caracteres");
                }
                break;
        }
    }
}