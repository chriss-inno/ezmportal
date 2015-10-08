<!-- Bootstrap -->
<html>
<head>
    <title></title>
</head>
<body>

<p>Team,</p>
<p>Below table has summary of pending issues from My Oracle Support portal</p>


<table width="100%"  border="1" align="center" cellpadding="1" cellspacing="0">
    <thead>
    <tr bgcolor="#CCCCCC">
        <td bgcolor="#CCCCCC" >SN</td>
        <td bgcolor="#CCCCCC">Problem Summary</td>
        <td bgcolor="#CCCCCC">SR Number</td>
        <td bgcolor="#CCCCCC" >Product</td>
        <td bgcolor="#CCCCCC">Contact</td>
        <td bgcolor="#CCCCCC">Status</td>
        <td bgcolor="#CCCCCC">Opened</td>
        <td bgcolor="#CCCCCC">Last update</td>
        <td bgcolor="#CCCCCC">Today's Update</td>
    </tr>
    </thead>
    <tbody>
    <?php $i=1;
    $issues=\App\OracleSupport::where('status','=','Opened')->where('email_sent','=','N')->get(); //retrieve all opened issues
    ?>
    @if(count($issues)>0)
    @foreach($issues as $is)

        <tr >
            <td  >{{$i++}}</td>
            <td >{{$is->issue_title}}</td>
            <td >{{$is->sr_number}}</td>
            <td >{{$is->product}}</td>
            <td >{{$is->contact}}</td>
            <td >{{$is->status}}</td>
            <td >{{date('jS F, Y',strtotime($is->date_opened))}}</td>
            <td >{{$is->current_status}}</td>
            <td  bgcolor="#f0f2f7" >
             <?php $update=\App\IssuesDailyUpdates::where('issue_id','=',$is->id)
                                    ->orderBy('current_date','Desc')
                                    ->get()->first();
                    if(count($update) >0 ){
                      echo $update->current_update;
                 }?>
            </td>
        </tr>
        <?php
        //Update status
        $is->email_sent='Y';
        $is->save();
        ?>
    @endforeach
        @endif
    </tbody>
</table>

</body>
</html>



