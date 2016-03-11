<?php
namespace SEfd\Efd\Tabelas;

/**
 * Class T321
 * @package SEfd\Efd\Tabelas
 * * Essa clase serve para ajudar na validação da tabela 3.2.1 - Tabela Situação do Documento
 */
abstract class T321
{
    private static $registros = [
        '132' => 'AFEGANISTAO',
        '175' => 'ALBANIA, REPUBLICA DA',
        '230' => 'ALEMANHA',
        '310' => 'BURKINA FASO',
        '370' => 'ANDORRA',
        '400' => 'ANGOLA',
        '418' => 'ANGUILLA',
        '434' => 'ANTIGUA E BARBUDA',
        '477' => 'ANTILHAS HOLANDESAS',
        '531' => 'ARABIA SAUDITA',
        '590' => 'ARGELIA',
        '639' => 'ARGENTINA',
        '647' => 'ARMENIA, REPUBLICA DA',
        '655' => 'ARUBA',
        '698' => 'AUSTRALIA',
        '728' => 'AUSTRIA',
        '736' => 'AZERBAIJAO, REPUBLICA DO',
        '779' => 'BAHAMAS, ILHAS',
        '809' => 'BAHREIN, ILHAS',
        '817' => 'BANGLADESH',
        '833' => 'BARBADOS',
        '850' => 'BELARUS, REPUBLICA DA',
        '876' => 'BELGICA',
        '884' => 'BELIZE',
        '906' => 'BERMUDAS',
        '930' => 'MIANMAR (BIRMANIA)',
        '973' => 'BOLIVIA',
        '981' => 'BOSNIA-HERZEGOVINA (REPUBLICA DA)',
        '1015' => 'BOTSUANA',
        '1058' => 'BRASIL',
        '1082' => 'BRUNEI',
        '1112' => 'BULGARIA, REPUBLICA DA',
        '1155' => 'BURUNDI',
        '1198' => 'BUTAO',
        '1279' => 'CABO VERDE, REPUBLICA DE',
        '1376' => 'CAYMAN, ILHAS',
        '1414' => 'CAMBOJA',
        '1457' => 'CAMAROES',
        '1490' => 'CANADA',
        '1504' => 'GUERNSEY, ILHA DO CANAL (INCLUI ALDERNEY E SARK)',
        '1508' => 'JERSEY, ILHA DO CANAL',
        '1511' => 'CANARIAS, ILHAS',
        '1538' => 'CAZAQUISTAO, REPUBLICA DO',
        '1546' => 'CATAR',
        '1589' => 'CHILE',
        '1600' => 'CHINA, REPUBLICA POPULAR',
        '1619' => 'FORMOSA (TAIWAN)',
        '1635' => 'CHIPRE',
        '1651' => 'COCOS(KEELING),ILHAS',
        '1694' => 'COLOMBIA',
        '1732' => 'COMORES, ILHAS',
        '1775' => 'CONGO',
        '1830' => 'COOK, ILHAS',
        '1872' => 'COREIA, REP.POP.DEMOCRATICA',
        '1902' => 'COREIA, REPUBLICA DA',
        '1937' => 'COSTA DO MARFIM',
        '1953' => 'CROACIA (REPUBLICA DA)',
        '1961' => 'COSTA RICA',
        '1988' => 'COVEITE',
        '1996' => 'CUBA',
        '2291' => 'BENIN',
        '2321' => 'DINAMARCA',
        '2356' => 'DOMINICA,ILHA',
        '2399' => 'EQUADOR',
        '2402' => 'EGITO',
        '2437' => 'ERITREIA',
        '2445' => 'EMIRADOS ARABES UNIDOS',
        '2453' => 'ESPANHA',
        '2461' => 'ESLOVENIA, REPUBLICA DA',
        '2470' => 'ESLOVACA, REPUBLICA',
        '2496' => 'ESTADOS UNIDOS',
        '2518' => 'ESTONIA, REPUBLICA DA',
        '2534' => 'ETIOPIA',
        '2550' => 'FALKLAND (ILHAS MALVINAS)',
        '2593' => 'FEROE, ILHAS',
        '2674' => 'FILIPINAS',
        '2712' => 'FINLANDIA',
        '2755' => 'FRANCA',
        '2810' => 'GABAO',
        '2852' => 'GAMBIA',
        '2895' => 'GANA',
        '2917' => 'GEORGIA, REPUBLICA DA',
        '2933' => 'GIBRALTAR',
        '2976' => 'GRANADA',
        '3018' => 'GRECIA',
        '3050' => 'GROENLANDIA',
        '3093' => 'GUADALUPE',
        '3131' => 'GUAM',
        '3174' => 'GUATEMALA',
        '3255' => 'GUIANA FRANCESA',
        '3298' => 'GUINE',
        '3310' => 'GUINE-EQUATORIAL',
        '3344' => 'GUINE-BISSAU',
        '3379' => 'GUIANA',
        '3417' => 'HAITI',
        '3450' => 'HONDURAS',
        '3514' => 'HONG KONG',
        '3557' => 'HUNGRIA, REPUBLICA DA',
        '3573' => 'IEMEN',
        '3595' => 'MAN, ILHA DE',
        '3611' => 'INDIA',
        '3654' => 'INDONESIA',
        '3697' => 'IRAQUE',
        '3727' => 'IRA, REPUBLICA ISLAMICA DO',
        '3751' => 'IRLANDA',
        '3794' => 'ISLANDIA',
        '3832' => 'ISRAEL',
        '3867' => 'ITALIA',
        '3913' => 'JAMAICA',
        '3964' => 'JOHNSTON, ILHAS',
        '3999' => 'JAPAO',
        '4030' => 'JORDANIA',
        '4111' => 'KIRIBATI',
        '4200' => 'LAOS, REP.POP.DEMOCR.DO',
        '4260' => 'LESOTO',
        '4278' => 'LETONIA, REPUBLICA DA',
        '4316' => 'LIBANO',
        '4340' => 'LIBERIA',
        '4383' => 'LIBIA',
        '4405' => 'LIECHTENSTEIN',
        '4421' => 'LITUANIA, REPUBLICA DA',
        '4456' => 'LUXEMBURGO',
        '4472' => 'MACAU',
        '4499' => 'MACEDONIA, ANT.REP.IUGOSLAVA',
        '4502' => 'MADAGASCAR',
        '4525' => 'MADEIRA, ILHA DA',
        '4553' => 'MALASIA',
        '4588' => 'MALAVI',
        '4618' => 'MALDIVAS',
        '4642' => 'MALI',
        '4677' => 'MALTA',
        '4723' => 'MARIANAS DO NORTE',
        '4740' => 'MARROCOS',
        '4766' => 'MARSHALL,ILHAS',
        '4774' => 'MARTINICA',
        '4855' => 'MAURICIO',
        '4880' => 'MAURITANIA',
        '4901' => 'MIDWAY, ILHAS',
        '4936' => 'MEXICO',
        '4944' => 'MOLDAVIA, REPUBLICA DA',
        '4952' => 'MONACO',
        '4979' => 'MONGOLIA',
        '4985' => 'MONTENEGRO',
        '4995' => 'MICRONESIA',
        '5010' => 'MONTSERRAT,ILHAS',
        '5053' => 'MOCAMBIQUE',
        '5070' => 'NAMIBIA',
        '5088' => 'NAURU',
        '5118' => 'CHRISTMAS,ILHA (NAVIDAD)',
        '5177' => 'NEPAL',
        '5215' => 'NICARAGUA',
        '5258' => 'NIGER',
        '5282' => 'NIGERIA',
        '5312' => 'NIUE,ILHA',
        '5355' => 'NORFOLK,ILHA',
        '5380' => 'NORUEGA',
        '5428' => 'NOVA CALEDONIA',
        '5452' => 'PAPUA NOVA GUINE',
        '5487' => 'NOVA ZELANDIA',
        '5517' => 'VANUATU',
        '5568' => 'OMA',
        '5665' => 'PACIFICO,ILHAS DO (POSSESSAO DOS EUA)',
        '5738' => 'PAISES BAIXOS (HOLANDA)',
        '5754' => 'PALAU',
        '5762' => 'PAQUISTAO',
        '5800' => 'PANAMA',
        '5860' => 'PARAGUAI',
        '5894' => 'PERU',
        '5932' => 'PITCAIRN,ILHA',
        '5991' => 'POLINESIA FRANCESA',
        '6033' => 'POLONIA, REPUBLICA DA',
        '6076' => 'PORTUGAL',
        '6114' => 'PORTO RICO',
        '6238' => 'QUENIA',
        '6254' => 'QUIRGUIZ, REPUBLICA',
        '6289' => 'REINO UNIDO',
        '6408' => 'REPUBLICA CENTRO-AFRICANA',
        '6475' => 'REPUBLICA DOMINICANA',
        '6602' => 'REUNIAO, ILHA',
        '6653' => 'ZIMBABUE',
        '6700' => 'ROMENIA',
        '6750' => 'RUANDA',
        '6769' => 'RUSSIA, FEDERACAO DA',
        '6777' => 'SALOMAO, ILHAS',
        '6781' => 'SAINT KITTS E NEVIS',
        '6858' => 'SAARA OCIDENTAL',
        '6874' => 'EL SALVADOR',
        '6904' => 'SAMOA',
        '6912' => 'SAMOA AMERICANA',
        '6955' => 'SAO CRISTOVAO E NEVES,ILHAS',
        '6971' => 'SAN MARINO',
        '7005' => 'SAO PEDRO E MIQUELON',
        '7056' => 'SAO VICENTE E GRANADINAS',
        '7102' => 'SANTA HELENA',
        '7153' => 'SANTA LUCIA',
        '7200' => 'SAO TOME E PRINCIPE, ILHAS',
        '7285' => 'SENEGAL',
        '7315' => 'SEYCHELLES',
        '7358' => 'SERRA LEOA',
        '7370' => 'SERVIA',
        '7412' => 'CINGAPURA',
        '7447' => 'SIRIA, REPUBLICA ARABE DA',
        '7480' => 'SOMALIA',
        '7501' => 'SRI LANKA',
        '7544' => 'SUAZILANDIA',
        '7560' => 'AFRICA DO SUL',
        '7595' => 'SUDAO',
        '7641' => 'SUECIA',
        '7676' => 'SUICA',
        '7706' => 'SURINAME',
        '7722' => 'TADJIQUISTAO, REPUBLICA DO',
        '7765' => 'TAILANDIA',
        '7803' => 'TANZANIA, REP.UNIDA DA',
        '7820' => 'TERRITORIO BRIT.OC.INDICO',
        '7838' => 'DJIBUTI',
        '7889' => 'CHADE',
        '7919' => 'TCHECA, REPUBLICA',
        '7951' => 'TIMOR LESTE',
        '8001' => 'TOGO',
        '8052' => 'TOQUELAU,ILHAS',
        '8109' => 'TONGA',
        '8150' => 'TRINIDAD E TOBAGO',
        '8206' => 'TUNISIA',
        '8230' => 'TURCAS E CAICOS,ILHAS',
        '8249' => 'TURCOMENISTAO, REPUBLICA DO',
        '8273' => 'TURQUIA',
        '8281' => 'TUVALU',
        '8311' => 'UCRANIA',
        '8338' => 'UGANDA',
        '8451' => 'URUGUAI',
        '8478' => 'UZBEQUISTAO, REPUBLICA DO',
        '8486' => 'VATICANO, EST.DA CIDADE DO',
        '8508' => 'VENEZUELA',
        '8583' => 'VIETNA',
        '8630' => 'VIRGENS,ILHAS (BRITANICAS)',
        '8664' => 'VIRGENS,ILHAS (E.U.A.)',
        '8702' => 'FIJI',
        '8737' => 'WAKE, ILHA',
        '8885' => 'CONGO, REPUBLICA DEMOCRATICA DO',
        '8907' => 'ZAMBIA',
        '8958' => 'ZONA DO CANAL DO PANAMA',
        '7600' => 'SUDAO DO SUL',
        '4235' => 'LEBUAN,ILHAS',
        '4885' => 'MAYOTTE (ILHAS FRANCESAS)',
        '5780' => 'PALESTINA',

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