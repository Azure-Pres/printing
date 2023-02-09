<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Create Clients</h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" wire:submit.prevent="modify()">
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="old_password">Old Password</label>
                                    <input wire:model.defer="old_password" type="text" class="form-control" id="old_password" placeholder="Email">
                                    <x-basic.message class="text-danger" :message="$errors->has('old_password')?$errors->first('old_password'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input wire:model.defer="new_password" type="text" class="form-control" id="new_password" placeholder="Email">
                                    <x-basic.message class="text-danger" :message="$errors->has('new_password')?$errors->first('new_password'):''"></x-basic.message>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input wire:model.defer="password_confirmation" type="text" class="form-control" id="password_confirmation" placeholder="Email">
                                    <x-basic.message class="text-danger" :message="$errors->has('password_confirmation')?$errors->first('password_confirmation'):''"></x-basic.message>
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
