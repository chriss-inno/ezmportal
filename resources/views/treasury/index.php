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
          <td width="96%" height="19" nowrap bgcolor="#E1204F"><span class="style2">&nbsp;<span class="style3">FOREX DEAL</span></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="484" valign="top" nowrap><div align="center">
      <table width="975"  border="0" align="center" cellpadding="0" cellspacing="0" >
        <tr>
          <td width="95%" height="484" valign="top" nowrap><form action="forexdealexe.php" method="post" name="forexdealslip" target="_blank" id="forexdealslip">
            <table width="93%" height="484"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32"  >
                <tr class="style37">
                  <td width="28%" height="20" align="right" nowrap style="border-bottom: 1px solid #7F9DB9;"><div align="center" class="style34 style40">
                    <table width="100%" height="31"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                      <tr class="style35">
                        <td width="21%" height="31" align="left" nowrap ><div align="right" class="style45"></div></td>
                        <td width="79%" align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style35">
                                <td width="2%" height="35" align="left" nowrap class="style49" > Forex deal slip </td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                    </table>
                  </div></td>
                </tr>
                <tr class="style37">
                  <td height="448" align="right" nowrap ><table width="100%" height="337"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                      <tr class="style3">
                        <td width="15%" height="31" align="right" nowrap >&nbsp;</td>
                        <td width="15%" align="left" nowrap ><div align="left" class="style3">DEAL NO: </div></td>
                        <td width="70%" align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style3">
                                <td width="33%" height="35" align="left" nowrap ><div align="left">
                                    <?php
                     mysql_connect("localhost", "root", "") or die(mysql_error());
                        mysql_select_db("bmpl_forexdealportal") or die(mysql_error());
                        $result = mysql_query("SELECT * FROM fd_dealslip order by fds_deal_serial") or die(mysql_error());  
                        while($row = mysql_fetch_array( $result )) 
                        { 
                        $fds_deal_number = $row['fds_deal_serial'];
                        } 
                        $fds_deal_number = ($fds_deal_number + 1);
						
						//$forexdeal = " INSERT INTO fd_dealslip (fds_deal_serial)
                        //VALUES(UPPER('$fds_deal_number'))";  
	                    //$result  = @mysql_query($forexdeal);	
					
						
                        ?>
                                    <strong>
                                    <input name="number" class="style33" id="number" type="hidden"   style="border:none;text-transform:uppercase;" value="<?php echo "$fds_deal_number".".".date("d", time()).".".date("m", time()); ?>" size="17">
									
                                    <?php echo "$fds_deal_number".".".date("d", time()).".".date("m", time()); ?>
                                    <input name="snumber" class="style26" id="snumber" type="hidden" style="border:none;text-transform:uppercase;" value="<?php echo "$fds_deal_number"; ?>" size="17">
                                </strong></div></td>
                                <td width="14%" nowrap ><div align="left">TIME: </div>
                                    <div align="left"></div></td>
                                <td width="53%" align="left" nowrap ><div align="left"> <?php echo date("H:i:s", time()); ?> <strong>
                                    <input name="fds_deal_time" class="style26" id="fds_deal_time" type="hidden" style="border:none;text-transform:uppercase;" value="<?php echo date("H:i:s", time()); ?>" size="17">
                                </strong></div></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                      <tr class="style3">
                        <td height="30" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left" class="style3">DEAL DATE: </div></td>
                        <td align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style3">
                                <td width="33%" height="35" align="left" nowrap ><div align="left">
                                    <input name="fds_deal_date"  type="hidden" class="style24" id="fds_deal_date" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" value="<?php echo date("d-m-Y", time()); ?>" size="8">
                                    <?php echo date("d-m-Y", time()); ?></div></td>
                                <td width="14%" nowrap ><div align="left">VALUE DATE:</div>
                                    <div align="left"></div></td>
                                <td width="53%" align="left" nowrap ><div align="left">
                                    <input name="fds_value_date" type="text" class="style38" id="fds_value_date" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" value="<?php echo date("d-m-Y", time()); ?>" size="8">
                                </div></td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                      <tr class="style3">
                        <td height="31" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">COUNTER PARTY: </div></td>
                        <td align="left" nowrap ><div align="left">
							<select name="fds_counter_party">
                            <option value="0">--Select Counter Party--</option>
                            <?php
                            include 'loadcounterparty.php';
							?>
                            </select>
                        </div></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">CURR. &amp; AMOUNT SOLD:</div></td>
                        <td align="left" nowrap ><div align="left">
                            <select name="fds_curr_sold" class="style39" id="fds_curr_sold">
                              <option value="CURRENCY">CURRENCY</option>
                              <option value="TZS">TZS</option>
                              <option value="USD">USD</option>
                              <option value="EUR">EUR</option>
                              <option value="GBP">GBP</option>
                              <option value="ZAR">ZAR</option>
							  <option value="KYS">KYS</option>
                            </select>
                      :
                      <input name="fds_curr_amount_sold" type="text" class="style39" id="fds_curr_amount_sold" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" size="17" >
                        </div></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">RATE:</div></td>
                        <td align="left" nowrap ><div align="left">
                            <input name="fds_rate" type="text" class="style39" id="fds_rate" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" size="17">
                        </div></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">CURR. &amp; AMOUNT BOUGHT :</div></td>
                        <td align="left" nowrap ><select name="fds_curr_bought" class="style39" id="fds_curr_bought">
                            <option value="CURRENCY">CURRENCY</option>
                            <option value="TZS">TZS</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                            <option value="ZAR">ZAR</option>
							<option value="KYS">KYS</option>
                          </select>
                    :
                    <input name="fds_curr_amount_bought" type="text" class="style39" id="fds_curr_amount_bought" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" size="17">
                        </td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">DEAL CONFIRMED WITH: </div></td>
                        <td align="left" nowrap ><table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                            <tr class="style35">
                              <td width="33%" height="35" align="left" nowrap ><div align="left">
                                  <input name="fds_confirmed_with" type="text" class="style39" id="fds_confirmed_with" style="border-bottom: 1px solid #7F9DB9; text-transform:uppercase;" size="30">
                              </div></td>
                              <td width="14%" nowrap class="style3" ><div align="left">BANK M DEALER:</div>
                                  <div align="left"></div></td>
                              <td width="53%" align="left" nowrap class="style3" ><div align="left">
                                  <select name="fds_bankm_dealer" class="style39" id="fds_bankm_dealer">
                                    <option value="Select Bank M Dealer">Select Bank M Dealer</option>
                                      <option value="Angela Odhiambo">Angela Odhiambo</option>
                                      <option value="Ali Khaki">Ali Khaki</option>
                            		  <option value="Amour Muro">Amour Muro</option>
                                      <option value="Ebrahim Mamoon">Ebrahim Mamoon</option>
                            		  <option value="Punita Shah">Punita Shah</option>
                                       <option value="Tunu Makuburi">Tunu Makuburi</option>
                                        <option value="Aliakber Kermalih">Aliakber Kermali</option>
                                         <option value="Kumail Abbas">Kumail Abbas</option>
                                  </select>
                              </div></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">PHONE/ MOBILE NO.: </div></td>
                        <td align="left" nowrap ><table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                            <tr class="style35">
                              <td width="33%" height="35" align="left" nowrap ><div align="left">
                                  <input name="fds_mobile" type="text" class="style39" id="fds_mobile" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" size="17">
                              </div></td>
                              <td width="14%" nowrap ><div align="left" class="style3">TIME: </div>
                                  <div align="left"></div></td>
                              <td width="53%" align="left" nowrap ><div align="left">
                                  <input name="fds_confirmed_time" type="text" class="style39" id="fds_confirmed_time" style="border-bottom: 1px solid #7F9DB9;text-transform:uppercase;" value="<?php echo date("H:i:s", time()); ?>" size="8">
                              </div></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap ><div align="left">SPL. INSTRUCTION:</div></td>
                        <td align="left" nowrap ><input name="fds_spl_instruction" type="text" class="style39" id="fds_spl_instruction" style="border-bottom: 1px solid #7F9DB9; text-transform:uppercase;" size="74"></td>
                      </tr>
                      <tr class="style3">
                        <td height="35" align="right" nowrap >&nbsp;</td>
                        <td align="left" nowrap >CUSTOMER E-MAIL ID:</td>
                        <td align="left" nowrap ><input name="fds_spl_email" type="text" class="style39" id="fds_spl_email" style="border-bottom: 1px solid #7F9DB9; text-transform:lowercase;" size="74"></td>
                      </tr>
                    </table>
                    <table width="100%" height="31"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" style="border-bottom: 1px solid #7F9DB9;">
                      <tr class="style35">
                        <td width="21%" height="31" align="left" nowrap ><div align="right" class="style45"></div></td>
                        <td width="79%" align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style35">
                                <td width="2%" height="35" align="left" nowrap class="style49" > Action </td>
                              </tr>
                            </table>
                        </div></td>
                      </tr>
                    </table>                    
                    <table width="100%" height="31"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                      <tr class="style35">
                        <td width="21%" height="31" align="left" nowrap ><div align="right" class="style45"></div></td>
                        <td width="79%" align="left" nowrap ><div align="left">
                            <table width="100%" height="35"  border="0" align="center" cellpadding="0" cellspacing="0" class="style32" >
                              <tr class="style35">
                                <td width="2%" height="35" align="left" nowrap class="style49" ><a href="index.php">
                                    <input name="Reset" type="reset" class="style39" value="Page Refresh">
                                    </a>&nbsp;<a href="search.php">&nbsp; </a>                                <input name="Reset" type="reset" class="style39" value="Cancel" >
&nbsp;<a href="search.php">&nbsp; </a>
              <input name="Submit" type="submit" class="style43" value="Save &amp; Print" >
&nbsp;<a href="search.php">&nbsp;
              <input name="Button" type="button" class="style38" value="Deal Maintainance" >
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
