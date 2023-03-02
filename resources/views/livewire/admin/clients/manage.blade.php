<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">{{$client?'Update':'Create'}} Clients</h5>
        </div>

        <form class="forms-sample" wire:submit.prevent="modify()">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Client basic information</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="name">Name</label>
                                    <input wire:model.defer="name" type="text" class="form-control" id="name" placeholder="Name">
                                    <x-basic.message class="text-danger" :message="$errors->has('name')?$errors->first('name'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="email">Email address</label>
                                    <input wire:model.defer="email" type="email" class="form-control" id="email" placeholder="Email">
                                    <x-basic.message class="text-danger" :message="$errors->has('email')?$errors->first('email'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="phone">Phone</label>
                                    <input wire:model.defer="phone" type="number" class="form-control" id="phone" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('phone')?$errors->first('phone'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="address">Address</label>
                                    <input wire:model.defer="address" type="text" class="form-control" id="address" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('address')?$errors->first('address'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="city">City</label>
                                    <input wire:model.defer="city" type="text" class="form-control" id="city" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('city')?$errors->first('city'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="state">State</label>
                                    <input wire:model.defer="state" type="text" class="form-control" id="state" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('state')?$errors->first('state'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="zipcode">Zip Code</label>
                                    <input wire:model.defer="zipcode" type="number" class="form-control" id="zipcode" placeholder="Phone">
                                    <x-basic.message class="text-danger" :message="$errors->has('zipcode')?$errors->first('zipcode'):''"></x-basic.message>
                                </div>
                            </div>

                            <div class="col-sm-6 ">
                                <div class="form-group mb-2">
                                    <label for="password">Password</label>
                                    <input wire:model.defer="password" type="password" class="form-control" id="password" placeholder="Password">
                                    <x-basic.message class="text-danger" :message="$errors->has('password')?$errors->first('password'):''"></x-basic.message>
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mb-0">Select applicable code attributes</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($attributes as $key=>$attribute)
                            <div class="col-sm-12 mb-1">
                                <div class="row">
                                    <div class="col-5">
                                        <label class="col-form-label">{{$key+1}}. {{$attribute->name}}</label>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="applicable" {{$client?'disabled readonly':''}}  id="{{$attribute->name}}-applicable" class="form-check-input" type="checkbox" value="{{$attribute->id}}">
                                            <label for="{{$attribute->name}}-applicable">Applicable</label>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-check">
                                            <input wire:model.defer="unique" {{$client?'disabled readonly':''}}  id="{{$attribute->name}}-unique"class="form-check-input" type="checkbox" value="{{$attribute->id}}">
                                            <label  for="{{$attribute->name}}-unique">Unique
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <a href="{{url('/admin/clients')}}" class="btn btn-light" >Cancel</a>
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
