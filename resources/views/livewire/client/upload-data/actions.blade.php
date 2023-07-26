<a href="{{url('client/upload-data/'.encrypt($data->id).'/details')}}" class="fetch-errors btn btn-sm btn-primary"><i class="typcn typcn-eye"></i></a>

@if($data->status != '2' && $data->status != '3')
<a href="javascript::void(0);" wire:click="cancel({{$data->id}})" class="fetch-errors btn btn-sm btn-danger"><i class="typcn typcn-times"></i></a>
@endif