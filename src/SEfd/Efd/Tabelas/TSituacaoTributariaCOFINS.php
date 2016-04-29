<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T412
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela da Situacao tributaria do COFINS
 */
abstract class TSituacaoTributariaCOFINS
{
    private static $registros = [
        '01' => 'Operação Tributável com Alíquota Básica',
        '02' => 'Operação Tributável com Alíquota Diferenciada',
        '03' => 'Operação Tributável com Alíquota por Unidade de Medida de Produto',
        '04' => 'Operação Tributável Monofásica - Revenda a Alíquota Zero',
        '05' => 'Operação Tributável por Substituição Tributária',
        '06' => 'Operação Tributável a Alíquota Zero',
        '07' => 'Operação Isenta da Contribuição',
        '08' => 'Operação sem Incidência da Contribuição',
        '09' => 'Operação com Suspensão da Contribuição',
        '49' => 'Outras Operações de Saída',
        '50' => 'Operação com Direito a Crédito - Vinculada Exclusivamente a Receita Tributada no Mercado Interno',
        '51' => 'Operação com Direito a Crédito - Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno',
        '52' => 'Operação com Direito a Crédito - Vinculada Exclusivamente a Receita de Exportação',
        '53' => 'Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno',
        '54' => 'Operação com Direito a Crédito - Vinculada a Receitas Tributadas no Mercado Interno e de Exportação',
        '55' => 'Operação com Direito a Crédito - Vinculada a Receitas Não Tributadas no Mercado Interno e de Exportação',
        '56' => 'Operação com Direito a Crédito - Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação',
        '60' => 'Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno',
        '61' => 'Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno',
        '62' => 'Crédito Presumido - Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação',
        '63' => 'Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno',
        '64' => 'Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação',
        '65' => 'Crédito Presumido - Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação',
        '66' => 'Crédito Presumido - Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação',
        '67' => 'Crédito Presumido - Outras Operações',
        '70' => 'Operação de Aquisição sem Direito a Crédito',
        '71' => 'Operação de Aquisição com Isenção',
        '72' => 'Operação de Aquisição com Suspensão',
        '73' => 'Operação de Aquisição a Alíquota Zero',
        '74' => 'Operação de Aquisição sem Incidência da Contribuição',
        '75' => 'Operação de Aquisição por Substituição Tributária',
        '98' => 'Outras Operações de Entrada',
        '99' => 'Outras Operações'
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