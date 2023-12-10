<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
if (isset($_GET['idCarReg'])) {
$_SESSION['idCarReg'] = $_GET['idCarReg'];
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

window.parent.document.all.Valor.value = temp;

}
function submeter(){

//window.opener.location.reload();
//window.parent.document.all.Botao.type = "hidden";
//window.parent.location.submit();


}
</script>
		<? if (!isset($_SESSION['cidRegistro'])) { ?>
		<form id="form1" name="form1" method="get" action="">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div align="center" class="TituloNoticia1"><br />
                Esolha a cidade e sua respectiva entidade:</div></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><div align="center">
                <? mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsCidReg = "SELECT entidades.cidade, entidades.id, entidades.nome FROM entidades WHERE entidades.registral = '1'";
$rsCidReg = mysql_query($query_rsCidReg, $Emolumentos) or die(mysql_error());
$row_rsCidReg = mysql_fetch_assoc($rsCidReg);
$totalRows_rsCidReg = mysql_num_rows($rsCidReg);
?>
                
                <select name="idCarReg" class="Formulario" id="idCarReg">
                  <?php
do {  
?>
                  <option value="<?php echo $row_rsCidReg['id']?>"><?php echo $row_rsCidReg['cidade']?> - <?php echo $row_rsCidReg['nome']?></option>
                  <?php
} while ($row_rsCidReg = mysql_fetch_assoc($rsCidReg));
  $rows = mysql_num_rows($rsCidReg);
  if($rows > 0) {
      mysql_data_seek($rsCidReg, 0);
	  $row_rsCidReg = mysql_fetch_assoc($rsCidReg);
  }
?>
                </select>
                
                <br />
                <br />
              </div></td>
            </tr>
          </table>
		  <div align="center"><input name="proximo" type="submit" class="Formulario" id="proximo" value="Proximo &gt;&gt;" />
		    <? } ?>
	      </div>
</form>
</body>
</html>
<? } ?>