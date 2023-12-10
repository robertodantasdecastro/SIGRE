<?php
$acao = "Acessou";
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Editar")) { $acao = "Salvou Alteracoes"; } 
require_once('../core/restrito.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: sigre.php'); 
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
    
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "Editar")) {
//include ('../../core/crypt.php');
//$string=$_POST['senha'];
//$crpt_string=cript($string);
include ("funcoes/validaCPF_CNPJ.php");
 $resCPF = CPF($_POST['CPF']); 
if ($resCPF == "N") { 
					?>
					<script language="javascript" type="text/javascript" ?>
					window.alert('Informe um CPF válido.');
//					window.history.back();
					</script>
					<? 
} else if ($resCPF == "S") { 
$ids = $row_rsLogin['id'];
  $updateSQL = sprintf("UPDATE usuarios SET id_site=%s, nome=%s, CPF=%s, telefones=%s, endereco=%s, cargo=%s, senha=%s, acesso=%s WHERE id=%s",
                       GetSQLValueString($row_rsLogin['id_site'], "int"),
                       GetSQLValueString($_POST['Nome'], "text"),
                       GetSQLValueString($_POST['CPF'], "text"),
                       GetSQLValueString($_POST['telefones'], "text"),
                       GetSQLValueString($_POST['Endereco'], "text"),
                       GetSQLValueString($_POST['Cargo'], "text"),
                       GetSQLValueString($_SESSION['senha'], "text"),
                       GetSQLValueString($acesso, "int"),
                       GetSQLValueString($ids, "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());

  ?>
<script language="javascript" type="text/javascript" ?>
window.alert('Dados Alterados!');
//window.close();
</script>
<?
}

}
$id_user = $id_usuario;
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsUsuarioEdit = "SELECT * FROM usuarios WHERE usuarios.id = '$id_user'";
	$rsUsuarioEdit = mysql_query($query_rsUsuarioEdit, $Emolumentos) or die(mysql_error());
	$row_rsUsuarioEdit = mysql_fetch_assoc($rsUsuarioEdit);
	$totalRows_rsUsuarioEdit = mysql_num_rows($rsUsuarioEdit);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Pagina.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>SIGRE 1.0</title>
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #333333;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(imagens/bg.jpg);
}
-->
</style>
<link href="estilos.css" rel="stylesheet" type="text/css" />
<!-- InstanceBeginEditable name="head" -->
<script language=JavaScript type=text/javascript src='js/form.js'></script>
<script type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<!-- InstanceEndEditable -->
</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20" align="left" valign="middle" background="imagens/topo.jpg">
	<div align="left"><script type="text/javascript" src="js/swfobject.js"></script>
	<? /* 
	<div id="flashcontent"></div>
	<script type="text/javascript">
          // <![CDATA[
		var so = new SWFObject("topo.swf", "sotester", "240", "55", "8.0.23", "#FFFFFF", true);
		//so.addVariable("flashVarText", "this is passed in via FlashVars"); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode", "transparent");
        so.addParam("menu", "false");
		so.write("flashcontent");
			
           // ]]>
    </script> */ ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="201"><div align="left"><img src="imagens/tjLogo.gif" width="201" height="46" /></div></td>
          <td>&nbsp;</td>
          <td width="212"><div align="right"><img src="imagens/SigreLogo.gif" width="287" height="40" /></div></td>
        </tr>
      </table>
	</div></td>
  </tr>
  <tr>
    <td height="2" bgcolor="#DCE0E9"></td>
  </tr>
  <tr>
    <td height="100" valign="top" bgcolor="#FFFFFF" >
      <? if ($acesso == 1) { ?><table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="cadastros.php" class="LinkTexto"><img src="imagens/CadastroSN.gif" alt="Entidades" width="70" height="70" border="0" /><br />
            Entidades </a></div>          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="AdministrarUsuarios.php" class="LinkTexto"><img src="imagens/CadastroUsuarios.gif" alt="Administra&ccedil;&atilde;o de usu&aacute;rios" width="70" height="70" border="0" /><br />
              Administra&ccedil;&atilde;o<br />
              de 
            usu&aacute;rios </a></div>          </td>
		  <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="dadosPessoais.php" class="LinkTexto"><img src="imagens/usuario.gif" alt="Dados pessoais do usu&aacute;rio <? echo $row_rsLogin['nome']; ?>." width="70" height="70" border="0" /><br />
            Administra&ccedil;&atilde;o de dados pessoais</a></div>          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="configurarGuias.php" class="LinkTexto"><img src="imagens/configurarBoleto.gif" alt="Configurar Guias de Pagamento" width="70" height="70" border="0" /><br />
            Configura&ccedil;&otilde;es das guias </a></div>          </td>
      
			<td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><div align="center"><a href="relatorios.php" class="LinkTexto"><img src="imagens/lupa.gif" alt="Consulta de guias" width="70" height="70" border="0" /><br />
			  Consulta de guias</a></div></td>
			<td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="arquivos.php" class="LinkTexto"><img src="imagens/arquivosEletronicos.gif" alt="Arquivos eletr&ocirc;nicos" width="70" height="70" border="0" /><br />
            Arquivos digitais </a></div>          </td>
			<? /* <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="../www/ajuda.php" class="LinkTexto"><img src="../www/imagens/ajuda.gif" alt="Ajuda" width="70" height="70" border="0" /><br />
            Ajuda</a></div>          </td> */ ?> 
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><a href="sair.php" class="LinkTexto"><img src="imagens/sair.gif" alt="Sair do sistema" width="70" height="70" border="0" /><br />
          Sair </a></td>
          <td align="right" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        </tr>
      </table>
      <? } else if ($acesso == 2 || $acesso == 3) {?>
      <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <? if ($acesso == 2) { ?><td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="AdministrarUsuarios.php" class="LinkTexto"><img src="imagens/CadastroUsuarios.gif" alt="Administra&ccedil;&atilde;o de usu&aacute;rios" width="70" height="70" border="0" /><br />
              Administra&ccedil;&atilde;o<br />
              de 
            usu&aacute;rios </a></div>
          </td><? } ?><td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="dadosPessoais.php" class="LinkTexto"><img src="imagens/usuario.gif" alt="Dados pessoais do usu&aacute;rio <? echo $row_rsLogin['nome']; ?>." width="70" height="70" border="0" /><br />
            Administra&ccedil;&atilde;o de dados pessoais</a></div>
          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><div align="center"><a href="emitirGuias.php" class="LinkTexto"><img src="imagens/emitirBoleto.gif" alt="Emitir Guias de Pagamento" width="70" height="70" border="0" /><br />
            Emiss&atilde;o de guias</a></div></td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="orcamentoGuias.php" class="LinkTexto"><img src="imagens/Orcamento.gif" alt="Or&ccedil;amentos" width="70" height="70" border="0" /><br />
            Or&ccedil;amentos</a></div>          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="relatorios.php" class="LinkTexto"><img src="imagens/lupa.gif" alt="Consulta de guias" width="70" height="70" border="0" /><br />
            Consulta de guias</a></div>          </td>
		<? /* 	<td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="../www/ajuda.php" class="LinkTexto"><img src="../www/imagens/ajuda.gif" alt="Ajuda" width="70" height="70" border="0" /><br />
            Ajuda</a></div>          </td> */ ?>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><a href="sair.php" class="LinkTexto"><img src="imagens/sair.gif" alt="Sair do sistema" width="70" height="70" border="0" /><br />
          Sair </a></td>
		  <? /*
		  $id_entidade = $row_rsEntidadeLogin['id'];

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuiaAlerta = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao FROM guias WHERE guias.tipo = 'Escritura' AND guias.id_entidade = '$id_entidade' AND guias.situacaoEmolumento = '1' OR guias.situacaoFarpen = '1' OR guias.situacaoSDJ = '1' ORDER BY guias.numero DESC";
$rsGuiaAlerta = mysql_query($query_rsGuiaAlerta, $Emolumentos) or die(mysql_error());
$row_rsGuiaAlerta = mysql_fetch_assoc($rsGuiaAlerta);
$totalRows_rsGuiaAlerta = mysql_num_rows($rsGuiaAlerta);

if ($totalRows_rsGuiaAlerta >= 1) { ?>
		   <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
             <div align="center"><a href="../www/relatorios.php" class="LinkTexto"><img src="../www/imagens/alerta.gif" alt="Emitir Guias de Pagamento" width="59" height="42" border="0" /><br />
              <br />
              Existe guias emitidas e n&atilde;o impressas </a></div></td><? } */ ?>
			<td align="right" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        </tr>
      </table>
      <? } else if ($acesso == 4 || $acesso == 5) {?>
      <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <? if ($acesso == 4) { ?>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="AdministrarUsuarios.php" class="LinkTexto"><img src="imagens/CadastroUsuarios.gif" alt="Administra&ccedil;&atilde;o de usu&aacute;rios" width="70" height="70" border="0" /><br />
              Administra&ccedil;&atilde;o<br />
              de 
            usu&aacute;rios </a></div>          </td>
         <? } ?><td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="dadosPessoais.php" class="LinkTexto"><img src="imagens/usuario.gif" alt="Dados pessoais do usu&aacute;rio <? echo $row_rsLogin['nome']; ?>." width="70" height="70" border="0" /><br />
            Administra&ccedil;&atilde;o de dados pessoais</a></div>
          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="arquivos.php?oq=arquivofarpen" class="LinkTexto"><img src="imagens/arquivosEletronicos.gif" alt="Arquivos eletr&ocirc;nicos" width="70" height="70" border="0" /><br />
            Arquivos digitais </a></div>          </td>
          
			<td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="relatorios.php" class="LinkTexto"><img src="imagens/lupa.gif" alt="Consulta de guias" width="70" height="70" border="0" /><br />
            Consulta de guias</a></div>          </td>
<? /*			<td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="../www/ajuda.php" class="LinkTexto"><img src="../www/imagens/ajuda.gif" alt="Ajuda" width="70" height="70" border="0" /><br />
            Ajuda</a></div>          </td> */ ?>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><a href="sair.php" class="LinkTexto"><img src="imagens/sair.gif" alt="Sair do sistema" width="70" height="70" border="0" /><br />
          Sair </a></td>
          <td align="right" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        </tr>
      </table>
      <? } else if ($acesso == 6 || $acesso == 7) {?>
      <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <? if ($acesso == 6) { ?>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="AdministrarUsuarios.php" class="LinkTexto"><img src="imagens/CadastroUsuarios.gif" alt="Administra&ccedil;&atilde;o de usu&aacute;rios" width="70" height="70" border="0" /><br />
              Administra&ccedil;&atilde;o<br />
              de 
            usu&aacute;rios </a></div>          </td>
         <? } ?><td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="dadosPessoais.php" class="LinkTexto"><img src="imagens/usuario.gif" alt="Dados pessoais do usu&aacute;rio <? echo $row_rsLogin['nome']; ?>." width="70" height="70" border="0" /><br />
            Administra&ccedil;&atilde;o de dados pessoais</a></div>
          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="arquivos.php?oq=arquivofarpen" class="LinkTexto"><img src="imagens/arquivosEletronicos.gif" alt="Arquivos eletr&ocirc;nicos" width="70" height="70" border="0" /><br />
            Arquivos digitais </a></div>          </td>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><div align="center"><a href="relatorios.php" class="LinkTexto"><img src="imagens/lupa.gif" alt="Consulta de guias" width="70" height="70" border="0" /><br />
            Consultas</a></div></td>
          <? /*        <td width="90" align="center" valign="top" bgcolor="#FFFFFF" >
            <div align="center"><a href="../www/ajuda.php" class="LinkTexto"><img src="../www/imagens/ajuda.gif" alt="Ajuda" width="70" height="70" border="0" /><br />
            Ajuda</a></div>          </td> */ ?>
          <td width="90" align="center" valign="top" bgcolor="#FFFFFF" ><a href="sair.php" class="LinkTexto"><img src="imagens/sair.gif" alt="Sair do sistema" width="70" height="70" border="0" /><br />
          Sair </a></td>
          <td align="right" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
        </tr>
      </table>
      <? } ?>    </td>
  </tr>
  <tr>
    <td height="2" bgcolor="#DCE0E9"></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
   <tr>
    <td height="2" bgcolor="#DCE0E9"></td>
  </tr>
    <tr>
    <td height="100%" ><!-- InstanceBeginEditable name="Conteudo" -->
      <form id="Editar" name="Editar" method="post" action="<?php echo $editFormAction; ?>">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" bgcolor="#FFFFFF" class="TituloPagina">&nbsp;&nbsp;Administra&ccedil;&atilde;o de usu&aacute;rios <br />
                <br />
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#FFFFFF">
              <table width="528" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="32">&nbsp;</td>
                  <td width="496">
                    <div align="center">
                      <table width="400" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td bgcolor="DCE0E9">
                            <table width="100%" border="0" cellspacing="1" cellpadding="0">
                              <tr>
                                <td height="20" background="imagens/topo.jpg" bgcolor="#FFFFFF">
                                  <div align="center" class="TituloNoticia1">Alterar dados pessoais </div>
                                </td>
                              </tr>
                              <tr>
                                <td bgcolor="#FFFFFF">
                                  <div align="center">
                                    <table width="400" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td>
                                          <div align="center"></div>                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div align="center">
                                            <table width="391" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td>
                                                  <div align="center" class="TituloNoticia1">
                                                    <? 
$ids=$row_rsUsuarioEdit['id_site'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidadeUser = "SELECT nome, id FROM entidades WHERE id = '$ids' ORDER BY entidades.id ASC";
$rsEntidadeUser = mysql_query($query_rsEntidadeUser, $Emolumentos) or die(mysql_error());
$row_rsEntidadeUser = mysql_fetch_assoc($rsEntidadeUser);
$totalRows_rsEntidadeUser = mysql_num_rows($rsEntidadeUser);?>
                                                  </div>                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  <div align="center">
                                                    <table width="100%" border="0" cellspacing="5" cellpadding="0">
                                                      <tr>
                                                        <td width="33%" class="SubTitulo">
                                                          <div align="right">Nome:</div>                                                        </td>
                                                        <td width="67%" align="left" valign="middle">
                                                          <div align="left">
                                                            <input onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Nome" type="text" class="Formulario" id="Nome" value="<?php echo $row_rsUsuarioEdit['nome']; ?>" size="40" maxlength="45" />
                                                          </div>                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="SubTitulo">
                                                          <div align="right">CPF:</div>                                                        </td>
                                                        <td align="left" valign="middle">
                                                          <div align="left">
                                                            <input name="CPF" type="text" class="Formulario" id="CPF" onBlur="javascript:formataCPF(this);" onKeyUp="javascript:formataCPF(this);" value="<?php echo $row_rsUsuarioEdit['CPF']; ?>" />
                                                            <span class="texto">&nbsp;Exp.002.834.093-02</span> </div>                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="SubTitulo">
                                                          <div align="right">Telefones:</div>                                                        </td>
                                                        <td align="left" valign="middle">
                                                          <div align="left">
                                                            <input name="telefones" type="text" class="Formulario" id="telefones" value="<?php echo $row_rsUsuarioEdit['telefones']; ?>" size="40" maxlength="50" />
                                                          </div>                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="SubTitulo">
                                                          <div align="right">Endere&ccedil;o:</div>                                                        </td>
                                                        <td align="left" valign="middle">
                                                          <div align="left">
                                                            <input onBlur="javascript:lm(this);" onKeyUp="javascript:lm(this);" name="Endereco" type="text" class="Formulario" id="Endereco" value="<?php echo $row_rsUsuarioEdit['endereco']; ?>" size="40" maxlength="100" />
                                                          </div>                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <td class="SubTitulo">
                                                          <div align="right"></div>                                                        </td>
                                                        <td align="left" valign="middle">
                                                          <input name="Submit3" type="button" class="Formulario" onClick="MM_openBrWindow('popups/alterarSenha.php','AlterarSenha','width=300,height=170')" value="Alterar Senha" />                                                        </td>
                                                      </tr>
                                                    </table>
                                                  </div>                                                </td>
                                              </tr>
                                              <tr>
                                                <td><div align="center">
                                                  <input name="imageField" type="image" src="imagens/salvar.gif" alt="Salvar" />
                                                </div></td>
                                              </tr>
                                            </table>
                                          </div>                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <div align="center">
                                            <input name="Cargo" type="hidden" class="Formulario" id="Cargo" value="<?php echo $row_rsUsuarioEdit['cargo']; ?>" size="40" maxlength="20" />
                                            <input name="id" type="hidden" id="id" value="<?php echo $row_rsUsuarioEdit['id']; ?>" />
                                            <input name="acesso" type="hidden" id="acesso" value="<?php echo $row_rsUsuarioEdit['acesso']; ?>" />
                                            <input name="id_site" type="hidden" id="id_site" value="<?php echo $row_rsUsuarioEdit['id_site']; ?>" />
                                          </div>                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <br />
                    </div>
                  </td>
                </tr>
              </table>
              <br />
              <br />
            </td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="Editar" />
      </form>
    <!-- InstanceEndEditable --></td>
  </tr>
  <tr>
    <td height="2" bgcolor="#DCE0E9"></td>
  </tr>
  <tr>
    <td height="22" background="imagens/imgInf.jpg" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td height="22" background="imagens/bg.jpg" bgcolor="#FFFFFF"><div align="right">
      <table width="70" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div id="ass"></div>
	<script type="text/javascript">
          // <![CDATA[
		
          var so = new SWFObject("ass.swf", "sotester", "150", "20", "8.0.23", "#FFFFFF");
		//so.addVariable("flashVarText", "this is passed in via FlashVars"); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode", "transparent");
        so.addParam("menu", "false");
		so.write("ass");
		
           // ]]>
    </script></a></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
}
?>
