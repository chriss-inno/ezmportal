<!-- Bootstrap -->
<table border="1">
    <thead>
    <tr>
        <th  colspan="11" align="center">CUSTOMER ISSUES TRACKING AS OF {{date("d-M-Y")}} </th>

    </tr>
    <tr>
        <th ><strong>SNO</strong></th>
        <th ><strong>REFERENCE NUMBER</strong> </th>
        <th ><strong>REPORTED DATE </strong></th>
        <th ><strong>INPUT BY</strong></th>
        <th ><strong>CUSTOMER NAME</strong></th>
        <th ><strong>CONTACT PERSON</strong></th>
        <th ><strong>PRODUCT TYPE</strong></th>
        <th ><strong>RECEIVED BY</strong></th>
        <th ><strong>RECEIVED MODE</strong></th>
        <th ><strong>STATUS</strong></th>
        <th ><strong>DESCRIPTION</strong></th>
        <th ><strong>ROOT CAUSED</strong></th>
        <th ><strong>RESPONSIBLE</strong></th>
        <th ><strong>REMARKS</strong></th>
        <th ><strong>RESOLUTION DATE</strong></th>
        <th ><strong>TAT</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php $c=1;?>
    @foreach($issues as $issue)
        <tr>
            <td>{{$c++}}</td>
            <td>{{$issue->issues_number}}</td>
            @if($issue->date_created_tmt != null && $issue->date_created_tmt !="" )
                <td>{{date("d-M-Y H:i",strtotime($issue->date_created_tmt))}}</td>
            @else
                <td></td>
            @endif
            <td>{{$issue->input_by}}</td>
            @if($issue->customer != null && $issue->customer !="" )
                <td>{{$issue->customer->company_name}}</td>
                <td>{{$issue->customer->contact_person}}</td>
            @else
                <td></td>
                <td></td>
            @endif
            @if($issue->product_id != null && $issue->product_id !="" )
                <td>{{$issue->producttype->product_type}}</td>
            @else
                <td></td>
            @endif
            @if($issue->received_by != null && $issue->received_by !="" )
                <td>{{$issue->received_by}}</td>
            @else
                <td></td>
            @endif
            @if($issue->receiptmode != null && $issue->receiptmode !="" )
                <td>{{$issue->receiptmode->mode_name	}}</td>
            @else
                <td></td>
            @endif
            @if($issue->status_id != null && $issue->status_id !="" )
                <td>{{$issue->status->status_name}}</td>
            @else
                <td></td>
            @endif
            <td class="wrap-text">{{$issue->description}}</td>
            <td class="wrap-text">{{$issue->root_cause}}</td>
            @if($issue->department_id != null && $issue->department_id !="" )
                <td>{{$issue->department_id}}</td>
            @else
                <td></td>
            @endif
            <td  class="wrap-text">{{$issue->remarks}}</td>
            @if(strtolower($issue->closed)=="yes" )
                <td >{{date("d-M-Y",strtotime($issue->date_resolved))}}</td>
            @else
                <td>NOT CLOSED</td>
            @endif
            @if(strtolower($issue->closed)=="yes" )
                <td>{{$days_between = floor (abs(strtotime($issue->updated_at) - strtotime($issue->date_resolved)) / 86400)}}</td>
            @else
                <td>{{$days_between = floor (abs(strtotime(date("Y-m-d H:i")) - strtotime($issue->date_created)) / 86400)}}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>