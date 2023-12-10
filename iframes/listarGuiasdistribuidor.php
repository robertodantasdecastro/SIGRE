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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><script type="text/JavaScript">
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
MM_openBrWindow('../boleto/boleto.php?oq=emolumento','uploa','scrollbars=yes,width=750,height=500');

</script>
<? } ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Emitir Guias</title>
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
<?
if ($mes<10){ $mes = "0".$mes; }
if (isset($_GET['oq'])) { 
$oq = $_GET['oq'];
if ($acesso > 1) {
$id_entidade = $row_rsEntidadeLogin['id']; 
}
if ($acesso == '4' || $acesso == '5'){


mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuias = "SELECT entidades.nome, entidades.id, guias.*, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao  FROM guias, entidades WHERE entidades.id_sdt = '$id_entidade' AND guias.id_entidade = entidades.id AND guias.situacaoSDJ > '3' AND guias.tipo = 'Escritura' ORDER BY guias.numero DESC";
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);
} else {
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuias = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao  FROM guias WHERE guias.id_entidade = '$id_entidade' AND guias.situacaoEmolumento != '5' ORDER BY guias.numero DESC";
$rsGuias = mysql_query($query_rsGuias, $Emolumentos) or die(mysql_error());
$row_rsGuias = mysql_fetch_assoc($rsGuias);
$totalRows_rsGuias = mysql_num_rows($rsGuias);
}
?>
        <table width="725" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td bgcolor="#DCE0E9">
              <?php if ($totalRows_rsGuias > 0) { // Show if recordset not empty ?>
              <table width="725" height="20" border="0" cellpadding="0" cellspacing="1">
                <?php do { 
				
		$d = substr($row_rsGuias['vencimento'], 0, 2);
		$m = substr($row_rsGuias['vencimento'], 3, 2);
		$a = substr($row_rsGuias['vencimento'], 6, 4);
		$res=checkdate($m,$d,$a);
	
		if ($res==1){
		$dias_do_mes = date ("t", mktime (0,0,0,$m,$d,$a));
		$diaV = $d + 15;
		if ($diaV > $dias_do_mes) {
			$diaV = $diaV - $dias_do_mes;
			$mesV = $m + 1;
			if ($mesV<10){ $mesV = "0".$mesV; }
		} else { 
			$mesV = $m;
		}
		if ($mesV > 12){
			$mesV = "01";
			$anoV = $a + 1;
		} else { 
			$anoV = $a;
		}
	
		if ($diaV<10){ $diaV = "0".$diaV; }
		$velidade = $diaV."/".$mesV."/".$anoV; // vencimento

		$dataAtual = $dia."/".$mes."/".$ano;;
//		echo $velidade."<br>".$dataAtual;
	} else {
		echo "Data incorreta, entre em contato com o Suporte dos sistemas Sapiens.";
	}
				
	if ( ($dia <= $d) && ($mes <= $m) && ($ano <= $a) || ($row_rsGuias['situacaoEmolumento'] == 4)) {
				
				

if ($row_rsGuias['numero'] < 10){ $numeros = "0000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 100) { $numeros = "000".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 1000) { $numeros = "00".$row_rsGuias['numero']; } else if ($row_rsGuias['numero'] < 10000) { $numeros = "0".$row_rsGuias['numero']; } 
$anos = substr($row_rsGuias['ano'], 2, 2);

if ($row_rsGuias['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuias['id_entidade']; } else if ($row_rsGuias['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuias['id_entidade']; } 

				?>
                <tr>
                  <td width="105" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><?php echo $id_entidade.".".$anos.".".$numeros; ?> </div>                  </td>
                  <td width="75" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><?php echo $row_rsGuias['emicao']; ?></div>                  </td>
                  <td width="74" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><?php echo $row_rsGuias['vencimento']; ?></div>                  </td>
                  <td width="80" height="20" class="texto" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?>>
                  <div align="left">&nbsp;R$&nbsp;<?php if ($acesso == '2' || $acesso == '3') { echo $row_rsGuias['valorEmolumento']; } else if ($acesso == '4' || $acesso == '5'){ echo $row_rsGuias['valorRetornoSDJ']; } ?></div>                  </td>
                  <td width="80"<? if ($row_rsGuias['situacaoEmolumento'] == "1") {?>bgcolor="#FEE7E8"<? } else if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoEmolumento'] == "1") { echo "Não emitida"; } else if ($row_rsGuias['situacaoEmolumento'] == "2") { echo "Emitida"; } else if ($row_rsGuias['situacaoEmolumento'] == "3") { echo "Reemitido"; } else if ($row_rsGuias['situacaoEmolumento'] == "4") { echo "Pago"; } ?></div>                  </td>
				  <td width="25" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoEmolumento'] == "1") { ?><input name="priVia" type="image" onclick="MM_openBrWindow('../boleto/boleto.php?oq=emolumento&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')" id="priVia" src="../imagens/emitirBoletoP.gif" alt="Emitir guia" />
                    <? } else if ($row_rsGuias['situacaoEmolumento'] == "2") { ?><input name="segVia" type="image" onclick="MM_openBrWindow('../boleto/boleto.php?oq=emolumento&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')"  id="segVia" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" /> <input name="oq2" type="hidden" id="oq2" value="emolumento" />
                    <? } ?>
                    </div>                  </td>
<? if ($row_rsGuias['tipo'] == "Escritura") { ?>				   <td width="80"<? if ($row_rsGuias['situacaoSDJ'] == "1") {?>bgcolor="#FEE7E8"<? } else if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoSDJ'] == "1") { echo "Não emitida"; } else if ($row_rsGuias['situacaoSDJ'] == "2") { echo "Emitida"; } else if ($row_rsGuias['situacaoSDJ'] == "3") { echo "Reemitido"; } else if ($row_rsGuias['situacaoEmolumento'] == "4") { echo "Pago"; }  ?></div>                  </td>
				  <td width="25" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoSDJ'] == "1") { ?><input name="priVia" onclick="MM_openBrWindow('../boleto/boleto.php?oq=distribuidor&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')" type="image" id="priVia" src="../imagens/emitirBoletoP.gif" alt="Emitir guia" />
                    <? } else if ($row_rsGuias['situacaoSDJ'] == "2") { ?><input name="segVia" onclick="MM_openBrWindow('../boleto/boleto.php?oq=distribuidor&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')" type="image" id="segVia" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" /> <input name="oq2" type="hidden" id="oq2" value="emolumento" />
                    <? } ?>
                    </div>                  </td> <? } else {?><td width="80" bgcolor="#FFFFFF" class="texto">
                    <div align="center"></div>                  </td>
				  <td width="25"bgcolor="#FFFFFF" class="texto">
                  </td> <? } ?>
				   <td width="80"<? if ($row_rsGuias['situacaoFarpen'] == "1") {?>bgcolor="#FEE7E8"<? } else if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoFarpen'] == "1") { echo "Não emitida"; } else if ($row_rsGuias['situacaoFarpen'] == "2") { echo "Emitida"; } else if ($row_rsGuias['situacaoFarpen'] == "3") { echo "Reemitido"; } else if ($row_rsGuias['situacaoEmolumento'] == "4") { echo "Pago"; }  ?></div>                  </td>
                    <td width="25" <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto">
                    <div align="center"><? if ($row_rsGuias['situacaoFarpen'] == "1") { ?><input name="priVia" onclick="MM_openBrWindow('../boleto/boleto.php?oq=farpen&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')"  type="image" id="priVia" src="../imagens/emitirBoletoP.gif" alt="Emitir guia" />
                    <? } else if ($row_rsGuias['situacaoFarpen'] == "2") { ?><input name="segVia" onclick="MM_openBrWindow('../boleto/boleto.php?oq=farpen&id_guia=<? echo $row_rsGuias['id']; ?>&situacao=2','uploa','scrollbars=yes,width=750,height=500')"  type="image" id="segVia" src="../imagens/emitirBoletoP2v.gif" alt="Emitir segunda via" /> <input name="oq2" type="hidden" id="oq2" value="emolumento" />
                    <? } ?>
                    </div>                  </td>
				  <td <? if ($row_rsGuias['tipo'] == "Escritura"){ ?>bgcolor="#FFFFFF"<? } else { ?>bgcolor="#F2F2F9"<? } ?> class="texto"><div align="center"><?php echo $row_rsGuias['tipo']; ?></div></td>
                </tr>
                <?php } } while ($row_rsGuias = mysql_fetch_assoc($rsGuias)); ?>
              </table>
              <?php } // Show if recordset not empty ?>
              <?php if ($totalRows_rsGuias == 0) { // Show if recordset empty ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="180" align="center" valign="middle" bgcolor="#FFFFFF" class="Erro1">N&atilde;o existem guias cadastradas </td>
                  </tr>
                </table>
                <?php } // Show if recordset empty ?></td>
          </tr>
</table>
<? } ?>
</body>
</html>
<? } ?>