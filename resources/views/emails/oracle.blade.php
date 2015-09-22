<!-- Bootstrap -->
<html>
<head>
    <title></title>
</head>
<body>

<p>Team,</p>
<p>Below table has summary of pending issues from My Oracle Support portal</p>


<table border="0" cellspacing="0" cellpadding="0" align="left" width="100%" style="border: 1px solid #000;">
    <thead>
    <tr >
        <td style="border: 1px solid #000;">SN</td>
        <td style="border: 1px solid #000;">Problem Summary</td>
        <td style="border: 1px solid #000;">SR Number</td>
        <td style="border: 1px solid #000;">Product</td>
        <td style="border: 1px solid #000;">Contact</td>
        <td style="border: 1px solid #000;">Status</td>
        <td style="border: 1px solid #000;">Opened</td>
        <td style="border: 1px solid #000;">Last update</td>
        <td style="border: 1px solid #000;">Today's Update</td>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach($issues as $issue)
        <tr>
            <td  style="border: 1px solid #000;">{{$i++}}</td>
            <td style="border: 1px solid #000;">{{$issue->issue_title}}</td>
            <td style="border: 1px solid #000;">{{$issue->sr_number}}</td>
            <td style="border: 1px solid #000;">{{$issue->product}}</td>
            <td style="border: 1px solid #000;">{{$issue->contact}}</td>
            <td style="border: 1px solid #000;">{{$issue->status}}</td>
            <td style="border: 1px solid #000;">{{$issue->date_opened}}</td>
            <td style="border: 1px solid #000;">{{$issue->current_status}}</td>
            <td style="border: 1px solid #000;"> <?php $update=\App\IssuesDailyUpdates::where('issue_id','=',$issue->id)
                        ->orderBy('current_date')->get()->first();
                echo $update->current_update;?></td>
        </tr>
        <?php
        //Update status
        $issue->email_sent='Y';
        $issue->save();
        ?>
    @endforeach
    </tbody>
</table>

</body>
</html>



