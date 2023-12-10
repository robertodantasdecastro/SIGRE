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
if (isset($_GET['m']) && $_GET['m'] == 1){ 

echo $hostname_Emolumentos."<br>";
echo $database_Emolumentos."<br>";
echo $username_Emolumentos."<br>";
echo $password_Emolumentos."<br>";
exit;

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

if (isset($_GET['exib'])) { 
	if ($_GET['exib'] == "paga") {
		$_SESSION['creditadas'] = 1;
		$_SESSION['emitida'] = 0;
		$_SESSION['pendentes'] = 0;
	} else if ($_GET['exib'] == "pendente") {
		$_SESSION['creditadas'] = 0;
		$_SESSION['emitida'] = 0;
		$_SESSION['pendentes'] = 1;
	}
}else{
	$_SESSION['creditadas'] = $_GET['creditadas'];
	$_SESSION['emitida'] = $_GET['emitida'];
	$_SESSION['pendentes'] = $_GET['pendentes'];
}
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
          <td class="TituloPagina"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consulta de guias </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div align="center">
    <? if (!isset($_GET['oqs'])) { ?><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center">
      <p class="TituloNoticia1"><br>
        Consultar por:</p>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <form name="form2" method="get" action=""><td width="50%"><div align="center">
            <input name="oqs" type="hidden" id="oqs" value="numero">
            <label>
            <input name="bt" type="submit" class="Formulario" id="bt" value="N. do Documento">
            </label>
          </div></td></form>  
          <form name="form3" method="get" action=""><td><div align="center">&nbsp;&nbsp;
            <input name="oqs" type="hidden" id="oqs" value="periodo">
            <label>
            <input name="bt" type="submit" class="Formulario" id="bt" value="Periodo">
            </label>
          </div></td></form>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div></td>
  </tr>
</table> 
    <? } else {?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<? if ($_GET['oqs'] == "numero") { ?>        <tr>
          <td width="38%" valign="top" class="TituloNoticia2"><div align="right">Consulta pelo n&uacute;mero da guia:&nbsp;</div></td>
          <form id="form1" name="form1" method="get" onsubmit="javascript:mandaValor();">
            <td width="62%"><div align="left">
                <label>
                <input name="numero_doc" type="text" onblur="javascript:formataNumDoc(this);" onkeyup="javascript:formataNumDoc(this);" class="Formulario" id="numero_doc" />
                </label>
                &nbsp;
                <label>
                <input name="Submit" type="button" onclick="javascript:mandaValor();" class="Formulario" value="Consultar" />
                <br>
                </label>
              <span class="texto"> (N. do documento) </span></div>
              <div align="left"></div></td> 
          </form>
        </tr><? } ?>
		<? if ($_GET['oqs'] == "periodo") { ?><br>
		<tr>
          <td valign="top"><div align="right" class="TituloNoticia2"> Per&iacute;odo:&nbsp; </div></td>
          <form action="Consulta.php" method="get" name="form1" id="form1">
            <td><div align="left">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><label class="TituloNoticia2">
                      <input name="di" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="di" />
                      </label>
                        <span class="TituloNoticia2">at&eacute; </span>
                        <label>
                        <input name="df" type="text" onblur="javascript:formataDataDigitada(this);" onkeyup="javascript:formataDataDigitada(this);" class="Formulario" id="df" />
                        </label>
                        <span class="texto">&nbsp;
                        <label>(DD/MM/AAAA)</label>
                        </span>                        <label></label></td>
                  </tr>
                  <tr>
                    <td valign="top"><table width="100%" <? if ($acesso == 1 || $acesso == 2 || $acesso == 3 || $acesso == 4 || $acesso == 5){ ?> height="90" <? } ?>border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <? if ($acesso == 1 || $acesso == 2 || $acesso == 3  || $acesso == 4 || $acesso == 5){ ?>
                          <td width="160" valign="middle"><div align="left">
                              <table width="150" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td bgcolor="#E0E3EA"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                                      <tr>
                                        <td bgcolor="#EEEDFE"><div align="center" class="TituloNoticia2">Exibir</div></td>
                                      </tr>
                                      <tr>
                                        <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td width="30"><div align="center">
                                                  <label></label>
                                                  <label>
                                                  <input name="exib" type="radio" value="paga" checked="checked" />
                                                  </label>
                                                  </div></td>
                                              <td class="TituloNoticia2">Guias creditadas </td>
                                            </tr>
                                            <tr>
                                              <td width="30"><div align="center">
                                                  <label>
                                                  <input name="exib" type="radio" value="pendente" />
                                                  </label>
                                              </div></td>
                                              <td class="TituloNoticia2">Guias pendentes </td>
                                            </tr>
                                        </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                          </div>
                            <div align="left"></div></td>
                          <? } else { ?>
						  
                          <input name="exib" type="hidden" id="exibir" value="paga" />
                          <? } ?>
                          <td valign="baseline"><div align="left">
                              <input name="Submit2" type="submit" class="Formulario" value="Consultar" />
                            <input name="oq" type="hidden" id="oq" value="consultar" />
                          </div></td>
                        </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td><label><span class="texto">Informe a data inicio e data fim.</span></label></td>
                  </tr>
                </table>
              <label class="TituloNoticia2"></label>
            </div></td>
          </form>
        </tr><? } ?>
      </table> 
    <? } ?>
    </div></td>
  </tr>
</table>

<? } ?>

