<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-12 mb-0">
            <h5 class="mb-2 text-titlecase"></h5>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 mb-2 mt-3">
            {{-- <div class="card">
                <div class="card-body py-2">
                    <h4 class="mb-0 text-sm"></h4>   
                </div>
            </div> --}}        
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">
                                100 <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                            </h4>
                            <p class="mb-0 opacity-50 text-sm">Total Batches Uploaded</p>
                        </div>
                        <a href="{{ url('admin/phonepe-batch-scans/upload') }}" class="btn btn-outline-primary btn-icon-text">
                            Upload Batches
                            <i class="typcn typcn-document btn-icon-append"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">
                                72 <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                            </h4>
                            <p class="mb-0 opacity-50 text-sm">Total Batches Scanned</p>
                        </div>
                        <a href="{{ url('admin/client-uploads') }}" class="btn btn-outline-primary btn-icon-text">
                            Download Report
                            <i class="typcn typcn-document btn-icon-append"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
