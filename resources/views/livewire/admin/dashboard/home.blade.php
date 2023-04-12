<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-12 mb-0">
            <h5 class="mb-2 text-titlecase">Welcome to Dashboard</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 mb-2 mt-3">
            <div class="card">
                <div class="card-body py-2">
                    <h4 class="mb-0 text-sm">All Time Summary</h4>   
                </div>
            </div>        
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1"> {{$dashboardData['total_jobcards']}} <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Total Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1"> {{$dashboardData['ready_for_print']}} <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Ready for Print</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1"> {{$dashboardData['printed_jobcards']}} <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Printed Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1"> {{$dashboardData['in_progress']}} <i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">In Progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mb-2 mt-3">
            <div class="card">
                <div class="card-body py-2">
                    <h4 class="mb-0 text-sm">Today Summary</h4>   
                </div>
            </div>        
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['today_total_jobcards']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Total Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['today_ready_for_print']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Ready for Print</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['today_printed_jobcards']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Printed Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['today_in_progress']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">In Progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 mb-2 mt-3">
            <div class="card">
                <div class="card-body py-2">
                    <h4 class="mb-0 text-sm">This Month Summary</h4>   
                </div>
            </div>        
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['month_total_jobcards']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Total Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['month_ready_for_print']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Ready for Print</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['month_printed_jobcards']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">Printed Jobcards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">

                        <div class="ms-2">
                            <h4 class="mb-1">{{$dashboardData['month_in_progress']}}<i class="ti ti-arrow-up-right-circle opacity-50"></i></h4>
                            <p class="mb-0 opacity-50 text-sm">In Progress</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
