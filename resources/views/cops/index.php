<?php
session_start();
$loginUser_id = $_SESSION['SESS_USER_ID'];
require_once('../../config/auth_content.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home - Report.Portal</title>
<meta http-equiv="Content-Language" content="en-us" />
<meta name="author" content="Bank M (Tanzania) Limited" />
<style type="text/css" media="all"> 
@import "css/down.css";body {
	background-image: url(../../images/backgrounds/pagebg.png);
} 
</style>
<link rel="shortcut icon" href="favicon.ico" />
<style type="text/css">
.style1 {
	font-family: tahoma;
	font-size: 12px;
	color: #FFFFFF;
}
a:link {
	color: #FFFFFF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: none;
	color: #FF0000;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
.style2 {font-size: 11px}
.style5 {	color: #0E3793;
	font-weight: bold;
}
.style3 {	font-size: 11px;
	font-family: tahoma;
	color: #FFFFFF;
}
.style6 {font-size: 11px; color: #FFFFFF; }
.style7 {font-family: tahoma}
.style21 {	color: #ffffff;
	font-weight: bold;
}
.style11 {font-family: tahoma; font-size: 11px; color: #ffffff; }
.style19 {font-size: 11px; font-family: tahoma; color: #FFFFFF; font-weight: bold; }
.style23 {font-size: 11px; font-weight: bold; }
</style>

</head>
<SCRIPT LANGUAGE="JavaScript">
// Set slideShowSpeed (milliseconds)
var slideShowSpeed = 5500;
// Duration of crossfade (seconds)
var crossFadeDuration = 3;
// Specify the image files
var Pic = new Array();
// to add more images, just continue
// the pattern, adding to the array below

Pic[0] = 'images/banners/1yr-young.jpg'
Pic[1] = 'images/banners/Banner1.jpg'
Pic[2] = 'images/banners/Banner2.jpg'
Pic[3] = 'images/banners/Banner3.jpg'
Pic[4] = 'images/banners/Banner4.jpg'
Pic[5] = 'images/banners/Guarantee1.jpg'
Pic[6] = 'images/banners/Guarantee-2.jpg'
Pic[7] = 'images/banners/Money-chapchap-1hr.jpg'
Pic[8] = 'images/banners/Money-Moja-kwa-moja.jpg'
Pic[9] = 'images/banners/1yr-young.jpg'
Pic[10] = 'images/banners/Money-Msafiri-A-Africa.jpg'
Pic[11] = 'images/banners/Money-Msafiri-Euro.jpg'
Pic[12] = 'images/banners/Money-Msafiri-India.jpg'
Pic[13] = 'images/banners/Money-Order.jpg'

// do not edit anything below this line
var t;
var j = 0;
var p = Pic.length;
var preLoad = new Array();
for (i = 0; i < p; i++) {
preLoad[i] = new Image();
preLoad[i].src = Pic[i];
}
function runSlideShow() {
if (document.all) {
document.images.SlideShow.style.filter="blendTrans(duration=2)";
document.images.SlideShow.style.filter="blendTrans(duration=crossFadeDuration)";
document.images.SlideShow.filters.blendTrans.Apply();
}
document.images.SlideShow.src = preLoad[j].src;
if (document.all) {
document.images.SlideShow.filters.blendTrans.Play();
}
j = j + 1;
if (j > (p - 1)) j = 0;
t = setTimeout('runSlideShow()', slideShowSpeed);
}
//  End -->
</script>
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
          <td width="96%" height="19" nowrap bgcolor="#E1204F" ><span class="style5">&nbsp;<span class="style21"><span class="style3">COPS ISSUE TRACKING</span></span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="166" valign="top" nowrap><div align="center">
      <span class="style11"><strong><span class="style19">
      </span></strong></span>
	  
	       <?php
     $con = mysql_connect("localhost","root","");
     if (!$con) {die('Could not connect: ' . mysql_error());}
     mysql_select_db("bmpl_system") or die(mysql_error());
			  
			  
	 $query = mysql_query(" SELECT * FROM sys_user WHERE usr_id = '$loginUser_id' ");  
	 while($row = mysql_fetch_array($query))
     {
	 $deprtmnt = $row['usr_department'];
     }
	 
	 $queryl = mysql_query(" SELECT * FROM sys_user_right WHERE usr_id = '$loginUser_id' and rgt_name = 'COPSVIEW' ");  
	 while($row = mysql_fetch_array($queryl))
     {
	 $rgtname = $row['rgt_name'];
     }
	 
	 if ($rgtname != "COPSVIEW")
	 
	 {
 include_once 'unuthorized.php';	
	  exit;
	 }?>
	  
	  
	  
	  <br/>
      <table width="96%"  border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td width="61%" align="left" valign="middle" nowrap><div align="left"><span class="style1"></span> </div>
              <div align="left"></div>
              <table width="100%" height="120"  border="0" align="left" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="1%" align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
                  <td width="99%" align="left" valign="middle" nowrap><span class="style1"><span class="style23"><a href="reg_new.php" target="_self">RECORD ISSUE FOR TRACKING </a></span></span></td>
                </tr>
				<tr>
				  <td align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
				  <td width="99%" align="left" valign="middle" nowrap><span class="style1"><span class="style23"><a href="search.php" target="_self">MANAGE RECORDED ISSUE</a></span></span></td>
				</tr>
				<tr>
				  <td align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
				  <td width="99%" align="left" valign="middle" nowrap><span class="style1"><span class="style23"><a href="pendingsrmwise.php" target="_self">PENDINGS-RMWISE</a></span></span></td>
				</tr>
				<tr>
                  <td width="1%" align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
                  <td width="99%" align="left" valign="middle" nowrap><span class="style1"></span></td>
                </tr><tr>
                  <td width="1%" align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
                  <td width="99%" align="left" valign="middle" nowrap><span class="style1"></span></td>
                </tr>
                <tr>
                  <td align="left" valign="middle" nowrap class="style6 style7">&nbsp;</td>
                  <td align="left" valign="middle" nowrap><span class="style1"></span></td>
                </tr>
            </table></td>
        </tr>
        <tr>
          <td height="23" align="left" valign="middle" nowrap>&nbsp;</td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
</body>
</html>