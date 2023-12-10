<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}
$qtd = 0;
$vTotal = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_GET['oq2'])) { 
$_SESSION['id_guia'] = $_GET['id_guia'];
$_SESSION['situacao'] = $_GET['situacao'];
}

if (isset($_SESSION['di']) && isset($_SESSION['df'])) {
if ($acesso != 1) { $id_entidade = $row_rsEntidadeLogin['id']; }
$di_F = substr($_SESSION['di'], 6, 4).substr($_SESSION['di'], 3, 2).substr($_SESSION['di'], 0, 2);
$df_F = substr($_SESSION['df'], 6, 4).substr($_SESSION['df'], 3, 2).substr($_SESSION['df'], 0, 2);



mysql_select_db($database_Emolumentos, $Emolumentos);
if ($acesso == 1) {

$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F,  date_format(guias.`dataMovFarpen`, '%d/%m/%Y') as dataMovFarpen_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F 
FROM guias 
WHERE (guias.dataMovFarpen >= '$di_F' AND guias.dataMovFarpen <= '$df_F')
ORDER BY guias.dataMovEmolumento DESC";


} else if ($acesso == 2 || $acesso == 3) {

$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F 
FROM guias 
WHERE guias.id_entidade = '$id_entidade' 
AND (guias.dataMovEmolumento >= '$di_F' AND guias.dataMovEmolumento <= '$df_F')
ORDER BY guias.dataMovEmolumento DESC";


} else if ($acesso == '4' || $acesso == '5') {

$query_rsGuias = "SELECT entidades.id, guias.* , date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F 
FROM entidades, guias 
WHERE entidades.id_sdt = '$idsLog' 
AND guias.id_entidade = entidades.id 
AND guias.tipo = 'Escritura'

AND (guias.dataMovSDJ >= '$di_F' AND guias.dataMovSDJ <= '$df_F')
ORDER BY guias.dataMovSDJ DESC";  // 

}
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

//-->
</script>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<? if (isset($_GET['oq2'])) { 
$_SESSION['id_guia'] = $_GET['id_guia'];
$_SESSION['situacao'] = $_GET['situacao'];
?>
<script language=JavaScript type=text/javascript> 

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
MM_openBrWindow('../boleto/boleto2Via.php?oq=emolumento','uploa','scrollbars=auto,width=750,height=500');

</script>
<? } ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGRE</title>
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
<table width="730" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="dce0e9">
		<table width="100%" border="0" cellpadding="0" cellspacing="1">
		<? 
		$qtd = 0;
		
		if ($mes < 10) $mes = "0".$mes;
		if ($dia < 10) $dia = "0".$dia;
		$dataHoje = $ano.$mes.$dia;

		
	do { 

		
		
		$vencimento = substr($row_rsGuias['vencimento'], 0, 4).substr($row_rsGuias['vencimento'], 5, 2).substr($row_rsGuias['vencimento'], 8, 2);

		
		// seta o tamanho do ano
		$anos = substr($row_rsGuias['ano'], 2, 2);
		$tam = 5;
		$tamNumero = strlen($row_rsGuias['numero']);
		if ($tamNumero>$tam)	{ 
			$numeros = substr($row_rsGuias['numero'],0,$tam); 
		} else {
			$numeros = $row_rsGuias['numero'];
			for ($i = $tamNumero; $i < $tam ; $i++) {
				$numeros = '0'.$numeros;	
			}
		}
		// seta o tamanho da id da entidade
		$tam = 3;
		$tamIdEnt = strlen($row_rsGuias['id_entidade']);
		if ($tamIdEnt>$tam)	{ 
			$id_entidade = substr($row_rsGuias['id_entidade'],0,$tam); 
		} else {
			$id_entidade =$row_rsGuias['id_entidade'];
			for ($i = $tamIdEnt; $i < $tam ; $i++) {
				$id_entidade = '0'.$id_entidade;	
			}
		}
		




		if ($row_rsGuias['tipo'] == "Escritura"){
			$corFundo = "#FFFFFF";
		} else if ($row_rsGuias['tipo'] == "Registro") {
			$corFundo = "#F2F2F9";
		}



		// indentifica o nivel de acesso dos usuarios
		if ($acesso == 1) {
			
			$dataMov = $row_rsGuias['dataMovFarpen_F']; // data pra impressão
			if ($row_rsGuias['situacaoFarpen'] >= 4) {
				$SitGuia = "PAGO";
			} if (($dataHoje > $vencimento) && (($row_rsGuias['situacaoFarpen'] < 4 && $row_rsGuias['situacaoEmolumento'] >= 4) || ($row_rsGuias['situacaoFarpen'] >= 4 && $row_rsGuias['situacaoEmolumento'] < 4))) {
				$SitGuia = "PENDENTE";
				$corFundo = "#EBED8B";
			} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
			}
			
		} else if ($acesso == 2 || $acesso == 3) {
			
			$dataMov = $row_rsGuias['dataMovEmolumento_F']; // data pra impressao
			if ($row_rsGuias['tipo'] == "Escritura") {
			
				if ($row_rsGuias['situacaoEmolumento'] >= 4 && $row_rsGuias['situacaoSDJ'] >= 4 && $row_rsGuias['situacaoFarpen'] >= 4) {
					$SitGuia = "PAGO";
				} else if ($dataHoje > $vencimento && ($row_rsGuias['situacaoEmolumento'] >= 4 || ($row_rsGuias['situacaoEmolumento'] >= 4 xor $row_rsGuias['situacaoSDJ'] >= 4 xor $row_rsGuias['situacaoFarpen'] >= 4))) {
					$SitGuia = "PENDENTE";
					$corFundo = "#EBED8B";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
				}
				
			} else if ($row_rsGuias['tipo'] == "Registro") {
				if ($row_rsGuias['situacaoEmolumento'] >= 4 && $row_rsGuias['situacaoFarpen'] >= 4) {
					$SitGuia = "PAGO";
				} else if ($dataHoje > $vencimento && ($row_rsGuias['situacaoEmolumento'] >= 4 || ($row_rsGuias['situacaoEmolumento'] >= 4 xor $row_rsGuias['situacaoSDJ'] >= 4 xor $row_rsGuias['situacaoFarpen'] >= 4))) {
					$SitGuia = "PENDENTE";
					$corFundo = "#EBED8B";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoFarpen'] < 4) {
					$SitGuia = "EMITIDO";
				}
			}
		
		} else if ($acesso == 4 || $acesso == 5) {
			if ($row_rsGuias['tipo'] == "Escritura"){
				$dataMov = $row_rsGuias['dataMovSDJ_F']; // data pra impressão
				if ($row_rsGuias['situacaoSDJ'] >= 4) {
					$SitGuia = "PAGO";
				} 
				if (($dataHoje > $vencimento) && ($row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoEmolumento'] >= 4)) { //|| ($row_rsGuias['situacaoSDJ'] >= 4 && $row_rsGuias['situacaoEmolumento'] < 4)
					$SitGuia = "PENDENTE";
					$corFundo = "#EBED8B";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4) {
					$SitGuia = "EMITIDO";
				} 
			} else {
				$SitGuia == "reg";
			}
		}
		


		
		
		
		if ( ((isset($_SESSION['creditadas']) && $_SESSION['creditadas'] == "1") && (isset($SitGuia) && $SitGuia == "PAGO")) || ((isset($_SESSION['pendentes']) && $_SESSION['pendentes'] == "1") && (isset($SitGuia) && $SitGuia == "PENDENTE")) ) { 
		$qtd = $qtd + 1;
	?>
		  <tr>
			<td height="20" width="98" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><a href="#" class="linkSecretarias" onclick="MM_openBrWindow('../popups/detalhesGuias.php?id_guia=<? echo $row_rsGuias['id']; if ($acesso == 1) { echo "&entidade=".$id_entidade; } ?>','','scrollbars=yes,width=640,height=480')"><?php echo $id_entidade.".".$anos.".".$numeros; ?></a></div></td>
			<td width="70" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $row_rsGuias['emicao_F']; ?></div></td>
			<td width="70" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $row_rsGuias['vencimento_F']; ?></div></td>
			<td width="70" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $dataMov; ?></div></td>
			<td width="80" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="left">&nbsp;R$&nbsp;<?php if ($acesso == '2' || $acesso == '3') { echo $row_rsGuias['valorEmolumento']; $vTotal = $vTotal + (fc ($row_rsGuias['valorRetornoEmo'])); } else if ($acesso == '4' || $acesso == '5'){ echo number_format($row_rsGuias['valorRetornoSDJ'], 2, ",", "."); $vTotal = $vTotal + (fc ($row_rsGuias['valorRetornoSDJ'])); } else if ($acesso == 1){ echo number_format($row_rsGuias['valorRetornoFARPEN'], 2, ",", "."); $vTotal = $vTotal + (fc ($row_rsGuias['valorRetornoFARPEN'])); } ?></div></td>
			<td width="60" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoEmolumento'] >= 4) { echo "PAGO"; } else { echo "PENDENTE"; } ?></div></td>
<? if ($acesso == 3 || $acesso == 2) { ?>
			<td width="25" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoEmolumento'] < 4) { ?>
			  <input type="image" name="imageField" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=emolumento&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" />
		      
		      </form>
			  <? } ?>
			</div></td>
			<? } ?><? if ($acesso == 1 || $acesso == 3 || $acesso == 2){ ?>
			<td width="60" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoFarpen'] >= 4) { echo "PAGO"; } else { echo "PENDENTE"; } ?></div></td>
			<? } ?><? if ($acesso == 3 || $acesso == 2) { ?><td width="25" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center">
			 <? if ($row_rsGuias['situacaoFarpen'] < 4) { ?>
			 <input type="image" name="imageField" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=farpen&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" />
			 <? } ?>
			</div></td>
			<? } if ($acesso == 3 || $acesso == 2 || $acesso == 4 || $acesso == 5) { ?>
			<td width="60" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoSDJ'] >= 4) { echo "PAGO"; } else if ($row_rsGuias['tipo'] == "Escritura") { echo "PENDENTE"; }  ?></div></td><? } ?><? if ($acesso == 3 || $acesso == 2) { ?>
			<td width="25" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['tipo'] == "Escritura") { ?>
			  <input type="image" name="imageField" onclick="MM_openBrWindow('../boleto/boleto2Via.php?oq=distribuidor&amp;id_guia=<? echo $row_rsGuias['id']; ?>&amp;situacao=2','uploa','scrollbars=yes,width=750,height=500')" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" />
			    <? } ?></div>
		    </td>
			<td  width="69" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $row_rsGuias['tipo']; ?></div></td>
			<? } ?>
			<td bgcolor="<? echo $corFundo; ?>" class="texto">&nbsp;</td>
		  </tr>
		  <? 
		  }
	} while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	?>
	  </table>
	</td>
  </tr>
</table>
<script language="javascript" type="text/javascript" >


window.top.document.all.vTotal.value = "<? echo number_format($vTotal, 2, ",", "."); ?>";
window.top.document.all.qtd.value = "<? echo $qtd; ?>";
window.top.document.all.dis.value = "<? echo $_SESSION['di']; ?>";
window.top.document.all.dfs.value = "<? echo $_SESSION['df']; ?>";

</script>

</body>
</html>
<? } else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Periodo</title>
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
</head></head>

<body>
<table width="100%" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center" class="TituloPagina">REALIZE A CONSULTA POR PERIODO </div></td>
  </tr>
</table>
<script language="javascript" type="text/javascript" >


window.top.document.all.vTotal.value = "";
window.top.document.all.qtd.value = "";
window.top.document.all.dis.value = "";
window.top.document.all.dfs.value = "";

</script>
</body>
</html>
<? } ?>
<? } 
if ($acesso != 1 && $acesso != 2 && $acesso != 3) { 
unset ($_SESSION['df']);
unset ($_SESSION['di']);
}
?>