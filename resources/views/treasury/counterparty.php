<?php
session_start();
$loginUser_id = $_SESSION['SESS_USER_ID'];
require_once('../../config/auth_content.php');

$user_id       = $_SESSION['SESS_USER_ID'];
$log_ipaddress = $_SERVER['REMOTE_ADDR']; 
$log_compuser  = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$log_datetime  = date("d/m/y : H:i:s", time());
$log_activity  = "ForexDealInputPageOpened";
$log_comment   = "PageOpened";
mysql_connect("localhost","root",""); 
mysql_select_db("bmpl_system") or die("Unable to select database");
@mysql_query("INSERT INTO sys_log(user_id, log_datetime, log_activity, log_comment, log_ipaddress, log_compuser)
VALUES('$user_id','$log_datetime','$log_activity','$log_comment','$log_ipaddress', '$log_compuser')");	

?>	
<?php
//connectiong to the databas

if(isset($_POST['save']))
{
	if(empty($_POST['cparty']))
	{
		$sms="Please enter Counterparty";
	}
	else
	{
		$cp=strtoupper($_POST['cparty']);
		
	}
	if(empty($_POST['rm']))
	{
		$mrm="Please enter RM code";
	}
	else
	{
		$rm=$_POST['rm'];
	}
	if($sms||$mrm)
	{
		include'counterparty.php';
	}
	if($cp&&$rm)
	{
		include'connect.php';
		$sql=mysql_query("insert into fd_customer(customer,rm_code)values ('".$cp."','".$rm."')");
		if($sql)
		{
			$sms="Successfully saved";
		
		}
		else
		{
			$sms="Failured";
		}
			
	}
}
	
?>

<style type="text/css">
<!--
.style24 {color: #0E3793}
.style24 {color: #0E3793}
.style25 {color: #0E3793}
.style25 {color: #0E3793}
.style26 {color: #0E3793}
.style26 {color: #0E3793}
a:link {
	text-decoration: none;
	color: #005DAE;
}
a:visited {
	text-decoration: none;
	color: #005DAE;
}
a:hover {
	text-decoration: none;
	color: #FE0003;
}
a:active {
	text-decoration: none;
	color: #005DAE;
}
.style32 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style32 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style33 {color: #0E3793}
.style33 {color: #0E3793}
.style34 {font-size: 18px;
	font-weight: bold;
}
.style34 {font-size: 18px;
	font-weight: bold;
}
.style35 {font-size: 14px}
.style35 {font-size: 14px}
.style27 {color: #0E3793}
.style27 {color: #0E3793}
.style28 {color: #0E3793}
.style28 {color: #0E3793}
.style36 {color: #0E3793}
.style36 {color: #0E3793}
.style37 {font-size: 11px}
.style37 {font-size: 11px}
.style38 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style38 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style39 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style39 {font-family: tahoma; font-size: 11px; color: #0E3793; }
body {
	background-image: url(images/pagebg.png);
}
.style2 {	color: #0E3793;
	font-weight: bold;
}
.style3 {	font-size: 11px;
	font-family: tahoma;
	color: #FFFFFF;
}
.style40 {
	color: #FFFFFF;
	font-size: 12px;
}
.style43 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style43 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style45 {	color: #FFFFFF;
	font-size: 11px;
}
.style49 {font-size: 11px; font-family: tahoma; color: #FFFFFF; font-weight: bold; }
-->
</style>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td></td>
  </tr>
</table>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #7F9DB9; border-left: 1px solid #7F9DB9; border-right: 1px solid #7F9DB9; border-top: 1px solid #7F9DB9; ">
  <tr>
    <td width="95%" height="20" nowrap ><table width="100%" height="20"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #7F9DB9;">
        <tr >
          <td width="96%" height="19" nowrap bgcolor="#E1204F"><span class="style2">&nbsp;<span class="style3">NEW COUNTER PARTY</span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" nowrap><div align="center">
      <table width="975"  border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr>
          <td width="95%" valign="top" nowrap><form action="" method="post">
            <table width="93%"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32"  >
                <tr class="style37">
                  <td width="28%" height="20" align="right" nowrap style="border-bottom: 1px solid #7F9DB9;"><div align="center" class="style34 style40">
                  </div></td>
                </tr>
                <tr class="style37">
                  <td align="right" nowrap ><table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                      <tr class="style3">
                        <td width="15%" align="right" nowrap >&nbsp;</td>
                        <td width="9%" align="left" nowrap ><div align="left">Counter Party:</div></td>
                        <td width="76%" align="left" nowrap ><input name="cparty" type="text" class="style39" id="cparty" style="border-bottom: 1px solid #7F9DB9; text-transform:uppercase;" size="74"></td>
                      </tr>
                      <tr class="style3">
                        <td width="15%" align="right" nowrap >&nbsp;</td>
                        <td width="9%" align="left" nowrap ><div align="left">RM code:</div></td>
                        <td width="76%" align="left" nowrap ><input name="rm" type="text" class="style39" id="rm" style="border-bottom: 1px solid #7F9DB9; text-transform:uppercase;" size="74"></td>
                      </tr>
                    </table>
                    <table width="100%" height="31"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" style="border-bottom: 1px solid #7F9DB9;">
                      <tr class="style35">
                        <td width="21%" height="31" align="left" nowrap >&nbsp;</td>
                        <td width="79%" align="left" nowrap ><?php echo $sms.$mrm;?></td>
                      </tr>
                    </table>                    
                    <table width="100%" height="31"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                      <tr class="style35">
                        <td width="21%" height="31" align="left" nowrap ><div align="right" class="style45"></div></td>
                        <td width="79%" align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style35">
                                <td width="2%" height="35" align="left" nowrap class="style49" >
              <input name="save" type="submit" class="style38" value="Save" >
            </a></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                    </table>
                    </td>
                </tr>
              </table>
              </form></td>
        </tr>
      </table>
        </div></td>
  </tr>
</table>
<p></br>
</p>
