<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User registration Notification</title>
</head>

<body bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
    <tr>
        <td><table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td align="center"><font style="font-family: Georgia, 'Times New Roman', Times, serif; color:#010101; font-size:24px"><strong> Bank M  Support Services System Portal</strong></font></td>
                </tr>
                <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" valign="top"><font style="font-family: Georgia, 'Times New Roman', Times, serif; color:#010101; font-size:24px"><strong><em>New User Account Details,</em></strong></font></td>
                            </tr>
                            <tr>
                                <td align="left" valign="top">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="width:15%">First Name</td>
                                            <td align="left" valign="top" style="width:35%">{{$user->first_name}}</td>
                                            <td style="width:15%">Last Name</td>
                                            <td align="left" valign="top" style="width:35%">{{$user->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>User ID</td>
                                            <td align="left" valign="top">{{$user->username}}</td>
                                            <td align="left" valign="top"></td>
                                            <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Designation</td>
                                            <td colspan="3" align="left" valign="top">{{$user->designation}}</td>
                                        </tr>
                                        <tr>
                                            <td>mobile #</td>
                                            <td align="left" valign="top">{{$user->phone}}</td>
                                            <td></td>
                                            <td align="left" valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Branch</td>
                                            <td align="left" valign="top">{{$user->branch->branch_Name}}</td>
                                            <td>Department</td>
                                            <td align="left" valign="top">{{$user->department->department_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Registered Date</td>
                                            <td align="left" valign="top">{{$user->created_at}}</td>
                                            <td>Account Status</td>
                                            <td align="left" valign="top">{{$user->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><font style="font-family: Georgia, 'Times New Roman', Times, serif; color:#010101; font-size:24px"><strong><em>Note</em></strong></font></td>
                                        </tr>
                                    </table></td>
                            </tr>
                            <tr>
                                <td width="80%" align="left" valign="top"><ol>
                                        <li>To know full details/all events raised for this query and corresponding attachments please access tool.These are not attached with this mail<br />
                                        </li>
                                        <li>For any further queries please contact or write to support<br />
                                        </li>
                                        <li>This is an autogenerated mail please do not reply, for any queries regarding support portal please write to support@bankm.com<br />
                                        </li>
                                        <li>The details of query are available on Support Portal site: http://bankmportal</li>
                                    </ol>                                </td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table></td>
    </tr>
</table>
</body>
</html>
