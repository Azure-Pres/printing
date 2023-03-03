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
                                    <div class="col-sm-6 ">
                                        <div class="form-group mb-3">
                                            <label for="lot_number">Lot Number</label>
                                            <input wire:model.defer="lot_number" type="text" class="form-control" id="lot_number" placeholder="Lot Number">
                                            <x-basic.message class="text-danger" :message="$errors->has('lot_number')?$errors->first('lot_number'):''"></x-basic.message>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 ">
                                        <div class="form-group mb-3">
                                            <label for="lot_size">Lot Size</label>
                                            <input wire:model.defer="lot_size" type="number" min="1" step="1" class="form-control" id="lot_size" placeholder="Lot Size">
                                            <x-basic.message class="text-danger" :message="$errors->has('lot_size')?$errors->first('lot_size'):''"></x-basic.message>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 ">
                                        <div class="form-group mb-3">
                                            <label for="category">Category (Printing material)</label>
                                            <select wire:model.defer="category" class="form-control" id="category">
                                                <option value="">Select</option>
                                                @foreach (printingMaterial() as $category)
                                                <option value="{{$category}}">{{$category}}</option>
                                                @endforeach
                                            </select>    
                                            <x-basic.message class="text-danger" :message="$errors->has('category')?$errors->first('category'):''"></x-basic.message>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 ">
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
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
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