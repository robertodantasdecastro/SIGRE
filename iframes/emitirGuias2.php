<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
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
<head>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
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
<script type="text/JavaScript">
<!--

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
</head>
<body>
<? if (!isset($_GET['oq'])) { 
if (isset($_SESSION['nOUTORGANTE'])) {
	for ($i = 1; $i <= $_SESSION['nOUTORGANTE']; $i++) {
		unset ($_SESSION['outorgante']["$i"]);
	}
	$_SESSION['nOUTORGANTE'] = "0"; 
}

if (isset($_SESSION['nOUTORGADO'])) {
	for ($i = 1; $i <= $_SESSION['nOUTORGADO']; $i++) {
		unset ($_SESSION['outorgado']["$i"]);
	}
	$_SESSION['nOUTORGADO'] = "0"; 
}
$_SESSION['addGuia'] = "noxxx";

?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle"><form id="form1" name="form1" method="get" action="">
        <div align="center">
          <p class="TituloNoticia2">Gostaria de emitir guias para:</p>
          <p>
            <input name="oq" type="submit" class="Formulario" id="oq" value="Escritura" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="oq" type="submit" class="Formulario" id="oq" value="Registro" />
          </p>
        </div>
      </form></td>
  </tr>
</table>
<? } else if ($_GET['oq'] == "Escritura" || $_GET['oq'] == "Registro") { 
$_SESSION['tipo'] = $_GET['oq']; 
$_SESSION['N_guia'] = "farpen"; ?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="7" align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td height="195" align="center" valign="top"><form id="form3" name="form3" method="get" action="">
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                  <? 
if (isset($_SESSION['nOUTORGANTE'])) {

echo $_SESSION['nOUTORGANTE'];

} else {
echo "0";
}
?>
                                  &nbsp;&nbsp;</span></div></td>
                              <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                            </tr>
                          </table></td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                  <? 
if (isset($_SESSION['nOUTORGADO'])) {
echo $_SESSION['nOUTORGADO'];
} else {
echo "0";
}
?>
                                  &nbsp;&nbsp;</span></div></td>
                              <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><table width="100%" height="90" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><div align="center"><a href="#" onclick="MM_openBrWindow('../popups/addParte.php?tipo=0','editar','scrollbars=no,width=300,height=200')" class="LinkTexto"><img src="../imagens/addOutorgante.gif" alt="Adicionar Outorgante" width="40" height="40" border="0" /><br />
                            Adicionar<br />
                            outorgante </a></div></td>
                        <td><div align="center"><a href="#" onclick="MM_openBrWindow('../popups/addParte.php?tipo=1','editar','scrollbars=no,width=300,height=200')" class="LinkTexto"><img src="../imagens/addOutogado.gif" alt="Adicionar Outorgado" width="40" height="40" border="0" /><br />
                            Adicionar<br />
                            outorgado </a></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><div align="center">
                      <? 
/*		for ($i = 1; $i <= $_SESSION['nOUTORGANTE']; $i++) {
echo $_SESSION['outorgante']["$i"]."<br>";
}
		for ($i = 1; $i <= $_SESSION['nOUTORGADO']; $i++) {
echo $_SESSION['outorgado']["$i"]."<br>";
}*/
?>
                      <input name="Submit43" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                      &nbsp;&nbsp;&nbsp;
                      <input name="Submit" type="submit" class="Formulario" value="Proximo &gt;&gt;" />
                      <input name="oq" type="hidden" id="oq" value="2" />
                    </div></td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else if ($_GET['oq'] == "2") { 
if (isset($_SESSION['nOUTORGANTE']) && $_SESSION['nOUTORGANTE'] != "0"){
?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="7" align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGANTE'])) {

echo $_SESSION['nOUTORGANTE'];

} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGADO'])) {
echo $_SESSION['nOUTORGADO'];
} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <? if ($_SESSION['tipo'] == "Escritura") {
unset($_SESSION['imobiliario']); ?>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="7"></td>
                    </tr>
                    <tr>
                      <td><div align="center">Gostaria de emitir a guia para <? echo $_SESSION['tipo']; ?></div>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="7"></td>
                          </tr>
                          <tr>
                            <form action="emitirGuias2.php" method="get" name="form3" id="form3">
                              <td><div align="center">
                                  <input name="botao" type="submit" class="Formulario" id="botao" value="Com valor declarado" />
                                  <input name="oq" type="hidden" id="oq" value="declarado" />
                                </div></td>
                            </form>
                          </tr>
                          <tr>
                            <td height="7"></td>
                          </tr>
                          <tr>
                            <form action="emitirGuias2.php" method="get" name="form3" id="form3">
                              <td><div align="center">
                                  <input name="botao" type="submit" class="Formulario" id="botao" value="Sem valor declarado" />
                                  <input name="oq" type="hidden" id="oq" value="ndeclarado" />
                                </div></td>
                            </form>
                          </tr>
                          <tr>
                            <td height="7"></td>
                          </tr>
                          <tr>
                            <td><div align="center">
                                <input name="Submit433" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              </div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <? } else if ($_SESSION['tipo'] == "Registro") {
			  unset($_SESSION['idCarReg']); 
			  unset($_SESSION['valSINDUSCON']);
			  unset($_SESSION['tipoRegistro']);
			  ?>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td height="7"></td>
                    </tr>
                    <tr>
                      <?
				  mysql_select_db($database_Emolumentos, $Emolumentos);
$query_TipoRegistro = "SELECT * FROM tiporegistro";
$TipoRegistro = mysql_query($query_TipoRegistro, $Emolumentos) or die(mysql_error());
$row_TipoRegistro = mysql_fetch_assoc($TipoRegistro);
$totalRows_TipoRegistro = mysql_num_rows($TipoRegistro);
?>
                      <td><div align="center">Gostaria de emitir a guia para <? echo $_SESSION['tipo']; ?></div>
                        <form id="form3" name="form3" method="get" action="emitirGuias2.php">
                          <div align="center">
                            <select name="tipoRegistro" class="Formulario" id="tipoRegistro">
                              <?php
do {  
?>
                              <option value="<?php echo $row_TipoRegistro['id']?>"><?php echo $row_TipoRegistro['nome']?></option>
                              <?php
} while ($row_TipoRegistro = mysql_fetch_assoc($TipoRegistro));
  $rows = mysql_num_rows($TipoRegistro);
  if($rows > 0) {
      mysql_data_seek($TipoRegistro, 0);
	  $row_TipoRegistro = mysql_fetch_assoc($TipoRegistro);
  }
?>
                            </select>
                            <br />
                            <br />
                            <input name="Submit432" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                            &nbsp;&nbsp;                            &nbsp;
                            <input name="Submit3" type="submit" class="Formulario" value="Proximo &gt;&gt;" />
                            <input name="oq" type="hidden" id="oq" value="declarado" />
                          </div>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
              <? } ?>
              <tr>
                <td height="2"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else {

	   ?>
<script language="javascript" type="text/javascript" ?>
		window.alert('Cadastre no mínimo um outorgante');
		window.history.back();
		</script>
<? }
} else if ($_GET['oq'] == "declarado") { 
//if (isset($_SESSION['nOUTORGADO']) && $_SESSION['nOUTORGADO'] != "0"){
$_SESSION['declarado'] = "s"; 
?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="7" align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGANTE'])) {

echo $_SESSION['nOUTORGANTE'];

} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGADO'])) {
echo $_SESSION['nOUTORGADO'];
} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><div align="center">
                    <form action="emitirGuias2.php" method="get" name="v" id="v">
					<input name="oq" id="oq" type="hidden" value="emitir" />
                      <? if ($_SESSION['tipo'] == "Escritura"){  ?>
                      <? if (!isset($_SESSION['imobiliario'])){ ?>
                      <iframe frameborder="0" height="123" width="100%" name="esc" id="esc" scrolling="no" src="emitir.php"></iframe>
                      <? } else { ?>
                      <? if ($_SESSION['imobiliario'] == "Sim") { 
					  if (isset($_SESSION['err']) && $_SESSION['err'] == "1"){
					  unset($_SESSION['err']);
					  ?>
					 
					  <script type="text/javascript" language="javascript">
					  
					  window.reload();
					  </script>
					  <? } 
					  
					  ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><div align="center" class="TituloNoticia1">Emitir guias de escritura imobili&aacute;ria com valor declarado</div></td>
                        </tr>
                      </table>
                      <table width="100%" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                          <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td><div align="right" class="TituloNoticia2">
                                    <? mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsTipoImovel = "SELECT * FROM tipoimovel ORDER BY tipoimovel.nome ASC";
$rsTipoImovel = mysql_query($query_rsTipoImovel, $Emolumentos) or die(mysql_error());
$row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel);
$totalRows_rsTipoImovel = mysql_num_rows($rsTipoImovel); ?>
                                    Tipo de im&oacute;vel:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
                              </tr>
                              <tr>
                                <td><div align="right">
                                    <select name="TipoImovel" class="Formulario" id="TipoImovel">
                                      <?php
do {  
?>
                                      <option value="<?php echo $row_rsTipoImovel['nome']?>"><?php echo $row_rsTipoImovel['nome']?></option>
                                      <?php
} while ($row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel));
  $rows = mysql_num_rows($rsTipoImovel);
  if($rows > 0) {
      mysql_data_seek($rsTipoImovel, 0);
	  $row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel);
  }
?>
                                    </select>
                                  </div></td>
                              </tr>
                              <tr>
                                <td><div align="right" class="TituloNoticia2">Natureza de Escritura:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
                              </tr>
                              <tr>
                                <td><div align="right">
                                    <input name="id_NatuEsc" type="text" onkeyup="javascript:lm(this);" onblur="javascript:lm(this);"  class="Formulario" id="id_NatuEsc" size="34" maxlength="100" />
                                  </div></td>
                              </tr>
                            </table></td>
                          <td valign="top"><div align="left">
                              <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                <tr>
                                  <td><div align="left" class="TituloNoticia2">Caracteristicas:&nbsp;</div></td>
                                </tr>
                                <tr>
                                  <td><textarea onblur="javascript:lm(this);" onkeyup="javascript:lm(this); " name="caracteristicas" cols="40" rows="4" class="Formulario" id="caracteristicas"></textarea></td>
                                </tr>
                              </table>
                            </div></td>
                        </tr>
                        <tr>
                          <td><div align="right" class="TituloNoticia2">Valor: R$ </div></td>
                          <td valign="top"><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                              &nbsp;
                              <input name="Submit4332" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;                        &nbsp;
                              <input name="Botao223" type="submit" class="Formulario" id="Botao223" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <div align="center">
                        <? } else if ($_SESSION['imobiliario'] == "Nao") { ?>
                        <br />
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div align="center" class="TituloNoticia1">Emitir guias de escritura com valor declarado<br />
                                <br />
                              </div></td>
                          </tr>
                        </table>
                      </div>
                      <table width="100%" border="0" cellspacing="4" cellpadding="0">
                        <tr>
                          <td width="48%" class="TituloNoticia2"><div align="right">Natureza de Escritura: </div></td>
                          <td width="52%"><div align="left">
                              <input name="id_NatuEsc" type="text" onkeyup="javascript:lm(this);" onblur="javascript:lm(this);"  class="Formulario" id="id_NatuEsc" size="30" maxlength="100" />
                            </div></td>
                        </tr>
                        <tr>
                          <td class="TituloNoticia2"><div align="right">Valor: R$ </div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                              &nbsp;&nbsp;&nbsp;
                              <input name="Submit4333" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao224" type="submit" class="Formulario" id="Botao224" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? }  }  } else if ($_SESSION['tipo'] == "Registro") { $_SESSION['tipoRegistro'] = $_GET['tipoRegistro']; 
					if (!isset($_SESSION['idCarReg'])) { ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><iframe frameborder="0" height="110" name="cidadeRegistro" scrolling="no" src="cidadeRegistro.php" width="100%"></iframe></td>
                        </tr>
                      </table>
                      <? } else {?>
					  <table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
    <td height="7"></td>
  </tr>
  <tr>
    <td><div align="center" class="TituloNoticia1">GUIAS PARA 
        <? 
	$idRegTipo= $_SESSION['tipoRegistro'];
	mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsRegitroTipo = "SELECT * FROM tiporegistro WHERE id = '$idRegTipo'";
$rsRegitroTipo = mysql_query($query_rsRegitroTipo, $Emolumentos) or die(mysql_error());
$row_rsRegitroTipo = mysql_fetch_assoc($rsRegitroTipo);
$totalRows_rsRegitroTipo = mysql_num_rows($rsRegitroTipo);

	echo $row_rsRegitroTipo['nome']; ?></div></td>
  </tr>
</table><? if ($_SESSION['tipoRegistro'] == '1' || $_SESSION['tipoRegistro'] == '22') { ?>
                      <table width="100%" border="0" cellspacing="5" cellpadding="0">
                        <tr>
                          <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td><div align="right" class="TituloNoticia2">
                                    <? mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsTipoImovel = "SELECT * FROM tipoimovel ORDER BY tipoimovel.nome ASC";
$rsTipoImovel = mysql_query($query_rsTipoImovel, $Emolumentos) or die(mysql_error());
$row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel);
$totalRows_rsTipoImovel = mysql_num_rows($rsTipoImovel); ?>
                                  Tipo de im&oacute;vel:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
                              </tr>
                              <tr>
                                <td><div align="right">
                                    <select name="TipoImovel" class="Formulario" id="TipoImovel">
                                      <option value="--">-----------------------------------</option>
                                      <?php
do {  
?>
                                      <option value="<?php echo $row_rsTipoImovel['nome']?>"><?php echo $row_rsTipoImovel['nome']?></option>
                                      <?php
} while ($row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel));
  $rows = mysql_num_rows($rsTipoImovel);
  if($rows > 0) {
      mysql_data_seek($rsTipoImovel, 0);
	  $row_rsTipoImovel = mysql_fetch_assoc($rsTipoImovel);
  }
?>
                                    </select>
                                </div></td>
                              </tr>
                              <tr>
                                <td><div align="right" class="TituloNoticia2">Natureza de Escritura:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
                              </tr>
                              <tr>
                                <td><div align="right">
                                    <input name="id_NatuEsc" type="text" onkeyup="javascript:lm(this);" onblur="javascript:lm(this);"  class="Formulario" id="id_NatuEsc" size="34" maxlength="100" />
                                </div></td>
                              </tr>
                              
                            </table></td>
                          <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
                              <tr>
                                <td><div align="left" class="TituloNoticia2">
                                    <div align="left">Caracteristicas:&nbsp;</div>
                                  </div></td>
                              </tr>
                              <tr>
                                <td><div align="left">
                                    <textarea onblur="javascript:lm(this);" onkeyup="javascript:lm(this);" name="caracteristicas" cols="40" rows="4" class="Formulario" id="caracteristicas"></textarea>
                                  </div></td>
                              </tr>
                            </table></td>
                        </tr>
                        <tr>
                          <td><div align="right" class="TituloNoticia2">Valor: R$ </div></td>
                          <td valign="top"><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td valign="top"><div align="left">
                              <input name="Submit4334" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao222" type="submit" class="Formulario" id="Botao222" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '2' || $_SESSION['tipoRegistro'] == '3' || $_SESSION['tipoRegistro'] == '17') { ?>
                      <br />
                      <input name="ValorM3" type="hidden" class="Formulario" id="ValorM3" onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" value="<? if (isset($_SESSION['valSINDUSCON'])) { echo $_SESSION['valSINDUSCON']; } ?>" size="10" />
                      <br />
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><div align="center">
                              <? if (!isset($_SESSION['valSINDUSCON'])) { ?>
                                <iframe frameborder="0" height="80" name="sinduscon" scrolling="no" src="sindusconSel.php" width="100%"></iframe>
                                <? } ?>
                            </div></td>
                        </tr>
                        <tr>
                          <td><? if (isset($_SESSION['valSINDUSCON'])) { ?>
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="0" cellspacing="4">
                                      <tr>
                                        <td width="50%"><div align="right">&Aacute;rea constru&iacute;da (m&sup2;):&nbsp; </div></td>
                                        <td><div align="left">
                                            <input name="areaConstruida" onblur="javascript:formataNUMERO(this);" onkeyup="javascript:formataNUMERO(this);" type="text" class="Formulario" id="areaConstruida" size="10" />
                                          </div></td>
                                      </tr>
                                    </table>
                                    <br /></td>
                                </tr>
                                <tr>
                                  <td><div align="center">
                                      <input name="Submit4335" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                                      &nbsp;&nbsp;
                                      <input name="Botao225" type="submit" class="Formulario" id="Botao225" value="Gerar guias" />
                                    </div></td>
                                </tr>
                              </table>
                              <? } ?>
                          </td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '4' || $_SESSION['tipoRegistro'] == '9' || $_SESSION['tipoRegistro'] == '19' || $_SESSION['tipoRegistro'] == '11' || $_SESSION['tipoRegistro'] == '12' || $_SESSION['tipoRegistro'] == '13' || $_SESSION['tipoRegistro'] == '16' || $_SESSION['tipoRegistro'] == '6' || $_SESSION['tipoRegistro'] == '21') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="50%"><div align="right">Valor:&nbsp;R$&nbsp;</div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                          </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit4336" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '5' || $_SESSION['tipoRegistro'] == '15') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="50%"><div align="right">Valor do im&oacute;vel:&nbsp;R$&nbsp;</div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right">Quantidade de unidades habitacionais :&nbsp; </div></td>
                          <td><div align="left">
                              <input name="unidadeHabitacional" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" type="text" class="Formulario" id="unidadeHabitacional" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit4337" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '7') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="50%"><div align="right">Quantidade de unidades habitacionais:&nbsp; </div></td>
                          <td><div align="left">
                              <input name="unidadeHabitacional" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" type="text" class="Formulario" id="unidadeHabitacional" size="10" />
                            </div></td>
                        </tr>
						<tr>
                          <td width="50%"><div align="right">Haverá Intimação ou Notificação:&nbsp; </div></td>
                          <td><div align="left">
                            
                            <input name="intimacao" type="checkbox" id="intimacao" value="ok" />
                            
                          SIM</div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit4338" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '8') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="50%"><div align="right">Valor do im&oacute;vel:&nbsp;R$&nbsp;</div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right">Valor da hipoteca:&nbsp;R$&nbsp;</div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="vHipoteca" type="text" class="Formulario" id="vHipoteca" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right">Primeito financiamento:&nbsp;</div></td>
                          <td><div align="left">
                              <input name="primeiro" type="checkbox" id="primeiro" value="1" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit4339" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '10') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="50%"><div align="right">Valor dos imoveis:&nbsp;R$ </div></td>
                          <td><div align="left">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td><div align="right">Quantidade de herdeiros:&nbsp; </div></td>
                          <td><div align="left">
                              <input name="QtdHerdeiros" onblur="javascript:formataNUMERO(this);" onkeyup="javascript:formataNUMERO(this);" type="text" class="Formulario" id="QtdHerdeiros" size="10" />
                            </div></td>
                        </tr>
                        <tr>
                          <td width="50%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit43311" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '14') { ?>
                      <br />
                      <br />
                      <table width="100%" border="0" cellpadding="0" cellspacing="4">
                        <tr>
                          <td width="38%"><div align="right">Valor alterado :&nbsp;R$ </div></td>
                          <td width="62%"><div align="left" class="texto">
                              <input onblur="javascript:formataValorDigitado(this);" onkeyup="javascript:formataValorDigitado(this);" name="valorFiscal" type="text" class="Formulario" id="valorFiscal" size="10" />
                              &nbsp;Campo opcional caso existal altera&ccedil;&atilde;o de valor </div></td>
                        </tr>
                        <tr>
                          <td width="38%"><div align="right"></div></td>
                          <td><div align="left">
                              <input name="Submit43311" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                              &nbsp;&nbsp;
                              <input name="Botao22" type="submit" class="Formulario" id="Botao22" value="Gerar guias" />
                            </div></td>
                        </tr>
                      </table>
                      <? } else if ($_SESSION['tipoRegistro'] == '18' || $_SESSION['tipoRegistro'] == '20' || $_SESSION['tipoRegistro'] == "23" || $_SESSION['tipoRegistro'] == "24" || $_SESSION['tipoRegistro'] == "25") { 	?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td height="7"></td>
                        </tr>
                        <tr>
                          <td height="7"><div align="center" class="TituloNoticia1">
                              <? include ("../calculo.php"); ?>
                              <br />
                              Emitir guias para Registro <br />
                              <br />
                            </div></td>
                        </tr>
                        <tr>
                          <td><div align="center">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="26%"><div align="right">Data da emiss&atilde;o:&nbsp; </div></td>
                                  <td width="20%"><div align="left" class="Erro1"><? echo $emicao; ?>&nbsp;</div></td>
                                  <td width="26%"><div align="right">Data do vencimento:&nbsp; </div></td>
                                  <td width="28%"><div align="left">
                                      <div align="left" class="Erro1"><? echo $vencimento; ?></div>
                                    </div></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Valor emolumentos:&nbsp; </div></td>
                                  <td><div align="left" class="Erro1">R$ <? echo $vCauculo; ?></div></td>
                                  <td><div align="right">Valor FARPEN:&nbsp; </div></td>
                                  <td><div align="left" class="Erro1">R$ <? echo $vFarpen; ?></div></td>
                                </tr>
                                <tr>
                                  <td><div align="right">Valor FEPJ:&nbsp; </div></td>
                                  <td><div align="left" class="Erro1">R$ <? echo $vTj; ?></div></td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table>
                            </div></td>
                        </tr>
                        <tr>
                          <td height="10"><? $_SESSION['situacao'] = "2"; ?></td>
                        </tr>
                        <tr>
                          <td><div align="center">
                              <iframe height="100" frameborder="0" name="botaos" scrolling="no" width="300" src="botao.php"></iframe>
                            </div></td>
                        </tr>
                      </table>
                      <?
	}
	} 
	}?>
                    </form>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else if ($_GET['oq'] == "ndeclarado") { $_SESSION['declarado'] = "n"; ?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGANTE'])) {

echo $_SESSION['nOUTORGANTE'];

} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
if (isset($_SESSION['nOUTORGADO'])) {
echo $_SESSION['nOUTORGADO'];
} else {
echo "0";
}
?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">
                    <form action="emitirGuias2.php" method="get" name="form4" target="_self" id="form4">
                      <? 
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsNdeclarado = "SELECT * FROM ndeclarado";
$rsNdeclarado = mysql_query($query_rsNdeclarado, $Emolumentos) or die(mysql_error());
$row_rsNdeclarado = mysql_fetch_assoc($rsNdeclarado);
$totalRows_rsNdeclarado = mysql_num_rows($rsNdeclarado);
						?>
                      Emolumentos sem valor declarado:&nbsp;
                      <select name="valor" class="Formulario" id="valor">
                        <?php
do {  
?>
                        <option value="<?php echo $row_rsNdeclarado['id']?>"><?php echo $row_rsNdeclarado['descricao']?> - R$ <?php echo $row_rsNdeclarado['valor']?></option>
                        <?php
} while ($row_rsNdeclarado = mysql_fetch_assoc($rsNdeclarado));
  $rows = mysql_num_rows($rsNdeclarado);
  if($rows > 0) {
      mysql_data_seek($rsNdeclarado, 0);
	  $row_rsNdeclarado = mysql_fetch_assoc($rsNdeclarado);
  }
?>
                      </select>
                      &nbsp;<br />
                      <br />
                      <input name="Submit43312" type="button" class="Formulario" value="&lt;&lt; Voltar" onclick="javascript:history.back();" />
                      &nbsp;&nbsp;
                      <input name="Submit2" type="submit" class="Formulario" value="Gerar guias" />
                      <input name="oq" type="hidden" id="oq" value="emitir" />
                    </form>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else if ($_GET['oq'] == "emitir") { 
	if ($_SESSION['tipo'] == "Escritura") {
	
/* 		if ($_SESSION['declarado'] == 's'){	
			if ($_GET['id_NatuEsc'] == "") {
				$_SESSION['err']="1";
				?><script language="javascript" type="text/javascript">
				
				window.alert('O campo Natureza de Escritura é obrigatório');
				window.history.go(-1);
				</script>
				<?

			}
			if ($_GET['valorFiscal'] == "" || $_GET['valorFiscal'] == "0,00") {
				$_SESSION['err']="1";
				?><script language="javascript" type="text/javascript">
				
				window.alert('O campo Valor é obrigatório');
				window.history.go(-1);
				</script>
				<?

			}
		} */

	 ?>

<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="7"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGANTE'])) {
		
		echo $_SESSION['nOUTORGANTE'];
		
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGADO'])) {
		echo $_SESSION['nOUTORGADO'];
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="7"><div align="center" class="TituloNoticia1"> <br />
                    <? include ("../calculo.php"); ?>
                    Emitir guias para Escritura <br />
                    <br />
                  </div></td>
              </tr>
              <tr>
                <td><div align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="26%"><div align="right">Data da emiss&atilde;o:&nbsp; </div></td>
                        <td width="20%"><div align="left" class="Erro1"><? echo $emicao; ?>&nbsp;</div></td>
                        <td width="26%"><div align="right">Data do vencimento:&nbsp; </div></td>
                        <td width="28%"><div align="left">
                            <div align="left" class="Erro1"><? echo $vencimento; ?></div>
                          </div></td>
                      </tr>
                      <tr>
                        <td><div align="right">Valor Emolumentos:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vCauculo; ?></div></td>
                        <td><div align="right">Valor FARPEN:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vFarpen; ?></div></td>
                      </tr>
                      <tr>
                        <td><div align="right">Valor distribui&ccedil;&atilde;o:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vDist; ?></div></td>
                        <td><div align="right">Valor FEPJ:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vTj; ?></div></td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
              <tr>
                <td height="10"><? $_SESSION['situacao'] = "2"; ?></td>
              </tr>
              <tr>
                <td><div align="center">
                    <iframe height="100" frameborder="0" name="botaos" scrolling="no" width="300" src="botao.php"></iframe>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else if ($_SESSION['tipo'] == "Registro") { ?>

<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="7"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGANTE'])) {
		
		echo $_SESSION['nOUTORGANTE'];
		
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGADO'])) {
		echo $_SESSION['nOUTORGADO'];
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td height="7"><div align="center" class="TituloNoticia1">
                    <? include ("../calculo.php"); ?>
                    <br />
                    Emitir guias para Registro <br />
                    <br />
                  </div></td>
              </tr>
              <tr>
                <td><div align="center">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="26%"><div align="right">Data da emiss&atilde;o:&nbsp; </div></td>
                        <td width="20%"><div align="left" class="Erro1"><? echo $emicao; ?>&nbsp;</div></td>
                        <td width="26%"><div align="right">Data do vencimento:&nbsp; </div></td>
                        <td width="28%"><div align="left">
                            <div align="left" class="Erro1"><? echo $vencimento; ?></div>
                          </div></td>
                      </tr>
                      <tr>
                        <td><div align="right">Valor emolumentos:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vCauculo; ?></div></td>
                        <td><div align="right">Valor FARPEN:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vFarpen; ?></div></td>
                      </tr>
                      <tr>
                        <td><div align="right">Valor FEPJ:&nbsp; </div></td>
                        <td><div align="left" class="Erro1">R$ <? echo $vTj; ?></div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  </div></td>
              </tr>
              <tr>
                <td height="10"><? $_SESSION['situacao'] = "2"; ?></td>
              </tr>
              <tr>
                <td><div align="center">
                    <iframe height="100" frameborder="0" name="botaos" scrolling="no" width="300" src="botao.php"></iframe>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else if ($_SESSION['tipo'] == "EscrituraRegistro") { ?>

<? if (!isset($_SESSION['idCarReg'])) { ?>

<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="7"></td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGANTE'])) {
		
		echo $_SESSION['nOUTORGANTE'];
		
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                <? 
		if (isset($_SESSION['nOUTORGADO'])) {
		echo $_SESSION['nOUTORGADO'];
		} else {
		echo "0";
		}
		?>
                                &nbsp;&nbsp;</span></div></td>
                            <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><div align="center"></div></td>
              </tr>
			   <tr>
                <td>
				
				
			
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><iframe frameborder="0" height="110" name="cidadeRegistro" scrolling="no" src="cidadeRegistro.php" width="100%"></iframe></td>
                        </tr>
                      </table>
                 </td>
			   </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } else { ?>
<table width="580" height="200" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" class="TituloNoticia2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="195" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="7"></td>
            </tr>
            <tr>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="72%"><div align="right">Outorgantes cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                    <? 
		if (isset($_SESSION['nOUTORGANTE'])) {
		
		echo $_SESSION['nOUTORGANTE'];
		
		} else {
		echo "0";
		}
		?>
                            &nbsp;&nbsp;</span></div></td>
                          <td width="28%"><div align="left"><? if (isset($_SESSION['nOUTORGANTE']) && ($_SESSION['nOUTORGANTE'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=0','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                        </tr>
                    </table></td>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="73%"><div align="right">Outorgados cadastrados:<span class="Erro1">&nbsp;&nbsp;
                                    <? 
		if (isset($_SESSION['nOUTORGADO'])) {
		echo $_SESSION['nOUTORGADO'];
		} else {
		echo "0";
		}
		?>
                            &nbsp;&nbsp;</span></div></td>
                          <td width="27%"><div align="left"><? if (isset($_SESSION['nOUTORGADO']) && ($_SESSION['nOUTORGADO'] > 0)) { ?><a href="#" onclick="MM_openBrWindow('../popups/partes.php?oq=1','editar','scrollbars=yes,width=420,height=120')" class="LinkTexto"><img src="../imagens/lupaP.gif" alt="Veja as partes" width="20" height="20" border="0" /></a><? } ?></div></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="7"><div align="center" class="TituloNoticia1">
                  <? include ("../calculo.php"); ?>
                  <br />
                Emitir guias para Registro <br />
                <br />
              </div></td>
            </tr>
            <tr>
              <td><div align="center">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="26%"><div align="right">Data da emiss&atilde;o:&nbsp; </div></td>
                      <td width="20%"><div align="left" class="Erro1"><? echo $emicao; ?>&nbsp;</div></td>
                      <td width="26%"><div align="right">Data do vencimento:&nbsp; </div></td>
                      <td width="28%"><div align="left">
                          <div align="left" class="Erro1"><? echo $vencimento; ?></div>
                      </div></td>
                    </tr>
                    <tr>
                      <td><div align="right">Valor emolumentos:&nbsp; </div></td>
                      <td><div align="left" class="Erro1">R$ <? echo $vCauculo; ?></div></td>
                      <td><div align="right">Valor FARPEN:&nbsp; </div></td>
                      <td><div align="left" class="Erro1">R$ <? echo $vFarpen; ?></div></td>
                    </tr>
                    <tr>
                      <td><div align="right">Valor FEPJ:&nbsp; </div></td>
                      <td><div align="left" class="Erro1">R$ <? echo $vTj; ?></div></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
              </div></td>
            </tr>
            <tr>
              <td height="10"><? $_SESSION['situacao'] = "2"; ?></td>
            </tr>
            <tr>
              <td><div align="center">
                  <iframe src="botao.php" name="botaos" width="300" height="100" scrolling="No" frameborder="0" id="botaos"></iframe>
              </div></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<? } }
} 
?>
</body>
</html>
<? } ?>
