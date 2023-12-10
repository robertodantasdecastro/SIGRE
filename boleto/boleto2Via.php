<?php require_once('../../core/restritoPopUp.php'); 

// echo $row_rsGuia["tipo"]; if ($row_rsGuia["declarado"] == "s"){ echo " com valor declarado."; } else if ($row_rsGuia["declarado"] == "n"){ echo " sem valor declarado - ".$row_rsGuia['ndescricao']; } 
if (isset($erros) && $erros == "off" || $erros == "erro" || $acesso > 3) {
//	if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
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
function formatarExportacao($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = "$branco".$var;	
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
	}
	function formatarExportacao2($var, $m, $tam, $branco)	{
	//	$tam = '20';
		$sizeName = strlen($var);	
		$a="1234567890ÁáÉéÍíÓóÚúÇçÃãÀàÂâÊêÎîÔôÕõÛûü& !#$%¨&*_+}=}{[]^~?:;><'´`";
		$b="1234567890AAEEIIOOUUCCAAAAAAEEIIOOOOUUUE _________________________";
		$var = strtr($var,$a,$b);
		if ($sizeName>$tam)	{ 
			 $var = substr($var,0,$tam); 
		} else {
		
			for ($i = $sizeName; $i < $tam ; $i++) {
			$var = $var."$branco";
			}
		
		}
		if (isset($m) && $m == "up") { 
			$var = strtoupper($var);
		}
		if (isset($m) && $m == "down") { 
			$var = strtolower($var);
		}
		return $var;
	}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
if (isset($_GET['id_guia'])) { $id_guia = $_GET['id_guia']; } else if (isset($_SESSION['id_guia'])) { $id_guia = $_SESSION['id_guia']; }
if (isset($_GET['situacao'])) { $situacao = $_GET['situacao']; } else if (isset($_SESSION['situacao'])) { $situacao = $_SESSION['situacao']; }








$dias_do_mes = date ("t", mktime (0,0,0,$mes,$dia,$ano));
		$diaV = $dia + 7;
		if ($diaV > $dias_do_mes) {
			$diaV = $diaV - $dias_do_mes;
			$mesV = $mes + 1;
		} else { 
			$mesV = $mes;
		}
		if ($mesV > 12){
			$mesV = 1;
			$anoV = $ano + 1;
		} else { 
			$anoV = $ano;
		}
	
		if ($diaV<10){ $diaV = "0".$diaV; }
		if ($mesV<10){ $mesV = "0".$mesV; }
		$vencimento = $anoV."-".$mesV."-".$diaV; // vencimento
		if ($mes<10) { $mes="0".$mes; }
		$emissao2 = $ano."-".$mes."-".$dia; // emissao








mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsGuia = "SELECT *, date_format(guias.`vencimento`, '%d/%m/%Y') as vencimento, date_format(guias.`emicao`, '%d/%m/%Y') as emicao FROM guias WHERE guias.id = '$id_guia'";
$rsGuia = mysql_query($query_rsGuia, $Emolumentos) or die(mysql_error());
$row_rsGuia = mysql_fetch_assoc($rsGuia);
$totalRows_rsGuia = mysql_num_rows($rsGuia);

$id_entidade = $row_rsGuia['id_entidade'];
//$id_guia = $row_rsGuia['id'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEnt= "SELECT * FROM entidades WHERE entidades.id = '$id_entidade'";
$rsEnt= mysql_query($query_rsEnt, $Emolumentos) or die(mysql_error());
$row_rsEnt= mysql_fetch_assoc($rsEnt);
$totalRows_rsEnt= mysql_num_rows($rsEnt);

$id_sdt = $row_rsEnt['id_sdt'];


if ($_GET['oq'] == "emolumento"){


if ($row_rsGuia["tipo"] == "Escritura") {

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidade = "SELECT * FROM entidades WHERE entidades.id = '$id_entidade'";
$rsEntidade = mysql_query($query_rsEntidade, $Emolumentos) or die(mysql_error());
$row_rsEntidade = mysql_fetch_assoc($rsEntidade);
$totalRows_rsEntidade = mysql_num_rows($rsEntidade);

} else if ($row_rsGuia["tipo"] == "Registro") {

$idReg = $row_rsGuia['idReg'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidade = "SELECT * FROM entidades WHERE entidades.id = '$idReg'";
$rsEntidade = mysql_query($query_rsEntidade, $Emolumentos) or die(mysql_error());
$row_rsEntidade = mysql_fetch_assoc($rsEntidade);
$totalRows_rsEntidade = mysql_num_rows($rsEntidade);

}


$_SESSION['N_guia'] = "FIM";
	$entra["valor"] = $row_rsGuia['valorEmolumento']; 
	

	if ((isset($situacao)) && ($situacao > $row_rsGuia['situacaoEmolumento'])) {
	
	
	$d = $ano."-".$mes."-".$dia;
	
	
	
		$updateSQL = sprintf("UPDATE guias SET situacaoEmolumento=%s, 2viaEmissaoEmo=%s, 2viaVencEmo=%s WHERE id=%s",
                       GetSQLValueString($situacao, "int"),
					   GetSQLValueString($emissao, "date"),
					   GetSQLValueString($vencimento, "date"),
                       GetSQLValueString($id_guia, "int"));

		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());

	}
} else if ($_GET['oq'] == "distribuidor"){ 

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidade = "SELECT * FROM entidades WHERE entidades.id = '$id_sdt'";
$rsEntidade = mysql_query($query_rsEntidade, $Emolumentos) or die(mysql_error());
$row_rsEntidade = mysql_fetch_assoc($rsEntidade);
$totalRows_rsEntidade = mysql_num_rows($rsEntidade);

$_SESSION['N_guia'] = "emolumento";
	$entra["valor"] = $row_rsGuia['valorSDT']; 
	
	if ((isset($situacao)) && ($situacao > $row_rsGuia['situacaoSDJ'])) {
	
	
	$d = $ano."-".$mes."-".$dia;
	
	
	
		$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s, 2viaEmissaoSdj=%s, 2viaVencSdj=%s WHERE id=%s",
                       GetSQLValueString($situacao, "int"),
					   GetSQLValueString($emissao, "date"),
					   GetSQLValueString($vencimento, "date"),
                       GetSQLValueString($id_guia, "int"));

		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				
	}
} else if ($_GET['oq'] == "farpen"){ 
if ($row_rsGuia["tipo"] == "Escritura") {

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidade = "SELECT * FROM entidades WHERE entidades.id = '$id_entidade'";
$rsEntidade = mysql_query($query_rsEntidade, $Emolumentos) or die(mysql_error());
$row_rsEntidade = mysql_fetch_assoc($rsEntidade);
$totalRows_rsEntidade = mysql_num_rows($rsEntidade);

} else if ($row_rsGuia["tipo"] == "Registro") {

$idReg = $row_rsGuia['idReg'];
mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsEntidade = "SELECT * FROM entidades WHERE entidades.id = '$idReg'";
$rsEntidade = mysql_query($query_rsEntidade, $Emolumentos) or die(mysql_error());
$row_rsEntidade = mysql_fetch_assoc($rsEntidade);
$totalRows_rsEntidade = mysql_num_rows($rsEntidade);

}
if ($_SESSION['tipo'] == "Registro" || $_SESSION['tipo'] == "EscrituraRegistro") { $_SESSION['N_guia'] = "emolumento"; } else { $_SESSION['N_guia'] = "distribuidor"; }

	$entra["valor"] = $row_rsGuia['valorFarpen']; 
	if ((isset($situacao)) && ($situacao > $row_rsGuia['situacaoFarpen'])) {
	
	
	$d = $ano."-".$mes."-".$dia;
	
	
	
		$updateSQL = sprintf("UPDATE guias SET situacaoFarpen=%s, 2viaEmissaoSdj=%s, 2viaVencSdj=%s WHERE id=%s",
                       GetSQLValueString($situacao, "int"),
					   GetSQLValueString($emissao, "date"),
					   GetSQLValueString($vencimento, "date"),
                       GetSQLValueString($id_guia, "int"));

		mysql_select_db($database_Emolumentos, $Emolumentos);
		$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
				

	}
	
}

$maxRows_rsOutorgante = 5;
$pageNum_rsOutorgante = 0;
if (isset($_GET['pageNum_rsOutorgante'])) {
  $pageNum_rsOutorgante = $_GET['pageNum_rsOutorgante'];
}
$startRow_rsOutorgante = $pageNum_rsOutorgante * $maxRows_rsOutorgante;

$maxRows_rsOutorgado = 5;
$pageNum_rsOutorgado = 0;
if (isset($_GET['pageNum_rsOutorgado'])) {
  $pageNum_rsOutorgado = $_GET['pageNum_rsOutorgado'];
}
$startRow_rsOutorgado = $pageNum_rsOutorgado * $maxRows_rsOutorgado;

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsOutorgante = "SELECT partesguias.*, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '0' AND partes.id = partesguias.id_parte";
$rsOutorgante = mysql_query($query_rsOutorgante, $Emolumentos) or die(mysql_error());
$row_rsOutorgante = mysql_fetch_assoc($rsOutorgante);
$totalRows_rsOutorgante = mysql_num_rows($rsOutorgante);



mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsOutorgado = "SELECT partesguias.*, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '1' AND partes.id = partesguias.id_parte";
$rsOutorgado = mysql_query($query_rsOutorgado, $Emolumentos) or die(mysql_error());
$row_rsOutorgado = mysql_fetch_assoc($rsOutorgado);
$totalRows_rsOutorgado = mysql_num_rows($rsOutorgado);


?>
<script language="javascript" type="text/javascript" ?>
window.opener.location.reload();
</script>
<?








/*------------------------------------------------------------*/
/*--- Dados Do Sacado (Opcional) -----------------------------*/
/*------------------------------------------------------------*/
if ($totalRows_rsOutorgado >= "1") { $entra["sacado"]            = $row_rsOutorgado['nome']." - ".$row_rsOutorgado['cpf']." ".$row_rsOutorgado['cnpj']; } else {

$entra["sacado"]            = $row_rsOutorgante['nome']." - ".$row_rsOutorgante['cpf']." ".$row_rsOutorgante['cnpj'];
}
$entra["endereco1"]         = "";
$entra["endereco2"]         = "";


/*------------------------------------------------------------*/
/*--- Dados Do Cedente ---------------------------------------*/
/*------------------------------------------------------------*/

$entra["agencia"]           = $row_rsEntidade['agencia'];
$entra["digito_agencia"]    = $row_rsEntidade['dvAG'];
$entra["conta"]             = $row_rsEntidade['conta'];
$entra["digito_conta"]      = $row_rsEntidade['dvCC'];
$entra["carteira"]          = "18";
if ($_GET['oq'] == "farpen"){ $entra["convenio"]          = $row_rsEntidade['convenio2'];  } else { $entra["convenio"]          = $row_rsEntidade['convenio'];  }
$entra["layout_boleto"]     = "3";

/*
====== Descrição Layout do boleto Banco do Brasil =======
1) Convênio c/ 0 ou 6 digitos, Nosso Numero até 11 digitos
2) Convênio c/ 6 digitos, Nosso Numero até 17 digitos *(raramente utilizado)
3) Convênio c/ 7 digitos, Nosso Numero até 10 digitos
4) Convênio c/ 4 Digitos, Nosso Numero até 7 digitos
5) Convênio c/ 6 Digitos, Nosso Numero até 5 digitos
====== Selecione o layout de 1 a 5 conforme o modelo de layout que você usa para sua conta =====
O padrão de layouts mais pelo Banco do Brasil é o seguinte:
Carteiras 11 ou 51 = Layout Boleto 1
Carteiras 16, 17 ou 18 e convenio com 4 digitos = Layout Boleto 4
Carteiras 16, 17 ou 18 e convenio com 6 digitos = Layout Boleto 5
Carteiras 16 ou 18 sem convenio = Layout Boleto 1
Convênios novos com 7 Digitos = Layout Boleto 3
Se ainda tiver duvidas, entre em contato com o suporte técnico da sua agência para verificar qual é o layout da sua conta.
*/

/*------------------------------------------------------------*/
/*--- Dados Do Títular Da Conta ------------------------------*/
/*------------------------------------------------------------*/

$entra["cpf_cnpj_cedente"]  = $row_rsEntidade['cnpj'];
$entra["endereco"]          = $row_rsEntidade['endereco'].", ".$row_rsEntidade['bairro'];
$entra["cidade"]            = $row_rsEntidade['cidade']." - ".$row_rsEntidade['uf'];
$entra["cedente"]           = $row_rsEntidade['nome'];

/*------------------------------------------------------------*/
/*--- Dados Do Boleto ----------------------------------------*/
/*------------------------------------------------------------*/
if ($row_rsEnt['id'] < 10){ $id_entidade = "00".$row_rsEnt['id']; } else if ($row_rsEnt['id'] < 100) { $id_entidade = "0".$row_rsEnt['id']; } else if ($row_rsEnt['id'] < 1000) { $id_entidade = $row_rsEnt['id']; }

if ($row_rsGuia['numero'] < 10){ $numeros = "0000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 100) { $numeros = "000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 1000) { $numeros = "00".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 10000) { $numeros = "0".$row_rsGuia['numero']; } 

$anos = substr($row_rsGuia['ano'], 2, 2);

$entra["data_vencimento"]   = substr($vencimento, 8, 2)."/".substr($vencimento, 5, 2)."/".substr($vencimento, 0, 4); 
$entra["data_documento"]    = substr($emissao2, 8, 2)."/".substr($emissao2, 5, 2)."/".substr($emissao2, 0, 4); 
$entra["numero_documento"]  = $id_entidade.".".$anos.".".$numeros; //$row_rsGuia['id'];
$entra["nosso_numero"]      = $id_entidade.$anos.$numeros;
//echo "numero".$numeros.$row_rsGuia['numero'];

//$entra["valor"]             = $_POST["valor"];

/*------------------------------------------------------------*/
/*--- Campos Opcionais ---------------------------------------*/
/*------------------------------------------------------------*/

if ($_GET['oq'] == "farpen") { $TG = "FARPEN"; } else if ($_GET['oq'] == "emolumento") { $TG = "EMOLUMENTOS"; } else if ($_GET['oq'] == "distribuidor") { $TG = "TAXA DE COMUNICAÇÃO"; }
$entra["instrucoes"] = "NÃO RECEBER APÓS O VENCIMENTO";
$entra["instrucoes1"] = "GUIA REFERENTE AOS ENCARGOS DE $TG";
if ($_SESSION['declarado'] == "s"){ $entra["instrucoes2"] = ""; $entra["instrucoes3"] = "";} else if ($_SESSION['declarado'] == "n") { $entra["instrucoes2"] = ""; $entra["instrucoes3"] = ""; }
if ($_GET['oq'] == "emolumento"){ $entra["instrucoes4"] = "Valor referente ao FEPJ: R$ ".$row_rsGuia['valorFEPJ']; } else if ($_GET['oq'] == "distribuidor") {
$v = $row_rsGuia['valorSDT'] * (3/100);
$v = number_format($v, 2, ",", ".");
 $entra["instrucoes4"] = "Valor referente ao FEPJ: R$ ".$v; } else { $entra["instrucoes4"] = ""; }
if ($_SESSION['declarado'] == "s"){ $entra["instrucoes5"] = "Valor fiscal do imóvel R$: ".$row_rsGuia['vfiscal']; }

		$doctipo = "";
		
		$doctipo = substr(strtoupper($row_rsGuia['tipo']), 0, 3).". ";
		if ($doctipo == 'ESC. ') { 
			if ($row_rsGuia['declarado'] == 's') { 
				if ($row_rsGuia['TipoImovel'] != 'N/D') { 
					$doctipo .="COM VALOR (IMOBILIARIA)";
				} else {
					
					$doctipo .="COM VALOR (".formatarExportacao ($row_rsGuia['id_natuEsc'], "up", "23", "").")";
				}
			} else {
				if (strtoupper($row_rsGuia['ndescricao']) == "OUTRAS (SEM VALOR DECLARADO)") { 
					$doctipo .= "SEM VALOR (OUTRAS)";
				}else{
					$doctipo .= "SEM VALOR (".formatarExportacao ($row_rsGuia['ndescricao'], "up", "23", "").")";
				}
			}
		
		} else if ($doctipo == 'REG. ') { 
			
			$idTipoReg = $row_rsGuia['tipoRegistro'];
			mysql_select_db($database_Emolumentos, $Emolumentos);
			$query_rsTipoRegistro = "SELECT * FROM tiporegistro WHERE tiporegistro.id = '$idTipoReg'";
			$rsTipoRegistro = mysql_query($query_rsTipoRegistro, $Emolumentos) or die(mysql_error());
			$row_rsTipoRegistro = mysql_fetch_assoc($rsTipoRegistro);
			$totalRows_rsTipoRegistro = mysql_num_rows($rsTipoRegistro);
			
			if ($idTipoReg == 7 || $idTipoReg == 20) { 
				$doctipo .= "DE IMOVEL "; 
			} else { 
				$doctipo .= "DE IMOVEL "; 
			}
			
			$doctipo .= "(".formatarExportacao ($row_rsTipoRegistro['nome'], "up", "23", "").")";
		}

$entra["data_processamento"]  = $row_rsGuia['emicao'];
$entra["quantidade"]          = "";
$entra["valor_unitario"]      = "";

/*------------------------------------------------------------*/
/*--- Campos com valores estáticos ---------------------------*/
/*------------------------------------------------------------*/

$entra["aceite"]              = "N";
$entra["uso_banco"]           = "";
$entra["especie"]             = "R$";
$entra["especie_doc"]         = "DM";


/*------------------------------------------------------------*/
/*--- NÃO ALTERE NADA A PARTIR DESTA LINHA -------------------*/
/*------------------------------------------------------------*/
include("bb.php");
$b = new boleto();                
$b->banco_brasil($entra);








?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>SIGRE - Guia de recolhimento de emolumentos</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META content="MSHTML 6.00.2800.1400" name=GENERATOR>
<style type="text/css">
<!--
.ld {font: bold 15px Arial; color: #000000}
.style2 {font-family: Arial, Helvetica, sans-serif}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</HEAD>
<BODY bgcolor="#FFFFFF">
<link href="../estilos.css" rel="stylesheet" type="text/css">
<STYLE>BODY {
        FONT: 10px Arial
}
.Titulo {
        FONT: 9px Arial Narrow; COLOR: navy
}
.Campo {
        FONT: 10px Arial; COLOR: black
}
.Normal {
        FONT: 12px Arial; COLOR: black
}
.Titulo {
        FONT: 9px Arial Narrow; COLOR: navy
}
.Campo {
        FONT: bold 10px Arial; COLOR: black
}
.CampoTitulo {
        FONT: bold 15px Arial; COLOR: navy
}
.CampoTitulo2 {
	FONT: bold 17px Verdana; COLOR: #333333
}
.TituloP {
	FONT: bold 10px Arial; COLOR: black
}
</STYLE>
<DIV align=center>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100"><div align="center"><img src="../imagens/pb.jpg" width="60" height="67"></div></td>
              <td valign="top"><div align="center" class=CampoTitulo2>TRIBUNAL DE JUSTI&Ccedil;A<br>
                GUIA DE RECOLHIMENTO DE EMOLUMENTOS<br>
              </div></td>
              <td width="100"><div align="center"><img src="../imagens/anoreg.jpg" width="65" height="59"></div></td>
            </tr>
          </table>
      </div></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class=CampoTitulo><div align="center">GUIA DE RECOLHIMENTO DE
              <? if ($_GET['oq'] == "farpen") { echo "FARPEN<br><br>"; } else if ($_GET['oq'] == "emolumento") { echo "EMOLUMENTOS<br><br>"; } else if ($_GET['oq'] == "distribuidor") { echo "TAXA DE COMUNICAÇÃO<br><br>"; } ?>
            </div></td>
          </tr>
          <tr>
            <td><div align="center">
             <table width="650" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="51%" valign="top" class="TituloP">OF&Iacute;CIO:</td>
                  <td width="49%" valign="top" class="TituloP">DATA :</td>
                </tr>
                <tr>
                  <td width="51%" valign="top" class="SubTitulo"><? echo $entra["cedente"]; ?> </td>
                  <td valign="top" class="SubTitulo"><?=$entra["data_documento"]?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td width="51%" valign="top" class="TituloP">OUTORGANTE(S):</td>
                  <td valign="top" class="TituloP"><? if ($row_rsOutorgado['nome'] != "") { ?> OUTORGADO(S): <? } ?></td>
                </tr>
                <tr>
                  <td valign="top" class="SubTitulo"><? echo $row_rsOutorgante['nome']." - ".$row_rsOutorgante['cpf'].$row_rsOutorgante['cnpj']; if ($totalRows_rsOutorgante > 1) { echo "<br>E Outro(s) (".($totalRows_rsOutorgante - 1).")"; }?></td>
                  <td valign="top" class="SubTitulo"><? if ($row_rsOutorgado['nome'] != "") { echo $row_rsOutorgado['nome']." - ".$row_rsOutorgado['cpf'].$row_rsOutorgado['cnpj']; if ($totalRows_rsOutorgado > 1) { echo "<br>E Outro(s) (".($totalRows_rsOutorgado - 1).")"; } }?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td valign="top" class="TituloP">VALOR EMOLUMENTOS:&nbsp;</td>
                  <td valign="top" class="TituloP">RESPONS&Aacute;VEL PELA EMISS&Atilde;O: </td>
                </tr>
                <tr>
                  <td valign="top" class="TituloP"><span class="SubTitulo">R$ <?=$entra["valor"]?></span></td>
                  <td valign="top" class="SubTitulo"><? echo $row_rsLogin['nome']; ?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td valign="top" class="TituloP"><? if ($_GET['oq'] == "emolumento" || $_GET['oq'] == "distribuidor") { echo "FEPJ: "; }?></td>
                  <td valign="top" class="TituloP">NATUREZA: </td>
                </tr>
                                <tr>
                  <td valign="top" class="TituloP"><span class="SubTitulo"><? if ($_GET['oq'] == "emolumento") { echo "R$ ".$row_rsGuia['valorFEPJ']; } else if ($_GET['oq'] == "distribuidor") { echo "R$ ".$v; } ?></span></td>
                  <td valign="top" class="SubTitulo"><?php echo $doctipo; ?></td>
                </tr>
                               <tr>
                  <td height="5"></td>
                  <td height="5"></td>
                </tr>
 <? if (isset($row_rsGuia['TipoImovel']) && $row_rsGuia['TipoImovel'] != "N/D") { ?><tr>
                  <td valign="top" class="TituloP"><? if ($row_rsGuia["TipoImovel"] != "--") { ?>TIPO DE IM&Oacute;VEL: <? } ?></td>
                  <td valign="top" class="TituloP">CARACTERISTICAS:</td>
 </tr>
                <tr>
                  <td valign="top" class="SubTitulo"><?php if ($row_rsGuia["TipoImovel"] != "--") { echo $row_rsGuia["TipoImovel"]; } ?></td>
                  <td valign="top" class="SubTitulo"><? if (isset($row_rsGuia['caracteristicas']) && $row_rsGuia['caracteristicas'] != "N/D") {  echo $row_rsGuia["caracteristicas"]; }?></td>
                </tr> <? } ?>
                <? if (isset($row_rsGuia['vfiscal'])) { ?><tr>
                  <td height="5"></td>
                  <td height="5"></td>
                </tr>
                  <td valign="top" class="TituloP">VALOR DA TRANSA&Ccedil;&Atilde;O:</td>
                  <td height="5"></td> 
                </tr>
                <tr>
                  <td valign="top" class="SubTitulo"><? if (isset($row_rsGuia['vfiscal'])) { echo $row_rsGuia['vfiscal']; } else { ?>SEM VALOR DECLARADO<? } ?></td>
                  <td height="5"></td> 
                </tr><? } ?>
              </table>
            </div></td>
          </tr>
          <tr>
            <td></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
<BR>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD class=campo width=150><IMG height=22 
      src="imagens/imgbb.gif" width=150 
      border=0></TD>
    <TD width=3><IMG height=22 
      src="imagens/imgbrrazu.gif" width=2 
      border=0></TD>
    <TD class=campotitulo align=middle width=46>001-9</TD>
    <TD width=3><IMG height=22 
      src="imagens/imgbrrazu.gif" width=2 
      border=0></TD>
    <TD class=campotitulo align=right width=464><span class="ld">
      <?=$entra["linha_digitavel"]?>
    </span> &nbsp;&nbsp;&nbsp; </TD>
  </TR>
  <TR>
    <TD colSpan=5><IMG height=2 
      src="imagens/imgpxlazu.gif" width=666 
      border=0></TD></TR></TBODY></TABLE><BR>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=298 height=13>Cedente</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=126 height=13>Agência / Código do Cedente</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=34 height=13>Espécie</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=53 height=13>Quantidade</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=120 height=13>Nosso número</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=298 height=12><? echo $entra["cedente"]; ?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=126 height=12><?=$entra["agencia_codigo"]?> 
    &nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=34 height=12><?=$entra["especie"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=53 height=12><?=$entra["quantidade"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=120 
    height=12><?=$entra["nosso_numero"]?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=298 height=3><IMG height=1
      src="imagens/imgpxlazu.gif" width=298
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=126 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=126 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=34 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=34 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=53 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=53 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=120 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=120 
      border=0></TD></TR></TBODY></TABLE>
      
      
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=113 height=13>Número do documento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=72 height=13>Contrato</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=132 height=13>CPF/CEI/CNPJ</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=134 height=13>Vencimento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 height=13>Valor documento</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=113 height=12><?=$entra["numero_documento"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=72 height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=132 height=12><?=$entra["cpf_cnpj_cedente"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=134 
    height=12><?=$entra["data_vencimento"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 
  height=12><?=$entra["valor"]?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=113 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=113 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=72 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=72 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=132 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=132 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=134 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=134 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
      
      
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=113 height=13>(-) Desconto / 
    Abatimento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=112 height=13>(-) Outras deduções</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=113 height=13>(+) Mora / Multa</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=113 height=13>(+) Outros acréscimos</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 bgColor=#ffffcc height=13>(=) Valor 
      cobrado</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=113 height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=112 height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=113 height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=113 height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 bgColor=#ffffcc 
    height=12>&nbsp;</TD></TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=113 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=113 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=112 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=112 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=113 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=113 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=113 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=113 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=659 height=13>Sacado</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=659 height=12><?=$entra["sacado"]?> 
    &nbsp;</TD></TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=659 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=659 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13></TD>
    <TD class=titulo vAlign=top width=7 height=13></TD>
    <TD class=titulo vAlign=top width=88 height=13>Autenticação mecânica</TD></TR>
  <TR>
    <TD vAlign=top width=7 height=3></TD>
    <TD vAlign=top width=564 height=3></TD>
    <TD vAlign=top width=7 height=3></TD>
    <TD vAlign=top width=88 height=3></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD class=titulo width=666>Corte na linha pontilhada</TD></TR></TBODY></TABLE>
<br>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD class=campo width=150><IMG height=22 
      src="imagens/imgbb.gif" width=150 
      border=0></TD>
    <TD width=3><IMG height=22 
      src="imagens/imgbrrazu.gif" width=2 
      border=0></TD>
    <TD class=campotitulo align=middle width=46>001-9</TD>
    <TD width=3><IMG height=22 
      src="imagens/imgbrrazu.gif" width=2 
      border=0></TD>
    <TD class=campotitulo align=right width=464><?=$entra["linha_digitavel"]?> &nbsp;&nbsp;&nbsp; </TD></TR>
  <TR>
    <TD colSpan=5><IMG height=2 
      src="imagens/imgpxlazu.gif" width=666 
      border=0></TD></TR></TBODY></TABLE><BR>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=472 height=13>Local de pagamento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 bgColor=#ffffcc 
    height=13>Vencimento</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=472 height=12>QUALQUER BANCO ATÉ O 
      VENCIMENTO&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 bgColor=#ffffcc 
      height=12><?=$entra["data_vencimento"]?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=472 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=472 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=472 height=13>Cedente</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 height=13>Agência/Código 
  cedente</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=472 height=12><?=$entra["cedente"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 
      height=12><?=$entra["agencia_codigo"]?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=472 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=472 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=93 height=13>Data do documento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=173 height=13>N<U>o</U> documento</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=72 height=13>Espécie doc.</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=34 height=13>Aceite</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=72 height=13>Data process.</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 height=13>Nosso número</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=93 
    height=12><?=$entra["data_documento"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=173 height=12><?=$entra["numero_documento"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=72 height=12><?=$entra["especie_doc"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=34 height=12><?=$entra["aceite"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=72 
    height=12><?=$entra["data_processamento"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 
    height=12><?=$entra["nosso_numero"]?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=93 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=93 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=173 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=173 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=72 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=72 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=34 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=34 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=72 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=72 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=93 bgColor=#ffffcc height=13>Uso do 
    banco</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=93 height=13>Carteira</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=53 height=13>Espécie</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=133 height=13>Quantidade</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=72 height=13>x Valor</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 height=13>(=) Valor documento</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=93 bgColor=#ffffcc height=12>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=93 height=12><?=$entra["carteira"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=53 height=12><?=$entra["especie"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=middle width=53 height=12><?=$entra["quantidade"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=72 height=12><?=$entra["valor_unitario"]?>&nbsp;</TD>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top align=right width=180 
  height=12><?=$entra["valor"]?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
  </TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=93 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=93 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=93 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=93 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=53 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=53 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=133 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=133 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=72 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=72 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD width=7 rowSpan=5></TD>
    <TD vAlign=top width=447 rowSpan=5><FONT 
      class=titulo>Instruções (Texto de responsabilidade do cedente)</FONT><BR><br><FONT class=campo>
                <? echo $entra["instrucoes"]; ?><br> 
                <? echo $entra["instrucoes1"]; ?><br>
                <? echo $entra["instrucoes2"]; ?><br>
                <? echo $entra["instrucoes3"]; ?><br> 
                <? echo $entra["instrucoes4"]; ?><br>
          </FONT></TD>
    <TD align=right width=212>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=titulo vAlign=top width=7 height=13></TD>
          <TD class=titulo vAlign=top width=18 height=13>27</TD>
          <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=titulo vAlign=top width=180 height=13>(-) Desconto / 
            Abatimento</TD></TR>
        <TR>
          <TD class=campo vAlign=top width=7 height=12></TD>
          <TD class=campo vAlign=top width=18 height=12>&nbsp;</TD>
          <TD class=campo vAlign=top width=7 height=12><IMG height=12 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=campo vAlign=top align=right width=180 
        height=12>&nbsp;</TD></TR>
        <TR>
          <TD vAlign=top width=7 height=3></TD>
          <TD vAlign=top width=18 height=3></TD>
          <TD vAlign=top width=7 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" width=7 
            border=0></TD>
          <TD vAlign=top width=180 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" 
            width=180 border=0></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD align=right width=212>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=titulo vAlign=top width=7 height=13></TD>
          <TD class=titulo vAlign=top width=18 height=13>35</TD>
          <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=titulo vAlign=top width=180 height=13>(-) Outras 
          deduções</TD></TR>
        <TR>
          <TD class=campo vAlign=top width=7 height=12></TD>
          <TD class=campo vAlign=top width=18 height=12>&nbsp;</TD>
          <TD class=campo vAlign=top width=7 height=12><IMG height=12 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=campo vAlign=top align=right width=180 
        height=12>&nbsp;</TD></TR>
        <TR>
          <TD vAlign=top width=7 height=3></TD>
          <TD vAlign=top width=18 height=3></TD>
          <TD vAlign=top width=7 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" width=7 
            border=0></TD>
          <TD vAlign=top width=180 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" 
            width=180 border=0></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD align=right width=212>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=titulo vAlign=top width=7 height=13></TD>
          <TD class=titulo vAlign=top width=18 height=13>19</TD>
          <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=titulo vAlign=top width=180 height=13>(+) Mora / 
        Multa</TD></TR>
        <TR>
          <TD class=campo vAlign=top width=7 height=12></TD>
          <TD class=campo vAlign=top width=18 height=12>&nbsp;</TD>
          <TD class=campo vAlign=top width=7 height=12><IMG height=12 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=campo vAlign=top align=right width=180 
        height=12>&nbsp;</TD></TR>
        <TR>
          <TD vAlign=top width=7 height=3></TD>
          <TD vAlign=top width=18 height=3></TD>
          <TD vAlign=top width=7 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" width=7 
            border=0></TD>
          <TD vAlign=top width=180 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" 
            width=180 border=0></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD align=right width=212>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=titulo vAlign=top width=180 height=13>(+) Outros 
          acréscimos</TD></TR>
        <TR>
          <TD class=campo vAlign=top width=7 height=12><IMG height=12 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=campo vAlign=top align=right width=180 
        height=12>&nbsp;</TD></TR>
        <TR>
          <TD vAlign=top width=7 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" width=7 
            border=0></TD>
          <TD vAlign=top width=180 height=3><IMG height=1 
            src="imagens/imgpxlazu.gif" 
            width=180 border=0></TD></TR></TBODY></TABLE></TD></TR>
  <TR>
    <TD align=right width=212>
      <TABLE cellSpacing=0 cellPadding=0 border=0>
        <TBODY>
        <TR>
          <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=titulo vAlign=top width=180 bgColor=#ffffcc height=13>(=) 
            Valor cobrado</TD></TR>
        <TR>
          <TD class=campo vAlign=top width=7 height=12><IMG height=12 
            src="imagens/imgbrrlrj.gif" width=5 
            border=0></TD>
          <TD class=campo vAlign=top align=right width=180 bgColor=#ffffcc 
          height=12><?=$entra["valor"]?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
        </TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD vAlign=top width=666 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=666 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=659 height=13>Sacado</TD></TR>
  <TR>
    <TD class=campo vAlign=top width=7 height=25><IMG height=25 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=659 height=25><?=$entra["sacado"]?></TD>
  </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=659 
  height=13>Sacador/Avalista</TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=campo vAlign=top width=7 height=12><IMG height=12 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=campo vAlign=top width=472 height=13>&nbsp;</TD>
    <TD class=titulo vAlign=top width=7 height=13><IMG height=13 
      src="imagens/imgbrrlrj.gif" width=5 
      border=0></TD>
    <TD class=titulo vAlign=top width=180 height=13>Cód. baixa</TD></TR>
  <TR>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=472 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=472 
      border=0></TD>
    <TD vAlign=top width=7 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=7 
      border=0></TD>
    <TD vAlign=top width=180 height=3><IMG height=1 
      src="imagens/imgpxlazu.gif" width=180 
      border=0></TD></TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 border=0>
  <TBODY>
  <TR>
    <TD class=titulo vAlign=top width=7 height=13></TD>
    <TD class=titulo vAlign=top width=470 height=13></TD>
    <TD class=titulo vAlign=top width=7 height=13></TD>
    <TD class=titulo vAlign=top width=182 height=13>Autenticação mecânica - 
      Ficha de Compensação</TD></TR></TBODY></TABLE><BR>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD><? fbarcode($entra["codigo_barras"]); ?></TD></TR></TBODY></TABLE><BR>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD class=titulo width=666>Corte na linha pontilhada </TD>
  </TR></TBODY></TABLE>
<TABLE cellSpacing=0 cellPadding=0 width=666 border=0>
  <TBODY>
  <TR>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD>
    <TD width=5><IMG height=1 
      src="imagens/imgpxlazu.gif" width=6 
      border=0></TD>
    <TD width=5></TD></TR></TBODY></TABLE><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div align="center" class="texto"></div></td>
	<tr>
    <td><div align="center" class="texto"><img src="../imagens/logoSapiensP2.gif" alt="Sistemas Sapiens" width="20" height="15" border="0" />&nbsp;&nbsp;Sapiens Tecnologia - www.sapienstecnologia.com.br <br>
    </div></td>
  </tr>
  </tr>
</table>
</DIV>
</BODY></HTML>
<script language="javascript">
window.print();
</script>
<? } ?>