<!-- Bootstrap -->

<table width="100%">
    <thead>
    <tr>
        <th ><strong>REFERENCE NUMBER</strong> </th>
        <th ><strong>DATE REPORTED </strong></th>
        <th ><strong>CUSTOMER NAME</strong></th>
        <th ><strong>PRODUCT TYPE</strong></th>
        <th ><strong>DESCRIPTION</strong></th>
        <th ><strong>ROOT CAUSE</strong></th>
        <th ><strong>REMARKS</strong></th>
        <th ><strong>RESOLUTION DATE</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($issues as $issue)
        <tr>
            <td>{{$issue->issues_number}}</td>
            @if($issue->date_created != null && $issue->date_created !="" )
                <td>{{date("d-M-Y",strtotime($issue->date_created))}}</td>
            @else
                <td></td>
            @endif
            <td>{{$issue->customer->company_name}}</td>
            @if($issue->product_id != null && $issue->product_id !="" )
                <td>{{$issue->producttype->product_type}}</td>
            @else
                <td></td>
            @endif
            <td class="wrap-text">{{$issue->description}}</td>
            <td class="wrap-text">{{$issue->root_cause}}</td>
            <td  class="wrap-text">{{$issue->remarks}}</td>
            @if(strtolower($issue->closed)=="yes" )
                <td >{{date("d-M-Y",strtotime($issue->date_resolved))}}</td>
            @else
                <td>NOT CLOSED</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>