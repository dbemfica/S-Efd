<?php
namespace SEfd\Efd\Bloco0;

use \SEfd\Efd\Tabelas\T321;

class _0150
{
    /*
     * Texto fixo contendo "0150"
     * @param string
     */
    private $REG = "0150";

    /*
     * Código de identificação do participante no arquivo.
     * @param string
     */
    private $COD_PART;

    /*
     * Nome pessoal ou empresarial do participante.
     * @param string
     */
    private $NOME;

    /*
     * Código do país do participante, conforme a tabela indicada no item 3.2.1
     * @param string
     */
    private $COD_PAIS;

    /*
     * CNPJ do participante.
     * @param string
     */
    private $CNPJ;

    /*
     * CPF do participante.
     * @param string
     */
    private $CPF;

    /*
     * Inscrição Estadual do participante.
     * @param string
     */
    private $IE;

    /*
     * Código do município, conforme a tabela IBGE
     * @param string
     */
    private $COD_MUN;

    /*
     * Número de inscrição do participante na SUFRAMA.
     * @param string
     */
    private $SUFRAMA;

    /*
     * Logradouro e endereço do imóvel
     * @param string
     */
    private $END;

    /*
     * Número do imóvel
     * @param string
     */
    private $NUM;

    /*
     * Dados complementares do endereço
     * @param string
     */
    private $COMPL;

    /*
     * Bairro em que o imóvel está situado
     * @param string
     */
    private $BAIRRO;

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
                if( $this->REG === '0150' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0150'");
                }
                break;
            case 'COD_PART':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 60 caracteres");
                }
                break;

            case 'NOME':
                if( strlen($valor) > 100 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 100 caracteres");
                }
                break;

            case 'COD_PAIS':
                if( !T321::isCodigo($valor) ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' está com um valor invalido");
                }
                break;

            case 'CNPJ':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 14 caracteres");
                }
                break;

            case 'CPF':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'IE':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'COD_MUN':
                if( strlen($valor) > 14 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 11 caracteres");
                }
                break;

            case 'COD_MUN':
                if( strlen($valor) > 7 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 7 caracteres");
                }
                break;

            case 'SUFRAMA':
                if( strlen($valor) > 9 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais que 7 caracteres");
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
        }
    }
}