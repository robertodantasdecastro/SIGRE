<?

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
function formatarNumero ($var) { 
	$var = str_replace(".","",$var);
	$var = ereg_replace("0","0",$var); 
	$var = ereg_replace("/","",$var); 
	$var = ereg_replace("-","",$var); 
	$var = ereg_replace("\.","",$var); 
	$var = ereg_replace(",","",$var); 
	return $var;

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


?>