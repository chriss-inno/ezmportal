<table width="100%"  border="1" align="center" cellpadding="1" cellspacing="0">
    <tr>
        <td width="153" align="center" bgcolor="#CCCCCC"><h3><strong>Services</strong></h3></td>
        <td colspan="4" align="center" bgcolor="#CCCCCC"><h3><strong>Today service status</strong></h3></td>
    </tr>

    <tr bgcolor="#f0f2f7">
        <td rowspan="2" align="center" bgcolor="#CCCCCC">&nbsp;</td>
        <td colspan="2" align="center" bgcolor="#CCCCCC" ><strong>Downtime</strong></td>
        <td width="69" rowspan="2" align="center" bgcolor="#CCCCCC"><strong>Area affected</strong></td>
        <td width="54" rowspan="2" align="center" bgcolor="#CCCCCC" ><strong>Remarks</strong></td>
    </tr>
    <tr bgcolor="#f0f2f7">
        <td width="136" align="center" bgcolor="#CCCCCC" ><strong>Start time</strong></td>
        <td width="104" align="center" bgcolor="#CCCCCC" ><strong>Restoration</strong></td>
    </tr>

    @foreach(\App\Service::where('email_sent','=','N')->get() as $ser)
        <tr bgcolor="#f0f2f7">
        <?php $serLogs=\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->get()?>
        @if(count($serLogs) > 0)
                <td align="center" bgcolor="#CCCCCC" rowspan="{{count($serLogs)}}">{{$ser->service_name}}
                </td>
                @foreach($serLogs as $sl)
                    <td align="center" >{{$sl->start_time}}</td>
                    <td align="center" >@if($sl->end_time != "" && $sl->end_time != null){{$sl->end_time}} @else Not Sorted @endif</td>
                    <td>
                        @if($sl->areas !="" && $sl->areas !=null && count($sl->areas) > 0)
                              <ol>
                                  @foreach($sl->areas as $area)
                                      <li>{{$area->area_affected}}</li>
                                      @endforeach
                              </ol>
                            @endif
                    </td>
                    <td >{{$sl->remarks}}</td>
        </tr>
                @endforeach

        @else
            <tr bgcolor="#f0f2f7">
                <td align="center" bgcolor="#CCCCCC">{{$ser->service_name}}</td>
                <td align="center" >NIL</td>
                <td align="center" >NIL</td>
                <td align="center">NIL</td>
                <td align="center" >NIL</td>
            </tr>
        @endif

            <?php
            //Update status
            $ser->email_sent='Y';
            $ser->save();
            ?>
    @endforeach
    <tr>
        <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
        <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
        <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
        <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
        <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
</table>