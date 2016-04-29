<?php
namespace SEfd\Efd\BlocoD;

use SEfd\Efd\Efd;

class BlocoD
{
    public $D001;
    public $D500 = array();
    public $D990;

    public function addD001(D001 $d001)
    {
        $this->D001 = $d001;
    }
    public function addD500(D500 $d500)
    {
        $this->D500[] = $d500;
    }
    public function addD510(D510 $d510)
    {
        $this->D500[(count( $this->D500)-1)]->D510[] = $d510;
    }
    public function addD590(D590 $d590)
    {
        $this->D500[(count( $this->D500)-1)]->D590[] = $d590;
    }
    public function addD990(D990 $d990)
    {
        $this->D990 = $d990;
    }

    /*
     * Essa função monta o registro D590
     */
    public function makeD590($COD_OBS)
    {
        $vetor = array();
        foreach( $this->D500[(count( $this->D500)-1)]->D510 as $d510 ){
            $chave = $d510->CST_ICMS.$d510->CFOP.$d510->ALIQ_ICMS;
            $vetor[$chave]['CST_ICMS'] = $d510->CST_ICMS;
            $vetor[$chave]['CFOP'] = $d510->CFOP;
            $vetor[$chave]['ALIQ_ICMS'] = $d510->ALIQ_ICMS;
            $vetor[$chave]['VL_OPR'] += ($d510->VL_ITEM+$d510->VL_ICMS+$d510->VL_PIS+$d510->VL_COFINS-$d510->VL_DESC);
            $vetor[$chave]['VL_BC_ICMS'] += $d510->VL_BC_ICMS;
            $vetor[$chave]['VL_ICMS'] += $d510->VL_ICMS;
            $vetor[$chave]['VL_BC_ICMS_UF'] += $d510->VL_BC_ICMS_UF;
            $vetor[$chave]['VL_ICMS_UF'] += $d510->VL_ICMS_UF;
            $vetor[$chave]['VL_RED_BC'] += $d510->VL_RED_BC;
        }

        foreach( $vetor as $registro ){
            if( substr($registro['CST_ICMS'],-2) != '20' && substr($registro['CST_ICMS'],-2) != '70' && substr($registro['CST_ICMS'],-2) != '90' ){
                $registro['VL_RED_BC'] = NULL;
            }else{
                if( $registro['VL_RED_BC'] <= 0 && (substr($registro['CST_ICMS'],-2) == '20' || substr($registro['CST_ICMS'],-2) == '70') ){
                    throw new \InvalidArgumentException("O campo 'VL_RED_BC' tem que ser maior que '0' quando os dois ultimos digitos do 'CST_ICMS' forem 20 ou 70");
                }
            }

            $d590 = new D590();
            $d590->CST_ICMS = $registro['CST_ICMS'];
            $d590->CFOP = $registro['CFOP'];
            $d590->ALIQ_ICMS = $registro['ALIQ_ICMS'];
            $d590->VL_OPR = $registro['VL_OPR'];
            $d590->VL_BC_ICMS = $registro['VL_BC_ICMS'];
            $d590->VL_ICMS = $registro['VL_ICMS'];
            $d590->VL_BC_ICMS_UF = $registro['VL_BC_ICMS_UF'];
            $d590->VL_ICMS_UF = $registro['VL_ICMS_UF'];
            $d590->VL_RED_BC = $registro['VL_RED_BC'];
            $d590->COD_OBS = $COD_OBS;
            $this->addD590($d590);
        }
    }

    /*
     * Essa função monta o registro D990
     */
    public function makeD990()
    {
        $QTD_LIN_D = 1;
        if( !empty($this->D001) ) $QTD_LIN_D++;
        if( !empty($this->D500) ){
            $QTD_LIN_D += count($this->D500);

            for( $i = 0; $i < count($this->D500); $i++ ){
                $QTD_LIN_D += count($this->D500[$i]->D510);
                $QTD_LIN_D += count($this->D500[$i]->D590);
            }
        }
        $d990 = new D990();
        $d990->QTD_LIN_D = $QTD_LIN_D;
        $this->addD990($d990);
    }

    /*
     * Esse metodo valida as informações presentes no Registro D500
     */
    public function validateD500(Efd $efd, D500 $d500)
    {
        //return true;

        //VALLIDAR DATA
        $DT_FIN = $efd->bloco0->_0000->DT_FIN;
        $DT_FIN = new \DateTime( $DT_FIN[4].$DT_FIN[5].$DT_FIN[6].$DT_FIN[7]."-".$DT_FIN[2].$DT_FIN[3]."-".$DT_FIN[0].$DT_FIN[1] );

        $DT_DOC = $d500->DT_DOC;
        $DT_DOC = new \DateTime( $DT_DOC[4].$DT_DOC[5].$DT_DOC[6].$DT_DOC[7]."-".$DT_DOC[2].$DT_DOC[3]."-".$DT_DOC[0].$DT_DOC[1] );
        if( $DT_DOC > $DT_FIN ){
            throw new \InvalidArgumentException("O 'dataEmissao' não pode ser maior que a 'DataFinal' no registro 0000");
        }

        if( !empty($d500->DT_A_P) ){
            $DT_A_P = $d500->DT_A_P;
            $DT_A_P = new \DateTime( $DT_A_P[4].$DT_A_P[5].$DT_A_P[6].$DT_A_P[7]."-".$DT_A_P[2].$DT_A_P[3]."-".$DT_A_P[0].$DT_A_P[1] );
            if( $DT_A_P > $DT_FIN ){
                throw new \InvalidArgumentException("O 'dataEntradaSaida' não pode ser maior que a 'DataFinal' no registro 0000");
            }
        }
        return true;
    }

    /*
     * Esse metodo valida as informações presentes no Registro D510
     */
    public function validateD510(Efd $efd, D510 $d510)
    {
        $CST_ICMS = $d510->CST_ICMS;
        $IND_OPER = $efd->blocoD->D500[(count($efd->blocoD->D500)-1)]->IND_OPER;
        $CFOP = $d510->CFOP;
        $IND_REC = $d510->IND_REC;
        $VL_BC_ICMS = $d510->VL_BC_ICMS;
        $ALIQ_ICMS = $d510->ALIQ_ICMS;
        $VL_ICMS = $d510->VL_ICMS;
        $VL_DESC = $d510->VL_DESC;
        $VL_ICMS = $d510->VL_ICMS;
        $VL_BC_ICMS_UF = $d510->VL_BC_ICMS_UF;
        $VL_ICMS_UF = $d510->VL_ICMS_UF;
        $VL_PIS = $d510->VL_PIS;
        $VL_COFINS = $d510->VL_COFINS;

        //VALIDA O NUMERO DE ITENS
        if (!empty($efd->blocoD->D500[(count($efd->blocoD->D500)-1)]->D510)) {
            foreach ($efd->blocoD->D500[(count($efd->blocoD->D500)-1)]->D510 as $registro) {
                $NUM_ITEM[] = $registro->NUM_ITEM;
            }
        }
        if (!empty($NUM_ITEM)) {
            if (in_array($d510->NUM_ITEM, $NUM_ITEM)) {
                throw new \InvalidArgumentException("O campo 'numeroItem' não pode se repetir");
            }
        }

        //VL_BC_ICMS
        if( !empty($VL_BC_ICMS) && !is_numeric($VL_BC_ICMS) ){
            throw new \InvalidArgumentException("O campo 'valorBaseCalculo' precisa der numerico(float)");
        }
        if( $IND_REC == 1 && $VL_BC_ICMS != 0 ){
            throw new \InvalidArgumentException("O campo 'valorBaseCalculo' deve ser igual a '0' (zero) caso o valor do Campo 'indicadorReceita' seja 1");
        }

        //ALIQ_ICMS
        if( !empty($ALIQ_ICMS) && !is_numeric($ALIQ_ICMS) ){
            throw new \InvalidArgumentException("O campo 'aliquotaICMS' precisa der numerico(float)");
        }
        if( ( $IND_REC == 1 || $IND_REC == 5 || $IND_REC == 9 ) && $ALIQ_ICMS != 0 ){
            throw new \InvalidArgumentException("O campo 'aliquotaICMS' deve ser igual a '0' (zero) caso o valor do Campo 'indicadorReceita' seja 1, 5 ou 9");
        }

        //VL_ICMS
        if( !empty($VL_ICMS) && !is_numeric($VL_ICMS) ){
            throw new \InvalidArgumentException("O campo 'valorICMS' precisa der numerico(float)");
        }
        if( ( $IND_REC == 1 || $IND_REC == 5 || $IND_REC == 9 ) && $VL_ICMS != 0 ){
            throw new \InvalidArgumentException("O campo 'valorICMS' deve ser igual a '0' (zero) caso o valor do Campo 'indicadorReceita' seja 1, 5 ou 9");
        }

        //VL_DESC
        if( !empty($VL_DESC) && !is_numeric($VL_DESC) ){
            throw new \InvalidArgumentException("O campo 'ValorDesconto' precisa der numerico(float)");
        }

        //VL_BC_ICMS_UF
        if( !empty($VL_BC_ICMS_UF) && !is_numeric($VL_BC_ICMS_UF) ){
            throw new \InvalidArgumentException("O campo 'valorBaseCalculoUF' precisa der numerico(float)");
        }

        //VL_ICMS_UF
        if( !empty($VL_ICMS_UF) && !is_numeric($VL_ICMS_UF) ){
            throw new \InvalidArgumentException("O campo 'valorICMSUF' precisa der numerico(float)");
        }

        //VL_PIS
        if( !empty($VL_PIS) && !is_numeric($VL_PIS) ){
            throw new \InvalidArgumentException("O campo 'valorPIS' precisa der numerico(float)");
        }

        //VL_COFINS
        if( !empty($VL_COFINS) && !is_numeric($VL_COFINS) ){
            throw new \InvalidArgumentException("O campo 'valorCOFINS' precisa der numerico(float)");
        }

        //CFOP
        if ($IND_OPER == 0 && (substr($CFOP,0,1) != '1' && substr($CFOP,0,1) != '2' && substr($CFOP,0,1) != '3')) {
            throw new \InvalidArgumentException("CFOP inválido. Utilizar CFOP com primeiro caracter = 1, 2 ou 3, quando for operação de entrada");
        }

        if ($IND_OPER == 1 && (substr($CFOP,0,1) != '5' && substr($CFOP,0,1) != '6' && substr($CFOP,0,1) != '7')) {
            throw new \InvalidArgumentException("CFOP inválido. Utilizar CFOP com primeiro caracter = 5, 6 ou 7, quando for operação de saída.");
        }

        //CST_ICMS
        if ( substr($CST_ICMS,-2) == '30' || substr($CST_ICMS,-2) == '40' || substr($CST_ICMS,-2) == '41' || substr($CST_ICMS,-2) == '50' || substr($CST_ICMS,-2) == '60') {
            if ( $VL_BC_ICMS != 0 ) {
                throw new \InvalidArgumentException("O campo 'valorBaseCalculo' deve ser igual a '0' (zero)");
            }
            if ( $ALIQ_ICMS != 0 ) {
                throw new \InvalidArgumentException("O campo 'aliquotaICMS' deve ser igual a '0' (zero)");
            }
            if ( $VL_ICMS != 0 ) {
                throw new \InvalidArgumentException("O campo 'valorICMS' deve ser igual a '0' (zero)");
            }
        }else{
            if ( $VL_BC_ICMS > 1 ) {
                if ( $ALIQ_ICMS < 0 ) {
                    throw new \InvalidArgumentException("O campo 'aliquotaICMS' deve ser igual a '0' (zero)");
                }
                if ( $VL_ICMS < 0 ) {
                    throw new \InvalidArgumentException("O campo 'valorICMS' deve ser igual a '0' (zero)");
                }
            }
        }
        if ( substr($CST_ICMS,-2) == '20' || substr($CST_ICMS,-2) == '51' || substr($CST_ICMS,-2) == '90') {
            if ( $VL_BC_ICMS < 0 ) {
                throw new \InvalidArgumentException("O campo 'aliquotaICMS' deve ser igual a '0' (zero)");
            }
            if ( $ALIQ_ICMS < 0 ) {
                throw new \InvalidArgumentException("O campo 'aliquotaICMS' deve ser igual a '0' (zero)");
            }
            if ( $VL_ICMS < 0 ) {
                throw new \InvalidArgumentException("O campo 'valorICMS' deve ser igual a '0' (zero)");
            }
        }
        return true;
    }
}