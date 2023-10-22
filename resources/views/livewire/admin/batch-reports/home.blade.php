<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">All Batches Reports
            </h5>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div>
                    <div class="col-sm-6 mt-3">
                        <a href="{{url('admin/batch-reports/exports')}}" class="btn btn-primary w-md mb-1">Export</a>
                    </div>
                    <div class="mt-3">
                        <div class="card table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>{{__('Batch')}}</th>
                                        <th>{{__('Language')}}</th>
                                        <th>{{__('Online Verified')}}</th>
                                        <th>{{__('Offline Verified')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach($batches as $batch)
                                    <tr>
                                        <td>
                                            {{$batch->batch}}
                                        </td>
                                        <td>
                                            {{$batch->language}}
                                        </td>
                                        <td>
                                            {{$batch->first_verified_count}}
                                        </td>
                                        <td>
                                            {{$batch->second_verified_count}}                                    
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>