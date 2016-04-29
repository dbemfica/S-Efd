<?php
namespace SEfd\Efd\BlocoC;

use SEfd\Efd\Efd;

class BlocoC
{
    public $C001;
    public $C100 = array();
    public $C990;

    public function addC001(C001 $c001)
    {
        $this->C001 = $c001;
    }
    public function addC100(C100 $c100)
    {
        if ($this->validateC100($c100)) {
            $this->C100[] = $c100;
        }
    }
    public function addC170(C170 $c170)
    {
        $this->C100[(count( $this->C100)-1)]->C170[] = $c170;
    }
    public function addC190(C190 $c190)
    {
        $this->C100[(count( $this->C100)-1)]->C190[] = $c190;
    }
    public function addC990(C990 $c990)
    {
        if ( $this->validateC190() ) {
            $this->C990 = $c990;
        }

    }

    /*
     * Essa função monta o registro C190
     */
    public function makeC190($COD_OBS)
    {
        $vetor = array();
        foreach( $this->C100[(count( $this->C100)-1)]->C170 as $c170 ){
            $chave = $c170->CST_ICMS.$c170->CFOP.$c170->ALIQ_ICMS;
            $vetor[$chave]['CST_ICMS'] = $c170->CST_ICMS;
            $vetor[$chave]['CFOP'] = $c170->CFOP;
            $vetor[$chave]['ALIQ_ICMS'] = $c170->ALIQ_ICMS;
            $vetor[$chave]['VL_OPR'] += $c170->VL_OPR;
            $vetor[$chave]['VL_BC_ICMS'] += $c170->VL_BC_ICMS;
            $vetor[$chave]['VL_ICMS'] += $c170->VL_ICMS;
            $vetor[$chave]['VL_BC_ICMS_ST'] += $c170->VL_BC_ICMS_ST;
            $vetor[$chave]['VL_ICMS_ST'] += $c170->VL_ICMS_ST;
            $vetor[$chave]['VL_RED_BC'] += $c170->VL_OPR-$c170->VL_BC_ICMS;
            $vetor[$chave]['VL_IPI'] += $c170->VL_IPI;
        }

        foreach( $vetor as $registro ){
            if( substr($registro['CST_ICMS'],-2) != '20' && substr($registro['CST_ICMS'],-2) != '70' && substr($registro['CST_ICMS'],-2) != '90' ){
                $registro['VL_RED_BC'] = NULL;
            }else{
                if( $registro['VL_RED_BC'] <= 0 && (substr($registro['CST_ICMS'],-2) == '20' || substr($registro['CST_ICMS'],-2) == '70') ){
                    throw new \InvalidArgumentException("O campo 'VL_RED_BC' tem que ser maior que '0' quando os dois ultimos digitos do 'CST_ICMS' forem 20 ou 70");
                }
            }

            $c190 = new C190();
            $c190->CST_ICMS = $registro['CST_ICMS'];
            $c190->CFOP = $registro['CFOP'];
            $c190->ALIQ_ICMS = $registro['ALIQ_ICMS'];
            $c190->VL_OPR = $registro['VL_OPR'];
            $c190->VL_BC_ICMS = $registro['VL_BC_ICMS'];
            $c190->VL_ICMS = $registro['VL_ICMS'];
            $c190->VL_BC_ICMS_ST = $registro['VL_BC_ICMS_ST'];
            $c190->VL_ICMS_ST = $registro['VL_ICMS_ST'];
            $c190->VL_RED_BC = $registro['VL_RED_BC'];
            $c190->VL_IPI = $registro['VL_IPI'];
            $c190->COD_OBS = $COD_OBS;
            $this->addC190($c190);
        }
    }

    /*
     * Essa função monta o registro C990
     */
    public function makeC990()
    {
        $QTD_LIN_C = 1;
        if( !empty($this->C001) ) $QTD_LIN_C++;
        if( !empty($this->C100) ){
            $QTD_LIN_C += count($this->C100);

            for( $i = 0; $i < count($this->C100); $i++ ){
                if ( $this->C100[$i]->IND_OPER == 1 || $this->C100[$i]->IND_EMIT == 1 && $this->C100[$i]->COD_SIT != '06' ) {
                    $QTD_LIN_C += count($this->C100[$i]->C170);
                }
                $QTD_LIN_C += count($this->C100[$i]->C190);
            }
        }
        $c990 = new C990();
        $c990->QTD_LIN_C = $QTD_LIN_C;
        $this->addC990($c990);
    }

    /*
     * Esse metodo valida as informações presentes no Registro C100
     */
    public function validateC100(C100 $c100)
    {
        if ( $c100->COD_SIT != '02' && $c100->COD_SIT != '03' && $c100->COD_SIT != '04' ) {
            if( $c100->IND_PGTO !== 0 && $c100->IND_PGTO !== 1 && $c100->IND_PGTO !== 2 ){
                throw new \InvalidArgumentException("O campo 'indicadorPagamento' só pode ter valores 0,1 ou 2");
            }
            if( $c100->IND_FRT !== 0 && $c100->IND_FRT !== 1 && $c100->IND_FRT !== 2 && $c100->IND_FRT !== 9){
                throw new \InvalidArgumentException("O campo 'indicadorFrete' só pode ter valores 0,1,2 ou 9");
            }
            if ($c100->IND_OPER == 0 && $c100->DT_E_S == '') {
                throw new \InvalidArgumentException("Quando a nota tem 'indicadorOperacao' = 0 a 'dataEntradaSaida' não pode estar vazia");
            }
            if ($c100->IND_EMIT == 0 && $c100->COD_MOD == '55' && $c100->CHV_NFE == '') {
                throw new \InvalidArgumentException("Quando a nota tem 'indicadorEmitente' = 0 e o 'codigoModelo' = 55 a 'chaveNFE' não pode estar vazia");
            }
            if ($c100->IND_EMIT == 1 && $c100->COD_MOD == '65' && $c100->CHV_NFE == '') {
                throw new \InvalidArgumentException("Quando a nota tem 'indicadorEmitente' = 1 e o 'codigoModelo' = 65 a 'chaveNFE' não pode estar vazia");
            }
            if ( ($c100->COD_MOD != '55' && $c100->COD_MOD != '57' && $c100->COD_MOD != '65') && $c100->CHV_NFE != "" ) {
                throw new \InvalidArgumentException("Quando a nota tem 'Modelo' = 55, 57 e 65 a Chave tem que estar vazia");
            }
        }

        if ( $c100->COD_SIT == '02' || $c100->COD_SIT == '03' || $c100->COD_SIT == '04' ) {
            if ( $c100->COD_PART != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->DT_DOC != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->DT_E_S != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_DOC != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->IND_PGTO != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_DESC != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_ABAT_NT != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_MERC != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->IND_FRT != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_FRT != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_SEG != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_OUT_DA != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_BC_ICMS != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_ICMS != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_BC_ICMS_ST != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_ICMS_ST != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_IPI != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_PIS != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_COFINS != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_PIS_ST != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
            if ( $c100->VL_COFINS_ST != '' ) {
                throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), somente informar os campos 'codigoSituacao', 'indicadorOperacao', 'codigoModelo' e a 'chaveNFE'");
            }
        }
        return true;
    }

    /*
     * Esse metodo valida as informações presentes no Registro C170
     */
    public function validateC170(Efd $efd, C170 $c170)
    {
        $C100 = $efd->blocoC->C100;

        if ( $C100->COD_SIT == '02' || $C100->COD_SIT == '03' || $C100->COD_SIT == '04' ) {
            throw new \InvalidArgumentException("Para documentos fiscal cancelado (código da situação = 02 ou 03) ou NF-e denegada(04), não pode informar os itens");
        }

        $CST_ICMS = $c170->CST_ICMS;
        $ALIQ_ICMS = $c170->ALIQ_ICMS;

        if ( $C100->IND_OPER == 0 ) {
            $CFOP = $c170->CFOP;
            if ( substr($CFOP,0,1) != '1' && substr($CFOP,0,1) != '2' && substr($CFOP,0,1) != '3' ) {
                throw new \InvalidArgumentException("Para operações de entrada a CFOP tem que iniciar por 1,2 ou 3");
            }
            if( $c170->CST_IPI >= 50 ){
                throw new \InvalidArgumentException("Para operações de entrada a CST_IPI deve ser menor que 50");
            }
        }

        if($C100->IND_OPER == 1){
            $CFOP = $c170->CFOP;
            if ( substr($CFOP,0,1) != '5' && substr($CFOP,0,1) != '6' && substr($CFOP,0,1) != '7' ) {
                throw new \InvalidArgumentException("Para operações de saida a CFOP tem que iniciar por 5,6 ou 7");
            }
            if( $c170->CST_IPI < 50 ){
                throw new \InvalidArgumentException("Para operações de saida a CST_IPI deve ser menor que 50");
            }
        }

        //CST_ICMS
        if ( substr($CST_ICMS,-2) == '00' || substr($CST_ICMS,-2) == '10' || substr($CST_ICMS,-2) == '20' || substr($CST_ICMS,-2) == '70') {
            if ( $ALIQ_ICMS <= 0 ) {
                throw new \InvalidArgumentException("O campo 'valorBaseCalculo' deve ser maior que '0' (zero)");
            }
        }
        return true;
    }

    /*
     * Esse metodo valida as informações presentes no Registro C190
     */
    public function validateC190()
    {
        return true;
    }
}