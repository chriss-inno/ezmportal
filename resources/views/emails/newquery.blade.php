<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #005DAD">
    <tr style="color:#FFF; border-bottom-color:#005DAD;">
        <td align="center" bgcolor="#005DAD"><h3 style="color:#FFF; border-bottom-color:#005DAD;"><strong>Bank M Tanzania plc - System Portal (Help desk)</strong><strong><br/>Support Portal Query Event Details</strong></h3></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><table width="100%"  border="0" align="center" cellpadding="1" cellspacing="0">

                <tr>
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td>Query # </td>
                                <td align="left">{{$query->query_code}}</td>
                                <td>&nbsp;</td>
                                <td><strong>Reported Date</strong></td>
                                <td align="left">{{date("d M, Y H:i",strtotime($query->reporting_Date))}}</td>
                            </tr>
                            <tr>
                                <td><strong>Addressed To </strong></td>
                                <td align="left">{{$query->toDepartment->department_name}}</td>
                                <td>&nbsp;</td>
                                <td><strong>Module </strong></td>
                                <td align="left">{{$query->module->module_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>Criticality </strong></td>
                                <td align="left">{{$query->critical_level}}</td>
                                <td>&nbsp;</td>
                                <td><strong>Status </strong></td>
                                <td align="left">{{$query->status}}</td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#f0f2f7" ><strong>Query Description</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF"><?php echo $query->description;?></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#f0f2f7" ><strong>Query Assignment</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td><strong>Assigned to</strong></td>
                                @if($query->assignment != null && $query->assignment !="")
                                    <td style="background-color:#78CD51; color: #FFF;">{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}</td>
                                    <td>{{$query->assignment->assigned_date_time}}</td>
                                @else
                                    <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                    <td></td>
                                @endif
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#f0f2f7" ><strong>Other Details</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="1">
                            <tr>
                                <td><strong>Reported By </strong></td>
                                <td align="left"> {{$query->user->first_name.' '.$query->user->last_name}}</td>
                                <td>&nbsp;</td>
                                <td><table width="100%" align="left" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td nowrap=""><strong>From Department {{$query->fromDepartment->department_name}}</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br></td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><strong>From Branch {{$query->fromDepartment->branch->branch_Name}}</strong></td>
                                <td align="left">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                        </table></td>
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

