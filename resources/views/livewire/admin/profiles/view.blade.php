<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <strong>Customer Details</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{$image}}" class="img-thumbnail border p-2 w-100" alt="">
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Admin Name : </strong>{{$admin->name??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Email : </strong>{{$admin->email??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Phone : </strong>{{$admin->phone??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Address : </strong>{{$admin->address??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2">
                                        <strong>City : </strong>{{$admin->city??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2">
                                        <strong>State : </strong>{{$admin->state??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-2">
                                        <strong>Country : </strong>{{$admin->country??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Pin Code : </strong>{{$admin->zipcode??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Status : </strong>{{$admin->status??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="">
                                        <strong>Joined At : </strong>{{$admin->created_at??'-'}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>