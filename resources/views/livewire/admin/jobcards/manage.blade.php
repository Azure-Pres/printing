<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Create Job Cards</h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" wire:submit.prevent="modify()">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="job_card_id">Job Card ID</label>
                                    <input wire:model.defer="job_card_id" type="text" class="form-control" id="job_card_id" placeholder="Job card id">
                                    <x-basic.message class="text-danger" :message="$errors->has('job_card_id')?$errors->first('job_card_id'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="machine">Machine</label>
                                    <select wire:model.defer="machine" class="form-control" id="machine">
                                        <option value="">Select</option>
                                        <option value="VDP">VDP</option>
                                        <option value="Handtop">Handtop</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('machine')?$errors->first('machine'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="print_status">Print status</label>
                                    <select wire:model.defer="print_status" class="form-control" id="print_status">
                                        <option value="">Select</option>
                                        <option value="Printed">Printed</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('print_status')?$errors->first('print_status'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="allowed_copies">Allowed copies</label>
                                    <input wire:model.defer="allowed_copies" type="number" min="0" step="1" class="form-control" id="allowed_copies" placeholder="Enter number">
                                    <x-basic.message class="text-danger" :message="$errors->has('allowed_copies')?$errors->first('allowed_copies'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="first_verification_status">First verification status</label>
                                    <select wire:model.defer="first_verification_status" class="form-control" id="first_verification_status">
                                        <option value="">Select</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('first_verification_status')?$errors->first('first_verification_status'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="second_verification_status">Second verification status</label>
                                    <select wire:model.defer="second_verification_status" class="form-control" id="second_verification_status">
                                        <option value="">Select</option>
                                        <option value="Verified">Verified</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('second_verification_status')?$errors->first('second_verification_status'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="remarks">Remarks</label>
                                    <input wire:model.defer="remarks" type="text" class="form-control" id="remarks" placeholder="Remarks">
                                    <x-basic.message class="text-danger" :message="$errors->has('remarks')?$errors->first('remarks'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
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
                                <a href="{{url('/admin/job-cards')}}" class="btn btn-light" >Cancel</a>
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
