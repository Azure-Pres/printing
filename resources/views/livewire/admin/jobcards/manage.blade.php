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
