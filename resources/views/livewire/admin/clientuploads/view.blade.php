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
                            @php
                            $serials = getSerialNo($data->id);
                            @endphp
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Client : {{$data->getClient->name}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Progress Id : {{$data->progress_id}}</label>
                                </div>
                                <div class="col-sm-4">
                                    <label>Upload Status : {{uploadStatusText($data->status)}}</label>
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

                                @if($serials['from'])
                                <div class="col-sm-4">
                                    <label>From Serial No : {{$serials['from']}}</label>
                                </div>                                
                                @endif

                                @if($serials['to'])
                                <div class="col-sm-4">
                                    <label>To Serial No : {{$serials['to']}}</label>
                                </div>                                
                                @endif
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
                @else

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title mb-0">Update Production Status</div>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent='modify'>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Status</label>
                                            <select wire:model="production_status" class="form-control">
                                                <option value="Pending">Pending</option>
                                                <option value="In Production">In Production</option>
                                                <option value="Ready">Ready</option>
                                                <option value="Dispatched">Dispatched</option>
                                            </select>
                                            <x-basic.message class="text-danger" :message="$errors->has('production_status')?$errors->first('production_status'):''"></x-basic.message>
                                        </div>
                                    </div>

                                    @if($production_status=='Dispatched')
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="floating-label">Dispatch Details</label>
                                            <input wire:model="dispatch_data" type="text" class="form-control" placeholder="Dispatch details">
                                            <x-basic.message class="text-danger" :message="$errors->has('dispatch_data')?$errors->first('dispatch_data'):''"></x-basic.message>
                                        </div>
                                    </div>
                                    @endif

                                    @if($production_status!='Dispatched')
                                    <div class="col-sm-12 mb-2 text-right">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                    @endif
                                </div>
                            </form>
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
