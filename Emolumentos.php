<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Emolumentos = "localhost";
$database_Emolumentos = "sigre";
$username_Emolumentos = "sigr8642";
$password_Emolumentos = "sig9584";
$Emolumentos = mysql_pconnect($hostname_Emolumentos, $username_Emolumentos, $password_Emolumentos) or trigger_error(mysql_error(),E_USER_ERROR); 
?>