<table>
    <thead>
    <tr>
        <th bgcolor="#CCCCCC">SNO</th>
        <th bgcolor="#CCCCCC">QUERY CODE</th>
        <th bgcolor="#CCCCCC">OPEN DATE</th>
        <th bgcolor="#CCCCCC">FROM DEPARTMENT</th>
        <th bgcolor="#CCCCCC">MODULE</th>
        <th bgcolor="#CCCCCC">STATUS</th>
        <th bgcolor="#CCCCCC">CRITICALITY</th>
        <th bgcolor="#CCCCCC">CLOSED DATE</th>
        <th bgcolor="#CCCCCC">PENDING DAYS</th>
        <th bgcolor="#CCCCCC">RESPONSIBLE PERSON</th>

    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($queries as $qr)

        @if($qr->next_check ==null || strtotime($qr->next_check) == strtotime(date("Y-m-d H:i")))
            <tr id="{{$qr->id}}">
                <td>{{$c++}}</td>
                <td>{{$qr->query_code}}</td>
                <td>{{date("d M, Y H:i",strtotime($qr->reporting_Date))}}</td>
                <?php $department=\App\Department::find($qr->from_department);?>
                <td>{{$department->department_name}} ({{$department->branch->branch_Name}})</td>
                <?php $module=\App\Module::find($qr->module_id); ?>
                <td>{{$module->module_name}}</td>
                <td>{{$qr->status}}</td>
                <td>{{$qr->critical_level}}</td>
                @if($qr->closed !="" && $qr->closed !=0)
                    <td>{{date("d M, Y H:i",strtotime($qr->updated_at))}}</td>
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
                    <td style="background-color:#78CD51; color: #FFF;">{{$qr->assignment->user->first_name.' '.$qr->assignment->user->last_name}}</td>
                @else
                    <td style="background-color:#FF6C60; color: #FFF;">Not Assigned</td>
                @endif
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
