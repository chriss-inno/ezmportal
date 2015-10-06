<?php
session_start();
$loginUser_id = $_SESSION['SESS_USER_ID'];
require_once('../../config/auth_content.php');



$user_id       = $_SESSION['SESS_USER_ID'];
$log_ipaddress = $_SERVER['REMOTE_ADDR']; 
$log_compuser  = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$log_datetime  = date("d/m/y : H:i:s", time());
$log_activity  = "ForexDealHomePageRedirectOpened";
$log_comment   = "PageOpened";
mysql_connect("localhost","root",""); 
mysql_select_db("bmpl_system") or die("Unable to select database");
@mysql_query("INSERT INTO sys_log(user_id, log_datetime, log_activity, log_comment, log_ipaddress, log_compuser)
VALUES('$user_id','$log_datetime','$log_activity','$log_comment','$log_ipaddress', '$log_compuser')");	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Report Calender -2011</title>
<style type="text/css">
<!--
.style2 {
	color: #0E3793;
	font-weight: bold;
}
.style3 {
	font-size: 11px;
	font-family: tahoma;
	color: #FFFFFF;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	color: #FFFFFF;
	text-decoration: none;
}
a:hover {
	color: #FF0000;
	text-decoration: none;
}
a:active {
	color: #FFFFFF;
	text-decoration: none;
}
body {
	background-image: url(../images/backgrounds/pagebg.png);
}
.style32 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style32 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style37 {font-size: 11px}
.style37 {font-size: 11px}
.style6 {font-size: 11px; font-family: tahoma; color: #FFFFFF; font-weight: bold; }
.style38 {color: #FFFFFF}
.style1 {	font-family: tahoma;
	font-size: 12px;
	color: #FFFFFF;
}
.style23 {font-size: 11px; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #7F9DB9; border-left: 1px solid #7F9DB9; border-right: 1px solid #7F9DB9; border-top: 1px solid #7F9DB9; ">
  <tr>
    <td width="95%" height="20" nowrap ><table width="100%" height="20"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #7F9DB9;">
        <tr >
          <td width="96%" height="19" nowrap bgcolor="#E1204F" ><span class="style2">&nbsp;<span class="style3">FOREX DEAL SLIP </span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="121" valign="top" nowrap><div align="center">
      <span class="style6"><?php
     $con = mysql_connect("localhost","root","");
     if (!$con) {die('Could not connect: ' . mysql_error());}
     mysql_select_db("bmpl_system") or die(mysql_error());
			  
			  
	 $query = mysql_query(" SELECT * FROM sys_user WHERE usr_id = '$loginUser_id' ");  
	 while($row = mysql_fetch_array($query))
     {
	 $deprtmnt = $row['usr_department'];
     }
	 
	 $queryl = mysql_query(" SELECT * FROM sys_user_right WHERE usr_id = '$loginUser_id' and rgt_name = 'FOREXDEALINPUT' ");  
	 while($row = mysql_fetch_array($queryl))
     {
	 $rgtname = $row['rgt_name'];
     }
	 
	 if ($rgtname != "FOREXDEALINPUT")
	 
	 {
 include_once 'unuthorized.php';
	  exit;
	 }
	 
	 ?>
    </span><br/>
            <table width="96%" height="83"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
              <tr class="style37">
                <td width="28%" height="20" align="right" nowrap bgcolor="#E1204F" ><div align="center" class="style3">
                    <div align="left">Forex deal slip</div>
                </div></td>
              </tr>
              <tr class="style37">
                <td height="63" align="right" nowrap ><div align="left" class="style38">&nbsp;&nbsp;<span class="style1"><span class="style23"><a href="index.php" target="_self">FOREX DEAL DATABASE </a></span></span></div></td>
              </tr>
              <tr class="style37">
                <td height="10" align="right" nowrap ><div align="left" class="style38">&nbsp;&nbsp;<span class="style1"><span class="style23"><a href="counterparty.php" target="_self">NEW COUNTER PARTY </a></span></span></div></td>
              </tr>
            </table>
            <br/>
    </div></td>
  </tr>
</table>


</body>
</html>
