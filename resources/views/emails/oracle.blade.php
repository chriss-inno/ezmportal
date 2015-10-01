<!-- Bootstrap -->
<html>
<head>
    <title></title>
</head>
<body>

<p>Team,</p>
<p>Below table has summary of pending issues from My Oracle Support portal</p>


<table border="0" cellspacing="0" cellpadding="1" align="left" width="800px" style="border: 1px solid #000;">
    <thead>
    <tr >
        <td style="border: 1px solid #000;width: 50px">SN</td>
        <td style="border: 1px solid #000;width: 100px">Problem Summary</td>
        <td style="border: 1px solid #000;width: 100px">SR Number</td>
        <td style="border: 1px solid #000;width: 100px">Product</td>
        <td style="border: 1px solid #000;width: 100px">Contact</td>
        <td style="border: 1px solid #000;width: 100px">Status</td>
        <td style="border: 1px solid #000;width: 100px">Opened</td>
        <td style="border: 1px solid #000;width: 100px">Last update</td>
        <td style="border: 1px solid #000;width: 200px">Today's Update</td>
    </tr>
    </thead>
    <tbody>
    <?php $i=1; ?>
    @foreach($issues as $issue)
        <tr style="border: 1px solid #000;">
            <td  style="border: 1px solid #000;">{{$i++}}</td>
            <td style="border: 1px solid #000;">{{$issue->issue_title}}</td>
            <td style="border: 1px solid #000;">{{$issue->sr_number}}</td>
            <td style="border: 1px solid #000;">{{$issue->product}}</td>
            <td style="border: 1px solid #000;">{{$issue->contact}}</td>
            <td style="border: 1px solid #000;">{{$issue->status}}</td>
            <td style="border: 1px solid #000;">{{date('jS F, Y',strtotime($issue->date_opened))}}</td>
            <td style="border: 1px solid #000;">{{$issue->current_status}}</td>
            <td style="border: 1px solid #000;">
             <?php $update=\App\IssuesDailyUpdates::where('issue_id','=',$issue->id)
                                    ->orderBy('current_date','Desc')
                                    ->get()->first();
                    if(count($update) >0 ){
                      echo $update->current_update;
                 }?>
            </td>
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



