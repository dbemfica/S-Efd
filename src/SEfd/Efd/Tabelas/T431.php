<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class DocumentosFiscais
 * @package SEfd\Efd\Tabelas
 * Essa clase serve para ajudar na validação da tabela 4.3.1 - Tabela Código da Situação Tributária
 */
abstract class T431
{
    private static $tabelaA = [
        '0' => 'Nacional.',
        '1' => 'Estrangeira - Importação direta.',
        '2' => 'Estrangeira - Adquirida no mercado interno.',
    ];

    private static $tabelaB = [
        '0' => 'Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8.',
        '1' => 'Estrangeira - Importação direta, exceto a indicada no código 6',
        '2' => 'Estrangeira - Adquirida no mercado interno, exceto a indicada no código 7.',
        '3' => 'Nacional, mercadoria ou bem com Conteúdo de Importação superior a 40% (quarenta por cento) e inferior ou igual a 70% (setenta por cento).',
        '4' => 'Nacional, cuja produção tenha sido feita em conformidade com os processos produtivos básicos (PPB) de que tratam o Decreto-Lei nº 288/1967, e as Leis nºs 8.248/1991, 8.387/1991, 10.176/2001 e 11.484/2007.',
        '5' => 'Nacional, mercadoria ou bem com Conteúdo de Importação inferior ou igual a 40% (quarenta por cento).',
        '6' => 'Estrangeira - Importação direta, sem similar nacional, constante em lista de Resolução CAMEX e gás natural.',
        '7' => 'Estrangeira - Adquirida no mercado interno, sem similar nacional, constante em lista de Resolução CAMEX e gás natural.',
        '8' => 'Nacional, mercadoria ou bem com Conteúdo de Importação superior a 70% (setenta por cento).',
    ];

    private static $tabelaB2 = [
        '00' => 'Tributada integralmente.',
        '10' => 'Tributada e com cobrança do ICMS por substituição tributária.',
        '20' => 'Com redução de Base de Cálculo.',
        '30' => 'Isenta ou não tributada e com cobrança do ICMS por substituição tributária.',
        '40' => 'Isenta.',
        '41' => 'Não tributada.',
        '50' => 'Com suspensão.',
        '51' => 'Com diferimento.',
        '60' => 'ICMS cobrado anteriormente por substituição tributária.',
        '70' => 'Com redução da Base de Cálculo e cobrança do ICMS por substituição tributária.',
        '90' => 'Outras.',
    ];

    /**
     * Valida se o codigo passado está presente no registro
     */
    public static function isCodigo($codigo)
    {
        foreach( self::$tabelaA as $chave1 => $valor1 ){
            foreach( self::$tabelaB as $chave2 => $valor2 ){
                $codigos[] = $chave1.$chave2;
            }
            foreach( self::$tabelaB2 as $chave2 => $valor2 ){
                $codigos[] = $chave1.$chave2;
            }
        }
        if( in_array($codigo, $codigos) ){
            return true;
        }
        return false;
    }
}