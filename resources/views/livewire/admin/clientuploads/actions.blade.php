<a href="{{url('admin/client-uploads/view/'.encrypt($data->id))}}" class="btn btn-outline-primary btn-icon-text">
  View
  <i class="typcn typcn-document btn-icon-append"></i>
</a>
<a href="javascript:;" wire:click="addBatch({{$data->id}})" class="btn btn-outline-primary btn-icon-text">
  Send for scan
  <i class="typcn typcn-send btn-icon-append"></i>
</a>