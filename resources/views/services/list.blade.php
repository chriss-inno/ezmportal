<?php $i=1;?>
@foreach($services as $ser)
    <tr>
        <td>{{$i++}}</td>
        <td>{{$ser->service_name}}</td>
        <td>{{$ser->description}}</td>
        <td>{{$ser->status}}</td>
        <td id="{{$ser->id}}" class="text-center">
            <a  href="#" title="Edit Service" class="editService btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            <a href="#b" title="Delete Department" class="deleteuser btn btn-danger btn-xs"><i class="fa fa-trash-o "></i> </a>
        </td>
    </tr>

@endforeach