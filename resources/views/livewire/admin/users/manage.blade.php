<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">{{$user?'Update':'Create'}} Users</h5>
        </div>

        <form class="forms-sample" wire:submit.prevent="modify()">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">User basic information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">
                                    <x-basic.message class="text-danger" :message="$errors->has('name')?$errors->first('name'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input wire:model.defer="email" type="email" class="form-control" id="email" placeholder="Email">
                                    <x-basic.message class="text-danger" :message="$errors->has('email')?$errors->first('email'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input wire:model.defer="phone" type="number" class="form-control" id="phone" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('phone')?$errors->first('phone'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('address')?$errors->first('address'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input wire:model.defer="city" type="text" class="form-control" id="city" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('city')?$errors->first('city'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input wire:model.defer="state" type="text" class="form-control" id="state" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('state')?$errors->first('state'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input wire:model.defer="zipcode" type="number" class="form-control" id="zipcode" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('zipcode')?$errors->first('zipcode'):''"></x-basic.message>
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
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input wire:model.defer="password" type="text" class="form-control" id="password" placeholder="Password">
                                    <x-basic.message class="text-danger" :message="$errors->has('password')?$errors->first('password'):''"></x-basic.message>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Assign Permissions</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 mb-1">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">1. Job Sheet</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="view" id="jobsheet-view" class="form-check-input" type="checkbox" value="jobsheet">
                                            <label for="jobsheet-view">View</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="modify" id="jobsheet-modify" class="form-check-input" type="checkbox" value="jobsheet">
                                            <label  for="jobsheet-modify">Modify
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">2. Printing</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="view"
                                            id="printing-view" wire:click="toggle_printing()" class="form-check-input" type="checkbox" value="printing">
                                            <label for="printing-view">View</label>
                                        </div>
                                    </div>
                                </div>
                                @if($show_printing_options)
                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">Please select machine</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="machines"
                                            id="VDP" class="form-check-input" type="checkbox" value="VDP">
                                            <label for="VDP">VDP</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label class="col-form-label"></label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="machines"
                                            id="Handtop" class="form-check-input" type="checkbox" value="Handtop">
                                            <label for="Handtop">Handtop</label>
                                        </div>
                                    </div>
                                </div>
                                @endif --}}

                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">2. Online Verification</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="view" id="online_verification-view" class="form-check-input" type="checkbox" value="online_verification">
                                            <label for="online_verification-view">View</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="modify" id="online_verification-modify" class="form-check-input" type="checkbox" value="online_verification">
                                            <label  for="online_verification-modify">Modify
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">3. Offline Verification</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="view" id="offline_verification-view" class="form-check-input" type="checkbox" value="offline_verification">
                                            <label for="offline_verification-view">View</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="modify" id="offline_verification-modify" class="form-check-input" type="checkbox" value="offline_verification">
                                            <label  for="offline_verification-modify">Modify
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">4. Batch Printing</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="view" id="batch_printing-view" class="form-check-input" type="checkbox" value="batch_printing">
                                            <label for="batch_printing-view">View</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="modify" id="batch_printing-modify" class="form-check-input" type="checkbox" value="batch_printing">
                                            <label  for="batch_printing-modify">Modify
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-6 mb-2">
                                <a href="{{url('/admin/users')}}" class="btn btn-light" >Cancel</a>
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
