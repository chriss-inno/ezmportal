<?php $user = unserialize($user); ?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #005DAD">
    <tr style="color:#FFF; border-bottom-color:#005DAD;">
        <td align="center" bgcolor="#005DAD"><h3 style="color:#FFF; border-bottom-color:#005DAD;"><strong>Bank M Tanzania plc - System Portal (Help desk)</strong><strong><br/>
                    Portal registration notification</strong></h3></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <td colspan="4" bgcolor="#005DAD" style="color:#FFFFFF"><strong>User account details,</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"><strong><span style="color:#005DAD">First Name</span></strong></td>
                    <td bgcolor="#FFFFFF"><strong>{{$user->first_name}}</strong></td>
                    <td bgcolor="#FFFFFF"><span style="color:#005DAD"><strong>Last Name</strong></span></td>
                    <td bgcolor="#FFFFFF"><strong>{{$user->last_name}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>User ID</strong></td>
                    <td colspan="3"><strong>{{$user->username}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Designation</strong></td>
                    <td colspan="3"><strong>{{$user->designation}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Mobile #</strong></td>
                    <td colspan="3"><strong>{{$user->phone}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Branch</strong></td>
                    <td><strong>{{$user->branch->branch_Name}}</strong></td>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Department</strong></td>
                    <td><strong>{{$user->department->department_name}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Registered Date</strong></td>
                    <td><strong>{{$user->created_at}}</strong></td>
                    <td bgcolor="#FFFFFF" style="color:#005DAD"><strong>Account Status</strong></td>
                    <td style="color: #FF0000"><strong>{{$user->status}}</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#005DAD" style="color:#FFFFFF"><strong>User login details</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"><strong><span style="color:#005DAD">User Name</span></strong></td>
                    <td colspan="3">{{$user->username}}</td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"><strong><span style="color:#005DAD">Password</span></strong></td>
                    <td colspan="3">{{$password}}</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#005DAD">&nbsp;</td>
    </tr>
</table>
