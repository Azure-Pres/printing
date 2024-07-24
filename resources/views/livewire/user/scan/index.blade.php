<div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body {{ $bgClass }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-2 text-titlecase">Scan Batch ID</h5>
{{--                             @if ($verificationMessage)
                                <div class="alert alert-success mb-0">
                                    {{ $verificationMessage }}
                                </div>
                            @endif --}}
                        </div>
                        <div class="form-group mt-3">
                            <label for="barcode"></label>
                            <input wire:model="barcode" type="text" class="form-control" id="barcode" placeholder="Scan or enter batch ID">
                        </div>
                        <!-- Display the last scan message -->
                        @if ($lastScanMessage)
                            <div class="alert alert-info mt-3 mb-0">
                                {{ $lastScanMessage }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            @this.on('duplicateScan', () => {
                alert('Duplicate scan not allowed');
                @this.call('clearBarcode');
            });

            @this.on('batchNotFound', () => {
                alert('Batch ID not found');
                @this.call('clearBarcode');
            });
        });
    </script>
</div>
