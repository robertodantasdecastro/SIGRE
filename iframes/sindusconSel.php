<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
} else {
if (isset($_GET['valSINDUSCON'])) {
$_SESSION['valSINDUSCON'] = $_GET['valSINDUSCON'];
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

window.parent.document.all.ValorM3.value = temp;

}
function submeter(){

//window.opener.location.reload();
//window.parent.document.all.Botao.type = "hidden";
//window.parent.location.submit();


}
</script>
		
		<form id="form1" name="form1" method="get" action="">
<? if (!isset($_GET['paviID'])) { ?>		  <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td><div align="center" class="TituloNoticia2">Quantidade de pavimentos:<? 
			  mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsPavimento = "SELECT * FROM sindusconres";
			$rsPavimento = mysql_query($query_rsPavimento, $Emolumentos) or die(mysql_error());
			$row_rsPavimento = mysql_fetch_assoc($rsPavimento);
			$totalRows_rsPavimento = mysql_num_rows($rsPavimento);?> 
                <select name="paviID" class="Formulario" id="paviID">
                  <?php
do {  
?>
                  <option value="<?php echo $row_rsPavimento['id']?>"><?php echo $row_rsPavimento['pavimentos']?></option>
                  <?php
} while ($row_rsPavimento = mysql_fetch_assoc($rsPavimento));
  $rows = mysql_num_rows($rsPavimento);
  if($rows > 0) {
      mysql_data_seek($rsPavimento, 0);
	  $row_rsPavimento = mysql_fetch_assoc($rsPavimento);
  }
?>
                </select>
                <br />
                <br />
                <input name="proximo" type="submit" class="Formulario" id="proximo" value="Proximo &gt;&gt;" />
              </div></td>
            </tr>
          </table><? } else { ?><table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td><div align="center" class="TituloNoticia2">Padr&atilde;o de constru&ccedil;&atilde;o / Valor :<?
			  
			  $paviID = $_GET['paviID'];
		mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsValorSinduscon = "SELECT * FROM sindusconres WHERE sindusconres.id = '$paviID'";
$rsValorSinduscon = mysql_query($query_rsValorSinduscon, $Emolumentos) or die(mysql_error());
$row_rsValorSinduscon = mysql_fetch_assoc($rsValorSinduscon);
$totalRows_rsValorSinduscon = mysql_num_rows($rsValorSinduscon);?>
                <select onchange="javascript:mandaValor(this);" name="valSINDUSCON" class="Formulario" id="valSINDUSCON">
                  <option value="<?php echo $row_rsValorSinduscon['baixo']; ?>">Baixo / R$ <?php echo $row_rsValorSinduscon['baixo']; ?></option>
                  <option value="<?php echo $row_rsValorSinduscon['normal']; ?>">Normal / R$ <?php echo $row_rsValorSinduscon['normal']; ?></option>
                  <option value="<?php echo $row_rsValorSinduscon['alto']; ?>">Alto / R$ <?php echo $row_rsValorSinduscon['alto']; ?></option>
                </select>
                <br />
                <br />
                <input name="proximo" type="submit" class="Formulario" id="proximo" value="Proximo &gt;&gt;" />
              </div></td>
            </tr>
          </table>
		  <? } ?>
</form>
</body>
</html>
<? } ?>