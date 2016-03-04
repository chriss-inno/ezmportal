<p>Team, </p>
<p>Below  is the update on system service status for today</p>
<table width="100%"  border="1" align="center" cellpadding="1" cellspacing="0">
    <tr>
        <td width="153" align="center" bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;"><h3><strong>Services</strong></h3></td>
        <td colspan="4" align="center"  bgcolor="#0f74b8" style="color:#FFF; border-bottom-color:#0f74b8;"><h3><strong>Today service status</strong></h3></td>
    </tr>

    <tr bgcolor="#f0f2f7">
        <td rowspan="2" align="center" >&nbsp;</td>
        <td colspan="2" align="center"   ><strong>Downtime</strong></td>
        <td width="69" rowspan="2" align="center"  ><strong>Area affected</strong></td>
        <td width="54" rowspan="2" align="center"   ><strong>Remarks</strong></td>
    </tr>
    <tr bgcolor="#f0f2f7">
        <td width="136" align="center"   ><strong>Start time</strong></td>
        <td width="104" align="center"   ><strong>Restoration</strong></td>
    </tr>
    @if(count(\App\ServiceLog::where('logdate','=',date("Y-m-d"))->get()) > 0)
        @foreach(\App\Service::where('email_sent','=','N')->get() as $ser)
            <tr bgcolor="#f0f2f7">
            <?php $serLogs=\App\ServiceLog::where('logdate','=',date("Y-m-d"))->where('service_id','=',$ser->id)->get()?>
            @if(count($serLogs) > 0)
                    <td align="center"  rowspan="{{count($serLogs)}}">{{$ser->service_name}}
                    </td>
                    @foreach($serLogs as $sl)
                        <td align="center" >{{$sl->start_time}}</td>
                        <td align="center" >@if($sl->end_time != "" && $sl->end_time != null){{$sl->end_time}} @else Not Sorted @endif</td>
                        <td>

                                  <ol>
                                      @if($sl->branchAreas != null && count($sl->branchAreas) >0 )
                                      @foreach($sl->branchAreas as $brch)
                                          <li>{{$brch->branch->branch_Name}}</li>
                                          @endforeach
                                      @endif
                                      @if($sl->departmentAreas != null && count($sl->departmentAreas) >0 )
                                          @foreach($sl->departmentAreas as $dpra)
                                              <li>{{$dpra->department->department_name}}</li>
                                          @endforeach
                                      @endif
                                      @if($sl->unitAreas != null && count($sl->unitAreas) >0 )
                                          @foreach($sl->unitAreas as $unar)
                                              <li>{{$unar->unit->unit_name}}</li>
                                          @endforeach
                                    @endif
                                  </ol>

                        </td>
                        <td >{{$sl->remarks}}</td>
            </tr>

                    @endforeach
            @else


            @endif

                <?php
                //Update status
                $ser->email_sent='Y';
                $ser->save();
                ?>
        @endforeach
    @else
        <tr bgcolor="#f0f2f7">
            <td align="center" >NIL</td>
            <td align="center" >NIL</td>
            <td align="center" >NIL</td>
            <td align="center">NIL</td>
            <td align="center" >NIL</td>
        </tr>
        <?php
        //Update status
        foreach(\App\Service::where('email_sent','=','N')->get() as $serV)
            {
                $serV->email_sent='Y';
                $serV->save();
            }
        ?>

        @endif


</table>