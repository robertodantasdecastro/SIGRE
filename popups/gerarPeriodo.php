<?php require_once('../../core/restritoPopUp.php'); 
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
function fc ($v) {
		if (strpos($v,",") > 0){
			$v = str_replace(".","",$v);
			$v = str_replace(",",".",$v);
			return $v;
		}
		return $v;
	}

if (isset($_GET['di']) && isset($_GET['df'])){
$_SESSION['di'] = $_GET['di'];
$_SESSION['df'] = $_GET['df'];
$_SESSION['exibir'] = $_GET['exibir'];
?>
<script language="javascript" type="text/javascript">

window.opener.location.reload();
window.close();

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
	valor = window.document.all.numero_doc.value;
	
	if (valor.length == 10 || valor.length == 12) { 
		window.open("detalhesGuias.php?numero_doc="+valor,'','scrollbars=yes,width=640,height=480')
	} else {
		window.alert('Informe um número correto');
	}
	window.close();
	window.document.all.numero_doc.value = "";
}


</script>
<link href="../estilos.css" rel="stylesheet" type="text/css">
<title>Consulta de guias</title><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30" align="left" valign="middle" background="../imagens/topo.jpg"><div align="left" class="TituloPagina">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><script type="text/javascript" src="../js/swfobject.js"></script>
                <div id="flashcontent"></div>
            <script type="text/javascript">
          // <![CDATA[
		var so = new SWFObject("../topoP.swf", "sotester", "55", "55", "8.0.23", "#FFFFFF");
		//so.addVariable("flashVarText", "this is passed in via FlashVars"); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode", "transparent");
        so.addParam("menu", "false");
		so.write("flashcontent");
			
           // ]]>
    </script></td>
          <td class="TituloPagina"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gerar arquivo por periodo </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="middle"><form id="form1" name="form1" method="get" action="gerarPeriodo.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="right" class="TituloNoticia2">Periodo:&nbsp;</div></td>
          <td><div align="left" class="TituloNoticia2">&nbsp;
            de 
              <input name="di" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="di" />
                at&eacute; 
                <input name="df" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="df" />
             &nbsp;&nbsp;
             <label>
             <input name="Submit" type="submit" class="Formulario" value="Gerar" />
             </label>
          </div></td>
        </tr>
      </table>
      
        </form>
    </td>
  </tr>
</table>

<? } ?>
