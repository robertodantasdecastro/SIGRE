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
function formatarNumero ($var) { 
		$var = str_replace(".","",$var);
		$var = ereg_replace("0","0",$var); 
		$var = ereg_replace("/","",$var); 
		$var = ereg_replace("-","",$var); 
		$var = ereg_replace("\.","",$var); 
		$var = ereg_replace(",","",$var); 
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
$vTotal = 0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


if (isset($_GET['di']) && isset($_GET['df'])) {

$di_F = substr($_GET['di'], 6, 4).substr($_GET['di'], 3, 2).substr($_GET['di'], 0, 2);
$df_F = substr($_GET['df'], 6, 4).substr($_GET['df'], 3, 2).substr($_GET['df'], 0, 2);



mysql_select_db($database_Emolumentos, $Emolumentos);

$query_rsGuias = "SELECT '1' `ID_LINHA`, guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				 JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoEmolumento >= '4' 
				AND (guias.tipo = 'Registro')
				UNION
				SELECT '2', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoSDJ >= '4'
				UNION
				SELECT '3', guias.*, entidades.farpen, entidades.convenio, entidades.id_sdt FROM guias
				JOIN entidades ON guias.id_entidade = entidades.id
				WHERE guias.situacaoEmolumento >= '4'
				AND (guias.tipo <> 'Registro')";



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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>FEPJ</title>
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
          <td width="201"><img src="../imagens/tjLogo.gif" width="201" height="46" /></td>
          <td class="TituloPagina"><div align="right"><img src="../imagens/SigreLogo.gif" width="287" height="40" /></div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center" class="TituloPagina">
      <p>Fundo Especial do Poder Judiciário - FEPJ<br /> 
        - Recolhimento por Serventia Extrajudicial -
    </p>
      </div>
     <div align="right"><span class="TituloNoticia2">Per&iacute;odo: <? echo $_GET['di']." a ".$_GET['df']; ?>&nbsp;&nbsp;&nbsp;</span></div>
     <div align="center"> <table width="780" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td bgcolor="dce0e9"><table width="100%" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td width="100" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center" class="TituloNoticia1">N. FARPEN</div></td>
              <td bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center" class="TituloNoticia1">Nome da entidade</div></td>
              <td width="50" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center" class="TituloNoticia1">Qtd.</div></td>
              <td width="110" bgcolor="#F2F3F7" class="TituloNoticia1"><div align="center" class="TituloNoticia1">Valor Total</div></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td bgcolor="dce0e9"><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <? 
		$qtd1 = 0;
		$qtd2 = 0;
		
		
		if ($mes < 10) $mes = "0".$mes;
		if ($dia < 10) $dia = "0".$dia;
		$dataHoje = $ano.$mes.$dia;
		$d_i = formatarNumero ($di_F);
		$d_f = formatarNumero ($df_F);
		
	do { 

		$d_SDJ = formatarNumero ($row_rsGuias['dataMovSDJ']);
		$d_SNR = formatarNumero ($row_rsGuias['dataRetornoFEPJ']);
								

				if (($row_rsGuias['ID_LINHA'] == 1 || $row_rsGuias['ID_LINHA'] == 3) && ($d_SNR >= $d_i && $d_SNR <= $d_f)) {

				$qtd1 = $qtd1 + 1;	
				
					if ($row_rsGuias['tipo'] == "Registro") { 
						$id_entidade = $row_rsGuias['idReg'];
					} else {
						$id_entidade = $row_rsGuias['id_entidade'];	
					}

					$vF = $row_rsGuias['velorRetornoFEPJ'];
					
					if (!isset($entidade_FEPJ["$id_entidade"])) {
						$entidade_FEPJ["$id_entidade"] = 0;	
						$qtd_FEPJ["$id_entidade"] = 0;
						$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
						$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
					} else {
						$qtd_FEPJ["$id_entidade"] = $qtd_FEPJ["$id_entidade"] + 1;
						$entidade_FEPJ["$id_entidade"] = $entidade_FEPJ["$id_entidade"] + $vF;
					}
						
				}
				
				if (($row_rsGuias['ID_LINHA'] == 2) && ($d_SDJ >= $d_i && $d_SDJ <= $d_f)) {
					$qtd2 = $qtd2 + 1;	
					$id_entidade = $row_rsGuias['id_entidade'];	
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$query_rsConveniosSN = "SELECT entidades.id, entidades.convenio, entidades.convenio2, entidades.id_sdt FROM entidades WHERE entidades.id = '$id_entidade'";
					$rsConveniosSN = mysql_query($query_rsConveniosSN, $Emolumentos) or die(mysql_error());
					$row_rsConveniosSN = mysql_fetch_assoc($rsConveniosSN);
					$totalRows_rsConveniosSN = mysql_num_rows($rsConveniosSN);
				
					$vSDJ_FEPJ = $row_rsGuias['valorRetornoSdjFEPJ']; 
					$id_SDT = $row_rsConveniosSN['id_sdt'];
					
					
					if (!isset($entidade_FEPJ["$id_SDT"])) {
						$entidade_FEPJ["$id_SDT"] = 0;	
						$qtd_FEPJ["$id_SDT"] = 0;
						$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
						$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
					} else {
						$qtd_FEPJ["$id_SDT"] = $qtd_FEPJ["$id_SDT"] + 1;
						$entidade_FEPJ["$id_SDT"] = $entidade_FEPJ["$id_SDT"] + $vSDJ_FEPJ;
					}
				}
				
	
		  
		 
	} while ($row_rsGuias = mysql_fetch_assoc($rsGuias));
	
	ksort($entidade_FEPJ);
	reset($entidade_FEPJ);
	while (list($chave, $valor) = each($entidade_FEPJ)) {
	
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsEntidadeGuia = "SELECT entidades.id, entidades.nome, entidades.farpen FROM entidades WHERE entidades.id = '$chave'";
	$rsEntidadeGuia = mysql_query($query_rsEntidadeGuia, $Emolumentos) or die(mysql_error());
	$row_rsEntidadeGuia = mysql_fetch_assoc($rsEntidadeGuia);
	$totalRows_rsEntidadeGuia = mysql_num_rows($rsEntidadeGuia);
		?>
		
		<tr>
    <td width="100" bgcolor="#FFFFFF" class="texto"><div align="center"><?php echo $row_rsEntidadeGuia['farpen']; ?></div></td>
    <td height="15" bgcolor="#FFFFFF" class="texto"><div align="left">&nbsp;<?php echo $row_rsEntidadeGuia['nome']; ?></div></td>
    <td width="50" bgcolor="#FFFFFF" class="texto">&nbsp;<? echo $qtd_FEPJ["$chave"]; ?></td>

    <td width="110" bgcolor="#FFFFFF" class="texto"><div align="left">&nbsp;R$ <? echo number_format($valor,2, ",", "."); ?></div></td>
	</tr> <?		
		$vTotal = $vTotal + fc ($valor);
	}
	?>
</table>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td height="20" bgcolor="#F2F3F7" class="TituloNoticia2"><div align="center" class="TituloNoticia2">TOTAL</div></td>
                <td width="110" bgcolor="#FFFFFF" class="TituloNoticia2"><div align="left">&nbsp;R$&nbsp;<? echo number_format($vTotal, 2, ",", "."); ?></div></td>
              </tr>
            </table></td>
        </tr>
      </table></div></td>
  </tr>
  <tr>
    <td><div align="center"><span class="texto"><br />
      SIGRE -
      Sistemas Sapiens Tecnologia - http://www.sapienstecnologia.com.br/ </span><br />
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
<? } }

?><script language="javascript">
window.print();
</script>