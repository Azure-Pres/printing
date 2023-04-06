<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Code Details
            </h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-0">Code details</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (json_decode($code->code_data,true) as $key => $data)
                        <div class="col-md-12">
                            <p class="mb-2">
                                <strong>{{$key}} : </strong>{{$data??'-'}}
                            </p>
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
                            <a href="{{url('/admin/codes')}}" class="btn btn-light" >Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
