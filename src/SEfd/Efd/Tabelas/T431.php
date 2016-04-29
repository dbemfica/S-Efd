<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T431
 * @package SEfd\Efd\Tabelas
 * Essa clase serve para ajudar na validação da tabela 4.3.1 - Tabela Código da Situação Tributária
 */
abstract class T431
{
    private static $tabelaA = [
        '0' => 'Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8.',
        '1' => 'Estrangeira - Importação direta, exceto a indicada no código 6',
        '2' => 'Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7.',
        '3' => 'Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% (quarenta por cento) e inferior ou igual a 70% (setenta por cento).',
        '4' => 'Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos (PPB) de que tratam o Decreto-Lei nº 288/1967, e as Leis nºs 8.248/1991, 8.387/1991, 10.176/2001 e 11.484/2007.',
        '5' => 'Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40% (quarenta por cento).',
        '6' => 'Estrangeira - Importação direta, sem similar nacional, constante em lista de Resolução CAMEX e gás natural.',
        '7' => 'Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução CAMEX e gás natural.'
    ];

    private static $tabelaB = [
        '00' => 'Tributada integralmente',
        '10' => 'Tributada e com cobrança do ICMS por substituição tributária',
        '20' => 'Com redução de base de cálculo',
        '30' => 'Isenta ou não tributada e com cobrança do ICMS por substituição tributária',
        '40' => 'Isenta',
        '41' => 'Não tributada',
        '50' => 'Suspensão',
        '51' => 'Diferimento',
        '60' => 'ICMS cobrado anteriormente por substituição tributária',
        '70' => 'Com redução de base de cálculo e cobrança do ICMS por substituição tributária',
        '90' => 'Outras'
    ];

    /**
     * Valida se o codigo passado está presente no registro
     */
    public static function isCodigo($codigo)
    {
        foreach( self::$tabelaA as $chave => $valor ){
            $codigos[] = $chave;
        }
        foreach( self::$tabelaB as $chave => $valor ){
            $codigos[] = $chave;
        }
        if( in_array($codigo, $codigos) ){
            return true;
        }
        return false;
    }
}