<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Upload Data</h5>
        </div>

        <div class="col-sm-12">
            <form class="forms-sample" wire:submit.prevent="modify()">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title mb-0">Upload information</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="file" class="w-100">File 
                                                <a href="javascript:;" wire:click="sample()" class="float-right">Download Sample</a>
                                            </label>
                                            <input wire:model.defer="file" type="file" accept=".xlsx, .xls, .csv" class="form-control" id="file">
                                            <x-basic.message class="text-danger" :message="$errors->has('file')?$errors->first('file'):''"></x-basic.message>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <a href="{{url('/client/upload-data')}}" class="btn btn-light" >Cancel</a>
                                    </div>
                                    <div class="col-sm-6 mb-2 text-right">
                                        <div wire:loading.remove>
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                        </div>
                                        <div wire:loading>
                                            <a href="javascript:;" class="btn btn-primary mr-2">Please Wait</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>