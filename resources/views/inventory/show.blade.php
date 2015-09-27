{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

{!! Form::model($item, array('route' => array('inventory.update', $item->id), 'method' => 'PUT','id'=>'InventoryForm')) !!}
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic Item details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-12">
                <label for="type_id">Item Type</label>
                <select class="form-control"  id="type_id" name="type_id" disabled>
                    @if($item->type_id !="")
                        <option value="{{$item->type->id}}">{{$item->type->type_name}}</option>
                    @else
                        <option value="">----</option>
                    @endif

                    <?php $inventories=\App\InventoryType::all();?>
                    @foreach($inventories as $inv)
                        <option value="{{$inv->id}}">{{$inv->type_name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="item_name">Item Name</label>
        <input type="text" class="form-control" id="item_name" name="item_name" value="{{$item->item_name}}" readonly placeholder="Enter Item Name ie Computer name">
    </div>
    <div class="form-group">
        <label for="item_name">Username</label>
        <input type="text" class="form-control" id="user_name" name="user_name" value="{{$item->user_name}}" readonly placeholder="Enter Username">
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="machine_model">Machine Model</label>
                <input type="text" class="form-control" id="machine_model" name="machine_model" value="{{$item->machine_model}}" readonly  placeholder="Enter Item Model">
            </div>
            <div class="col-md-4">
                <label for="serial_number">Serial Number</label>
                <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{$item->serial_number}}" readonly placeholder="Enter Serial Number">
            </div>
            <div class="col-md-4">
                <label for="ip_address">IP Address</label>
                <input type="text" class="form-control" id="item_name" name="ip_address" value="{{$item->ip_address}}" readonly placeholder="Enter IP Address ie 192.168.1.1">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="usb">USB</label>
                <select class="form-control"  id="usb" name="usb" disabled>
                    @if($item->usb != null && $item->usb !="")
                        <option value="{{$item->usb}}" selected>{{$item->usb}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                    <option value="N/A">N/A</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

            </div>
            <div class="col-md-6">
                <label for="antivirus">Antivirus</label>
                <select class="form-control"  id="antivirus" name="antivirus" disabled>
                    @if($item->antivirus != null && $item->antivirus !="")
                        <option value="{{$item->antivirus}}" selected>{{$item->antivirus}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                    <option value="N/A">N/A</option>
                    <option value="Yes">Done</option>
                </select>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label for="description">Item Descriptions</label>
        <textarea class="form-control" id="description" name="description" disabled >{{$item->description}}</textarea>
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Item Location</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="branch_id">Branch</label>
                <select class="form-control"  id="branch_id" name="branch_id" disabled>
                    @if($item->branch_id != null && $item->branch_id !="")
                        <option value="{{$item->branch_id}}" selected>{{$item->branch->branch_Name}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                    <?php $branches=\App\Branch::all();?>
                    @foreach($branches as $br)
                        <option value="{{$br->id}}">{{$br->branch_Name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="department_id">Department</label>
                <select class="form-control"  id="department_id" name="department_id" disabled>
                    @if($item->department_id != null && $item->department_id !="")
                        <option value="{{$item->department_id}}" selected>{{$item->department->department_name}}</option>
                    @else
                        <option value="" selected>----</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
</fieldset>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="status">Status</label>
            <select name="status" class="form-control" id="status" disabled>
                @if($item->status != null && $item->status !="")
                    <option value="{{$item->status}}" selected>{{$item->status}}</option>
                @else
                    <option value="" selected>----</option>
                @endif
                <option value="Working">Working</option>
                <option value="Not Working">Not Working</option>
            </select>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>

    </div>
</div>
{!! Form::close() !!}
