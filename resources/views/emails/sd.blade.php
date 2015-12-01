<?php  $issues= \App\CustomerIssues::where("date_created",'=',date("Y-m-d"))->orwhere("closed",'=','No')->get(); ?>
<!-- Bootstrap -->
<html>
<head>
    <title></title>
</head>
<body>

<p>Dear Team,</p>
<p> Below table has summary of daily issues logged on the Service Delivery Customer Issue Tracking Portal.</p>

<table width="100%"  border="1" align="center" cellpadding="1" cellspacing="0">
    <thead>
    <tr>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>SNO</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>REFERENCE NUMBER</strong> </th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>CUSTOMER NAME</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>PRODUCT TYPE</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>STATUS</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>OPEN DATE</strong></th>
        <th bgcolor="#005DAD" style="color:#FFF; border-bottom-color:#005DAD;"><strong>CLOSED DATE</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($issues as $issue)
        <tr>
            <td>{{$c++}}</td>
            <td>{{$issue->issues_number}}</td>
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
            @if($issue->date_created != null && $issue->date_created !="" )
                <td>{{date("d,M Y",strtotime($issue->date_created))}}</td>
            @else
                <td></td>
            @endif
            @if(strtolower($issue->closed)=="yes" )
                <td>{{date("d,M Y",strtotime($issue->date_resolved))}}</td>
            @else
                <td>NOT CLOSED</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</tbody>
</table>

</body>
</html>
