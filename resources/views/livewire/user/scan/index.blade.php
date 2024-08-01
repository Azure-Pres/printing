<div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body {{ $bgClass }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-2 text-titlecase">Scan Batch ID</h5>
                        </div>
                        <div class="form-group mt-3">
                            <label for="barcode"></label>
                            <input wire:model="barcode" type="text" class="form-control" id="barcode" placeholder="Scan or enter batch ID">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($lastScanMessage)
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column border p-2" style="width: 48%;">
                                <p><strong style="font-size: 1rem;">Batch Name:</strong> <span style="font-size: 1rem;">{{ $lastScanMessage['left'] }}</span></p>
                            </div>
                            <div class="d-flex flex-column border p-2" style="width: 48%;">
                                <p><strong style="font-size: 1rem;">Printing Material:</strong> <span style="font-size: 1rem;">{{ $lastScanMessage['right'] }}</span></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column border p-2" style="width: 48%;">
                                <p><strong style="font-size: 1rem;">Status:</strong> <span style="font-size: 1rem;">{{ $lastScanMessage['status'] }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
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

        @this.on('verificationSuccess', () => {
            setTimeout(() => {
                @this.set('bgClass', '');
                }, 1000); // Change the delay time as needed
        });
    });
</script>
</div>