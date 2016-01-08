<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="deal_date">DEAL DATE: </label></div>
        <div class="col-md-3">
            <input type="text" name="deal_date" class="form-control" readonly value="{{date("d-M-Y",strtotime($deal->deal_date))}}">
        </div>
        <div class="col-md-2"><label for="value_date">VALUE DATE: </label></div>
        <div class="col-md-4">
            <input type="text" name="value_date" class="default-date-picker form-control" @if($deal->value_date !="") value="{{date("d-m-Y",strtotime($deal->value_date))}}" @endif required>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party"> COUNTER PARTY: </label></div>
        <div class="col-md-9">
            <select class="form-control" name="counter_party" id="counter_party" required>
                @if($deal->counter_party !="")
                    <option value="{{$deal->customer->id}}">{{$deal->customer->customer}}</option>
                @else
                    <option value="">--Select--</option>
                @endif
                @foreach(\App\ForexCustomer::orderBy('customer','ASC')->get() as $cust)
                    <option value="{{$cust->id}}">{{$cust->customer}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="curr_amount_sold_ccy"> CURR. & AMOUNT SOLD: </label></div>
        <div class="col-md-3">
            <select class="form-control" name="curr_amount_sold_ccy" id="curr_amount_sold_ccy" required>
                @if($deal->curr_amount_sold_ccy !="")
                    <option value="{{$deal->curr_amount_sold_ccy}}">{{$deal->curr_amount_sold_ccy}}</option>
                @else
                    <option value="">--Currency--</option>
                @endif
                @foreach(\App\ForexCurrency::orderBy('currency','ASC')->get() as $cust)
                    <option value="{{$cust->currency}}">{{$cust->currency}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" name="curr_amount_sold" class="form-control" @if($deal->curr_amount_sold !="") value="{{$deal->curr_amount_sold}}" @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party"> RATE: </label></div>
        <div class="col-md-3">
            <input type="text" name="rate" class="form-control" @if($deal->rate !="") value="{{$deal->rate}}" @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="curr_amount_bought_ccy"> CURR. & AMOUNT BOUGHT : </label></div>
        <div class="col-md-3">
            <select class="form-control" name="curr_amount_bought_ccy" id="curr_amount_bought_ccy">
                @if($deal->curr_amount_bought_ccy !="")
                    <option value="{{$deal->curr_amount_bought_ccy}}">{{$deal->curr_amount_bought_ccy}}</option>
                @else
                    <option value="">--Currency--</option>
                @endif
                @foreach(\App\ForexCurrency::orderBy('currency','ASC')->get() as $cust)
                    <option value="{{$cust->currency}}">{{$cust->currency}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <input type="text" name="curr_amount_bought" class="form-control" @if($deal->curr_amount_bought !="") value="{{$deal->curr_amount_bought}}" @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party">DEAL CONFIRMED WITH: </label></div>
        <div class="col-md-3">
            <input type="text" name="confirmed_with" class="form-control" @if($deal->confirmed_with !="") value="{{$deal->confirmed_with}}" @endif>
        </div>
        <div class="col-md-2"><label for="bankm_dealer"> BANK M DEALER: </label></div>
        <div class="col-md-4">
            <select class="form-control" name="bankm_dealer" id="bankm_dealer">
                @if($deal->bankm_dealer !="")
                    <option value="{{$deal->bankm_dealer}}">{{$deal->bankm_dealer}}</option>
                @else
                    <option value="">--Select Bank M Dealer--</option>
                @endif
                @foreach(\App\User::where('right_id','=',9)->where('status','=','Active')->orderBy('first_name','ASC')->get() as $cust)
                    <option value="{{$cust->first_name." ".$cust->last_name}}">{{$cust->first_name." ".$cust->last_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party">PHONE/ MOBILE NO.: </label></div>
        <div class="col-md-3">
            <input type="text" name="mobile" class="form-control" @if($deal->mobile !="") value="{{$deal->mobile}}" @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party">SPL. INSTRUCTION: </label></div>
        <div class="col-md-9">
            <input type="text" name="instruction" class="form-control" @if($deal->instruction !="") value="{{$deal->instruction}}" @endif>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-3"><label for="counter_party">CUSTOMER E-MAIL ID: </label></div>
        <div class="col-md-9">
            <input type="text" name="email" class="form-control" @if($deal->email !="") value="{{$deal->email}}" @endif>
        </div>
    </div>
</div>

</div>

<div class="row">
    <div class="col-md-8 pull-left" id="output"></div>
    <div class="col-md-2 pull-right">
        <a href="#" data-dismiss="modal"  class="btn btn-primary btn-block"> <i class="icon-remove"></i>  Close</a>
    </div>
