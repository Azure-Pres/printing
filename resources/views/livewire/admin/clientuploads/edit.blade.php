<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase">Edit Common Fields</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Edit Details</div>
                </div>
                <div class="card-body">
                    @if(count($fields) > 0)
                        <form wire:submit.prevent="saveChanges">
                            @foreach($fields as $key => $field)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{ ucfirst(str_replace('_', ' ', $field['key'])) }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" wire:model.defer="fields.{{ $key }}.value" class="form-control" placeholder="Enter value">
                                    </div>
                                </div>
                            @endforeach
                        </form>
                    @else
                        <div class="alert alert-info">
                            You can only edit the fields which have common values throughout the file. This file does not have common values.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
