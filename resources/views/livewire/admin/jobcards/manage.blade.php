<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">{{$job_card?'Update':'Create'}} Job Cards</h5>
        </div>

        <form class="forms-sample" wire:submit.prevent="modify()">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="col-sm-6 card-title mb-0">Job card basic information 
                            @if($client)
                            :{{$client->name}}
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="job_card_id">Job Card ID</label>
                                    <input wire:model.defer="job_card_id" type="text" class="form-control" id="job_card_id" placeholder="Job card id">
                                    <x-basic.message class="text-danger" :message="$errors->has('job_card_id')?$errors->first('job_card_id'):''"></x-basic.message>
                                </div>
                            </div>

                            @if($job_card)
                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="batch_id">Select Batch</label>
                                    <input wire:model.defer="batch_id" class="form-control" id="batch_id" hidden />
                                    <input wire:model.defer="batch_code" class="form-control" id="batch_code" readonly/>
                                </div>
                            </div>
                            @else
                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="batch_id">Select Batch</label>
                                    <select wire:model.defer="batch_id" class="form-control" id="batch_id">
                                        <option value="">Please select</option>
                                        @foreach($batches as $batch)
                                        <option value="{{$batch->id}}">{{$batch->batch_code}}</option>
                                        @endforeach
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('batch_id')?$errors->first('batch_id'):''"></x-basic.message>
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="machine">Machine</label>
                                    <select wire:model="machine" class="form-control" id="machine">
                                        <option value="">Select</option>
                                        <option value="VDP">VDP</option>
                                        <option value="Handtop">Handtop</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('machine')?$errors->first('machine'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="print_status">Print status</label>
                                    <select wire:model="print_status" class="form-control" id="print_status">
                                        <option value="">Select</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Ready for Print">Ready for Print</option>
                                        <option value="Printing in Progress">Printing in Progress</option>
                                        <option value="Printed">Printed</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('print_status')?$errors->first('print_status'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="allowed_copies">Allowed copies</label>
                                    <input wire:model.defer="allowed_copies" type="number" min="0" step="1" class="form-control" id="allowed_copies" placeholder="Enter number">
                                    <x-basic.message class="text-danger" :message="$errors->has('allowed_copies')?$errors->first('allowed_copies'):''"></x-basic.message>
                                </div>
                            </div>

                            {{-- <div class="col-sm-4 ">
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

                            <div class="col-sm-4 ">
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
                            </div> --}}

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="remarks">Remarks</label>
                                    <input wire:model.defer="remarks" type="text" class="form-control" id="remarks" placeholder="Remarks">
                                    <x-basic.message class="text-danger" :message="$errors->has('remarks')?$errors->first('remarks'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-4 ">
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

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="divide_in_lot">Divide in lot</label>
                                    <select wire:model.defer="divide_in_lot" wire:change="toggle_lot_size" class="form-control" id="divide_in_lot">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('divide_in_lot')?$errors->first('divide_in_lot'):''"></x-basic.message>
                                </div>
                            </div>

                            @if($show_lot_size)
                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="lot_size">Lot size</label>
                                    <input wire:model.defer="lot_size" type="text" class="form-control" id="lot_size" placeholder="Lot size">
                                    <x-basic.message class="text-danger" :message="$errors->has('lot_size')?$errors->first('lot_size'):''"></x-basic.message>
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-4 ">
                                <div class="form-group mb-2">
                                    <label for="printing_material">Printing Material</label>
                                    <input wire:model.defer="printing_material" type="text" class="form-control" id="printing_material" placeholder="Printing material">
                                    <x-basic.message class="text-danger" :message="$errors->has('printing_material')?$errors->first('printing_material'):''"></x-basic.message>
                                </div>
                            </div>

                            @if($print_status=='Ready for Print' && $machine=='Handtop')
                            <div class="col-sm-12">
                                <div class="form-group mb-2">
                                    <label for="print_file">Print File</label>
                                    <input wire:model.defer="print_file" accept=".pdf" type="file" class="form-control" id="print_file">
                                    <x-basic.message class="text-danger" :message="$errors->has('print_file')?$errors->first('print_file'):''"></x-basic.message>
                                </div>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

            @if($job_card)
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Actions
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <a href="javascript:;" wire:click="downloadCodes()" class="btn btn-primary btn-sm">
                                    <span wire:loading>Please wait</span>
                                    <span wire:loading.remove>Download Codes</span>
                                </a>
                            </div>

                            <div class="col-sm-6">
                                @if($print_status=='Ready for Print')
                                <a href="javascript:;" wire:click="sendForPrint()" class="btn btn-primary btn-sm">
                                    <span wire:loading>Please wait</span>
                                    <span wire:loading.remove>Send for print</span>
                                </a>
                                @endif
                            </div>

                            @if($machine=='Handtop')
                            <div class="col-lg-12 mt-4">
                                <div class="form-group mb-2">
                                    <label for="template">Select Template</label>
                                    <select wire:model.defer="template" class="form-control" id="template">
                                        <option value="">Select</option>
                                        @foreach($templates as $temp)
                                        <option value="{{$temp->id}}">{{$temp->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-basic.message class="text-danger" :message="$errors->has('template')?$errors->first('template'):''"></x-basic.message>
                                </div>

                                <a href="javascript:;" wire:click="preparePdfFile()" class="btn btn-primary btn-sm">
                                    <span wire:loading>Please wait</span>
                                    <span wire:loading.remove>Prepare Pdf file</span>
                                </a>
                            </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
            @endif

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <a href="{{url('/admin/job-cards')}}" class="btn btn-light" >Cancel</a>
                            </div>
                            <div class="col-sm-6 mb-2 text-right">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>
