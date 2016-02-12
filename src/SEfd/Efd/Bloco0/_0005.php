<?php
namespace SEfd\Efd\Bloco0;

class _0005
{
    /*
     * Texto fixo contendo "0005"
     * @param string
     */
    private $REG = "0005";

    /*
     * Nome de fantasia associado ao nome empresarial
     * @param string
     */
    private $FANTASIA;

    /*
     * Código de Endereçamento Postal.
     * @param string
     */
    private $CEP;

    /*
     * Número do imóvel.
     * @param string
     */
    private $END;

    /*
     * Dados complementares do endereço.
     * @param string
     */
    private $COMPL;

    /*
     * Bairro em que o imóvel está situado.
     * @param string
     */
    private $BAIRRO;

    /*
     * Número do telefone (DDD+FONE).
     * @param string
     */
    private $FONE;

    /*
     * Número do fax.
     * @param string
     */
    private $FAX;

    /*
     * Endereço do correio eletrônico.
     * @param string
     */
    private $EMAIL;

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
                if( $this->REG === '0005' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0005'");
                }
                break;

            case 'FANTASIA':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'CEP':
                if( strlen($valor) != 8 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' só pode ter 8 caracteres");
                }
                break;

            case 'END':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'NUM':
                if( strlen($valor) > 10 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 10 caracteres");
                }
                break;

            case 'COMPL':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'BAIRRO':
                if( strlen($valor) > 60 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 60 caracteres");
                }
                break;

            case 'FONE':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 11 caracteres");
                }
                break;

            case 'FAX':
                if( strlen($valor) > 11 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 11 caracteres");
                }
                break;
        }
    }
}