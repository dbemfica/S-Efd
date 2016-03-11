<?php
namespace SEfd\Efd\Bloco0;

class _0450
{
    /*
     * Texto fixo contendo "0450""
     * @param string
     */
    private $REG = "0450";

    /*
     * Código da informação complementar do documento fiscal.
     * @param string
     */
    private $COD_INF;

    /*
     * Texto livre da informação complementar existente no documento fiscal,
     * inclusive espécie de normas legais,
     * poder normativo, número, capitulação,
     * data e demais referências pertinentes com indicação referentes ao tributo.
     * @param string
     */
    private $TXT;

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
                if( $this->REG === '0450"' ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' tem que ter o valor '0450\"'");
                }
                break;
            case 'COD_INF':
                if( strlen($valor) > 6 ){
                    throw new \InvalidArgumentException("O campo '{$atributo}' não pode ter mais 6 caracteres");
                }
                break;
        }
    }
}