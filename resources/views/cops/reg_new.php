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
.style21 {	color: #ffffff;
	font-weight: bold;
}
.style11 {font-family: tahoma; font-size: 11px; color: #ffffff; }
.style13 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style22 {font-size: 11px; font-family: tahoma; color: #FFFFFF; font-weight: bold; }
.style16 {font-family: tahoma; font-size: 11px; color: #0E3793; font-weight: bold; }
.style24 {font-size: 11px; font-family: tahoma;}
.style25 {color: #FFFFFF}
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
          <td width="96%" height="19" nowrap bgcolor="#E1204F" ><span class="style5">&nbsp;<span class="style21"><span class="style3">COPS ISSUE TRACKING - INPUT</span></span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="423" valign="top" nowrap><div align="center">
      <form action="" method="post" name="" id="">
        <table width="96%"  border="0" align="center" cellpadding="2" cellspacing="0">
          <tr>
            <td width="61%" align="left" valign="middle" nowrap><div align="left">
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="center"><span class="style22">                    <?php
     $con = mysql_connect("localhost","root","");
     if (!$con) {die('Could not connect: ' . mysql_error());}
     mysql_select_db("bmpl_system") or die(mysql_error());
			  
			  
	 $query = mysql_query(" SELECT * FROM sys_user WHERE usr_id = '$loginUser_id' ");  
	 while($row = mysql_fetch_array($query))
     {
	 $deprtmnt = $row['usr_department'];
     }
	 
	 $queryl = mysql_query(" SELECT * FROM sys_user_right WHERE usr_id = '$loginUser_id' and rgt_name = 'COPSINPUT' ");  
	 while($row = mysql_fetch_array($queryl))
     {
	 $rgtname = $row['rgt_name'];
     }
	 
	 if ($rgtname != "COPSINPUT")
	 
	 {
 include_once 'unuthorized.php';	
	  exit;
	 }?>
                  </span></div></td>
                </tr>
              </table>
              </div>
            </td>
          </tr>
          <tr>
            <td height="23" align="left" valign="middle" nowrap><table width="80%" height="530"  border="0" align="center" cellpadding="0" cellspacing="0" class="style11" >
              <tr class="style2">
                <td height="14" nowrap style="border-bottom: 1px solid #7F9DB9;">&nbsp;</td>
                <td nowrap style="border-bottom: 1px solid #7F9DB9;"><span class="style21"><span class="style24">COP'S ISSUE INPUT </span></span></td>
                <td nowrap style="border-bottom: 1px solid #7F9DB9;">&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="13" align="right" nowrap >&nbsp;</td>
                <td nowrap ><div align="center"><span class="style16">
                    <?php    
  
        mysql_connect("localhost", "root", "") or die(mysql_error());
        mysql_select_db("bmpl_system") or die(mysql_error());
        $result = mysql_query("SELECT * FROM sys_user WHERE usr_id = '$loginUser_id' ") or die(mysql_error());  
        while($row = mysql_fetch_array( $result )) 
        {  
        $fullname       = $row['usr_full_name'];
        $userdepartment = $row['usr_department'];
        $userbranch     = $row['usr_branch'];
        } 
        ?>
                    <span class="style25"><?php
if (isset($_POST['reg_issue'])) 
{


$user  = $_POST['user1M'];
$con = mysql_connect("localhost","root","");
if (!$con) {die('Could not connect: ' . mysql_error());}
mysql_select_db("bmpl_system") or die(mysql_error());
	 

$query = mysql_query(" SELECT * FROM sys_user WHERE usr_id = '$user' ");  
while($row = mysql_fetch_array($query))
{
$usr_full_name    =$row['usr_full_name'];
$usr_email        =$row['usr_email'];
}


      $con = mysql_connect("localhost","root","");
     if (!$con) {die('Could not connect: ' . mysql_error());}
     mysql_select_db("bmpl_cops") or die(mysql_error());

$inputer         = $_POST['inputer'];
$idate           = $_POST['idate'];
$refnumber       = $_POST['refnumber'];
$itime           = $_POST['itime'];
$cpstatus        = $_POST['cpstatus'];
$cpcusname       = $_POST['cpcusname'];
$cpacnumber      = $_POST['cpacnumber'];
$cpissuetyp      = $_POST['cpissuetyp'];
$cpdescription   = $_POST['cpdescription'];
$cppendstatus    = $_POST['cppendstatus'];
$cpactvtd        = $_POST['cpactvtd'];
$cprmcode        = $_POST['cprmcode'];
$cpaprvdby       = $_POST['cpaprvdby'];
$cpdtrcvd        = $_POST['cpdtrcvd'];
$cpdtprmsd       = $_POST['cpdtprmsd'];
$cprgref         = $_POST['cprgref'];
$cphbl           = $_POST['cphbl'];



if ($cpcusname === "")
{
echo "CUSTOMER NAME MISSING!"; 
echo "</br>"; 
exit; }


if ($cpissuetyp === "ISSUE TYPE")
{
echo "TYPE OF THE ISSUE NOT SELECTED!"; 
echo "</br>"; 
exit; }


if ($cppendstatus === "SELECT PENDING ITEM(S) STATUS")
{
echo "PENDING ITEM STATUS NOT SELECTED!"; 
echo "</br>"; 
exit; }


if ($cprmcode === "SELECT RM CODE!")
{
echo "RM CODE NOT SELECTED"; 
echo "</br>"; 
exit; }


if ($cpaprvdby === "SELECT APPROVER")
{
echo "APPROVER NAME NOT SELECTED!"; 
echo "</br>"; 
exit; }


if ($cphbl === "SELECT HBL")
{
echo "HBL NOT SELECTED!"; 
echo "</br>"; 
exit; }


if ($cpdescription === "NA")
{
echo "PENDING ITEM NOT ENTERED!"; 
echo "</br>"; 
exit; }


if ($cpdescription === "")
{
echo "PENDING ITEM NOT ENTERED!"; 
echo "</br>"; 
exit; }



@mysql_query("INSERT INTO cps_issues
(
cit_inputer,
cit_input_date,
cit_input_time,
cit_reference_no,
cit_status,
cit_custmrnname,
cit_ac_no,
cit_iss_type,
cit_descrpt,
cit_pendng_itm,
cit_dt_activated,
cit_rm,
cit_apprvdby,
cit_dt_rcvd,
cit_dt_promised,
cit_ref_reg,
cit_hbl,
cit_rmuser
) 
VALUES(
UPPER('$inputer'),
'$idate',
'$itime',
'$refnumber',
'$cpstatus',
UPPER('$cpcusname'),
'$cpacnumber',
'$cpissuetyp',
UPPER('$cpdescription'),
UPPER('$cppendstatus'),
'$cpactvtd',
'$cprmcode',
'$cpaprvdby',
'$cpdtrcvd',
'$cpdtprmsd',
'$cprgref',
'$cphbl',
UPPER('$user')
)");

echo "</br>";
echo "</br>";
echo "ISSUE $refnumber RECORDED SUCCESSFULL";
echo "</br>";
echo "</br>";



$date   = $_POST['cpdtprmsd'];



$dater1 = strtotime(date("Y-m-d", strtotime($date)) . " -1 days");
$dater1 = date('Y-m-d', $dater1);

$dater2 = "$date";


$dater3 = strtotime(date("Y-m-d", strtotime($date)) . " +1 days");
$dater3 = date('Y-m-d', $dater3);


$dater4 = strtotime(date("Y-m-d", strtotime($date)) . " +7 days");
$dater4 = date('Y-m-d', $dater4);


if ($date === "NA")
{
$dater1 = "0000-00-00";
$dater2 = "0000-00-00";
$dater3 = "0000-00-00";
$dater4 = "0000-00-00";
}



@mysql_query("INSERT INTO cps_pdngitems
(
pdn_inputer,
pdn_input_date,
pdn_input_time,
pdn_reference_no,
pdn_status,
pdn_r1,
pdn_r2,
pdn_r3,
pdn_r4
) 
VALUES(
UPPER('$inputer'),
'$idate',
'$itime',
'$refnumber',
'$cpstatus',
'$dater1',
'$dater2',
'$dater3',
'$dater4'
)");


 $query = mysql_query(" SELECT * FROM cps_issues WHERE cit_reference_no = '$refnumber' ");  
	 while($row = mysql_fetch_array($query))
     {
	 
$inputer          = $row['cit_inputer'];
$refnumber        = $row['cit_reference_no'];
$cpstatus         = $row['cit_status'];
$cpcusname        = $row['cit_custmrnname'];
$cpacnumber       = $row['cit_ac_no'];
$cpissuetyp       = $row['cit_iss_type'];
$cpdescription    = $row['cit_descrpt'];
$cppendstatus     = $row['cit_pendng_itm'];
$cpactvtd         = $row['cit_dt_activated'];
$cprmcode         = $row['cit_rm'];
$cpaprvdby        = $row['cit_apprvdby'];
$cpdtrcvd         = $row['cit_dt_rcvd'];
$cpdtprmsd        = $row['cit_dt_promised'];
$cprgref          = $row['cit_ref_reg'];
$cphbl            = $row['cit_hbl'];
     }


if ($cpactvtd === "0000-00-00")
{
$cpactvtd = "NA";
}

if ($cpdtrcvd === "0000-00-00")
{
$cpdtrcvd = "NA";
}


if ($cpdtprmsd === "0000-00-00")
{
$cpdtprmsd = "NA";
}


//define the receiver of the email
//$to = ''."ganpath.pillai@bankm.com,veronica.kanyama@bankm.com,COPS@bankm.com,ntinginya.musisa@bankm.com,vinesh.davda@bankm.com,linda.mshana@bankm.com,$usr_email".'';
$to = ''."rizwan.abdulkarim@bankm.com,COPS@bankm.com,veronica.kanyama@bankm.com,linda.mshana@bankm.com,$usr_email,vinesh.davda@bankm.com,ntinginya.musisa@bankm.com".'';
//$to = ''."ntinginya.musisa@bankm.com".'';
//define the subject of the email
$subject = ''."$cpissuetyp ".'QUERY FOR '."$cpcusname ".''; //create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: bankmportal.cops@bankm.com\r\nReply-To: support.portal@bankm.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\""; 
//define the body of the message.
ob_start(); //Turn on output buffering
?>
                    </span>
                    <style type="text/css">
<!--
.style2 {color: #FFFFFF;
	font-weight: bold;
}
.style3 {font-size: 11px; font-family: tahoma;}
.style4 {	color: #0E3793;
	font-weight: bold;
}
.style5 {color: #0E3793}
.style7 {	color: #0E3793;
	font-size: 12px;
	font-weight: bold;
}
-->
</style> 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<style type="text/css">
<!--
.style2 {	color: #FFFFFF;
	font-weight: bold;
}
.style3 {font-size: 11px; font-family: tahoma;}
.style4 {
	color: #0E3793;
	font-weight: bold;
}
.style5 {color: #0E3793}
.style6 {font-size: 12px}
.style7 {
	color: #0E3793;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<table width="1%" height="39"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-left: 1px solid #0E3793; border-right: 1px solid #0E3793; border-top: 1px solid #0E3793; border-bottom: 1px solid #0E3793;">
  <tr>
    <td width="95%" height="39" valign="top" nowrap><table width="56%" align="center" cellpadding="0" cellspacing="0" >
      <tr class="style11" >
        <td ><table width="100%" height="24"  border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #0E3793;">
            <tr>
              <td width="96%" height="23" nowrap bgcolor="#0E3793"><span style="font-family: tahoma;font-size: 11px;font-weight: bold;">Bank M Tanzaniza Limited - System Portal</span></td>
            </tr>
        </table></td>
      </tr>
      <tr class="style11" >
        <td width="226" >&nbsp;</td>
      </tr>
      <tr class="style11" >
        <td style="border-bottom: 1px solid #0E3793;"><span class="style5" style="font-family: tahoma; font-size: 12px;"><strong>Issue Details</strong></span></td>
      </tr>
      <tr class="style11" >
        <td ><table width="100%" align="left" cellpadding="0" cellspacing="0" >
            <tr class="style11" >
              <td width="83" nowrap >&nbsp;</td>
              <td width="17" nowrap >&nbsp;</td>
              <td width="18" nowrap ></td>
              <td width="95" nowrap >&nbsp;</td>
              <td width="17" nowrap >&nbsp;</td>
            </tr>
            <tr class="style11" >
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Reference # :</strong></span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$refnumber"; ?></span></td>
              <td nowrap ></td>
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><span class="style4"><strong><span class="style5" style="font-family: tahoma; font-size: 11px;">Status :</span></strong></span> </span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpstatus"; ?></span></td>
            </tr>
            <tr class="style11" >
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Customer Name   :</strong></span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpcusname"; ?></span></td>
              <td nowrap ></td>
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Account #   :</strong></span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpacnumber"; ?></span></td>
            </tr>
            <tr class="style11" >
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Issue Type  :</strong></span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpissuetyp"; ?></span></td>
              <td nowrap ></td>
              <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Inputer<strong> : </strong></strong></span></strong></span></td>
              <td nowrap ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$inputer"; ?></span></td>
            </tr>
            <tr class="style11" >
              <td nowrap >&nbsp;</td>
              <td nowrap >&nbsp;</td>
              <td nowrap ></td>
              <td nowrap >&nbsp;</td>
              <td nowrap >&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr class="style11" >
        <td style="border-bottom: 1px solid #0E3793;"><span class="style5" style="font-family: tahoma; font-size: 12px;"><strong>Description</strong></span></td>
      </tr>
      <tr class="style11" >
        <td ><table width="100%" align="left" cellpadding="0" cellspacing="0" >
            <tr class="style11" >
              <td width="210" >&nbsp;</td>
            </tr>
            <tr class="style11" >
              <td ><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpdescription"; ?></span></td>
            </tr>
            <tr class="style11" >
              <td >&nbsp;</td>
            </tr>
            <tr class="style11" >
              <td ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Pending Item: </strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cppendstatus"; ?></span></td>
            </tr>
            <tr class="style11" >
              <td style="border-bottom: 1px solid #0E3793;">&nbsp;</td>
            </tr>
            <tr class="style11" >
              <td >&nbsp;</td>
            </tr>
            <tr class="style11" >
              <td ><table width="100%" align="left" cellpadding="0" cellspacing="0" >
                <tr class="style11" >
                  <td width="83" nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Date activated: </strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpactvtd"; ?></span></td>
                  <td width="17" nowrap >&nbsp;</td>
                  <td width="18" nowrap ></td>
                  <td width="95" nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong><span class="style4"><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>RM Code   :</strong></span></span> </strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cprmcode"; ?></span></td>
                  <td width="17" nowrap >&nbsp;</td>
                </tr>
                <tr class="style11" >
                  <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Aproved by <strong> : </strong></strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpaprvdby"; ?></span></td>
                  <td nowrap >&nbsp;</td>
                  <td nowrap ></td>
                  <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Date Received<strong> : </strong></strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpdtrcvd"; ?></span></td>
                  <td nowrap >&nbsp;</td>
                </tr>
                <tr class="style11" >
                  <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Date Promised <strong> : </strong></strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cpdtprmsd"; ?></span></td>
                  <td nowrap >&nbsp;</td>
                  <td nowrap ></td>
                  <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>Ref/ Reg # <strong>: </strong></strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cprgref"; ?></span></td>
                  <td nowrap >&nbsp;</td>
                </tr>
                <tr class="style11" >
                  <td nowrap ><span class="style5" style="font-family: tahoma; font-size: 11px;"><strong>HBL<strong> : </strong></strong></span><span style="font-family: tahoma; font-size: 11px;"><?php echo"$cphbl"; ?></span></td>
                  <td nowrap >&nbsp;</td>
                  <td nowrap ></td>
                  <td nowrap >&nbsp;</td>
                  <td nowrap >&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr class="style11" >
              <td >&nbsp;</td>
            </tr>
        </table></td>
      </tr>
      <tr class="style11" >
        <td ><span class="style5" style="font-family: tahoma; font-size: 12px;"><span class="style5" style="font-family: tahoma; font-size: 12px;"></span></span></td>
      </tr>
    </table></td>
  </tr>
</table>
--PHP-alt-<?php echo $random_hash; ?>--
<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"









}
?>
                </span></div></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td width="28%" height="23" align="right" nowrap >INPUTER&nbsp;&nbsp; </td>
                <td width="31%" nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="29%" nowrap class="style11" ><input type="text" class="style13" value="<?php echo "$fullname"; ?>" style="text-transform:uppercase;"></td>
                      <td width="39%" nowrap class="style11" ><input name="inputer" type="hidden" class="style11" id="inputer" value="<?php echo "$fullname"; ?>"></td>
                      <td width="32%" align="center" nowrap class="style11"  ><div align="right">INPUT DATE&nbsp;&nbsp; </div></td>
                    </tr>
                </table></td>
                <td width="41%" nowrap ><input type="text" class="style13" value="<?php echo date("Y-m-d", time()); ?>" size="10">
                    <input name="idate" type="hidden"  class="style11" id="idate" value="<?php echo date("Y-m-d", time()); ?>"></td>
              </tr>
              <tr class="style2">
                <td height="28" align="right" nowrap >REF #&nbsp;&nbsp;&nbsp;</td>
                <td nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="29%" nowrap class="style11" ><?php
               
               mysql_connect("localhost", "root", "") or die(mysql_error());
               mysql_select_db("bmpl_cops") or die(mysql_error());
               $result = mysql_query("SELECT cit_serial_number FROM cps_issues") or die(mysql_error());  
               while($row = mysql_fetch_array( $result )) 
               {  
               $name = $row['cit_serial_number'];
               } 
               $number = ($name + 1);
			   
              ?>
                        <?PHP $YR = date("Y", time()) ?><?PHP $MN = date("m", time()) ?><?PHP $DT = date("d", time()) ?>
                        <input type="text" class="style13" value="COPS<?php echo "$YR"; ?><?php echo "$MN"; ?><?php echo "$DT"; ?><?php echo "$number"; ?>" size="20">
                        <input name="refnumber" type="hidden" class="style24" id="refnumber" value="COPS<?php echo "$YR"; ?><?php echo "$MN"; ?><?php echo "$DT"; ?><?php echo "$number"; ?>"></td>
                      <td width="39%" nowrap class="style11" >&nbsp;</td>
                      <td width="32%" align="center" nowrap class="style11" ><div align="right">INPUT TIME&nbsp;&nbsp;</div></td>
                    </tr>
                </table></td>
                <td nowrap ><input type="text" class="style13" value="<?php echo date("H:i:s", time()); ?>" size="10">
                    <input name="itime" type="hidden"  class="style11" id="itime" value="<?php echo date("H:i:s", time()); ?>"></td>
              </tr>
              <tr class="style2">
                <td height="13" align="right" nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="23" align="right" nowrap >ISSUE STATUS &nbsp;&nbsp;&nbsp;</td>
                <td nowrap ><input type="text" class="style13" value="PENDING" size="15">
                  <input name="cpstatus" type="hidden" class="style24" id="cpstatus" value="PENDING"></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="23" align="right" nowrap >CUSTOMER NAME &nbsp;&nbsp;&nbsp;</td>
                <td nowrap ><input style="text-transform:uppercase;" name="cpcusname" type="text" class="style13" id="cpcusname" size="50"></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="23" align="right" nowrap >ACCOUNT #&nbsp;&nbsp;&nbsp;</td>
                <td nowrap ><input name="cpacnumber" type="text" class="style13" id="cpacnumber" value="NA" size="30"></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="23" align="right" nowrap >ISSUE TYPE &nbsp;&nbsp;&nbsp;</td>
                <td nowrap ><select name="cpissuetyp" class="style13" id="cpissuetyp">
                  <option value="ISSUE TYPE">ISSUE TYPE</option>
                  
<option value="DORMANT ACCOUNTS">DORMANT ACCOUNTS</option>
<option value="SIGNATURE DIFFERS">SIGNATURE DIFFERS</option>
<option value="MISSING KYC DOCUMEENTS">MISSING KYC DOCUMEENTS</option>
<option value="ADDITIONAL SIGNTAURE">ADDITIONAL SIGNTAURE</option>
<option value="2ND SIGATURE REQUIRED">2ND SIGATURE REQUIRED</option>
<option value="FDRS">FDRS</option>
<option value="OLD FDRS">OLD FDRS</option>
<option value="CUSTOMER INSTRUCTION FOR FDRS">CUSTOMER INSTRUCTION FOR FDRS</option>
<option value="WITHHOLDING TAX ACKNOWLEDGEMENT">WITHHOLDING TAX ACKNOWLEDGEMENT</option>
<option value="FDR RECEIPT BY CUST ACK">FDR RECEIPT BY CUST ACK</option>
<option value="ACCOUNT MAINTENANCE">ACCOUNT MAINTENANCE</option>
<option value="CHEQUE BOOK RELATED">CHEQUE BOOK RELATED</option>
<option value="CALL BACK CONFIRMATION LETTER">CALL BACK CONFIRMATION LETTER</option>
<option value="SIGNATURE ISSUES">SIGNATURE ISSUES</option>
<option value="CHEQUE BOOK">CHEQUE BOOK</option>
<option value="REQUISITION NOT RECEIVED">REQUISITION NOT RECEIVED</option>
<option value="REQUISITION SIGNATURE DIFFERS">REQUISITION SIGNATURE DIFFERS</option>
<option value="CHEQUE BOOK UNDLEIVERED">CHEQUE BOOK UNDLEIVERED</option>
<option value="OTHERS">OTHERS</option>
                </select></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="22" align="right" nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="103" align="right" valign="middle" nowrap ><p>ISSUE DESCRIPTION&nbsp;&nbsp;&nbsp; </p>
                  <p>&nbsp;</p>
                  <p>&nbsp;&nbsp;&nbsp;</p></td>
                <td nowrap ><textarea style="text-transform:uppercase;" name="cpdescription" cols="70" rows="5" class="style13" id="cpdescription">NA</textarea></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="23" align="right" nowrap >PENDING ITEM &nbsp;&nbsp;&nbsp;</td>
                <td nowrap >                  <input name="cppendstatus" type="text" class="style13" id="cppendstatus" style="text-transform:uppercase;" value="NA" size="50"></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="22" align="right" nowrap >DATE ACTIVATED/CHANGED&nbsp;&nbsp;&nbsp;</td>
                <td nowrap >                  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="17%" nowrap class="style11" ><input name="cpactvtd" type="text" class="style13" id="cpactvtd" value="NA" size="10"></td>
                      <td width="30%" nowrap class="style11" ><strong>&nbsp;&nbsp;YYYY-MM-DD</strong></td>
                      <td width="53%" align="center" nowrap class="style11" ><div align="right">RM CODE &nbsp;&nbsp;</div></td>
                    </tr>
                  </table></td>
                <td nowrap ><select name="cprmcode" class="style13" id="cprmcode">
                  <option value="SELECT RM CODE">SELECT RM CODE</option>
                  <option value="NA">NA</option>
				  <option value="CB1">CB1</option>
                  <option value="CB2">CB2</option>
                  <option value="CB3">CB3</option>
                  <option value="CB4">CB4</option>
                  <option value="CB5">CB5</option>
                  <option value="CB6">CB6</option>
                  <option value="CB7">CB7</option>
                  <option value="CB8">CB8</option>
                  <option value="CB9">CB9</option>
                  <option value="CB10">CB10</option>
                  <option value="CR1">CR1</option>
                  <option value="CR2">CR2</option>
                  <option value="CR3">CR3</option>
                  <option value="CR4">CR4</option>
                  <option value="TB1">TB1</option>
                  <option value="TB2">TB2</option>
                  <option value="TB3">TB3</option>
                  <option value="TB4">TB4</option>
                  <option value="TB5">TB5</option>
				  <option value="TB6">TB6</option>
                  <option value="TB7">TB7</option>
				  <option value="TB8">TB8</option>
                  
                    <option value="IB1">IB1</option>
                    <option value="IB2">IB2</option>
                    <option value="IB3">IB3</option>
                    <option value="IB4">IB4</option>
                    <option value="IB5">IB5</option>
                </select></td>
              </tr>
              <tr class="style2">
                <td height="28" align="right" nowrap >&nbsp;</td>
                <td nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                  <tr>
                    <td width="17%" nowrap class="style11" >&nbsp;</td>
                    <td width="30%" nowrap class="style11" >&nbsp;</td>
                    <td width="53%" align="center" nowrap class="style11" ><div align="right">RM NAME &nbsp;&nbsp;</div></td>
                  </tr>
                </table></td>
                <td nowrap ><?PHP
			mysql_connect("localhost", "root", ""); 
			mysql_select_db("bmpl_system"); 
			$res=mysql_query("SELECT * FROM sys_user order by usr_first_name") or die(mysql_error()); 
			echo "<select name=user1M class=style13 style=text-transform:uppercase	>"; 
			while($row=mysql_fetch_assoc($res)) 
			{ echo " <option value=$row[usr_id]>$row[usr_full_name]</a></option> ";} 
			echo "</select>";
					?></td>
              </tr>
              <tr class="style2">
                <td height="28" align="right" nowrap >APPROVED BY &nbsp;&nbsp;</td>
                <td nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="17%" nowrap class="style11" ><select name="cpaprvdby" class="style13" id="cpaprvdby">
                        <option value="SELECT APPROVER">SELECT APPROVER</option>
                        <option value="CB">CB</option>
                        <option value="TB">TB</option>
                         <option value="NA">NA</option>
                        <option value="DRR">DRR</option>
                      </select></td>
                      <td width="30%" nowrap class="style11" >&nbsp;</td>
                      <td width="53%" align="center" nowrap class="style11" ><div align="right">DATE RECEIVED &nbsp;&nbsp;</div></td>
                    </tr>
                  </table></td>
                <td nowrap ><input name="cpdtrcvd" type="text" class="style13" id="cpdtrcvd" value="NA" size="10">
                  <strong>&nbsp;&nbsp;YYYY-MM-DD</strong></td>
              </tr>
              <tr class="style2">
                <td height="24" align="right" nowrap >DATE PROMISED &nbsp;&nbsp;</td>
                <td nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                  <tr>
                    <td width="16%" nowrap class="style11" ><input name="cpdtprmsd" type="text" class="style13" id="cpdtprmsd" value="NA" size="10"></td>
                    <td width="52%" nowrap class="style11" >                      <strong>&nbsp;&nbsp;YYYY-MM-DD</strong></td>
                    <td width="32%" align="center" nowrap class="style11" ><div align="right">REF #/REG # &nbsp;&nbsp;</div></td>
                  </tr>
                </table></td>
                <td nowrap ><input style="text-transform:uppercase;" name="cprgref" type="text" class="style13" id="cprgref" value="NA" size="15"></td>
              </tr>
              <tr class="style2">
                <td height="24" align="right" nowrap >HBL&nbsp;&nbsp;</td>
                <td nowrap ><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" >
                  <tr>
                    <td width="14%" nowrap class="style11" ><select name="cphbl" class="style13" id="cphbl">
                      <option value="SELECT HBL">SELECT HBL</option>
                      <option value="JACQUELINE WOISO">JACQUELINE WOISO</option>
                      <option value="WASEEM ARAIN">WASEEM ARAIN</option>
					  <option value="ABEL LASWAY">ABEL LASWAY </option>
                      <option value="GODFREY UTOUH">GODFREY UTOUH</option>
                      <option value="ANNE NEHEMIAH">ANNE NEHEMIAH</option>
                      <option value="DEEPALI RAMAIYA">DEEPALI RAMAIYA</option>

                    </select></td>
                    <td width="54%" nowrap class="style11" >&nbsp;</td>
                    <td width="32%" align="center" nowrap class="style11" ><div align="right"></div></td>
                  </tr>
                </table></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="30" align="right" nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="30" align="right" nowrap >&nbsp;</td>
                <td nowrap ><input name="reg_issue" type="submit" class="style13" id="Submit" value="SUBMIT" onClick="show_alert()">
                  <input name="Reset" type="reset" class="style13" id="Submit" value="RESET" onClick="show_alert()">
                  <?php 
			  echo "<a href='index.php?canumber=".$canumber."'><input name=Button type=button class=style13 id=Submit value=HOME></a>"
			  ?></td>
                <td nowrap >&nbsp;</td>
              </tr>
              <tr class="style2">
                <td height="13" align="right" nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
                <td nowrap >&nbsp;</td>
              </tr>
            </table>
              <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="center"><span class="style22">

                  </span></div></td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>