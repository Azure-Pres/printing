<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase">Edit Consistent Fields</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Edit Details</div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveChanges">
                        @foreach($fields as $key => $field)
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Key</label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="fields.{{ $key }}.key" class="form-control" value="{{ $key }}" placeholder="Enter key">
                                </div>

                                <label class="col-sm-2 col-form-label">Value</label>
                                <div class="col-sm-4">
                                    <input type="text" wire:model="fields.{{ $key }}.value" class="form-control" value="{{ $field['value'] }}" placeholder="Enter value">
                                </div>
                            </div>
                        @endforeach

{{--                         <div class="row mt-4">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{ url('/admin/client-uploads') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
