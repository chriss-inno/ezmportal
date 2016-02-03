<!-- Bootstrap -->
<table>
    <thead>
    <tr>
        <th bgcolor="#CCCCCC" colspan="11" align="center">Daily Logged queries</th>

    </tr>
    <tr>
        <th ><strong>SNO</strong></th>
        <th ><strong>QUERY CODE</strong></th>
        <th ><strong>OPEN DATE</strong></th>
        <th ><strong>FROM DEPARTMENT</strong></th>
        <th ><strong>FROM BRANCH</strong></th>
        <th ><strong>MODULE</strong></th>
        <th ><strong>DESCRIPTIONS</strong></th>
        <th ><strong>STATUS</strong></th>
        <th ><strong>CRITICALITY</strong></th>
        <th ><strong>CLOSED DATE</strong></th>
        <th ><strong>PENDING DAYS</strong></th>
        <th ><strong>RESPONSIBLE PERSON</strong></th>

    </tr>
    </thead>
    <tbody>
    <?php $c=1;
     $queries=\App\Query::where('to_department','=',$did)->where('today_date','=',date("Y-m-d"))->get(); //Get all queries under this department
    ?>
    @foreach($queries as $qr)

            <tr id="{{$qr->id}}">
                <td>{{$c++}}</td>
                <td>{{$qr->query_code}}</td>
                <td>{{date("d-M-Y H:i",strtotime($qr->reporting_Date))}}</td>
                <?php $department=\App\Department::find($qr->from_department);?>
                <td>{{$department->department_name}}</td>
                <td>{{$department->branch->branch_Name}}</td>
                <?php $module=\App\Module::find($qr->module_id); ?>
                <td>{{$module->module_name}}</td>
                <td><?php echo $qr->description; ?></td>
                <td>{{$qr->status}}</td>
                <td>{{$qr->critical_level}}</td>
                @if($qr->closed !="" && $qr->closed !=0)
                    <td>{{date("d-M-Y H:i",strtotime($qr->updated_at))}}</td>
                @else
                    <td>Not Closed</td>
                @endif

                @if($qr->closed !="" && $qr->closed !=0)
                    <td>{{$days_between = floor (abs(strtotime($qr->updated_at) - strtotime($qr->reporting_Date)) / 86400)}}</td>
                @else
                    <td>{{$days_between = floor (abs(strtotime(date("Y-m-d H:i")) - strtotime($qr->reporting_Date)) / 86400)}}</td>
                @endif
                <?php $assignment=\App\QueryAssignment::where('query_id','=',$qr->id)->first()?>
                @if($assignment != null && $assignment !="")
                    <td style="background-color:#005DAD; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
                @else
                    <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                @endif
            </tr>
    @endforeach
    <?php
    //load unclossed query
    $queries2=\App\Query::where('to_department','=',$did)->where('closed','=',0)->get(); //Get all queries under this department
    ?>
    <?php $c2=1;?>
    @foreach($queries2 as $qr)

        <tr id="{{$qr->id}}">
            <td>{{$c2++}}</td>
            <td>{{$qr->query_code}}</td>
            <td>{{date("d-M-Y H:i",strtotime($qr->reporting_Date))}}</td>
            <?php $department=\App\Department::find($qr->from_department);?>
            <td>{{$department->department_name}}</td>
            <td>{{$department->branch->branch_Name}}</td>
            <?php $module=\App\Module::find($qr->module_id); ?>
            <td>{{$module->module_name}}</td>
            <td><?php echo $qr->description; ?></td>
            <td>{{$qr->status}}</td>
            <td>{{$qr->critical_level}}</td>
            @if($qr->closed !="" && $qr->closed !=0)
                <td>{{date("d-M-Y H:i",strtotime($qr->updated_at))}}</td>
            @else
                <td>Not Closed</td>
            @endif

            @if($qr->closed !="" && $qr->closed !=0)
                <td>{{$days_between = floor (abs(strtotime($qr->updated_at) - strtotime($qr->reporting_Date)) / 86400)}}</td>
            @else
                <td>{{$days_between = floor (abs(strtotime(date("Y-m-d H:i")) - strtotime($qr->reporting_Date)) / 86400)}}</td>
            @endif
            <?php $assignment=\App\QueryAssignment::where('query_id','=',$qr->id)->first()?>
            @if($assignment != null && $assignment !="")
                <td style="background-color:#005DAD; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
            @else
                <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
