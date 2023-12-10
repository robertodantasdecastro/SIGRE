<?

$arq = $_GET['arquivo'];


$query_rsArquivoChkFEPJ = "SELECT guias.arquivoNomeFEPJ_SNR FROM guias WHERE guias.arquivoNomeFEPJ_SNR = '$arq'";
$rsArquivoChkFEPJ = mysql_query($query_rsArquivoChkFEPJ, $Emolumentos) or die(mysql_error());
$row_rsArquivoChkFEPJ = mysql_fetch_assoc($rsArquivoChkFEPJ);
$totalRows_rsArquivoChkFEPJ = mysql_num_rows($rsArquivoChkFEPJ);

if ($row_rsArquivoChkFEPJ > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_Emolumento = 2 WHERE arquivoNomeFEPJ_SNR = %s AND situacao_FEPJ_Emolumento >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}


$query_rsArquivoChkFEPJ_SDJ = "SELECT guias.arquivoNomeFEPJ_SDJ FROM guias WHERE guias.arquivoNomeFEPJ_SDJ = '$arq'";
$rsArquivoChkFEPJ_SDJ = mysql_query($query_rsArquivoChkFEPJ_SDJ, $Emolumentos) or die(mysql_error());
$row_rsArquivoChkFEPJ_SDJ = mysql_fetch_assoc($rsArquivoChkFEPJ_SDJ);
$totalRows_rsArquivoChkFEPJ_SDJ = mysql_num_rows($rsArquivoChkFEPJ_SDJ);

if ($row_rsArquivoChkFEPJ_SDJ > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacao_FEPJ_SDJ = 2 WHERE arquivoNomeFEPJ_SDJ = %s AND situacao_FEPJ_SDJ >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}


$query_rsArquivoChkSNR_emo = "SELECT guias.nomeArquivo FROM guias WHERE guias.nomeArquivo = '$arq'";
$rsArquivoChkSNR_emo = mysql_query($query_rsArquivoChkSNR_emo, $Emolumentos) or die(mysql_error());
$row_rsArquivoChkSNR_emo = mysql_fetch_assoc($rsArquivoChkSNR_emo);
$totalRows_rsArquivoChkSNR_emo = mysql_num_rows($rsArquivoChkSNR_emo);

if ($row_rsArquivoChkSNR_emo > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacaoEmolumento = 2 WHERE nomeArquivo = %s AND situacaoEmolumento >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}

$query_rsArquivoChkFARPEN_snr = "SELECT guias.nomeArquivoFarpenSNR FROM guias WHERE guias.nomeArquivoFarpenSNR = '$arq'";
$rsArquivoChkFARPEN_snr = mysql_query($query_rsArquivoChkFARPEN_snr, $Emolumentos) or die(mysql_error());
$row_rsArquivoChkFARPEN_snr = mysql_fetch_assoc($rsArquivoChkFARPEN_snr);
$totalRows_rsArquivoChkFARPEN_snr = mysql_num_rows($rsArquivoChkFARPEN_snr);

if ($row_rsArquivoChkFARPEN_snr > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacaoFarpen = 2 WHERE nomeArquivoFarpenSNR = %s AND situacaoFarpen >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}

$query_rsArquivoChkFARPEN_sdj = "SELECT guias.nomeArquivoFarpenSDJ FROM guias WHERE guias.nomeArquivoFarpenSDJ = '$arq'";
$rsArquivoChkFARPEN_sdj = mysql_query($query_rsArquivoChkFARPEN_sdj, $Emolumentos) or die(mysql_error());
$row_rsArquivoChkFARPEN_sdj = mysql_fetch_assoc($rsArquivoChkFARPEN_sdj);
$totalRows_rsArquivoChkFARPEN_sdj = mysql_num_rows($rsArquivoChkFARPEN_sdj);

if ($row_rsArquivoChkFARPEN_sdj > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacaoFARPEN_SDJ = 2 WHERE nomeArquivoFarpenSDJ = %s AND situacaoFARPEN_SDJ >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}

$query_rsArquivoChk_sdj = "SELECT guias.nomeArquivoSDJ FROM guias WHERE guias.nomeArquivoSDJ = '$arq'";
$rsArquivoChk_sdj = mysql_query($query_rsArquivoChk_sdj, $Emolumentos) or die(mysql_error());
$row_rsArquivoChk_sdj = mysql_fetch_assoc($rsArquivoChk_sdj);
$totalRows_rsArquivoChk_sdj = mysql_num_rows($rsArquivoChk_sdj);

if ($row_rsArquivoChk_sdj > 0) {
	
	$updateSQL = sprintf("UPDATE guias SET situacaoSDJ = 2 WHERE nomeArquivoSDJ = %s AND situacaoSDJ >= 4",          
	   GetSQLValueString($arq, "text"));
	
	mysql_select_db($database_Emolumentos, $Emolumentos);
	$Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());
	
}




?>