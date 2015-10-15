
                                <table>
                                    <thead>
                                    <tr>
                                        <th colspan="10" align="center"> <h2 class="text-info text-center">Bank M Service Portal Inventory Items Report as of {{date('d, F Y')}}</h2></th>
                                    </tr>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Item Name</th>
                                        <th>IP Address</th>
                                        <th>Item Type</th>
                                        <th>Username</th>
                                        <th>Machine Model</th>
                                        <th>Serial number</th>
                                        <th>Operation System</th>
                                        <th>Domain</th>
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
                                            <td>{{$item->platform}}</td>
                                            <td>{{$item->domain}}</td>
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
