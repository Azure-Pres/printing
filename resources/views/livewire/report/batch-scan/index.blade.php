<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">All Batches Scanned</h5>
        </div>

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="mt-3">
                        <button wire:click="exportSelected" class="btn btn-primary mb-3">Export Selected</button>
                        <livewire:report.tables.batch-scan-table wire:key="batch-scan-table" wire:target="exportSelected" wire:listen="updateSelectedIds"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
