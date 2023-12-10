<?php require_once('../../Connections/Emolumentos.php'); ?><?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso != 1) { ?>
	<script language="javascript" type="text/javascript" ?>
		window.close()
	</script> 
<?
echo "Pagina Restrita";
} else {
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsCidade = "SELECT * FROM municipiospb WHERE grav = '0' ORDER BY nome ASC";
$rsCidade = mysql_query($query_rsCidade, $Emolumentos) or die(mysql_error());
$row_rsCidade = mysql_fetch_assoc($rsCidade);
$totalRows_rsCidade = mysql_num_rows($rsCidade);
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "cadastro")) {

include ("../funcoes/validaCPF_CNPJ.php");

if (isset($_POST['CNPJ']) && $_POST['CNPJ'] != "") { 
	$cnpj = $_POST['CNPJ'];
					$cnpj = ereg_replace("0","0",$cnpj); 
					$cnpj = ereg_replace("/","",$cnpj); 
					$cnpj = ereg_replace("-","",$cnpj); 
					$cnpj = ereg_replace("\.","",$cnpj); 
					$oCnpj = new cnpj;
					if ($oCnpj->verfica_cnpj($cnpj)==1){
					$valida = "ok";
					}
					else{
					$erro = "Informe um CNPJ válido.";
					}
}

if (isset($_POST['CPF']) && $_POST['CPF'] != "") { 

	if (isset($_POST['CPF'])) { $resCPF = CPF($_POST['CPF']); }
	if ($resCPF == "N") { 
		$erro = "Informe um CPF válido.";
	} else if ($resCPF == "S") {
		$valida = "ok";
	}
}
if ($_POST['CPF'] == "" && $_POST['CNPJ'] == ""){
	$erro = "Informe um CPF ou um CNPJ válido";
}
if ($valida == "ok") {

 $updateSQL = sprintf("UPDATE municipiospb SET grav=%s WHERE nome=%s",
                       GetSQLValueString('1', "text"),
                       GetSQLValueString($_POST['Cidade'], "text"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());



  $insertSQL = sprintf("INSERT INTO entidades (nome, cnpj, cpf, endereco, bairro, cidade, uf, cep, fone, fax, email, farpen, conta, dvCC, agencia, dvAG, convenio, datacadastro, responsavel, tipo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CNPJ'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Bairro'], "text"),
                       GetSQLValueString($_POST['Cidade'], "text"),
                       GetSQLValueString("PB", "text"),
                       GetSQLValueString($_POST['CEP'], "text"),
                       GetSQLValueString($_POST['Telefone'], "text"),
                       GetSQLValueString($_POST['Fax'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['FARPEN'], "text"),
                       GetSQLValueString($_POST['Conta'], "text"),
                       GetSQLValueString($_POST['dvCC'], "text"),
                       GetSQLValueString($_POST['agencia'], "text"),
                       GetSQLValueString($_POST['dvAG'], "text"),
					   GetSQLValueString($_POST['convenio'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['responsavel'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($insertSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Instituição inserida');
window.close();
</script>
<?
}
}


if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Editar")) {
include ("../funcoes/validaCPF_CNPJ.php");

if (isset($_POST['CNPJ']) && $_POST['CNPJ'] != "") { 
	$cnpj = $_POST['CNPJ'];
					$cnpj = ereg_replace("0","0",$cnpj); 
					$cnpj = ereg_replace("/","",$cnpj); 
					$cnpj = ereg_replace("-","",$cnpj); 
					$cnpj = ereg_replace("\.","",$cnpj); 
					$oCnpj = new cnpj;
					if ($oCnpj->verfica_cnpj($cnpj)==1){
					$valida = "ok";
					}
					else{
					$erro = "Informe um CNPJ válido.";
					}
}

if (isset($_POST['CPF']) && $_POST['CPF'] != "") { 

	if (isset($_POST['CPF'])) { $resCPF = CPF($_POST['CPF']); }
	if ($resCPF == "N") { 
		$erro = "Informe um CPF válido.";
	} else if ($resCPF == "S") {
		$valida = "ok";
	}
}
if ($_POST['CPF'] == "" && $_POST['CNPJ'] == ""){
	$erro = "Informe um CPF ou um CNPJ válido";
}
if ($valida == "ok") {

  $updateSQL = sprintf("UPDATE entidades SET nome=%s, cnpj=%s, cpf=%s, endereco=%s, bairro=%s, cidade=%s, uf=%s, cep=%s, fone=%s, fax=%s, email=%s, farpen=%s, conta=%s, dvCC=%s, agencia=%s, dvAG=%s, convenio=%s, datacadastro=%s, responsavel=%s, tipo=%s WHERE id=%s",
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CNPJ'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Bairro'], "text"),
                       GetSQLValueString($_POST['Cidade'], "text"),
                       GetSQLValueString("PB", "text"),
                       GetSQLValueString($_POST['CEP'], "text"),
                       GetSQLValueString($_POST['Telefone'], "text"),
                       GetSQLValueString($_POST['Fax'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['FARPEN'], "text"),
                       GetSQLValueString($_POST['Conta'], "text"),
                       GetSQLValueString($_POST['dvCC'], "text"),
                       GetSQLValueString($_POST['agencia'], "text"),
                       GetSQLValueString($_POST['dvAG'], "text"),
					   GetSQLValueString($_POST['convenio'], "text"),
                       GetSQLValueString($_POST['data'], "text"),
                       GetSQLValueString($_POST['responsavel'], "text"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
  ?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
window.alert('Dados atualizados!');
window.close();
</script>
<?
}
}
if (isset($_GET['id'])) { 
$id = $_GET['id'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidades = "SELECT * FROM entidades WHERE entidades.id = '$id' ORDER BY entidades.id ASC";
$rsEntidades = mysql_query($query_rsEntidades, $Emolumentos) or die(mysql_error());
$row_rsEntidades = mysql_fetch_assoc($rsEntidades);
$totalRows_rsEntidades = mysql_num_rows($rsEntidades);
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language=JavaScript type=text/javascript src='../js/form.js'></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Entidades</title>
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
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' deve conter um e-mail válido.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' é obrigatório.\n'; }
  } if (errors) alert('Detectado(s) o(s) seguinte(s) error(s):\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>

<body>
<div align="center">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="30" align="left" valign="middle" background="../imagens/topo.jpg"><div align="left" class="TituloPagina">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td> <script type="text/javascript" src="../js/swfobject.js"></script>
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
              <td class="TituloPagina">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Administra&ccedil;&atilde;o de entidade de Servi&ccedil;o de Distribui&ccedil;&atilde;o </td>
            </tr>
          </table>
      </div></td>
    </tr>
    <tr>
      <td>
       <? if (isset($_GET['oq']) && $_GET['oq'] == "novo") { ?> <form id="cadastro" name="cadastro" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td>
                <div align="center">
                  <table width="580" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="323">
                        <div align="center" class="TituloNoticia1">Dados  da entidade </div>                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div align="center">
                          <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="37%" class="SubTitulo">
                                <div align="right">Entidade:</div>                              </td>
                              <td width="63%">
                                <div align="left" class="TituloNoticia2">
                                  <input name="tipo" type="hidden" id="tipo" value="<? echo $_GET['tipo']; ?>" />
                                  Servi&ccedil;o de Distribui&ccedil;&atilde;o                                </div>                              </td>
                            </tr>
							 <tr>
                              <td class="SubTitulo">
                                <div align="right">Cidade:</div>                              </td>
                              <td>
                                <div align="left">
                                  
                                  <span class="SubTitulo">
                                  <input name="UF2" type="hidden" id="UF2" value="PB" />
                                  </span>
                                  <select name="Cidade" class="Formulario" id="Cidade">
                                    <?php
do {  
?>
                                    <option value="<?php echo $row_rsCidade['nome']?>"><?php echo $row_rsCidade['nome']?></option>
                                    <?php
} while ($row_rsCidade = mysql_fetch_assoc($rsCidade));
  $rows = mysql_num_rows($rsCidade);
  if($rows > 0) {
      mysql_data_seek($rsCidade, 0);
	  $row_rsCidade = mysql_fetch_assoc($rsCidade);
  }
?>
                                  </select>
                                  
                                </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right" class="SubTitulo">Nome:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Nome" type="text" class="Formulario" id="Nome" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" value="<? if (isset($_POST['Nome'])) { echo $_POST['Nome']; } ?>" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">CNPJ ou CPF:</div>                              </td>
                              <td>
                                <div align="left">
                                  <iframe align="middle" frameborder="0" height="19" id="cfp" scrolling="No" src="../iframes/Ent_CPF_CNPJ.php" width="100%"></iframe>
                                  <input name="CNPJ" type="hidden" id="CNPJ" />
                                  <input name="CPF" type="hidden" id="CPF" />
</div>                              </td>
                            </tr>
                           
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Endere&ccedil;o:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Endereco" type="text" class="Formulario" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" value="<? if (isset($_POST['Endereco'])) { echo $_POST['Endereco']; } ?>" id="Endereco" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
							<tr>
                              <td class="SubTitulo">
                                <div align="right">Bairro:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Bairro" type="text" class="Formulario" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" value="<? if (isset($_POST['Bairro'])) { echo $_POST['Bairro']; } ?>" id="Bairro" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">CEP:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="CEP" type="text" class="Formulario" value="<? if (isset($_POST['CEP'])) { echo $_POST['CEP']; } ?>" onKeyPress="MascaraCEP(window.event.keyCode,this)" id="CEP" size="20" maxlength="19" />
                                  <span class="texto"> &nbsp;Exp. 58910-000</span> </div>                              </td>
                            </tr>
                          </table>
                        </div>                      </td>
                    </tr>
                  </table>
                </div>              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
                      <div align="right">
                        <table width="290" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center" class="TituloNoticia1">Dados financeiros </div>                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="35%" class="SubTitulo">
                                    <div align="right">ID  FARPEN:</div>                                  </td>
                                  <td width="65%">
                                    <div align="left">
                                      <input name="FARPEN" type="text" class="Formulario" value="<? if (isset($_POST['FARPEN'])) { echo $_POST['FARPEN']; } ?>" id="FARPEN" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo"><div align="right">Convênio:</div></td>
                                  <td><div align="left">
                                      <input name="convenio" type="text" class="Formulario" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" id="convenio" value="<? if (isset($_POST['convenio'])) { echo $_POST['convenio']; } ?>" size="20" maxlength="7" />
                                  </div></td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Conta:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="Conta" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" type="text" class="Formulario" value="<? if (isset($_POST['Conta'])) { echo $_POST['Conta']; } ?>" id="Conta" size="11" maxlength="10" /> 
                                      - <input name="dvCC" type="text" class="Formulario" id="dvCC" size="3" value="<? if (isset($_POST['dvCC'])) { echo $_POST['dvCC']; } ?>" maxlength="1" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Ag&ecirc;ncia:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="agencia" type="text" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" class="Formulario" value="<? if (isset($_POST['agencia'])) { echo $_POST['agencia']; } ?>" id="agencia" size="11" maxlength="4" />
                                     - 
                                     <input name="dvAG" type="text" class="Formulario" id="dvAG" value="<? if (isset($_POST['dvAG'])) { echo $_POST['dvAG']; } ?>" size="3" maxlength="1" />
</div>                                  </td>
                                </tr>
                              </table>                            </td>
                          </tr>
                        </table>
                      </div>                    </td>
                    <td valign="top">

                      <div align="left">
                        <table width="290" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center" class="TituloNoticia1">Dados para contato com a entidade </div>                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="27%" class="SubTitulo">
                                    <div align="right">Telefone:</div>                                  </td>
                                  <td width="73%">
                                    <div align="left">
                                      <input name="Telefone" type="text" class="Formulario" value="<? if (isset($_POST['Telefone'])) { echo $_POST['Telefone']; } ?>" id="Telefone" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Fax:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="Fax" type="text" class="Formulario" id="Fax" value="<? if (isset($_POST['Fax'])) { echo $_POST['Fax']; } ?>" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">E-mail:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="email" type="text" class="Formulario" id="email" value="<? if (isset($_POST['email'])) { echo $_POST['email']; } ?>" size="30" maxlength="60" />
                                    </div>                                  </td>
                                </tr>
                              </table>                            </td>
                          </tr>
                        </table>
                        <input name="data" type="hidden" id="data" value="<? echo $dataLog; ?>" />
                        <input name="responsavel" type="hidden" id="responsavel" value="<? echo $id_usuario; ?>" />
                      </div>                    </td>
                  </tr>
                </table>              </td>
            </tr>
            <tr>
              <td>
                <div align="center">
                  <input name="imageField2" type="image" onClick="MM_validateForm('Nome','','R','Endereco','','R','Bairro','','R','CEP','','R','convenio','','R','contrato','','R','carteira','','R','vcarteira','','R','Conta','','R','agencia','','R','email','','R');return document.MM_returnValue" src="../imagens/salvar.gif" alt="Salvar" />
                </div>              </td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="cadastro">
        </form><? } else if (isset($_GET['oq']) && $_GET['oq'] == "editar") {?> <form id="cadastro" name="cadastro" method="POST" action="<?php echo $editFormAction; ?>">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">

            <tr>
              <td>
                <div align="center">
                  <table width="580" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="323">
                        <div align="center" class="TituloNoticia1">Dados  da entidade </div>                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div align="center">
                          <table width="100%" border="0" cellspacing="5" cellpadding="0">
                            <tr>
                              <td width="27%" class="SubTitulo">
                                <div align="right">Entidade:</div>                              </td>
                              <td width="73%">
                                <div align="left">
                                  <div align="left" class="TituloNoticia2">
                                    <?php if ($row_rsEntidades['tipo'] == "SN") { ?>
                                    Servi&ccedil;o Notarial e Registral
                                    <? } else { ?>
                                    Servi&ccedil;o de distribui&ccedil;&atilde;o
                                    <? } ?>
                                  </div>
                                </div>                              </td>
                            </tr>
							<tr>
                              <td align="center" class="SubTitulo">
                              <div align="right">Cidade:</div>                              </td>
                              <td align="center">
                              <div align="left"><span class="TituloNoticia2"><?php echo $row_rsEntidades['cidade']; ?></span> </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Nome:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Nome" type="text" class="Formulario"  onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);"  id="Nome" value="<?php echo $row_rsEntidades['nome']; ?>" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
     <? if ($row_rsEntidades['cnpj'] != ""){  ?>                       <tr>
                              <td class="SubTitulo"><div align="right">CNPJ:</div></td>
                              <td><div align="left">
                                  <input name="CNPJ" type="text" class="Formulario" id="CNPJ" onBlur="javascript:formataCNPJ(this);" onKeyUp="javascript:formataCNPJ(this);" value="<?php echo $row_rsEntidades['cnpj']; ?>" size="20" maxlength="19" />
                                  <input name="CPF" type="hidden" id="CPF" value="<?php echo $row_rsEntidades['cnpj']; ?>" />
                              </div></td>
                            </tr><? } ?>
     <? if ($row_rsEntidades['cpf'] != "") { ?>                        <tr>
                              <td class="SubTitulo">
                                <div align="right">CPF:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="CPF" type="text" class="Formulario" id="CPF" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" value="<?php echo $row_rsEntidades['cpf']; ?>" size="20" maxlength="19" />
                                  <input name="CNPJ" type="hidden" id="CNPJ" value="<?php echo $row_rsEntidades['cnpj']; ?>" />
                                </div>                              </td>
                            </tr><? } ?>
                            
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Endere&ccedil;o:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Endereco" type="text" class="Formulario" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" id="Endereco" value="<?php echo $row_rsEntidades['endereco']; ?>" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">Bairro:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="Bairro" type="text" class="Formulario" onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" id="Bairro" value="<?php echo $row_rsEntidades['bairro']; ?>" size="40" maxlength="45" />
                                </div>                              </td>
                            </tr>
                            <tr>
                              <td class="SubTitulo">
                                <div align="right">CEP:</div>                              </td>
                              <td>
                                <div align="left">
                                  <input name="CEP" type="text" class="Formulario" id="CEP" onKeyPress="MascaraCEP(window.event.keyCode,this)" value="<?php echo $row_rsEntidades['cep']; ?>" size="20" maxlength="19" />
                                  <span class="texto"> &nbsp;Exp. 58910-000</span> </div>                              </td>
                            </tr>
                          </table>
                        </div>                      </td>
                    </tr>
                  </table>
                </div>              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top">
                      <div align="right">
                        <table width="290" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center" class="TituloNoticia1">Dados financeiros </div>                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="35%" class="SubTitulo">
                                    <div align="right">ID  FARPEN:</div>                                  </td>
                                  <td width="65%">
                                    <div align="left">
                                      <input name="FARPEN" type="text" class="Formulario" id="FARPEN" value="<?php echo $row_rsEntidades['farpen']; ?>" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo"><div align="right">Convênio:</div></td>
                                  <td><div align="left">
                                      <input name="convenio" type="text" class="Formulario" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" id="convenio" value="<?php echo $row_rsEntidades['convenio']; ?>" size="20" maxlength="7" />
                                  </div></td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Conta:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="Conta" type="text" class="Formulario" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" id="Conta" value="<?php echo $row_rsEntidades['conta']; ?>" size="11" maxlength="10" />
                                     - 
                                     <input name="dvCC" type="text" class="Formulario" id="dvCC" size="3" value="<? echo $row_rsEntidades['dvCC']; ?>" maxlength="1" />
</div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Ag&ecirc;ncia:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="agencia" type="text" onBlur="javascript:formataNUMERO(this);" onKeyUp="javascript:formataNUMERO(this);" class="Formulario" id="agencia" value="<?php echo $row_rsEntidades['agencia']; ?>" size="11" maxlength="4" />
                                    
                                     - 
                                     <input name="dvAG" type="text" class="Formulario" id="dvAG" size="3" value="<? echo $row_rsEntidades['dvAG'];  ?>" maxlength="1" />
</div>                                  </td>
                                </tr>
                              </table>                            </td>
                          </tr>
                        </table>
                      </div>                    </td>
                    <td valign="top">

                      <div align="left">
                        <table width="290" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td>
                              <div align="center" class="TituloNoticia1">Dados para contato com a entidade </div>                            </td>
                          </tr>
                          <tr>
                            <td>
                              <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                <tr>
                                  <td width="27%" class="SubTitulo">
                                    <div align="right">Telefone:</div>                                  </td>
                                  <td width="73%">
                                    <div align="left">
                                      <input name="Telefone" type="text" class="Formulario" id="Telefone" value="<?php echo $row_rsEntidades['fone']; ?>" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">Fax:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="Fax" type="text" class="Formulario" id="Fax" value="<?php echo $row_rsEntidades['fax']; ?>" size="20" maxlength="11" />
                                    </div>                                  </td>
                                </tr>
                                <tr>
                                  <td class="SubTitulo">
                                    <div align="right">E-mail:</div>                                  </td>
                                  <td>
                                    <div align="left">
                                      <input name="email" type="text" class="Formulario" id="email" value="<?php echo $row_rsEntidades['email']; ?>" size="30" maxlength="60" />
                                    </div>                                  </td>
                                </tr>
                              </table>                            </td>
                          </tr>
                        </table>
                        <input name="Cidade" type="hidden" class="Formulario" id="Cidade" value="<?php echo $row_rsEntidades['cidade']; ?>" size="40" maxlength="20" />
                        <input name="data" type="hidden" id="data" value="<? echo $dataLog; ?>" />
                        <input name="responsavel" type="hidden" id="responsavel" value="<? echo $id_usuario; ?>" />
                        <input name="id" type="hidden" id="id" value="<?php echo $row_rsEntidades['id']; ?>" />
                        <input name="tipo" type="hidden" id="tipo" value="<? echo $row_rsEntidades['tipo']; ?>" />
                      </div>                    </td>
                  </tr>
                </table>              </td>
            </tr>
            <tr>
              <td>
                <div align="center">
                  <input name="imageField" type="image" onClick="MM_validateForm('Nome','','R','Endereco','','R','Bairro','','R','CEP','','R','convenio','','R','contrato','','R','carteira','','R','vcarteira','','R','Conta','','R','agencia','','R','email','','R');return document.MM_returnValue" src="../imagens/salvar.gif" alt="Salvar" />
                </div>              </td>
            </tr>
          </table>
          <input type="hidden" name="MM_update" value="Editar">
        </form><? } ?>      </td>
    </tr>
  </table>
</div>
</body>
</html>
<? if (isset($erro)) {
?>
<script language="javascript" type="text/javascript" ?>
window.alert('<? echo $erro; ?>');
</script>
<?
}
?>
<? } ?>