
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

                               <tr>
                                   <td>{{$issue->issue_title}}</td>
                                   <td>{{$issue->sr_number}}</td>
                                   <td>{{$issue->product}}</td>
                                   <td>{{$issue->contact}}</td>
                                   <td>{{$issue->date_opened}}</td>
                                   <td>{{$issue->date_closed}}</td>
                                   <td>{{$issue->status}}</td>

                               </tr>


                           </tbody>
                       </table>
                   </div>
                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-12 col-sm-12">
                           <p><h4 class="text-info"><strong><i class="fa fa-envelope-o"></i> Issue daily updates</strong></h4></p>
                           <div class="timeline-messages">
                              @foreach($issue->dailyUpdates as $message)
                               <!-- Comment -->
                               <div class="msg-time-chat">

                                   <div class="message-body msg-in">
                                       <span class="arrow"></span>
                                       <div class="text">
                                           <p class="attribution"><a href="#">{{$message->display_name}}</a> at {{date("h:i A",strtotime($message->dcreated_at))}}, {{date("l, jS F Y",strtotime($message->created_at))}}</p>
                                           <p>{{$message->current_update}}</p>
                                       </div>
                                   </div>
                               </div>
                               @endforeach
                               <!-- /comment -->
                           </div>
                       </div>
                   </div>
               </div>
           </section>
       </div>
   </div>
   <div class="row">
       <div class="col-md-8 pull-left" id="output"></div>
       <div class="col-md-2 pull-right">
           <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
       </div>
   </div>



