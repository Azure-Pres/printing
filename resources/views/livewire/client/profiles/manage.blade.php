<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Update Profile</h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" wire:submit.prevent="modify()">
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
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input wire:model.defer="city" type="text" class="form-control" id="city" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('city')?$errors->first('city'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input wire:model.defer="state" type="text" class="form-control" id="state" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('state')?$errors->first('state'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="zipcode">Zip Code</label>
                                    <input wire:model.defer="zipcode" type="number" class="form-control" id="zipcode" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('zipcode')?$errors->first('zipcode'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <a href="{{url('/admin')}}" class="btn btn-light" >Cancel</a>
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
