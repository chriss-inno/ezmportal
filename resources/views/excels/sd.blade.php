<!-- Bootstrap -->
<table>
    <thead>
    <tr>
        <th bgcolor="#CCCCCC" colspan="11" align="center">Daily Logged queries</th>

    </tr>
    <tr>
        <th ><strong>SNO</strong></th>
        <th ><strong>REFERENCE NUMBER</strong> </th>
        <th ><strong>REPORTED DATE</strong></th>
        <th ><strong>CUSTOMER NAME</strong></th>
        <th ><strong>PRODUCT TYPE</strong></th>
        <th ><strong>STATUS</strong></th>
        <th ><strong>DESCRIPTION</strong></th>
        <th ><strong>RESPONSIBLE DEPARTMENT</strong></th>
        <th ><strong>REMARKS</strong></th>
        <th ><strong>CLOSED DATE</strong></th>
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
                <td>{{$issue->department_id}}</td>
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