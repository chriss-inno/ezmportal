<?php
session_start();
$loginUser_id = $_SESSION['SESS_USER_ID'];
require_once('../../config/auth_content.php');

$user_id       = $_SESSION['SESS_USER_ID'];
$log_ipaddress = $_SERVER['REMOTE_ADDR']; 
$log_compuser  = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$log_datetime  = date("d/m/y : H:i:s", time());
$log_activity  = "ForexDealExeOpened";
$log_comment   = "PageOpened";
mysql_connect("localhost","root",""); 
mysql_select_db("bmpl_system") or die("Unable to select database");
@mysql_query("INSERT INTO sys_log(user_id, log_datetime, log_activity, log_comment, log_ipaddress, log_compuser)
VALUES('$user_id','$log_datetime','$log_activity','$log_comment','$log_ipaddress', '$log_compuser')");	
?>	
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jqprint.0.3.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
$(function() {
                $("#PrintVocab").click( function() {
                    $('#divToPrint').jqprint();
                    return false;
                });
             });
</script>
<style type="text/css">
<!--
.style6 {font-size: 11px}
-->
</style>
<style type="text/css">
<!--
.style1 {
	font-family: tahoma;
	color: #0E3793;
	font-size: 11px;
}
.style21 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style21 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style22 {font-size: 14px}
.style22 {font-size: 14px}
.style23 {font-size: 13px}
.style27 {font-size: 12px}
.style28 {
	font-size: 16px;
	font-weight: bold;
}
a {
	font-family: tahoma;
	font-size: 16px;
	color: #0E3793;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0E3793;
}
a:hover {
	text-decoration: none;
	color: #0E3793#0E3793;
}
a:active {
	text-decoration: none;
	color: #0E3793;
}
-->
</style>
<div align="center">

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <form action="index.php" method="post" name="returnTomainPage" id="returnTomainPage">
    <span class="style1">
    <?php
     $con = mysql_connect("localhost","root","");
     if (!$con) {die('Could not connect: ' . mysql_error());}
     mysql_select_db("bmpl_forexdealportal") or die(mysql_error());
	 
	 
	     // $fds_sdeal_number        = $_POST['snumber'];	
	    //$forexdeal = ("DELETE FROM fd_dealslip WHERE fds_deal_serial = '$fds_sdeal_number' and fds_deal_number = '' and fds_deal_time = '' and fds_deal_date = '' and fds_value_date = '' and fds_counter_party = '' and fds_curr_amount_bought = '' and fds_rate = '' and fds_curr_amount_sold = '' and fds_confirmed_with = '' and fds_bankm_dealer = '' and fds_mobile = '' and fds_confirmed_time = '' and fds_spl_instruction = '' and fds_spl_email = ''");
		//$result  = @mysql_query($forexdeal);	
	 
	  $fds_sdeal_number        = $_POST['snumber'];	
	  $fds_deal_number         = $_POST['number'];	 	 	 	 	 	 	 	 
      $fds_deal_time	       = $_POST['fds_deal_time'];	 	 	 	 	 	 	 
      $fds_deal_date 	 	   = $_POST['fds_deal_date']; 	 	 	 	 	 
      $fds_value_date 	       = $_POST['fds_value_date']; 	 	 	 	 	 	 
      $fds_counter_party 	   = $_POST['fds_counter_party']; 	
	  $fds_curr_sold           = $_POST['fds_curr_sold']; 	
	  $fds_curr_bought         = $_POST['fds_curr_bought']; 	 	 
      $fds_curr_amount_bought  = $_POST['fds_curr_amount_bought']; 	 	 	 	 	 
      $fds_rate 	 	       = $_POST['fds_rate'];  	 	 	 	 
      $fds_curr_amount_sold	   = $_POST['fds_curr_amount_sold'];	 	 	 	 	 	 	 
      $fds_confirmed_with	   = $_POST['fds_confirmed_with']; 	 	 	 	 	 	 	 
      $fds_bankm_dealer	       = $_POST['fds_bankm_dealer']; 	 	 	 	 	 	 	 
      $fds_mobile 	 	       = $_POST['fds_mobile']; 	 	 	 	 
      $fds_confirmed_time 	   = $_POST['fds_confirmed_time']; 	 	 	 	 	 	 
      $fds_spl_instruction     = $_POST['fds_spl_instruction'];
	  $fds_spl_email           = $_POST['fds_spl_email'];
	  
	  
	  
	  
	  
	        if($fds_curr_sold == "CURRENCY") 	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Sold currency details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 	 
      if($fds_curr_bought   == "CURRENCY")	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Bought currency details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 
	  
      if($fds_deal_number == "") 	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Deal number details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 	 
      if($fds_deal_time   == "")	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Deal time details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 	 	 	 
      if($fds_deal_date   == "") 	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Deal date details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 	 
      if($fds_value_date  == "") 	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Value date details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 	 	 
      if($fds_counter_party == "") 
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Counter party details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 	 
      if($fds_curr_amount_bought == '') 
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Curr. amount bought details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 
      if($fds_rate == '')  	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Rate details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 
      if($fds_curr_amount_sold == "")	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Curr. amount sold details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 	 	 	 
      if($fds_confirmed_with == "")	
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Confirmed with details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   }  	 	 	 	 	 	 
      if($fds_bankm_dealer == "Select Bank M Dealer") 	 
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Bankm dealer details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 	 
      if($fds_mobile == "")	 
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Mobile details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 
      if($fds_confirmed_time == "") 
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Confirmed time details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 	 	 	 	 	 	 
      if($fds_spl_instruction == "")
	                   {
					   echo'</br>';echo'</br>';
                       echo'<span class="style17"><span class="style36">Slp. instruction details missing</span></span>';
                       echo'</br>';echo'</br>';
					   echo "<INPUT TYPE=button class=style11 VALUE=Back onclick=self.close();return true;>";
				       exit; 
					   } 
					   
					   
					   
					//   if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $fds_spl_email)) { 
        
                    //      } 
                    //      else { 
					//      echo '<span class="style17"><span class="style36">Invalid Customer email address</span></span>';
					//      exit; 
                   //       } 
	  
	    
        $result = mysql_query("SELECT * FROM fd_dealslip WHERE fds_deal_number = '$fds_deal_number' ") or die(mysql_error());  
		if($result) 
		             {
		if(mysql_num_rows($result) >= 1) 
			          
                     {
			   $result = mysql_query("SELECT fds_deal_serial FROM fd_dealslip order by fds_deal_serial") or die(mysql_error());  
               while($row = mysql_fetch_array( $result )) 
               {
			            $fds_sdeal_number = $row['fds_deal_serial'];
			   } 
                        $fds_deal_number = ($fds_sdeal_number + 1);
						$fds_sdeal_number = ($fds_sdeal_number + 1);
						
						$date  = date("d", time());
						
						$month = date("m", time());
						
						$fds_deal_number = "$fds_deal_number.$date.$month";
	  
        $forexdeal = " INSERT INTO fd_dealslip (fds_deal_serial, fds_deal_number, fds_deal_time, fds_deal_date, fds_value_date, fds_counter_party, fds_curr_amount_bought, fds_rate, fds_curr_amount_sold, fds_confirmed_with, fds_bankm_dealer, fds_mobile, fds_confirmed_time, fds_spl_instruction, fds_spl_email)
        VALUES(UPPER('$fds_sdeal_number') , UPPER('$fds_deal_number'), UPPER('$fds_deal_time'), UPPER('$fds_deal_date'), UPPER('$fds_value_date'), UPPER('$fds_counter_party'), UPPER('$fds_curr_bought $fds_curr_amount_bought'), UPPER('$fds_rate'), UPPER('$fds_curr_sold $fds_curr_amount_sold'), UPPER('$fds_confirmed_with'), UPPER('$fds_bankm_dealer'), UPPER('$fds_mobile'), UPPER('$fds_confirmed_time'), UPPER('$fds_spl_instruction'), '$fds_spl_email')";	  
	  
		$result  = @mysql_query($forexdeal);	
		               }
					   else
					   {
		$forexdeal = " INSERT INTO fd_dealslip (fds_deal_serial, fds_deal_number, fds_deal_time, fds_deal_date, fds_value_date, fds_counter_party, fds_curr_amount_bought, fds_rate, fds_curr_amount_sold, fds_confirmed_with, fds_bankm_dealer, fds_mobile, fds_confirmed_time, fds_spl_instruction, fds_spl_email)
        VALUES(UPPER('$fds_sdeal_number') , UPPER('$fds_deal_number'), UPPER('$fds_deal_time'), UPPER('$fds_deal_date'), UPPER('$fds_value_date'), UPPER('$fds_counter_party'), UPPER('$fds_curr_bought $fds_curr_amount_bought'), UPPER('$fds_rate'), UPPER('$fds_curr_sold $fds_curr_amount_sold'), UPPER('$fds_confirmed_with'), UPPER('$fds_bankm_dealer'), UPPER('$fds_mobile'), UPPER('$fds_confirmed_time'), UPPER('$fds_spl_instruction'), '$fds_spl_email')";  
	  
		$result  = @mysql_query($forexdeal);	
					   
					   }}
?>
    </span>
  </form>
  
  
  <?php
                        mysql_connect("localhost", "root", "") or die(mysql_error());
                        mysql_select_db("bmpl_forexdealportal") or die(mysql_error());
                        $result = mysql_query("SELECT * FROM fd_dealslip WHERE fds_deal_serial = '$fds_sdeal_number'") or die(mysql_error());  
                        while($row = mysql_fetch_array( $result )) 
                        {  

						$fds_deal_number  = $row['fds_deal_number'];	 	 	 	 	 	 	 	 
						$fds_deal_time	   = $row['fds_deal_time'];	 	 	 	 	 	 	 
						$fds_deal_date 	  = $row['fds_deal_date']; 	 	 	 	 	 
						$fds_value_date 	 = $row['fds_value_date']; 	 	 	 	 	 	 
						$fds_counter_party 	 = $row['fds_counter_party']; 	 	 	 	 	 	 
						$fds_curr_amount_bought  = $row['fds_curr_amount_bought']; 	 	 	 	 	 
						$fds_rate 	 = $row['fds_rate'];  	 	 	 	 
						$fds_curr_amount_sold	 = $row['fds_curr_amount_sold'];	 	 	 	 	 	 	 
						$fds_confirmed_with	  = $row['fds_confirmed_with']; 	 	 	 	 	 	 	 
						$fds_bankm_dealer	 = $row['fds_bankm_dealer']; 	 	 	 	 	 	 	 
						$fds_mobile  = $row['fds_mobile']; 	 	 	 	 
						$fds_confirmed_time  = $row['fds_confirmed_time']; 	 	 	 	 	 	 
						$fds_spl_instruction   = $row['fds_spl_instruction'];
						$fds_spl_email = $row['fds_spl_email'];
                        } 
           
                        ?>
						
						
						
						
  <style type="text/css">
<!--
.style11 {font-family: tahoma; font-size: 11px; color: #0E3793; }
.style17 {color: #0E3793}
.style19 {	font-size: 18px;
	font-weight: bold;
}
.style20 {font-size: 14px}
.style6 {font-size: 11px}
.style22 {font-family: tahoma; font-size: 12px; color: #0E3793; }
.style23 {color: #7F9DB9}
-->
</style>

<div id="divToPrint">

<table width="1030"  border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="95%" height="300" valign="top" nowrap><form action="forexdealexe.php" method="post" name="forexdealslip" id="forexdealslip">
      <table width="98%" height="353"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21"  >
        <tr class="style6">
          <td height="23" align="right" nowrap ><div align="center"><span class="style28">FOREX DEAL SLIP</span></div></td>
        </tr>
        <tr class="style6">
          <td width="28%" height="5" align="right" nowrap ><div align="center" class="style28" ></div></td>
        </tr>
        <tr class="style6">
          <td height="254" align="right" nowrap ><table width="100%" height="217"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
              <tr class="style22">
                <td width="10%" height="18" align="right" nowrap >&nbsp;</td>
                <td width="20%" align="left" nowrap ><div align="left" class="style23">DEAL NO: </div></td>
                <td width="70%" align="left" nowrap ><div align="left">
                    <table width="100%" height="10"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                      <tr class="style22">
                        <td width="43%" height="10" align="left" nowrap ><div align="left" class="style23"><strong> <?php echo"$fds_deal_number";?> </strong></div></td>
                        <td width="20%" nowrap ><div align="left" class="style23">TIME: </div>
                            <div align="left"></div></td>
                        <td width="37%" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_deal_time";?></div></td>
                      </tr>
                    </table>
                </div></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">DEAL DATE: </div></td>
                <td align="left" nowrap ><div align="left">
                    <table width="100%" height="10"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                      <tr class="style22">
                        <td width="43%" height="10" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_deal_date";?> </div></td>
                        <td width="20%" nowrap ><div align="left" class="style23">VALUE DATE:</div>
                            <div align="left"></div></td>
                        <td width="37%" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_value_date";?></div></td>
                      </tr>
                    </table>
                </div></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">COUNTER PARTY: </div></td>
                <td align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_counter_party";?></div></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">CURR. &amp; AMOUNT SOLD:</div></td>
                <td align="left" nowrap ><div align="left" class="style23"><?php echo"$fds_curr_amount_sold";?> </div></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">RATE:</div></td>
                <td align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_rate";?></div></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">CURR. &amp; AMOUNT BOUGHT :</div></td>
                <td align="left" nowrap ><span class="style23"><?php echo"$fds_curr_amount_bought";?></span></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">DEAL CONFIRMED WITH: </div></td>
                <td align="left" nowrap ><table width="100%" height="10"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                    <tr class="style22">
                      <td width="43%" height="10" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_confirmed_with";?></div></td>
                      <td width="20%" nowrap ><div align="left" class="style23">BANK M DEALER:</div>
                          <div align="left"></div></td>
                      <td width="37%" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_bankm_dealer";?></div></td>
                    </tr>
                </table></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">PHONE/ MOBILE NO.: </div></td>
                <td align="left" nowrap ><table width="100%" height="10"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                    <tr class="style22">
                      <td width="43%" height="10" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_mobile";?></div></td>
                      <td width="20%" nowrap ><div align="left" class="style23">TIME: </div>
                          <div align="left"></div></td>
                      <td width="37%" align="left" nowrap ><div align="left" class="style23"> <?php echo"$fds_confirmed_time";?></div></td>
                    </tr>
                </table></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><div align="left" class="style23">SPL. INSTRUCTION:</div></td>
                <td align="left" nowrap ><span class="style23"><?php echo "$fds_spl_instruction";?></span></td>
              </tr>
              <tr class="style22">
                <td height="18" align="right" nowrap >&nbsp;</td>
                <td align="left" nowrap ><span class="style23">CUSTOMER E-MAIL ID:</span></td>
                <td align="left" nowrap ><span class="style23"><?php echo "$fds_spl_email";?></span></td>
              </tr>
            </table>
              <table width="103%" height="25"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                <tr class="style22">
                  <td width="71%" height="30" align="left" nowrap ><div align="center">
                      <p class="style27">As per the indemnity entered into by you with the Bank the above deal has been closed over phone. This will be subject to availability of funds in your accounts </p>
                  </div></td>
                </tr>
              </table>
              <table width="100%" height="64"  border="0" align="center" cellpadding="0" cellspacing="0" class="style21" >
                <tr class="style22">
                  <td width="10%" height="64" align="right" nowrap >&nbsp;</td>
                  <td width="50%" align="left" nowrap ><div align="left" class="style23">SIGNATURE :Bank M Dealer &nbsp;&nbsp;&nbsp;&nbsp;................................ </div></td>
                  <td width="40%" align="left" nowrap ><div align="left" class="style23">Head - Treasury Back Office  &nbsp;&nbsp;&nbsp;&nbsp;................................ </div></td>
                </tr>
            </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</div>
</div>
<div align="center">
</div>
