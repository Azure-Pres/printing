<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <strong>Code Details</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Client Name : </strong>{{$code->getClient->name??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Batch Code : </strong>{{$code->getBatch->batch_code}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Code Data : </strong>{{$code->code_data??'-'}}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-2">
                                        <strong>Status : </strong>{{$code->status??'-'}}
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