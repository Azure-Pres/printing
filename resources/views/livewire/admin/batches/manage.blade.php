<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Create Batches</h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" wire:submit.prevent="modify()">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="batch_code">Batch Code</label>
                                    <input wire:model.defer="batch_code" type="text" class="form-control" id="batch_code" placeholder="batch code">
                                    <x-basic.message class="text-danger" :message="$errors->has('batch_code')?$errors->first('batch_code'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="from_serial_number">From Serial Number</label>
                                    <input wire:model.defer="from_serial_number" type="number" class="form-control" id="from_serial_number" placeholder="From serial number">
                                    <x-basic.message class="text-danger" :message="$errors->has('from_serial_number')?$errors->first('from_serial_number'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="to_serial_number">To Serial Number</label>
                                    <input wire:model.defer="to_serial_number" type="number" class="form-control" id="to_serial_number" placeholder="To serial number">
                                    <x-basic.message class="text-danger" :message="$errors->has('to_serial_number')?$errors->first('to_serial_number'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select wire:model.defer="status" class="form-control" id="status">
                                        <option value="">Select</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>    
                                    <x-basic.message class="text-danger" :message="$errors->has('status')?$errors->first('status'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <a href="{{url('/admin/batches')}}" class="btn btn-light" >Cancel</a>
                            </div>
                            <div class="col-sm-6 mb-2 text-right">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>