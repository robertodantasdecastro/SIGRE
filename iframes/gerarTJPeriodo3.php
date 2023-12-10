<?

require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {


	
	
	include ("../funcoes/padrao.php");
	include ("../funcoes/doctipo.php");
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	
	$valorTotal = 0;
	$vFarpenSDJ = 0;
	$vFarpenEmo = 0;
	$qtdFarpen = 0;
	$qtdFarpenSDJ = 0;
	$vTotalFEPJ = 0;
	$vTotalFEPJ_DIST = 0;
	$n = 0;
	$v = 0; // <-- declara e zedra variaveis

	$dataInicio = substr($_GET['dataInicio'], 6, 4).substr($_GET['dataInicio'], 3, 2).substr($_GET['dataInicio'], 0, 2);
	$dataFim = substr($_GET['dataFim'], 6, 4).substr($_GET['dataFim'], 3, 2).substr($_GET['dataFim'], 0, 2);
	
	$di_FF = substr($_SESSION['di'], 6, 4)."-".substr($_SESSION['di'], 3, 2)."-".substr($_SESSION['di'], 0, 2);
	$df_FF = substr($_SESSION['df'], 6, 4)."-".substr($_SESSION['df'], 3, 2)."-".substr($_SESSION['df'], 0, 2);
	if ($di_F < 20060901) { $di_f = 20060901; $_SESSION['di'] = "01/09/2006"; }


	mysql_select_db($database_Emolumentos, $Emolumentos);
	
	$query_rsGuias ="SELECT 'SN `ID_LINHA`, guias.emicao, guias.dataRetornoFEPJ_SDJ, guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, guias.numero, guias.ano, guias.docTipo, guias.declarado, guias.tipoImovel, guias.id_natuEsc, guias.ndeclarado, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
	                 JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacaoEmolumento >= '4' AND (guias.tipo = 'Registro')  AND guias.dataRetornoFEPJ BETWEEN '$di_FF' AND '$df_FF'
					UNION
					SELECT 'SD', guias.emicao, guias.dataRetornoFEPJ_SDJ, guias.dataRetornoFEPJ, guias.tipo, guias.idReg, guias.velorRetornoFEPJ, guias.id, guias.id_entidade, guias.valorRetornoSdjFEPJ, guias.numero, guias.ano, guias.docTipo, guias.declarado, guias.tipoImovel, guias.id_natuEsc, guias.ndeclarado, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
					JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacaoSDJ >= '4'";
	
	
	$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
	$row_rsGuias = mysql_fetch_assoc($rsGuias);
	$totalRows_rsGuias = mysql_num_rows($rsGuias);
	
	$arquivo2 = "../../dados/tj/".substr($dataInicio, 0, 4).substr($dataInicio, 4, 2).substr($dataInicio, 6, 2)."_".substr($dataFim, 0, 4).substr($dataFim, 4, 2).substr($dataFim, 6, 2).".txt";
	$_SESSION['nomeArqDownload'] = substr($dataInicio, 0, 4).substr($dataInicio, 4, 2).substr($dataInicio, 6, 2)."_".substr($dataFim, 0, 4).substr($dataFim, 4, 2).substr($dataFim, 6, 2).".txt";
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arquivo de retorno</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="../estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? if ($totalRows_rsGuias > 0 && $df_F >= 20060901) { ?>
<table width="710" border="0" cellspacing="0" cellpadding="0">
  <?
	if (file_exists($arquivo2)){
		unlink ($arquivo2);
	}
		$qtdReg = 0;
		$qtdEsc = 0;
		$qtdSdj = 0;
		
		if ($mes < 10) $mes = "0".$mes;
		if ($dia < 10) $dia = "0".$dia;
		$dataHoje = $ano.$mes.$dia;
		$d_i = formatarNumero ($di_F);
		$d_f = formatarNumero ($df_F);

	do {
		
		$d_SDJ = formatarNumero ($row_rsGuias['dataRetornoFEPJ_SDJ']);
		$d_SNR = formatarNumero ($row_rsGuias['dataRetornoFEPJ']);
		$d_sd = $row_rsGuias['dataRetornoFEPJ_SDJ'];
		$d_fe = $row_rsGuias['dataRetornoFEPJ'];

		
		if ($row_rsGuias['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 1000) { $id_entidade = $row_rsGuias['id_entidade']; }
		if ($row_rsGuias['numero'] < 10){ $numeros = "0000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 100) { $numeros = "000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 1000) { $numeros = "00".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 10000) { $numeros = "0".$row_rsGuias['numero']; } 
		
		$anos = substr($row_rsGuias['ano'], 2, 2);

		
		$valorLinha['docTipo'] = TipoDocumento ($row_rsGuias['tipo'], $row_rsGuias['declarado'], $row_rsGuias['TipoImovel'], $row_rsGuias['id_natuEsc'], $row_rsGuias['ndescricao'], $row_rsGuias['tipoRegistro']);
		
		if ($row_rsGuias['ID_LINHA'] == "SN") && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {
			
			if ($row_rsGuias['tipo'] == "Registro") { 
			
				$id_reg = $row_rsGuias['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntidadeREGISTRAL = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id = '$id_reg'";
				$rsEntidadeREGISTRAL = mysql_query($query_rsEntidadeREGISTRAL, $Emolumentos) or die(mysql_error());
				$row_rsEntidadeREGISTRAL = mysql_fetch_assoc($rsEntidadeREGISTRAL);
				$totalRows_rsEntidadeREGISTRAL = mysql_num_rows($rsEntidadeREGISTRAL);
				
				$numeroFarpen = formatarNumero ($row_rsEntidadeREGISTRAL['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsEntidadeREGISTRAL['convenio'], "up", "7", "0");
				
				$qtdReg = $qtdReg + 1;
				
			} else {
			
				$qtdEsc = $qtdEsc + 1;
			
				$numeroFarpen = formatarNumero ($row_rsGuias['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsGuias['convenio'], "up", "7", "0");
			
			} 
			
			
			$qtdFarpen = $qtdFarpen + 1;
			$v_FEPJ = $row_rsGuias['velorRetornoFEPJ'];
			$valorLinha['valorFEPJ'] = formatarExportacao ($v_FEPJ, "up", "8", "0");
			$valorLinha['numeroDocumento'] = $id_entidade.$anos.$numeros; 
			$valorLinha['farpen'] = formatarExportacao ($numeroFarpen, "up", "7", "0");
			$valorLinha['emissao'] = substr($row_rsGuias['emicao'], 8, 2).substr($row_rsGuias['emicao'], 5, 2).substr($row_rsGuias['emicao'], 0, 4);
			$valorLinha['compencacao'] = substr($row_rsGuias['dataRetornoFEPJ'], 8, 2).substr($row_rsGuias['dataRetornoFEPJ'], 5, 2).substr($row_rsGuias['dataRetornoFEPJ'], 0, 4);
			
			$linha = $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['docTipo'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valorFEPJ'];
			
					
			$fp2 = fopen($arquivo2, "a"); 
			fwrite($fp2, $linha."\r\n"); 
			fclose($fp2);
				
		}
		
		if (($row_rsGuias['ID_LINHA'] == "SD") && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {
				
				$qtdSdj = $qtdSdj + 1;
				
				$vFarpenSDJ = fc ($row_rsGuias['valorRetornoFARPEN_SDJ']) + $vFarpenSDJ;
							
				$id_sdt = $row_rsGuias['id_sdt'];
				
				
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntidadeSDT = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id = '$id_sdt'";
				$rsEntidadeSDT = mysql_query($query_rsEntidadeSDT, $Emolumentos) or die(mysql_error());
				$row_rsEntidadeSDT = mysql_fetch_assoc($rsEntidadeSDT);
				$totalRows_rsEntidadeSDT = mysql_num_rows($rsEntidadeSDT);
				

				$farpenSDT = formatarNumero ($row_rsEntidadeSDT['farpen']);

				$vSDJ_FEPJ = $row_rsGuias['valorRetornoSdjFEPJ'];
				
				$valorLinha['vSDJ_FEPJ'] = formatarExportacao ($vSDJ_FEPJ, "up", "8", "0");

				$valorLinhaSDT['convenio'] = formatarExportacao ($row_rsEntidadeSDT['convenio'], "up", "7", "0");
				$valorLinhaSDT['numeroDocumento'] = $id_entidade.$anos.$numeros; 
				$valorLinhaSDT['farpen'] = formatarExportacao ($farpenSDT, "up", "7", "0");
				$valorLinhaSDT['emissao'] = substr($row_rsGuias['emicao'], 8, 2).substr($row_rsGuias['emicao'], 5, 2).substr($row_rsGuias['emicao'], 0, 4);
				$valorLinhaSDT['compencacao'] = substr($row_rsGuias['dataMovFARPEN_SDJ'], 8, 2).substr($row_rsGuias['dataMovFARPEN_SDJ'], 5, 2).substr($row_rsGuias['dataMovFARPEN_SDJ'], 0, 4);

				$linha2 = $valorLinhaSDT['convenio'].$valorLinhaSDT['numeroDocumento'].$valorLinhaSDT['farpen'].$valorLinha['docTipo'].$valorLinhaSDT['emissao'].$valorLinhaSDT['compencacao'].$valorLinha['vSDJ_FEPJ']; 
				
				
				
				$fp2 = fopen($arquivo2, "a"); 
				fwrite($fp2, $linha2."\r\n"); 
				fclose($fp2); 			
		}
		  
		include ("../funcoes/gerar2pg.php");
		
		$v = fc ($row_rsGuias['valorRetornoFARPEN_SDJ']) + fc ($row_rsGuias['valorRetornoFARPEN']) + $v;
		
	 } while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
 
	 
	 //$vTotal = $vFarpenSDJ + $vFarpenEmo;
	 
/*	
	 echo  "Preiodo: ".$_GET['dataInicio']." a ".$_GET['dataFim']."\n";
	 echo  "-----------------------------------------------\n";
	 echo  " Qtr. Reg. Farpen SN: ".$qtdFarpen."\n";
	 echo  " Valor Total Farpen SN: ".number_format($vFarpenEmo, 2, ",", ".")."\n";
	 echo  " -----------------------------------------------\n";
	 echo  " Qtr. Reg. Farpen SDJ: ".$qtdFarpenSDJ."\n";
	 echo  " Valor Total Farpen SN: ".number_format($vFarpenSDJ, 2, ",", ".")."\n";
	 echo  " -----------------------------------------------\n";
	 
	
	 echo  " Valor Total: R$ ".number_format($vTotal, 2, ",", ".")."\n";
	 echo  " Numero de registros: ".$n."\n"; */
	
	
?>
<script language="javascript" type="text/javascript">
<?
 /*
 
 <? echo "Preiodo: ".$_GET['dataInicio']." a ".$_GET['dataFim'] ?>\n-------------------------------------\n Qtr. Reg. Farpen SN: <? echo $qtdFarpen; ?>\n Valor Total Farpen SN: R$ <? echo number_format($vFarpenEmo, 2, ",", "."); ?>\n Valor FEPJ do SN: R$ <? echo number_format($vTotalFEPJ, 2, ",", "."); ?>\n-------------------------------------\n Qtr. Reg. Farpen SDJ: <? echo $qtdFarpenSDJ; ?>\n Valor Total Farpen SDJ: R$<? echo number_format($vFarpenSDJ, 2, ",", "."); ?>\n Valor do FEPJ do SDJ: R$ <? echo number_format($vTotalFEPJ_DIST, 2, ",", "."); ?>\n-------------------------------------\n Valor Total: R$ <? echo number_format($vTotal, 2, ",", "."); ?>\n Valor total do FEPJ: R$ <? $totalGeralFEPJ = $vTotalFEPJ_DIST + $vTotalFEPJ; echo number_format($totalGeralFEPJ, 2, ",", "."); ?>\n Numero de registros: <? echo $n; ?>
 
 */ ?>
window.alert('Concluido!\n');

</script>
</table>
<? //echo $v2; 
} else { ?>
<table width="729" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"><p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <table width="729" height="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="TituloPagina">N&atilde;o existem registros no per&iacute;odo de <? echo $_SESSION['di']." até ".$_SESSION['df']; ?></td>
      </tr>
    </table></td>
  </tr>
</table>

<? } ?>
</body>
</html>
<? 
?><iframe frameborder="0" height="1" id="salvar" scrolling="no" width="1" src="salvarArquivo.php?arquivo=<? echo $_SESSION['nomeArqDownload']; ?>&onde=tj"></iframe><?
unset ($_SESSION['di']);
unset ($_SESSION['df']);

} 

?>