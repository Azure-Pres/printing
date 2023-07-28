<a href="{{url('client/upload-data/'.encrypt($data->id).'/details')}}" class="fetch-errors btn btn-sm btn-primary"><i class="typcn typcn-eye"></i></a>

@if($data->status != '2' && $data->status != '3')
<a wire:click="cancel({{$data->id}})" class="fetch-errors btn btn-sm btn-danger"><i class="typcn typcn-times"></i></a>
@endif

<!--  -->
<!-- @if($data->status != '2' && $data->status != '3')
<a wire:click="deleteId({{$data->id}})" data-id="{{encrypt($data->id)}}" data-bs-toggle="modal" data-bs-target
="#deleteModal" class="fetch-errors btn btn-sm btn-danger"><i class="typcn typcn-times"></i></a>
@endif

<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Confirm</h5>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                                <button type="button" wire:click.prevent="cancel()" class="btn btn-danger close-modal" data-bs-dismiss="modal">Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </div> -->
<!--  -->