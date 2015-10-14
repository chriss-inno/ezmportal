  <!-- Bootstrap -->
{!!HTML::style("css/bootstrap.min.css")!!}
{!!HTML::style("css/bootstrap-reset.css")!!}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-info text-center">Bank M Service Portal Inventory Items Report as of {{date('d, F Y')}}</h2>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="adv-table">
                                <table  class="display table table-bordered table-striped" id="branches">
                                    <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Item Name</th>
                                        <th>IP Address</th>
                                        <th>Item Type</th>
                                        <th>Username</th>
                                        <th>Machine Model</th>
                                        <th>Serial number</th>
                                        <th>USB</th>
                                        <th>Antivirus</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1;?>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$item->item_name}}</td>
                                            <td>{{$item->ip_address}}</td>
                                            @if($item->type_id != null && $item->type_id !="" )
                                                <td>{{$item->type->type_name}}</td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{$item->user_name}}</td>
                                            <td>{{$item->machine_model}}</td>
                                            <td>{{$item->serial_number}}</td>
                                            <td>{{$item->usb}}</td>
                                            <td>{{$item->antivirus}}</td>
                                            @if($item->status =="Working" || $item->status =="working")
                                                <td><span class=" btn btn-success btn-xs"> {{ucwords(strtolower($item->status)) }} </span></td>
                                            @else
                                                <td><span  class=" btn btn-danger btn-xs"> {{ucwords(strtolower($item->status)) }} </span></td>
                                            @endif

                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>