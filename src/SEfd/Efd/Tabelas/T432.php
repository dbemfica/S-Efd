<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T432
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela 4.3.2 - Tabela Código de Tributação do IPI
 */
class T432
{
    private static $registros = [
        '00' => 'Entrada com Recuperação de Crédito',
        '01' => 'Entrada Tributada com Alíquota Zero',
        '02' => 'Entrada Isenta',
        '03' => 'Entrada Não Tributada',
        '04' => 'Entrada Imune',
        '05' => 'Entrada com Suspensão',
        '49' => 'Outras Entradas',
        '50' => 'Saída Tributada',
        '51' => 'Saída Tributável com Alíquota Zero',
        '52' => 'Saída Isenta',
        '53' => 'Saída Não Tributada',
        '54' => 'Saída Imune',
        '55' => 'Saída com Suspensão',
        '99' => 'Outras Saídas',
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