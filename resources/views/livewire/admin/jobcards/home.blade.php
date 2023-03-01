<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">All Job Cards
            </h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{url('admin/job-cards/create')}}" class="btn btn-outline-primary btn-icon-text">
                            Create Job Card
                            <i class="typcn typcn-document btn-icon-append"></i>
                        </a>
                    </h4>
                    <div class="mt-3">
                        <livewire:admin.tables.job-cards-table/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
