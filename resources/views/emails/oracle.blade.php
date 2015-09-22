{!!HTML::style("css/bootstrap.min.css")!!}
{!!HTML::style("css/bootstrap-reset.css")!!}

{!!HTML::script("js/jquery.js") !!}
{!!HTML::script("js/jquery-1.8.3.min.js") !!}
{!!HTML::script("js/bootstrap.min.js") !!}

<div class="row">
    <div class="col-md-12 col-sm-12">
        <section class="panel">
            <header class="panel-heading">
                <h3 class="text-info"> <strong><i class="fa fa-info"></i> ORACLE SUPPORT LOGGED ISSUES</strong></h3>
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="adv-table">
                            <table  class="display table table-bordered table-striped" id="branches">
                                <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Problem Summary</th>
                                    <th>SR Number</th>
                                    <th>Product</th>
                                    <th>Contact</th>
                                    <th>Opened</th>
                                    <th>Closed</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; ?>
                               @foreach($issues as $issue)
                                    <tr>
                                        <td rowspan="5">{{$i++}}</td>
                                        <td>{{$issue->issue_title}}</td>
                                        <td>{{$issue->sr_number}}</td>
                                        <td>{{$issue->product}}</td>
                                        <td>{{$issue->contact}}</td>
                                        <td>{{$issue->date_opened}}</td>
                                        <td>{{$issue->date_closed}}</td>
                                        <td>{{$issue->status}}</td>

                                    </tr>
                                    <tr>
                                        <th colspan="8">Issue Description</th>
                                    </tr>
                                    <tr>
                                        <td colspan="8"><?php echo $issue->description; ?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="8">Today Update</th>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <?php $update=\App\IssuesDailyUpdates::where('issue_id','=',$issue->id)
                                                    ->orderBy('current_date')->get()->first();
                                            echo $update->current_update;
                                            ?>
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
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>



