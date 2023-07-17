<div class="content-wrapper">
    <div class="row">
        <div class="col-xl-6 grid-margin stretch-card flex-column">
            <h5 class="mb-2 text-titlecase mb-2">Create Templates</h5>
        </div>

        <div class="col-sm-12">
            <form class="forms-sample" wire:submit.prevent="modify()">
                <div class="row">
                    {{-- style="height: 100vh; scroll-behavior: smooth; overflow-y: scroll;" --}}
                    <div class="col-lg-7">
                        <div class="row">

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Basic Information</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label for="client">Select Client</label>
                                                    <select wire:model.defer="client" class="form-control" id="client">
                                                        <option value="">Please select</option>
                                                        @foreach($clients as $client)
                                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-basic.message class="text-danger" :message="$errors->has('client')?$errors->first('client'):''"></x-basic.message>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Name</label>
                                                    <input wire:model="name" type="text" class="form-control" placeholder="Name" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Master Layout</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="master_layout.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="master_layout.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 ">
                                                <div class="form-group mb-2">
                                                    <label>Master Image</label>
                                                    <input wire:model='master_image' type="file" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Qr Code</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="qr_code.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="qr_code.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="qr_code.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="qr_code.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Side Data</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Applicable</label>
                                                    <select wire:model="side_data.applicable" class="form-control" required>
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="side_data.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="side_data.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="side_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="side_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Font Size</label>
                                                    <input wire:model="side_data.font_size" type="number" class="form-control" placeholder="Font Size" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Rotate</label>
                                                    <input wire:model="side_data.rotate" type="number" class="form-control" placeholder="Rotate" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Base Data</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Applicable</label>
                                                    <select wire:model="base_data.applicable" class="form-control" required>
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="base_data.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="base_data.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="base_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="base_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Font Size</label>
                                                    <input wire:model="base_data.font_size" type="number" class="form-control" placeholder="Font Size" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title mb-0">Page information</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="page_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="page_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Left</label>
                                                    <input wire:model="page_data.margin_left" type="number" class="form-control" placeholder="Margin Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Top</label>
                                                    <input wire:model="page_data.margin_top" type="number" class="form-control" placeholder="Margin Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Right</label>
                                                    <input wire:model="page_data.margin_right" type="number" class="form-control" placeholder="Margin Right" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Bottom</label>
                                                    <input wire:model="page_data.margin_bottom" type="number" class="form-control" placeholder="Margin Bottom" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title mb-0">Output</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div style="position: absolute; width: {{$master_layout['width']}}mm; height: {{$master_layout['height']}}mm; border: 1px solid #ccc;">

                                            @if ($master_image)
                                            <img style="width:100%; height:100%;" src="{{$master_image->temporaryUrl()}}">
                                            @endif

                                            <div style="position: absolute; width: {{$qr_code['width']}}mm; height: {{$qr_code['height']}}mm; top: {{$qr_code['top']}}mm; left: {{$qr_code['left']}}mm; border: 1px solid #ccc;">
                                                <img style="width:100%; height:100%;" src="{{url('/assets/images/qr/qr_demo.png')}}">
                                            </div>

                                            @if($side_data['applicable'])
                                            <div class="equal-distribute" style="position: absolute; width: {{$side_data['width']}}mm; height: {{$side_data['height']}}mm; top: {{$side_data['top']}}mm; left: {{$side_data['left']}}mm; rotate: {{$side_data['rotate']}}deg; font-size: {{$side_data['font_size']}}mm; border: 1px solid #ccc;">
                                                <span class="left">00000000</span>
                                                <span class="left">0000000</span>
                                                <span class="left">000000</span>
                                            </div>
                                            @endif

                                            @if($base_data['applicable'])
                                            <div class="equal-distribute" style="position: absolute; width: {{$base_data['width']}}mm; height: {{$base_data['height']}}mm; top: {{$base_data['top']}}mm; left: {{$base_data['left']}}mm; font-size: {{$base_data['font_size']}}mm; border: 1px solid #ccc;">
                                                <span class="center">00000000</span>
                                                <span class="center">0000000</span>
                                                <span class="center">000000</span>
                                                <span class="center">000</span>
                                                <span class="center">0-0</span>
                                            </div>
                                            @endif

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
                                        <a href="{{url('/admin/templates')}}" class="btn btn-light" >Cancel</a>
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
