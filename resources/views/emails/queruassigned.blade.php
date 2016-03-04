<?php $query = unserialize($query); ?>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #0f74b8;font-family:Tahoma,Geneva,sans-serif;color: #0f74b8;font-size: 14px;">
    <tr style="color:#FFF; border-bottom-color:#0f74b8;">
        <td align="center" bgcolor="#0f74b8"><h3 style="color:#FFF; border-bottom-color:#0f74b8;"><strong>Bank M Tanzania plc - System Portal (Help desk)</strong><strong><br/>Support Portal Query Event Details</strong></h3></td>
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
                    <td valign="top" bgcolor="#FFFFFF"><table width="99%" border="0" align="center" cellpadding="1" cellspacing="0" style="font-family:Tahoma,Geneva,sans-serif;color: #0f74b8;font-size: 14px;">
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
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" bgcolor="#f0f2f7"><strong>Query Description</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5"><?php echo $query->description;?></td>
                            </tr>
                            <tr>
                                <td colspan="5">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" bgcolor="#f0f2f7"><strong>Query Assignment</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><strong>Assigned to</strong></td>
                                @if($query->assignment != null && $query->assignment !="")
                                    <td align="left">{{$query->assignment->user->first_name.' '.$query->assignment->user->last_name}}</td>
                                    <td>&nbsp;</td>

                                    <td>Assigned date</td>
                                    <td align="left">{{$query->assignment->assigned_date_time}}</td>
                                @else
                                    <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                    <td>&nbsp;</td>
                                    <td>Assigned date</td>
                                    <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                                @endif
                            </tr>
                            <tr>
                                <td><strong>Assigned By</strong></td>
                                @if($query->assignment != null && $query->assignment !="")
                                    <td align="left">{{$query->assigned_by}}</td>
                                    <td>&nbsp;</td>

                                    <td></td>
                                    <td align="left"></td>
                                @else
                                    <td style="background-color:#FF6C60; color: #FFF;"></td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="5" bgcolor="#f0f2f7"><strong>Other Details</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td align="left">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><strong>Reported By </strong></td>
                                <td colspan="4" align="left">{{$query->user->first_name.' '.$query->user->last_name}}</td>
                            </tr>
                            <tr>
                                <td><strong>From Branch </strong></td>
                                <td align="left">{{$query->fromDepartment->branch->branch_Name}}</td>
                                <td>&nbsp;</td>
                                <td><strong>From Department/Unit</strong></td>
                                <td align="left">@if($query->from_unit != null && $query->from_unit != "") {{$query->fromUnit->unit_name}} @elseif($query->from_department != "" && $query->from_department != null) {{$query->fromDepartment->department_name}} @endif</td>
                            </tr>
                        </table></td>
                </tr>
            </table></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#FFFFFF">&nbsp;</td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#0f74b8">&nbsp;</td>
    </tr>
</table>
