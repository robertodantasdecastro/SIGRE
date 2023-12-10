<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
if (isset($_GET['imobiliario'])) {
$_SESSION['imobiliario'] = $_GET['imobiliario'];
?>
<script language="javascript">
window.parent.location.reload();
</script>
<?

}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<script language="javascript" type="text/javascript">
function mandaNatuEsc(string){
var temp = string.value;
var valor = "";
valor = (temp.toUpperCase());
window.parent.document.all.id_NatuEsc.value = valor;

}
function mandaCaracteristicas(string){
var temp = string.value;
var valor = "";
valor = (temp.toUpperCase());
window.parent.document.all.Caracteristicas.value = valor;

}
function mandaTipoImovel(string){
var temp = string.value;
var valor = "";
valor = (temp.toUpperCase());
window.parent.document.all.TipoImovel.value = valor;

}
function mandaValor(campo){


var decimalNum=2;

var temp = FormataNumero(campo.value.stripCharsNotInBag("0123456789").trimLeadingZeros() / Math.pow(10,decimalNum), decimalNum, true, false, true);

window.parent.document.all.valorFiscal.value = temp;

}
function submeter(){

//window.opener.location.reload();
//window.parent.document.all.Botao.type = "hidden";
//window.parent.location.submit();


}
</script>
<? if (!isset($_SESSION['imobiliario'])) {?>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="TituloNoticia1"><br />
      Gostaria de emitir uma escritura imobili&aacute;ria? </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">
      <table width="150" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="center">
            <form id="form1" name="form1" method="get" action="emitir.php?imobiliario=Sim">
              
              <input name="imobiliario" type="hidden" id="imobiliario" value="Sim" />
              <input name="Submit" type="submit" class="Formulario" value="Sim" />
              
                                                                        </form>
            </div></td>
          <td><div align="center">
            <form id="form2" name="form2" method="get" action="emitir.php?imobiliario=Nao">
              
              <input name="imobiliario" type="hidden" id="imobiliario" value="Nao" />
              <input name="Submit2" type="submit" class="Formulario" value="N&atilde;o" />
              
                                                </form>
            </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>

					
					  <? } ?>
					  
</body>
</html>
<? } ?>