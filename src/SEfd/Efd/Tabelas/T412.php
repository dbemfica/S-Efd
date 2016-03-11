<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T412
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela 4.1.2 - Tabela Situação do Documento
 */
abstract class T412
{
    private static $registros = [
        '00' => 'Documento regular',
        '01' => 'Escrituração extemporânea de documento regular',
        '02' => 'Documento cancelado',
        '03' => 'Escrituração extemporânea de documento cancelado',
        '04' => 'NF-e ou CT-e – denegado',
        '05' => 'NF-e ou CT-e - Numeração inutilizada',
        '06' => 'Documento Fiscal Complementar',
        '07' => 'Escrituração extemporânea de documento complementar',
        '08' => 'Documento Fiscal emitido com base em Regime Especial ou Norma Específica',
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