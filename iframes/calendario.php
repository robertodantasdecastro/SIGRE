<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
.corDiaHoje {
background-color: #B4B7E0;
}
.corDias {
background-color: #DEDEEB;
}
.linkDia {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: underline;
	background-color: #9EA3DA;
}
.linkDia:hover {

	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: underline;
	background-color: #7A8BB1;
}
.ano { 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 12px; 
font-style: normal; 
line-height: normal; 
font-weight: bold; 
color: #000000; 
text-decoration: none 
} 
.dia { 
font-family: Arial, Helvetica, sans-serif; 
font-size: 10px; font-style: normal; 
font-weight: normal; 
color: #000000; 
text-decoration: none 
} 

.setas { 
font-family: Verdana, Arial, Helvetica, sans-serif; 
font-size: 10px; 
font-style: normal; 
line-height: normal; 
color: #CCCCCC; 
text-decoration: none 
} 
.Destaque1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	font-weight: bold;
	color: #003300;
	text-decoration: none;
}
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
</head>

<body>
<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="1" cellpadding="0">
          
          <tr align="center">
            <td colspan="7" align="center" valign="middle" bgcolor="#ECEFF9" class="destaque1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?  include ('../../core/calendario.php'); ?>
                        <a href="calendario.php?month=<? echo $prevmonth; ?>&amp;year=<? echo $prevano; if (isset($_GET['dia'])){ echo "&dia=".$_GET['dia']; } if (isset($_GET['mes'])) { echo "&mes=".$_GET['mes']; } if (isset($_GET['ano'])) { echo "&ano=".$_GET['ano']; } ?>" class="linkDia">&nbsp;&lt;&lt;&nbsp;</a></td>
                <td width="75%"><div class="Destaque1" align="center">
                  <?  echo "$month_name de $year";?>
                </div></td>
                <td><span class=""> <a href="calendario.php?month=<? echo $nextmonth; ?>&amp;year=<? echo $nextano; ?><? if ($acesso == "3") { ?>&amp;id_muni=<? echo $id_muni; }?><? if (isset($_GET['oq']) && $_GET['oq'] == "edit") { echo "&oq=".$_GET['oq']; if (isset($_GET['dia'])){ echo "&dia=".$_GET['dia']; } if (isset($_GET['mes'])) { echo "&mes=".$_GET['mes']; } if (isset($_GET['ano'])) { echo "&ano=".$_GET['ano']; }} ?><? if (isset($_GET['oq']) && $_GET['oq'] == "novo") { echo "&oq=novo"; } ?>" class="linkDia">&nbsp;&gt;&gt;&nbsp;</a></span></td>
              </tr>
            </table></td>
          </tr>
          <tr class="dia" align="center">
            <? 
  for ($i=0;$i<7;$i++) { ?>
            <td align="center" bgcolor="#FFFFFF"><? echo "$day_name[$i]"; //dia da semana?></td>
            <? } ?>
          </tr>
          <tr class="dia" align="center">
            <? 
  if (date("w",mktime(0,0,0,$month,1,$year))==0) { 
    $start=7; 
  } else { 
    $start=date ("w",mktime(0,0,0,$month,1,$year)); 
    } 
  for($a=($start-2);$a>=0;$a--) 
     { 
      $d=date("t",mktime(0,0,0,$month,0,$year))-$a; 
  ?>
            <td bgcolor="#EEEEEE" align="center"><? // dias da semana do mes anterior ?>
                    <?=$d?>            </td>
            <? } 
  for($d=1;$d<=date("t",mktime(0,0,0,($month+1),0,$year));$d++) 
        { 
        global $linha; 
     if($month==date("m") && $year==date("Y") && $d==date("d")) { 
      $bg="class=\"corDiaHoje\""; 
    } else { 
      $bg="class=\"corDias\""; 
      } 
    for ($i=0;$i<$linha;$i++){ 
    global $month,$year,$d; 
	/*
    $dia_sql=mysql_result($result,$i,'dia'); 
    $mes_sql=mysql_result($result,$i,'mes'); 
    $ano_sql=mysql_result($result,$i,'ano'); 
	*/
	$dtaV = mysql_result($result,$i,'vencimento'); 
	$dtaE = mysql_result($result,$i,'emicao'); 

	$dia=$dtaE[8].$dtaE[9];
    $mes=$dtaE[5].$dtaE[6]; 
    $ano=$dtaE[0].$dtaE[1].$dtaE[2].$dtaE[3];
	/*
    $ano = ltrim(rtrim($ano_sql)); 
    $mes = ltrim(rtrim($mes_sql));
    $dia = ltrim(rtrim($dia_sql)); 
    */

	if($d==$dia&$year==$ano&$month==$mes) { 
	  $bg="class=\"linkDia\""; 
	  if (isset($id)){
	  $linkPag="calendario.php?id=$id&dia=$dia&mes=$mes&ano=$ano";
	  } else if ($acesso == "3") {
	  $linkPag="calendario.php?id_muni=$id_muni&dia=$dia&mes=$mes&ano=$ano&oq=edit";
	  } else {
	  $linkPag="calendario.php?dia=$dia&mes=$mes&ano=$ano&oq=edit";
	  }
      }} 
  ?>
            <? // dias do mes ?>
            <td width="175" align="center" <?php echo $bg; ?>><? if ($bg == "class=\"linkDia\"") { ?>
                    <a class="linkDia" href="<? echo $linkPag; ?>">
                    <? } ?>
                    <?php echo $d;?>
                    <? if ($bg == "class=\"linkDia\"") { ?>
                    </a>
                    <? } ?>            </td>
            <? 
  if(date("w",mktime(0,0,0,$month,$d,$year))==0&date("t",mktime(0,0,0,($month+1),0,$year))>$d) 
  { 
  ?>
          </tr>
          <tr class="dia" align="center">
            <?   }} 
  $da=$d+1; 
  if(date("w",mktime(0,0,0,$month+1,1,$year))<>1) 
         { 
          $d=1; 
          while(date("w",mktime(0,0,0,($month+1),$d,$year))<>1) 
                  { 
  ?>
            <td bgcolor="#EEEEEE" align="center"><? // dia do proximo mes ?>
                    <?=$d?>            </td>
            <? 
            $d++; 
                  } 
        } 
  ?>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
