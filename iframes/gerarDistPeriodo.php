<?php
require_once('../../core/restritoPopUp.php');
if (isset($erros) && $erros == "off" || $erros == "erro") {
	//if ($acesso != 1) { $_SESSION['erro'] = "Pagina restrina!"; }
	header ('Location: ../sigre.php'); 
}else {

if ($mes < 10) { $mes = "0".$mes; }
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
function formatarNumero ($var) { 

	$var = ereg_replace("0","0",$var); 
	$var = ereg_replace("/","",$var); 
	$var = ereg_replace("-","",$var); 
	$var = ereg_replace("\.","",$var); 
	$var = ereg_replace(",","",$var); 
	return $var;

}

$dataInicio = substr($_GET['dataInicio'], 6, 4).substr($_GET['dataInicio'], 3, 2).substr($_GET['dataInicio'], 0, 2);


mysql_select_db($database_Emolumentos, $Emolumentos);

if (isset($_GET['dataFim']) && $_GET['dataFim'] != "") {

	$dataFim = substr($_GET['dataFim'], 6, 4).substr($_GET['dataFim'], 3, 2).substr($_GET['dataFim'], 0, 2); 
	
	$query_rsGuia = "SELECT entidades.id, guias.* , date_format(guias.`dataMovSDJ`, '%d%m%Y') as dataMovSDJ_F, date_format(guias.`emicao`, '%d%m%Y') as emicao_F 
	FROM entidades, guias 
	WHERE entidades.id_sdt = '$idsLog' 
	AND guias.id_entidade = entidades.id 
	AND (guias.situacaoSDJ = '4' OR guias.situacaoSDJ = '5')
	AND (guias.dataMovSDJ >= '$dataInicio' AND guias.dataMovSDJ <= '$dataFim')
	ORDER BY situacaoSDJ ASC";

} else {

	$query_rsGuia = "SELECT entidades.id, guias.* , date_format(guias.`dataMovSDJ`, '%d%m%Y') as dataMovSDJ_F, date_format(guias.`emicao`, '%d%m%Y') as emicao_F 
	FROM entidades, guias 
	WHERE entidades.id_sdt = '$idsLog' 
	AND guias.id_entidade = entidades.id 
	AND (guias.situacaoSDJ = '4' OR guias.situacaoSDJ = '5')
	AND (guias.dataMovSDJ >= '$dataInicio' AND guias.dataMovSDJ <= '$dataInicio')
	ORDER BY situacaoSDJ ASC";
	
	$dataFim = "";
}
$rsGuia = mysql_query($query_rsGuia, $Emolumentos) or die(mysql_error());
$row_rsGuia = mysql_fetch_assoc($rsGuia);
$totalRows_rsGuia = mysql_num_rows($rsGuia);

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsFarpenDist = "SELECT * FROM `farpen` WHERE id = '5'";
$rsFarpenDist = mysql_query($query_rsFarpenDist, $Emolumentos) or die(mysql_error());
$row_rsFarpenDist = mysql_fetch_assoc($rsFarpenDist);
$totalRows_rsFarpenDist = mysql_num_rows($rsFarpenDist);


$valorFARPEN = fc ($row_rsFarpenDist['valor']);
$valorFARPEN = $valorFARPEN * (95 / 100);
$valorFARPEN = number_format($valorFARPEN, 2, ".", ".");
$valorFARPEN = formatarNumero ($valorFARPEN);

$arquivo2 = "../../dados/distribuidor/".$id_usuario."_".substr($dataInicio, 6, 2).substr($dataInicio, 4, 2).substr($dataInicio, 0, 4)."_".substr($dataFim, 6, 2).substr($dataFim, 4, 2).substr($dataFim, 0, 4).".txt";
$_SESSION['nomeArqDownload'] = $id_usuario."_".substr($dataInicio, 6, 2).substr($dataInicio, 4, 2).substr($dataInicio, 0, 4)."_".substr($dataFim, 6, 2).substr($dataFim, 4, 2).substr($dataFim, 0, 4).".txt";
if (file_exists($arquivo2)){
		unlink ($arquivo2);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Arquivo de retorno</title>
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
<table width="710" border="0" cellspacing="0" cellpadding="0">
  <? if ($totalRows_rsGuia > 1){
  
  
  
  do {   
  




$valorGuia = fc ($row_rsGuia['valorSDT']);
$valorFEPJ = ($valorGuia - $valorFARPEN) * (3/100);
$valorRecebido = fc ($row_rsGuia['vfiscal']);
$valorFEPJ = number_format($valorFEPJ, 2, ".", ".");

$valorGuia = formatarNumero ($valorGuia);
$valorFEPJ = formatarNumero ($valorFEPJ);
$valorRecebido = formatarNumero ($valorRecebido);
  ?><tr>
    <td class="texto"><? unset ($valorLinha);
	// Gerar o numero da guia
	if ($row_rsGuia['id_entidade'] < 10){ $id_entidade = "00".$row_rsGuia['id_entidade']; } else if ($row_rsGuia['id_entidade'] < 100) { $id_entidade = "0".$row_rsGuia['id_entidade']; } else if ($row_rsGuia['id_entidade'] < 1000) { $id_entidade = $row_rsGuia['id_entidade']; }
	if ($row_rsGuia['numero'] < 10){ $numeros = "0000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 100) { $numeros = "000".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 1000) { $numeros = "00".$row_rsGuia['numero']; } else if ($row_rsGuia['numero'] < 10000) { $numeros = "0".$row_rsGuia['numero']; } 
	$anos = substr($row_rsGuia['ano'], 2, 2);
	$convenio = $row_rsEntidadeLogin['convenio'];
	// fim do nmero da guia
	
	// gerar outorgantes e outorgados
	$id_guia = $row_rsGuia['id'];
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsOutorgante = "SELECT partesguias.id_parte, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '0' AND partes.id = partesguias.id_parte";
	$rsOutorgante = mysql_query($query_rsOutorgante, $Emolumentos) or die(mysql_error());
	$row_rsOutorgante = mysql_fetch_assoc($rsOutorgante);
	$totalRows_rsOutorgante = mysql_num_rows($rsOutorgante);

	$documentoOutorgante = $row_rsOutorgante['cpf'].$row_rsOutorgante['cnpj'];		
	$id_outorgante_prin = $row_rsOutorgante['id_parte'];
	$documentoOutorgante = formatarNumero ($documentoOutorgante); 
	
	if (strlen($documentoOutorgante) > 11) { 
		$tipoOutorgante = "2";
	} else {
		$tipoOutorgante = "1";
	}
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$query_rsOutorgado = "SELECT partesguias.id_parte, partes.nome, partes.cpf, partes.cnpj FROM partesguias, partes WHERE partesguias.id_guia = '$id_guia' AND partesguias.tipo = '1' AND partes.id = partesguias.id_parte";
	$rsOutorgado = mysql_query($query_rsOutorgado, $Emolumentos) or die(mysql_error());
	$row_rsOutorgado = mysql_fetch_assoc($rsOutorgado);
	$totalRows_rsOutorgado = mysql_num_rows($rsOutorgado);
	
	$documentoOutorgado = $row_rsOutorgado['cpf'].$row_rsOutorgado['cnpj'];
	$id_outorgado_prin = $row_rsOutorgado['id_parte'];
	$documentoOutorgado = formatarNumero ($documentoOutorgado); 

	if (strlen($documentoOutorgado) > 11) { 
		$tipoOutorgado = "2";
	} else {
		$tipoOutorgado = "1";
	}



	// fim outorgantes outorgados

	
	// formatacao do numero
	$valorLinha['tipoRegistro'] = 0;   // -----> tipo de registro -- 1 
	$valorLinha['numeroDocumento'] = $id_entidade.$anos.$numeros; // -----> numero do documento -- 10 
	if (isset($row_rsGuia['ndescricao']) && $row_rsGuia['ndescricao'] != "") { $valorLinha['natureza'] = formatarExportacao2 ($row_rsGuia['ndescricao'], "up", "40", " "); } else { $valorLinha['natureza'] = formatarExportacao2 ($row_rsGuia['id_natuEsc'], "up", "40", " "); }// natureza de escritura -- 40
	$valorLinha['Tipo'] = formatarExportacao2 ($row_rsGuia['TipoImovel'], "up", "30", " "); // tipo imovel -- 30
	$valorLinha['tipoOutorgante'] = $tipoOutorgante; // -----> tipo outorgante -- 1
	$valorLinha['documentoOutorgante'] = formatarExportacao ($documentoOutorgante, "up", "14", "0"); // -------> documento do outorgante -- 14
	$valorLinha['nomeOutorgante'] = formatarExportacao2 ($row_rsOutorgante['nome'], "up", "45", " "); // -------> noem do outorgante -- 45
	$valorLinha['tipoOutorgado'] = $tipoOutorgado; // ------> tipo outorgado -- 1
	$valorLinha['documentoOutorgado'] = formatarExportacao ($documentoOutorgado, "up", "14", "0"); // --------> documento outorgado -- 14
	$valorLinha['nomeOutorgado'] = formatarExportacao2 ($row_rsOutorgado['nome'], "up", "45", " "); //---------> nome do outorgado -- 45
	$valorLinha['emissao'] = $row_rsGuia['emicao_F']; // ------> data da emucai -- 8
	$valorLinha['compencacao'] = $row_rsGuia['dataMovSDJ_F']; // ------> data pagmto -- 8
	$valorLinha['tranzacao'] = formatarExportacao ($valorRecebido, "up", "11", "0"); // ------> valor da guia -- 11       -----<<<<<<<<<<<<<--------------<<<<<<<<<<< modificar esse valor
	$valorLinha['valorFEPJ'] = formatarExportacao ($valorFEPJ, "up", "8", "0"); // -----> valor do FEPJ -- 8
	$valorLinha['valorRecebido'] = formatarExportacao ($valorGuia, "up", "11", "0"); // ------> valor do recebido -- 11
	$valorLinha['valorFARPEN'] = formatarExportacao ($valorFARPEN, "up", "8", "0"); // -------> valor do farpen -- 8
	$valorLinha['entidadeArquivo'] =  formatarExportacao ($row_rsEntidadeLogin['id'], "up", "3", "0");
	
	//Gera a linha
	$linha = $valorLinha['tipoRegistro'].$valorLinha['numeroDocumento'].$valorLinha['natureza'].$valorLinha['Tipo'].$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['tipoOutorgado'].$valorLinha['documentoOutorgado'].$valorLinha['nomeOutorgado'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['tranzacao'].$valorLinha['valorRecebido'].$valorLinha['valorFEPJ'].$valorLinha['valorFARPEN'];
	echo $valorLinha['tipoRegistro'].$valorLinha['numeroDocumento'].$valorLinha['Tipo'].$valorLinha['natureza'].$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['tipoOutorgado'].$valorLinha['documentoOutorgado'].$valorLinha['nomeOutorgado'].$valorLinha['emissao'].$valorLinha['compencacao'].$valorLinha['tranzacao'].$valorLinha['valorRecebido'].$valorLinha['valorFEPJ'].$valorLinha['valorFARPEN']."<br>";
	
	$updateSQL = sprintf("UPDATE guias SET situacaoSDJ=%s WHERE id=%s",
					   GetSQLValueString("5", "int"),
					   GetSQLValueString($id_guia, "int"));
					
					mysql_select_db($database_Emolumentos, $Emolumentos);
					$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
	//gera o arquivo
	$fp2 = fopen($arquivo2, "a"); 
	fwrite($fp2, $linha."\r\n"); 
	fclose($fp2); 	
if (isset($row_rsOutorgante['id_parte'])) { $id_outorgante = $row_rsOutorgante['id_parte']; } else { $id_outorgante = 0; }
if (isset($row_rsOutorgado['id_parte'])) { $id_outorgado = $row_rsOutorgado['id_parte']; } else { $id_outorgado = 0; }

	if ($totalRows_rsOutorgante > 1) {
		$p = 1;
		 do { 
			 if ($p == 1) { 
				if ($id_outorgante_prin == $row_rsOutorgante['id_parte']) { $p = $p + 1; } else { $p = 1; }
				$documentoOutorgante = $row_rsOutorgante['cpf'].$row_rsOutorgante['cnpj'];		
				$documentoOutorgante = formatarNumero ($documentoOutorgante); 
				
				if (strlen($documentoOutorgante) > 11) { 
					$tipoOutorgante = "2";
				} else {
					$tipoOutorgante = "1";
				}
			
				$valorLinha['tipoOutorgante'] = $tipoOutorgante; // -----> tipo outorgante -- 1
				$valorLinha['documentoOutorgante'] = formatarExportacao ($documentoOutorgante, "up", "14", "0"); // -------> documento do outorgante -- 14
				$valorLinha['nomeOutorgante'] = formatarExportacao2 ($row_rsOutorgante['nome'], "up", "45", " "); // -------> noem do outorgante -- 45
				$valorLinha['complemento'] = formatarExportacao2 (" ", "up", "194", " "); // espaco em branco -- 194
				
				
				$linha = "1".$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['complemento'];
				echo "1".$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['complemento']."<br>";
		
				$fp2 = fopen($arquivo2, "a"); 
				fwrite($fp2, $linha."\r\n"); 
				fclose($fp2); 
			} else { 
				$p = 1;
			}
		 } while ($row_rsOutorgante = mysql_fetch_assoc($rsOutorgante)); 
	}
	if ($totalRows_rsOutorgado > 1) {
		$r = 1;
		 do { 
			 if ($r == 1) {
			 
			 	if ($id_outorgado_prin == $row_rsOutorgado['id_parte']) { $r = $r + 1 ; } else { $r = 1; }
				$documentoOutorgante = $row_rsOutorgado['cpf'].$row_rsOutorgado['cnpj'];		
				$documentoOutorgante = formatarNumero ($documentoOutorgante); 
				
				if (strlen($documentoOutorgante) > 11) { 
					$tipoOutorgante = "2";
				} else {
					$tipoOutorgante = "1";
				}
			
				$valorLinha['tipoOutorgante'] = $tipoOutorgante; // -----> tipo outorgante -- 1
				$valorLinha['documentoOutorgante'] = formatarExportacao ($documentoOutorgante, "up", "14", "0"); // -------> documento do outorgante -- 14
				$valorLinha['nomeOutorgante'] = formatarExportacao2 ($row_rsOutorgado['nome'], "up", "45", " "); // -------> noem do outorgante -- 45
				$valorLinha['complemento'] = formatarExportacao2 (" ", "up", "194", " ");
				
				
				$linha = "2".$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['complemento'];
				echo "2".$valorLinha['tipoOutorgante'].$valorLinha['documentoOutorgante'].$valorLinha['nomeOutorgante'].$valorLinha['complemento']."<br>";
				
				$fp2 = fopen($arquivo2, "a"); 
				fwrite($fp2, $linha."\r\n"); 
				fclose($fp2); 
			} else {
				$r = 1;
			}
		 } while ($row_rsOutorgado = mysql_fetch_assoc($rsOutorgado)); 
	} ?></td>
  </tr><? } while ($row_rsGuia = mysql_fetch_assoc($rsGuia)); 
  if (isset($_SESSION['nomeArqDownload'])) { ?><iframe frameborder="0" height="1" id="salvar" scrolling="no" width="1" src="salvarArquivo.php?arquivo=<? echo $_SESSION['nomeArqDownload']; ?>&onde=distribuidor"></iframe><? }

unset ($_SESSION['di']);
unset ($_SESSION['df']);

} else {?>
  <tr>
  	<td height="200" align="center" class="Erro1">N&atilde;o existem arquivos a serem gerados. </td>
  </tr><? } ?>
</table>
</body>
</html>
<? } ?>