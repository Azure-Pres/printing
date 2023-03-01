<a href="{{url('admin/job-cards/update/'.encrypt($jobCard->id))}}" class="btn btn-outline-primary btn-icon-text">
  Edit
  <i class="typcn typcn-document btn-icon-append"></i>                          
</a>

{{-- @can('delete', $row)
<div class="cursor-pointer"
wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'destroyRecord', '{{ $row->uuid }}')">
  <i class="typcn typcn-document btn-icon-append"></i>  
</div>
@endcan --}}