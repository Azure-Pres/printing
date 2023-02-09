<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="mb-4">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                        </div>
                        <h4>Welcome! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form class="pt-3" wire:submit.prevent='login'>
                            <div class="form-group">
                                <input type="email" wire:model='email' class="form-control form-control-lg"
                                placeholder="Enter email" autocomplete="off">
                                <x-basic.message class="text-danger" :message="$errors->has('email')?$errors->first('email'):''"></x-basic.message>
                             </div>
                            <div class="form-group">
                                <input type="password" wire:model='password' class="form-control form-control-lg"
                                placeholder="Enter password" autocomplete="off">
                                <x-basic.message class="text-danger" :message="$errors->has('password')?$errors->first('password'):''"></x-basic.message>
                            </div>
                            <x-basic.alert class="mb-4" :success="$success" :message="$message"></x-basic.alert>
                            <div class="mt-3">
                                <button type="submit"
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                            IN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
