<?php $queries = unserialize($queries); ?>
        <!-- Bootstrap -->
<html>
<head>
    <title></title>
</head>
<body>

<p>Team,</p>
<p>Below are unassigned queries logged to {{$department}} for the past 15 minutes, Please take time to assign to users</p>


<table width="100%"  border="1" align="center" cellpadding="1" cellspacing="0" style="font-family:Tahoma,Geneva,sans-serif;color: #0f74b8;font-size: 14px;">
    <thead>
    <tr>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">SNO</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Query code</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Reported</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">From Department</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Person Assigned </th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Critical</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Module</th>
        <th bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($queries as $qr)

        <tr id="{{$qr->id}}">
            <td>{{$c++}}</td>
            <td>{{$qr->query_code}}</td>
            <td>{{date("d M, Y H:i",strtotime($qr->reporting_Date))}}</td>
            <?php $department=\App\Department::find($qr->from_department);?>
            <td>{{$department->department_name}} ({{$department->branch->branch_Name}})</td>
            <?php $assignment=\App\QueryAssignment::where('query_id','=',$qr->id)->first()?>
            @if($assignment != null && $assignment !="")
                <td style="background-color:#78CD51; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
            @else
                <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
            @endif
            <td>{{$qr->critical_level}}</td>
            <?php $module=\App\Module::find($qr->module_id); ?>
            <td>{{$module->module_name}}</td>
            <td>{{$qr->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
