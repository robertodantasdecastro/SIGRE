<?

require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
	
	include ("../funcoes/padrao.php");
	
	if ($mes < 10) { $mes = "0".$mes; }
		
	$valorTotal = 0;
	$vFarpenSDJ = 0;
	$vFarpenEmo = 0;
	$qtdFarpen = 0;
	$qtdFarpenSDJ = 0;
	$n = 0;
	$v= 0;
						

	$dataInicio = substr($_GET['dataInicio'], 6, 4).substr($_GET['dataInicio'], 3, 2).substr($_GET['dataInicio'], 0, 2);
	$dataFim = substr($_GET['dataFim'], 6, 4).substr($_GET['dataFim'], 3, 2).substr($_GET['dataFim'], 0, 2);

	$di_F = substr($_GET['dataInicio'], 6, 4).substr($_GET['dataInicio'], 3, 2).substr($_GET['dataInicio'], 0, 2);
	$df_F = substr($_GET['dataFim'], 6, 4).substr($_GET['dataFim'], 3, 2).substr($_GET['dataFim'], 0, 2);
	
	$di_FF = substr($_GET['dataInicio'], 6, 4)."-".substr($_GET['dataInicio'], 3, 2)."-".substr($_GET['dataInicio'], 0, 2);
	$df_FF = substr($_GET['dataFim'], 6, 4)."-".substr($_GET['dataFim'], 3, 2)."-".substr($_GET['dataFim'], 0, 2);
	
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsGuias = "SELECT 'SN' `ID_LINHA`, guias.idReg, guias.tipo, guias.numero, guias.ano, guias.id_entidade, guias.emicao, guias.valorRetornoFARPEN, guias.dataMovFarpen, guias.valorRetornoFARPEN_SDJ, guias.dataMovFARPEN_SDJ, guias.situacaoFarpen, guias.situacaoFARPEN_SDJ, entidades.farpen, entidades.convenio2, entidades.convenio, entidades.id_sdt 
					FROM guias 
					JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacaoFarpen >= 4 AND (guias.dataMovFarpen BETWEEN '$di_FF' AND '$df_FF')
					UNION 
					SELECT 'SD', guias.idReg, guias.tipo, guias.numero, guias.ano, guias.id_entidade, guias.emicao, guias.valorRetornoFARPEN, guias.dataMovFarpen, guias.valorRetornoFARPEN_SDJ, guias.dataMovFARPEN_SDJ, guias.situacaoFarpen, guias.situacaoFARPEN_SDJ, entidades.farpen, entidades.convenio2, entidades.convenio, entidades.id_sdt  
					FROM guias
					JOIN entidades ON entidades.id = guias.id_entidade
					WHERE guias.situacaoFARPEN_SDJ >= 4 AND (guias.dataMovFARPEN_SDJ BETWEEN '$di_FF' AND '$df_FF')
					ORDER BY dataMovFarpen DESC";
	$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
	$row_rsGuias = mysql_fetch_assoc($rsGuias);
	$totalRows_rsGuias = mysql_num_rows($rsGuias);
	
	
	$arquivo2 = "../../dados/farpen/".substr($dataInicio, 0, 4).substr($dataInicio, 4, 2).substr($dataInicio, 6, 2)."_".substr($dataFim, 0, 4).substr($dataFim, 4, 2).substr($dataFim, 6, 2).".txt";
	$_SESSION['nomeArqDownload'] = substr($dataInicio, 0, 4).substr($dataInicio, 4, 2).substr($dataInicio, 6, 2)."_".substr($dataFim, 0, 4).substr($dataFim, 4, 2).substr($dataFim, 6, 2).".txt";
	
	if (file_exists($arquivo2)){
		unlink ($arquivo2);
	}
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
<? if ($totalRows_rsGuias > 0 && ($di_F >= 20060901 && $df_F >= 20060901)) { ?>
<table width="710" border="0" cellspacing="0" cellpadding="0">
  <?
	$d_i = formatarNumero ($di_F);
	$d_f = formatarNumero ($df_F);
		
	do {
	
		$d_SDJ = formatarNumero ($row_rsGuias['dataMovFARPEN_SDJ']);
		$d_SNR = formatarNumero ($row_rsGuias['dataMovFarpen']);
		$d_sd = $row_rsGuias['dataMovFARPEN_SDJ'];
		$d_fe = $row_rsGuias['dataMovFarpen'];

		if ($row_rsGuias['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 1000) { $id_entidade = $row_rsGuias['id_entidade']; }
		if ($row_rsGuias['numero'] < 10){ $numeros = "0000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 100) { $numeros = "000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 1000) { $numeros = "00".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 10000) { $numeros = "0".$row_rsGuias['numero']; } 
		
		$anos = substr($row_rsGuias['ano'], 2, 2);
	
		if ($row_rsGuias['ID_LINHA'] == "SN") {		
		
			if ($row_rsGuias['tipo'] == "Registro") { 
			
				$id_reg = $row_rsGuias['idReg'];
				mysql_select_db($database_Emolumentos, $Emolumentos);
				$query_rsEntidadeREGISTRAL = "SELECT entidades.convenio2, entidades.farpen FROM entidades WHERE entidades.id = '$id_reg'";
				$rsEntidadeREGISTRAL = mysql_query($query_rsEntidadeREGISTRAL, $Emolumentos) or die(mysql_error());
				$row_rsEntidadeREGISTRAL = mysql_fetch_assoc($rsEntidadeREGISTRAL);
				$totalRows_rsEntidadeREGISTRAL = mysql_num_rows($rsEntidadeREGISTRAL);
				
				$numeroFarpen = formatarNumero ($row_rsEntidadeREGISTRAL['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsEntidadeREGISTRAL['convenio2'], "up", "7", "0");
				
				
			} else {
			
				$numeroFarpen = formatarNumero ($row_rsGuias['farpen']);
				$valorLinha['convenio'] = formatarExportacao ($row_rsGuias['convenio2'], "up", "7", "0");
			
			}
			
			$n = $n + 1; 
			$qtdFarpen = $qtdFarpen + 1;
			$vFarpenEmo = fc ($row_rsGuias['valorRetornoFARPEN']) + $vFarpenEmo;
						
			
			$vFarpen = formatarNumero ($row_rsGuias['valorRetornoFARPEN']);
			

			
			$valorLinha['numeroDocumento'] = $id_entidade.$anos.$numeros; 
			$valorLinha['farpen'] = formatarExportacao ($numeroFarpen, "up", "7", "0");
			$valorLinha['emissao'] = substr($row_rsGuias['emicao'], 8, 2).substr($row_rsGuias['emicao'], 5, 2).substr($row_rsGuias['emicao'], 0, 4);
			$valorLinha['compencacao'] = substr($row_rsGuias['dataMovFarpen'], 8, 2).substr($row_rsGuias['dataMovFarpen'], 5, 2).substr($row_rsGuias['dataMovFarpen'], 0, 4);
			$valorLinha['valor'] = formatarExportacao ($vFarpen, "up", "8", "0");
			
			$linha = $valorLinha['convenio'].$valorLinha['numeroDocumento'].$valorLinha['farpen'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['valor'];
//			echo "<tr><td class=\"texto\">".$linha."</td></tr>";
			$fp2 = fopen($arquivo2, "a"); 
			fwrite($fp2, $linha."\r\n"); 
			fclose($fp2);			
		}
		
		if ($row_rsGuias['ID_LINHA'] == "SD") {
						
			$n = $n + 1; 
			$qtdFarpenSDJ = $qtdFarpenSDJ + 1;
			$vFarpenSDJ = fc ($row_rsGuias['valorRetornoFARPEN_SDJ']) + $vFarpenSDJ;
		
		
			$id_sdt = $row_rsGuias['id_sdt'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsEntidadeSDT = "SELECT entidades.convenio, entidades.farpen FROM entidades WHERE entidades.id = '$id_sdt'";
			$rsEntidadeSDT = mysql_query($query_rsEntidadeSDT, $Emolumentos) or die(mysql_error());
			$row_rsEntidadeSDT = mysql_fetch_assoc($rsEntidadeSDT);
			$totalRows_rsEntidadeSDT = mysql_num_rows($rsEntidadeSDT);
			
			$vFarpenSDT = formatarNumero ($row_rsGuias['valorRetornoFARPEN_SDJ']);
			$farpenSDT = formatarNumero ($row_rsEntidadeSDT['farpen']);

			$valorLinhaSDT['convenio'] = formatarExportacao ($row_rsEntidadeSDT['convenio'], "up", "7", "0");
			$valorLinhaSDT['numeroDocumento'] = $id_entidade.$anos.$numeros; 
			$valorLinhaSDT['farpen'] = formatarExportacao ($farpenSDT, "up", "7", "0");
			$valorLinhaSDT['emissao'] = substr($row_rsGuias['emicao'], 8, 2).substr($row_rsGuias['emicao'], 5, 2).substr($row_rsGuias['emicao'], 0, 4);
			$valorLinhaSDT['compencacao'] = substr($row_rsGuias['dataMovFARPEN_SDJ'], 8, 2).substr($row_rsGuias['dataMovFARPEN_SDJ'], 5, 2).substr($row_rsGuias['dataMovFARPEN_SDJ'], 0, 4);
			$valorLinhaSDT['valor'] = formatarExportacao ($vFarpenSDT, "up", "8", "0");
			
			$linha2 = $valorLinhaSDT['convenio'].$valorLinhaSDT['numeroDocumento'].$valorLinhaSDT['farpen'].$valorLinhaSDT['emissao'].$valorLinhaSDT['compencacao'].$valorLinhaSDT['valor'];
			
//			echo "<tr><td class=\"texto\">".$linha2."</td></tr>";
			$fp2 = fopen($arquivo2, "a"); 
			fwrite($fp2, $linha2."\r\n"); 
			fclose($fp2); 	
	
		}
		include ("../inc/gerar2pgFarpen.php");
		$v = fc ($row_rsGuias['valorRetornoFARPEN_SDJ']) + fc ($row_rsGuias['valorRetornoFARPEN']) + $v;
		
	 } while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	echo "<td><div align=\"center\" class=\"TituloPagina\"><br><br><br><br><br><br>Concluído!</div></td>";
	 $vTotal = $vFarpenSDJ + $vFarpenEmo;
	 
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

window.alert('<? echo "Preiodo: ".$_GET['dataInicio']." a ".$_GET['dataFim'] ?>\n-------------------------------------\n Qtr. Reg. Farpen SN: <? echo $qtdFarpen; ?>\n Valor Total Farpen SN: <? echo number_format($vFarpenEmo, 2, ",", "."); ?>\n-------------------------------------\n Qtr. Reg. Farpen SDJ: <? echo $qtdFarpenSDJ; ?>\n Valor Total Farpen SDJ: <? echo number_format($vFarpenSDJ, 2, ",", "."); ?>\n-------------------------------------\n Valor Total: R$ <? echo number_format($vTotal, 2, ",", "."); ?>\n Numero de registros: <? echo $n; ?>\n');

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
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="TituloPagina">Periodos anteriores a 01/09/2006 n&atilde;o dispon&iacute;veis</td>
      </tr>
    </table></td>
  </tr>
</table>

<? } ?>
</body>
</html>
<? 
?><iframe frameborder="0" height="1" id="salvar" scrolling="no" width="1" src="salvarArquivo.php?arquivo=<? echo $_SESSION['nomeArqDownload']; ?>&onde=farpen"></iframe><?
unset ($_SESSION['di']);
unset ($_SESSION['df']);

} 

?>