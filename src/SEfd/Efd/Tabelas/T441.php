<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T441
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela 4.4.1 - Tabela Classificação de Itens de Energia Elétrica, Serviços de Comunicação e Telecomunicação.
 */
abstract class T441
{
    private static $registros = [
        '0101' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de serviços de telefonia'
        ],
        '0102' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de serviços de comunicação de dados'
        ],
        '0103' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de serviços de TV por Assinatura'
        ],
        '0104' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de serviços de provimento à internet'
        ],
        '0105' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de outros serviços de multimídia'
        ],
        '0199' => [
            'grupo' => '01. Assinatura',
            'descricao' => 'Assinatura de outros serviços'
        ],
        '0201' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de serviços de telefonia'
        ],
        '0202' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de serviços de comunicação de dados'
        ],
        '0203' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de TV por Assinatura'
        ],
        '0204' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de serviços de provimento à internet'
        ],
        '0205' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de outros serviços multimídia'
        ],
        '0299' => [
            'grupo' => '02. Habilitação',
            'descricao' => 'Habilitação de outros serviços'
        ],
        '0301' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas locais'
        ],
        '0302' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas interurbanas no Estado'
        ],
        '0303' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas interurbanas para fora do Estado'
        ],
        '0304' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas internacionais'
        ],
        '0305' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - Números Especiais (0300/0500/0600/0800/etc.)'
        ],
        '0306' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - comunicação de dados'
        ],
        '0307' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas originadas em Roaming'
        ],
        '0308' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - chamadas recebidas em Roaming'
        ],
        '0309' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - adicional de chamada'
        ],
        '0310' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - provimento de acesso à Internet'
        ],
        '0311' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - pay-per-view (programação TV)'
        ],
        '0312' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - Mensagem SMS'
        ],
        '0313' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - Mensagem MMS'
        ],
        '0314' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - outros mensagens'
        ],
        '0315' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - serviço multimídia'
        ],
        '0399' => [
            'grupo' => '03. Serviço Medido',
            'descricao' => 'Serviço Medido - outros serviços'
        ],
        '0401' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Cartão Telefônico - Telefonia Fixa'
        ],
        '0402' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Cartão Telefônico - Telefonia Móvel'
        ],
        '0403' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Cartão de Provimento de acesso à internet'
        ],
        '0404' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Ficha Telefônica'
        ],
        '0405' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Recarga de Créditos - Telefonia Fixa'
        ],
        '0406' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Recarga de Créditos - Telefonia Móvel'
        ],
        '0407' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Recarga de Créditos - Provimento de acesso à Internet'
        ],
        '0499' => [
            'grupo' => '04. Serviço pré-pago',
            'descricao' => 'Outras cobranças realizadas de assinantes de plano serviço pré-pago'
        ],
        '0501' => [
            'grupo' => '05. Outros Serviços',
            'descricao' => 'Serviço Adicional (substituição de número, troca de aparelho, emissão de 2ª via de conta, conta detalhada, etc.)'
        ],
        '0502' => [
            'grupo' => '05. Outros Serviços',
            'descricao' => 'Serviço Facilidades (identificador de chamadas, caixa postal, transferência temporária, não-perturbe, etc.)'
        ],
        '0599' => [
            'grupo' => '05. Outros Serviços',
            'descricao' => 'Outros Serviços'
        ],
        '0601' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Energia Elétrica - Consumo'
        ],
        '0602' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Energia Elétrica - Demanda'
        ],
        '0603' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Energia Elétrica - Serviços (Vistoria de unidade consumidora, Aferição de Medidor, Ligação, Religação, Troca de medidor, etc.)'
        ],
        '0604' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Energia Elétrica - Encargos Emergenciais'
        ],
        '0605' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Tarifa de Uso dos Sistemas de Distribuição de Energia Elétrica - TUSD - Consumidor Cativo'
        ],
        '0606' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Tarifa de Uso dos Sistemas de Distribuição de Energia Elétrica - TUSD - Consumidor Livre'
        ],
        '0607' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Encargos de Conexão'
        ],
        '0608' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Tarifa de Uso dos Sistemas de Transmissão de Energia Elétrica - TUST - Consumidor Cativo'
        ],
        '0609' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Tarifa de Uso dos Sistemas de Transmissão de Energia Elétrica - TUST - Consumidor Livre'
        ],
        '0610' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Subvenção econômica para consumidores da subclasse "baixa renda"'
        ],
        '0699' => [
            'grupo' => '06. Energia Elétrica',
            'descricao' => 'Energia Elétrica - Outros"'
        ],
        '0701' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Aparelho Telefônico'
        ],
        '0702' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Aparelho Identificador de chamadas'
        ],
        '0703' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Modem'
        ],
        '0704' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Rack'
        ],
        '0705' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Sala/Recinto'
        ],
        '0706' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Roteador'
        ],
        '0707' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Servidor'
        ],
        '0708' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Multiplexador'
        ],
        '0709' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'de Decodificador/Conversor'
        ],
        '0799' => [
            'grupo' => '07. Disponibilização de meios ou equipamentos',
            'descricao' => 'Outras disponibilizações'
        ],
        '0801' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Serviços de Terceiros'
        ],
        '0802' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Seguros'
        ],
        '0803' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Financiamento de Aparelho/Serviços'
        ],
        '0804' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Juros de Mora'
        ],
        '0805' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Multa de Mora'
        ],
        '0806' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Conta de meses anteriores'
        ],
        '0807' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Cobrança de Taxa Iluminação Pública'
        ],
        '0808' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Retenção de ICMS-ST'
        ],
        '0899' => [
            'grupo' => '08. Cobranças',
            'descricao' => 'Outras Cobranças'
        ],
        '0901' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Dedução relativa a impugnação de serviços'
        ],
        '0902' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Dedução referente ajuste de conta'
        ],
        '0903' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Redutor - Energia Elétrica - IN Nº 306/2003 (PIS/COFINS/IRPJ/CSLL)'
        ],
        '0904' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Dedução relativa à multa pela interrupção de fornecimento'
        ],
        '0905' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Dedução relativa à distribuição de dividendos Eletrobrás'
        ],
        '0906' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Dedução relativa à subvenção econômica para consumidores da subclasse "baixa renda"'
        ],
        '0999' => [
            'grupo' => '09. Deduções',
            'descricao' => 'Outras deduções'
        ],
        '1001' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de serviços de telefonia'
        ],
        '1002' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de serviços de comunicação de dados'
        ],
        '1003' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de serviços de TV por Assinatura'
        ],
        '1004' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de serviços de provimento à internet'
        ],
        '1005' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de outros serviços de multimídia'
        ],
        '1099' => [
            'grupo' => '10. Serviço não medido',
            'descricao' => 'Serviço não medido de outros serviços'
        ]
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