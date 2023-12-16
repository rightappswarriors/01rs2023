<div class="row">
    <div class="col-md-12"><hr/></div>
    <div class="col-md-12 pt-3 pb-2 text-center">
        <h4 class="text-uppercase font-weight-bold" style="font-size:30px ;">List of Details for Change</h4>
    </div>
    <div class="col-md-12">
        <table class="table display" id="example" style="overflow-x: scroll;">
            <thead>
                <tr>
                    <th style="white-space: nowrap; width: 50px;" class="sorting_disabled">Line No.</th>
                    <th style="white-space: nowrap; width: 235px;" class="sorting_disabled">Type of Change</th>
                    <th style="white-space: nowrap; width: 461.458px;" class="sorting_disabled">Remarks</th>
                </tr>
            </thead>
            <tbody>                
                @if (isset($appform_changeaction)) 
                    @php $i=1;  @endphp
                    @foreach ($appform_changeaction as $data)
                    <tr class="odd" role="row">
                        <td class="font-weight-bold">{{$i++}} [{{$data->cat_id}}]</td>
                        <td >{{$data->description}}</td>
                        <td >{{$data->remarks}}</td>
                    </tr> 
                    @endforeach
                @else
                    <tr class="odd" role="row">
                        <td colspan="3">No Changes made yet.</td>
                    </tr> 
                @endif        
            </tbody>
        </table>
    </div>
</div>