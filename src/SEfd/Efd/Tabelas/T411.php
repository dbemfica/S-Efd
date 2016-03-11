<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class DocumentosFiscais
 * @package SEfd\Efd\Tabelas
 * Essa clase serve para ajudar na validação da tabela 4.1.1 - Tabela Documentos Fiscais do ICMS
 */
abstract class T411
{
    private static $registros = [
        '01' => [
            'descricao' => 'Nota Fiscal',
            'modelo' => '1/1A'
        ],
        '01' => [
            'descricao' => 'Nota Fiscal Avulsa',
            'modelo' => ''
        ],
        '02' => [
            'descricao' => 'Nota Fiscal de Venda a Consumidor',
            'modelo' => '2'
        ],
        '2D' => [
            'descricao' => 'Cupom Fiscal',
            'modelo' => ''
        ],
        '2E' => [
            'descricao' => 'Cupom Fiscal Bilhete de Passagem',
            'modelo' => ''
        ],
        '04' => [
            'descricao' => 'Nota Fiscal de Produtor',
            'modelo' => '4'
        ],
        '06' => [
            'descricao' => 'Nota Fiscal/Conta de Energia Elétrica',
            'modelo' => '6'
        ],
        '07' => [
            'descricao' => 'Nota Fiscal de Serviço de Transporte',
            'modelo' => '7'
        ],
        '08' => [
            'descricao' => 'Conhecimento de Transporte Rodoviário de Cargas',
            'modelo' => '8'
        ],
        '8B' => [
            'descricao' => 'Conhecimento de Transporte de Cargas Avulso',
            'modelo' => '8'
        ],
        '09' => [
            'descricao' => 'Conhecimento de Transporte Aquaviário de Cargas',
            'modelo' => '9'
        ],
        '10' => [
            'descricao' => 'Conhecimento Aéreo',
            'modelo' => '10'
        ],
        '11' => [
            'descricao' => 'Conhecimento de Transporte Ferroviário de Cargas',
            'modelo' => '11'
        ],
        '13' => [
            'descricao' => 'Bilhete de Passagem Rodoviário',
            'modelo' => '13'
        ],
        '14' => [
            'descricao' => 'Bilhete de Passagem Aquaviário',
            'modelo' => '14'
        ],
        '15' => [
            'descricao' => 'Bilhete de Passagem e Nota de Bagagem',
            'modelo' => '15'
        ],
        '17' => [
            'descricao' => 'Despacho de Transporte',
            'modelo' => '17'
        ],
        '16' => [
            'descricao' => 'Bilhete de Passagem Ferroviário',
            'modelo' => '16'
        ],
        '18' => [
            'descricao' => 'Resumo de Movimento Diário',
            'modelo' => '18'
        ],
        '20' => [
            'descricao' => 'Ordem de Coleta de Cargas',
            'modelo' => '20'
        ],
        '21' => [
            'descricao' => 'Nota Fiscal de Serviço de Comunicação',
            'modelo' => '21'
        ],
        '22' => [
            'descricao' => 'Nota Fiscal de Serviço de Telecomunicação',
            'modelo' => '22'
        ],
        '23' => [
            'descricao' => 'GNRE',
            'modelo' => '23'
        ],
        '24' => [
            'descricao' => 'Autorização de Carregamento e Transporte',
            'modelo' => '24'
        ],
        '25' => [
            'descricao' => 'Manifesto de Carga',
            'modelo' => '25'
        ],
        '26' => [
            'descricao' => 'Conhecimento de Transporte Multimodal de Cargas',
            'modelo' => '26'
        ],
        '27' => [
            'descricao' => 'Nota Fiscal De Transporte Ferroviário De Carga',
            'modelo' => ''
        ],
        '28' => [
            'descricao' => 'Nota Fiscal/Conta de Fornecimento de Gás Canalizado',
            'modelo' => ''
        ],
        '29' => [
            'descricao' => 'Nota Fiscal/Conta De Fornecimento D\'água Canalizada',
            'modelo' => ''
        ],
        '55' => [
            'descricao' => 'Nota Fiscal Eletrônica',
            'modelo' => ''
        ],
        '57' => [
            'descricao' => 'Conhecimento de Transporte Eletrônico – CT-e',
            'modelo' => ''
        ],
        '59' => [
            'descricao' => 'Cupom Fiscal Eletrônico – CF-e',
            'modelo' => ''
        ],
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