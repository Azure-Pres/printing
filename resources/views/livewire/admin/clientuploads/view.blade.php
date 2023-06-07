<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Client Upload</h5>
        </div>

        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">Upload details</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Progress Id : {{$data->progress_id}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Status : {{uploadStatusText($data->status)}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Date : {{date('M d, Y',strtotime($data->created_at))}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Processed Rows : {{$data->processed_rows}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Uploaded Rows : {{$uploaded_rows}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($data->error_logs)
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">Error Logs</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php
                                $errors = json_decode($data->error_logs,true);
                                @endphp

                                @if (!empty($errors))
                                @foreach ($errors as $key=>$error)
                                <div class="col-sm-12">On row {{$key}} : {{$error}}</div>
                                @endforeach
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
                                    <a href="{{url('/admin/client-uploads')}}" class="btn btn-light" >Go Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
