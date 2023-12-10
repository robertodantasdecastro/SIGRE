<?php require_once('../Connections/Emolumentos.php'); 

include ('../core/crypt.php');
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

mysql_select_db($database_Emolumentos, $Emolumentos);
$query_rsUsuarios = "SELECT id, senha, ns FROM usuarios";
$rsUsuarios = mysql_query($query_rsUsuarios, $Emolumentos) or die(mysql_error());
$row_rsUsuarios = mysql_fetch_assoc($rsUsuarios);
$totalRows_rsUsuarios = mysql_num_rows($rsUsuarios);



if (isset($_GET['modo'])){

if ($_GET['modo'] == 1) {


do { 
if ($row_rsUsuarios['ns'] != "" ) { 
	$crpt_string = $row_rsUsuarios['ns'];
} else {
	$crpt_string = "4321";
}
	$p=cript($crpt_string);
	$SenhaUser = md5("$p");


$id = $row_rsUsuarios['id'];

$updateSQL = sprintf("UPDATE usuarios SET senha=%s WHERE id=%s",
                       GetSQLValueString($SenhaUser, "text"),
                       GetSQLValueString($id, "int"));

  mysql_select_db($database_Emolumentos, $Emolumentos);
  $Result1 = mysql_query($updateSQL, $Emolumentos) or die(mysql_error());




/*

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><? echo $crpt_string."  --->  ".$SenhaUser;?></td>
    </tr>
      </table>
	  */
?>
  <?php 
  echo "ok!";
  } while ($row_rsUsuarios = mysql_fetch_assoc($rsUsuarios)); 
  
  
  
  
  } else if ($_GET['modo'] == 2) {  
  
  
 
  
  
  ?>
  ediçao de diretorio modo 2
  
  
  <?


  
	if (!isset($_GET['arquivo'])) {

		$caminho = "../";
		$dir = opendir($caminho); 
		
		while ($i = readdir($dir)) {
			if(!preg_match('/^\./',$i)) {  //((strstr($i,'.txt') || strstr($i,'.TXT')) || (strstr($i,'.ret') || strstr($i,'.RET')))
				echo "<a href=\"decriptall.php?arquivo=".$i."\">".$i."</a><br>";
			}
		}
		closedir($dir); 
//
	}


  }
  
  
  
  }
  
  ?>