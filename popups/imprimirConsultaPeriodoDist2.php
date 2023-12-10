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
function formatarExportacao($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = "$branco".$var;	
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
	}
	function formatarExportacao2($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = $var."$branco";
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset($_GET['oq2'])) { 
$_SESSION['id_guia'] = $_GET['id_guia'];
$_SESSION['situacao'] = $_GET['situacao'];
}

if (isset($_GET['di']) && isset($_GET['df'])) {
if ($acesso != 1) { $id_entidade = $row_rsEntidadeLogin['id']; }
$di_F = substr($_GET['di'], 6, 4).substr($_GET['di'], 3, 2).substr($_GET['di'], 0, 2);
$df_F = substr($_GET['df'], 6, 4).substr($_GET['df'], 3, 2).substr($_GET['df'], 0, 2);

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


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" valign="middle" background="../imagens/topo.jpg"><div align="left" class="TituloPagina">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="../imagens/tjLogo.gif" width="201" height="46" /></td>
          <td class="TituloPagina"><div align="right"><img src="../imagens/SigreLogo.gif" width="287" height="40" />
            </div>
            <div align="right"></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td>
	
	<div align="center">
      <p class="TituloPagina">Guia de Recolhimento da Taxa de Comunica&ccedil;&atilde;o <br />
- Relat&oacute;rio de Guias <? if (isset($_GET['cred']) && $_GET['cred'] == "ok") { echo "Creditadas"; } else { echo "Pendentes"; } ?> -
<br />
<br />
	</div><div align="left"><span class="TituloNoticia2">&nbsp;&nbsp;&nbsp;Per&iacute;odo: <? echo $_GET['di']." a ".$_GET['df']; ?></span></div>
	<div align="center">
	<? 
	
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsEntLista = "SELECT entidades.id, entidades.nome, entidades.farpen, entidades.fone, entidades.id_sdt FROM entidades WHERE entidades.id_sdt = '$idsLog'";
	$rsEntLista = mysql_query($query_rsEntLista, $Emolumentos) or die(mysql_error());
	$row_rsEntLista = mysql_fetch_assoc($rsEntLista);
	$totalRows_rsEntLista = mysql_num_rows($rsEntLista);
	
						 
						 /*
						 
						 guias.situacaoSDJ, guias.situacaoEmolumento, guias.valorSDJ, guias.vencimento, guias.dataMovSDJ
						 
						 
						 AND guias.id_entidade = entidades.id
						 AND guias.tipo = 'Escritura'
						 AND (guias.dataMovSDJ >= '$di_F' AND guias.dataMovSDJ <= '$df_F') 
						 AND (guias.situacaoSDJ > 4)
						 AND (guias.situacaoEmolumento >= 4)
						 
						 */
	
	?>
	<?php do {   //   < ----- rsEntLista
	$vTotal = 0;
	$entId = $row_rsEntLista['id'];
	
mysql_select_db($database_Emolumentos, $Emolumentos);


$query_rsGuias = "SELECT guias.* , date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento_F, date_format(guias.`dataMovEmolumento`, '%d/%m/%Y') as dataMovEmolumento_F, date_format(guias.`dataMovSDJ`, '%d/%m/%Y') as dataMovSDJ_F, date_format(guias.`emicao`, '%d/%m/%Y') as emicao_F 
FROM guias 
WHERE guias.id_entidade = '$entId'
AND guias.tipo = 'Escritura'

AND (guias.dataMovSDJ >= '$di_F' AND guias.dataMovSDJ <= '$df_F') AND guias.id
ORDER BY guias.dataMovSDJ DESC";  

$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);

	?><div align="left"><span class="TituloNoticia2"><br />
	  &nbsp;&nbsp;&nbsp; <? echo "Entidade: ".$row_rsEntLista['farpen']." | ".$row_rsEntLista['nome']." - Fone: ".$row_rsEntLista['fone']; ?></span></div><div align="center">
      <table width="770" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="dce0e9"><table width="100%" border="0" cellpadding="0" cellspacing="1">
            <tr>
              <td width="95" bgcolor="#F2F3F7"><div align="center" class="TituloNoticia1">N. Doc </div></td>
              <td bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">Natureza</div></td>
              <td width="60" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">Sit. Dist</div></td>
   			  <td width="60" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">Sit. SNR</div></td>
			  <td width="85" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">Emiss&atilde;o</div></td>
              <td width="85" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">Venciemeto</div></td>
              <td width="90" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center">V. Guia </div></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td bgcolor="dce0e9"><table width="100%" border="0" cellpadding="0" cellspacing="1">
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
			$corFundo = "#FFFFFF";
		}



		// indentifica o nivel de acesso dos usuarios
		if ($acesso == 4 || $acesso == 5) {
			if ($row_rsGuias['tipo'] == "Escritura"){
				$dataMov = $row_rsGuias['dataMovSDJ_F']; // data pra impress&atilde;o
				if ($row_rsGuias['situacaoSDJ'] >= 4) {
					$SitGuia = "PAGO";
				} else if (($dataHoje > $vencimento) && ($row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoEmolumento'] >= 4)) {  // || ($row_rsGuias['situacaoSDJ'] >= 4 && $row_rsGuias['situacaoEmolumento'] < 4)
					$SitGuia = "PENDENTE";
					$corFundo = "#FFFFFF";
				} else if ($row_rsGuias['situacaoEmolumento'] < 4 && $row_rsGuias['situacaoSDJ'] < 4) {
					$SitGuia = "EMITIDO";
				} 
			} else {
				$SitGuia == "reg";
			}
		}
		
$doctipo = "";
		
		$doctipo = substr(strtoupper($row_rsGuias['tipo']), 0, 3).". ";
		if ($doctipo == 'ESC. ') { 
			if ($row_rsGuias['declarado'] == 's') { 
				if ($row_rsGuias['TipoImovel'] != 'N/D') { 
					$doctipo .="COM VALOR (IMOBILIARIA)";
				} else {
					
					$doctipo .="COM VALOR (".formatarExportacao ($row_rsGuias['id_natuEsc'], "up", "23", "").")";
				}
			} else {
				if (strtoupper($row_rsGuias['ndescricao']) == "OUTRAS (SEM VALOR DECLARADO)") { 
					$doctipo .= "SEM VALOR (OUTRAS)";
				}else{
					$doctipo .= "SEM VALOR (".formatarExportacao ($row_rsGuias['ndescricao'], "up", "23", "").")";
				}
			}
		
		} else if ($doctipo == 'REG. ') { 
			
			$idTipoReg = $row_rsGuias['tipoRegistro'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
			$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
			$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
			$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
			
			if ($idTipoReg == 7 || $idTipoReg == 20) { 
				$doctipo .= "DE IMOVEL "; 
			} else { 
				$doctipo .= "DE IMOVEL "; 
			}
			
			$doctipo .= "(".formatarExportacao ($row_rsTipoRegistro['nome'], "up", "23", "").")";
		}

		
		
		
		if (($dataHoje > $vencimento) && ($row_rsGuias['situacaoSDJ'] < 4 && $row_rsGuias['situacaoEmolumento'] >= 4)) { // || ($row_rsGuias['situacaoSDJ'] >= 4 && $row_rsGuias['situacaoEmolumento'] < 4)
		$qtd = $qtd + 1;
		
	?>
              <tr>
                <td width="95" height="19" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $id_entidade.".".$anos.".".$numeros; ?></div></td>
                <td bgcolor="<? echo $corFundo; ?>" class="texto"><div align="left">&nbsp;<? echo $doctipo; ?></div>
                    <div align="left"></div></td>
				<td width="60" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoSDJ'] < 4) { echo "PENDENTE"; } else { echo "PAGO"; }?></div></td>
   			    <td width="60" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? if ($row_rsGuias['situacaoEmolumento'] < 4) { echo "PENDENTE"; } else { echo "PAGO"; }?></div></td>
                <td width="85" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><?php echo $row_rsGuias['emicao_F']; ?></div></td>
                <td width="85" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="center"><? echo $dataMov; ?></div></td>
                <td width="90" bgcolor="<? echo $corFundo; ?>" class="texto"><div align="left">&nbsp;R$&nbsp;
                        <?php echo number_format($row_rsGuias['valorSDT'], 2, ",", "."); $vTotal = $vTotal + (fc ($row_rsGuias['valorSDT']));  ?>
                </div></td>
              </tr>
              <? 
		  }
	} while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	?>
          </table><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td bgcolor="#F2F3F7"><div align="center" class="TituloNoticia1">Total</div></td>
    <td width="90" bgcolor="#FFFFFF" class="TituloNoticia1">&nbsp;<? echo number_format($vTotal, 2, ",", "."); ?></td>
  </tr>
</table>
</td>
        </tr>
      </table>
    </div> <?php } while ($row_rsEntLista = mysql_fetch_assoc($rsEntLista)); ?></td>
  </tr>
  <tr>
    <td><div align="center"><span class="texto">SIGRE -
      Sistemas Suprema Tecnologia - http://www.stecnologia.com.br/ </span><br />
    </div></td>
  </tr>
</table>
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

</body>
</html>
<? } ?>
<? } 

?><script language="javascript">
window.print();
</script>