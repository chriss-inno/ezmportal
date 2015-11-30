<!-- Bootstrap -->
<table>
    <thead>
    <tr>
        <th bgcolor="#CCCCCC" colspan="11" align="center">Daily Logged queries</th>

    </tr>
    <tr>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>SNO</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>REFERENCE NUMBER</strong> </th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>REPORTED DATE</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>CUSTOMER NAME</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>PRODUCT TYPE</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>STATUS</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>DESCRIPTION</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>RESPONSIBLE DEPARTMENT</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>REMARKS</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>CLOSED DATE</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($issues as $issue)
        <tr>
            <td>{{$c++}}</td>
            <td>{{$issue->issues_number}}</td>
            @if($issue->date_created != null && $issue->date_created !="" )
                <td>{{date("d,M Y",strtotime($issue->date_created))}}</td>
            @else
                <td></td>
            @endif
            <td>{{$issue->customer->company_name}}</td>
            @if($issue->product_id != null && $issue->product_id !="" )
                <td>{{$issue->producttype->product_type}}</td>
            @else
                <td></td>
            @endif
            @if($issue->status_id != null && $issue->status_id !="" )
                <td>{{$issue->status->status_name}}</td>
            @else
                <td></td>
            @endif
            <td>{{$issue->description}}</td>
            @if($issue->department_id != null && $issue->department_id !="" )
                <td>{{$issue->department->department_name}}</td>
            @else
                <td></td>
            @endif
            <td>{{$issue->remarks}}</td>
            @if(strtolower($issue->closed)=="yes" )
                <td>{{date("d,M Y",strtotime($issue->date_resolved))}}</td>
            @else
                <td>NOT CLOSED</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>