<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T412
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela 5.4 - Tabela Códigos das Obrigações do ICMS a Recolher
 */
class T54
{
    private static $registros = [
        '000' => 'ICMS a recolher',
        '001' => 'ICMS da substituição tributária pelas entradas',
        '002' => 'ICMS da substituição tributária pelas saídas para o Estado',
        '003' => 'Antecipação do diferencial de alíquotas do ICMS',
        '004' => 'Antecipação do ICMS da importação',
        '005' => 'Antecipação tributária',
        '006' => 'ICMS resultante da alíquota adicional dos itens incluídos no Fundo de Combate à Pobreza',
        '090' => 'Outras obrigações do ICMS',
        '999' => 'ICMS da substituição tributária pelas saídas para outro Estado'
    ];

    /**
     * Valida se o codigo passado está presente no registro
     */
    public static function isCodigo($codigo)
    {
        foreach( self::$registros as $chave => $valor ){
            $codigos[] = $chave;
        }
        if( in_array($codigo, $codigos) ){
            return true;
        }
        return false;
    }
}