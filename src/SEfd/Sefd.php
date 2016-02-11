<?php
namespace SEfd;

class SEfd
{

    /*
     * Código da versão do leiaute conforme a tabela indicada no Ato COTEPE.
     * Verificar na Tabela Versão (http://www1.receita.fazenda.gov.br/sistemas/spedfiscal/tabelas-de-codigos.htm)
     * @param string
     */
    private $versaoLeiaute;

    /*
     * Código da finalidade do arquivo:
     * 0 - Remessa do arquivo original;
     * 1 - Remessa do arquivo substituto.
     * @param int
     */
    private $codigoFinalidade;

    /*
     * O periodos das informações contidas no arquivo
     * (MMAAAA) Mês e Ano
     */
    private $periodoInformacao;

    private $nomeEntidade;
    private $cnpjEntidade;
    private $cpfEntidade;
    private $ufEntidade;
    private $ieEntidade;
    private $codMunEntidade;
    private $imEntidade;
    private $suframaEntidade;

    /*
     * Perfil de apresentação do arquivo fiscal;
     * A – Perfil A;
     * B – Perfil B.;
     * C – Perfil C.
     * @param string
     */
    private $indentificacaoPerfil;

    /*
     * Indicador de tipo de atividade:
     * 0 – Industrial ou equiparado a industrial;
     * 1 – Outros.
     * @param int
     */
    private $indicadorAtividade;

    /*
     * Indicador de movimento:
     * 0- Bloco com dados informados;
     * 1- Bloco sem dados informados
     * @param int
     */
    private $indicadorMovimento;



    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    /*
     * Esse metodo faz a impressão do arquivo no formato TXT
     */
    public function printTxt()
    {
        $efd = new Efd\Efd();
        $efd->makeBloco0($this);
        $efd->printTxt();
//        echo "<pre>";
//        print_r($efd);
//        echo "</pre>";
    }
}