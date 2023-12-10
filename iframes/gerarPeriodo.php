<?php require_once('../../core/restritoPopUp.php'); 
if (isset($erros) && $erros == "off" || $erros == "erro") {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {

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

function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}

if (($acesso == 1 || $acesso == 4 || $acesso == 5 || $acesso == 6 || $acesso == 7) && (isset($_GET['di']) && isset($_GET['df']))) {

if (isset($_GET['di'])){ $_SESSION['di'] = $_GET['di']; }
if (isset($_GET['df'])){ $_SESSION['df'] = $_GET['df']; }
if (isset($_SESSION['exibir'])) { $_SESSION['exibir'] = $_GET['exibir']; }
?>
<script language="javascript" type="text/javascript">

//window.opener.location.reload();
parent.location.reload();
//window.close();

</script>

<? } ?>
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
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->


function mandaValor(){
	valor = parent.document.all.numero_doc.value;
	
	if (valor.length == 10 || valor.length == 12) { 
		window.open("detalhesGuias.php?numero_doc="+valor,'','scrollbars=yes,width=640,height=480')
	} else {
		window.alert('Informe um número correto');
	}
//	window.close();
	parent.document.all.numero_doc.value = "";
}


</script>
<link href="../estilos.css" rel="stylesheet" type="text/css">
<title>Consulta de guias</title><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" valign="middle"><form id="form1" name="form1" method="get" action="gerarPeriodo.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="right" class="TituloNoticia2"><? if ($acesso == 1 || $acesso == 6 || $acesso == 7 || $acesso == 4 || $acesso == 5) { echo "Periodo:&nbsp;"; } else { echo "Data:&nbsp;"; } ?></div></td>
          <td><div align="left" class="TituloNoticia2"><? if ($acesso == 1 || $acesso == 6 || $acesso == 7 || $acesso == 4 || $acesso == 5) { echo "&nbsp;de"; } ?>
              <input name="di" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="di" />
                <? if ($acesso == 1 || $acesso == 6 || $acesso == 7 || $acesso == 4 || $acesso == 5) { ?>at&eacute; 
                <input name="df" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="df" />
             <? } ?>&nbsp;&nbsp;
             <input name="Submit" type="submit" class="Formulario" value="Gerar" />
          &nbsp;&nbsp;<span class="texto">Formato: DD/MM/AAAA</span></div></td>
        </tr>
      </table>
      
        </form>    </td>
  </tr>
</table>

<? } ?>
