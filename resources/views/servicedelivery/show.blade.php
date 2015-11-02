<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Customer Details</legend>
    <div class="form-group">
        <label for="company_name">Company Name</label>
        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$issue->company_name}}" placeholder="Enter company name ">
    </div>
    <div class="form-group">
        <label for="contact_person">Contact Person</label>
        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{$issue->contact_person}}" placeholder="Enter contact person">
    </div>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Issues Details</legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="product_id">Product Type</label>
                <select class="form-control"  id="product_id" name="product_id">
                    @if($issue->product_id != null && $issue->product_id !="")
                        <option value="{{$issue->producttype->id}}" selected>{{$issue->producttype->product_type}}</option>
                    @else
                        <option value="">Select Product Type</option>
                    @endif


                </select>
            </div>
            <div class="col-md-6">
                <label for="product_details_id">Product Details</label>
                <select class="form-control"  id="product_details_id" name="product_details_id">
                    @if($issue->product_details_id != null && $issue->product_details_id !="")
                        <option value="{{$issue->productdetails->id}}" selected>{{$issue->productdetails->details_name}}</option>
                    @else
                        <option value="">Select Product details</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="received_by">Received By</label>
        <input type="text" class="form-control" id="received_by" name="received_by" value="{{$issue->received_by}}" placeholder="Enter received_by">
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <label for="mode_id">Mode of receipt</label>
                <select class="form-control"  id="mode_id" name="mode_id">
                    @if($issue->mode_id != null && $issue->mode_id !="")
                        <option value="{{$issue->receiptmode->id}}" selected>{{$issue->receiptmode->mode_name}}</option>
                    @else
                        <option value="">Select Mode of Receipt </option>
                    @endif
                </select>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
                <label for="status_id">Status</label>
                <select name="status_id" class="form-control" id="status_id">
                    @if($issue->status_id != null && $issue->status_id !="")
                        <option value="{{$issue->status->id}}" selected>{{$issue->status->status_name}}</option>
                    @else
                        <option selected value="">Select Status</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description">Issue Descriptions</label>
        <textarea class="form-control" id="description" name="description" >{{$issue->description}}</textarea>
    </div>
    <div class="form-group">

        <label for="department_id">Department Responsible</label>
        <select name="department_id" class="form-control" id="department_id">
            @if($issue->department_id != null && $issue->department_id !="")
                <option value="{{$issue->department->id}}" selected>{{$issue->department->department_name}}</option>
            @else
                <option selected value="">Select Department</option>
            @endif
        </select>
    </div>
</fieldset>
<div class="form-group">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2 pull-right">
            <a href="#" data-dismiss="modal" class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        </div>
    </div>
</div>


