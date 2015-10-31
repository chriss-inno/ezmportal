{!!HTML::script("assets/advanced-datatable/media/js/jquery.js")!!}
{!!HTML::script("assets/advanced-datatable/media/js/jquery.dataTables.js") !!}
{!!HTML::script("assets/data-tables/DT_bootstrap.js") !!}

<fieldset class="scheduler-border">
    <legend class="scheduler-border" style="color:#005DAD">Basic product details</legend>

    <div class="form-group">
        <label for="item_name">Product Type</label>
        <input type="text" class="form-control" id="product_type" name="product_type" value="{{$product->product_type}}" placeholder="Enter product type">
    </div>
    <div class="form-group">
        <label for="description"> Details</label>
        <textarea class="form-control" id="details" name="details">{{$product->details}}</textarea>
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

