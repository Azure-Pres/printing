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
                                                    <select wire:model.defer="client" wire:change="getDataList" class="form-control" id="client">
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
                                            <div class="col-sm-6">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="qr_code.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="qr_code.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="qr_code.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="qr_code.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Dynamic Field</label>
                                                    <select wire:model="qr_code.field"  class="form-control" required>
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
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
                                            <div class="col-sm-6">
                                                <div class="form-group mb-2">
                                                    <label>Applicable</label>
                                                    <select wire:model="side_data.applicable" class="form-control" required>
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="side_data.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="side_data.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="side_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="side_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Font Size</label>
                                                    <input wire:model="side_data.font_size" type="number" class="form-control" placeholder="Font Size" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group mb-2">
                                                    <label>Rotate</label>
                                                    <input wire:model="side_data.rotate" type="number" class="form-control" placeholder="Rotate" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 1</label>
                                                    <select wire:model="side_data.data_one" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 2</label>
                                                    <select wire:model="side_data.data_two" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 3</label>
                                                    <select wire:model="side_data.data_three" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 4</label>
                                                    <select wire:model="side_data.data_four" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
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
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Applicable</label>
                                                    <select wire:model="base_data.applicable" class="form-control" required>
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Left</label>
                                                    <input wire:model="base_data.left" type="number" class="form-control" placeholder="Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Top</label>
                                                    <input wire:model="base_data.top" type="number" class="form-control" placeholder="Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="base_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="base_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group mb-2">
                                                    <label>Font Size</label>
                                                    <input wire:model="base_data.font_size" type="number" class="form-control" placeholder="Font Size" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 1</label>
                                                    <select wire:model="base_data.data_one" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 2</label>
                                                    <select wire:model="base_data.data_two" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 3</label>
                                                    <select wire:model="base_data.data_three" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 4</label>
                                                    <select wire:model="base_data.data_four" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Data 5</label>
                                                    <select wire:model="base_data.data_five" class="form-control">
                                                        <option value="">Please select</option>
                                                        @foreach($data_list as $data)
                                                        <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @if(in_array('vendor_code',[$base_data['data_one'],$base_data['data_two'],$base_data['data_three'],$base_data['data_four'],$base_data['data_five']]))
                                            <div class="col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label>Vendor Code</label>
                                                    <input wire:model="base_data.vendor_code" type="text" class="form-control" placeholder="Vendor Code" required>
                                                </div>
                                            </div>
                                            @endif

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
                                            <div class="col-sm-12 ">
                                                <div class="form-group mb-2">
                                                    <label for="font_style">Select Font Style</label>
                                                    <select wire:model="page_data.font_style" class="form-control" required>
                                                        <option value="">Please select</option>
                                                        <option value="300">SANS Light</option>
                                                        <option value="400">SANS Regular</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Width</label>
                                                    <input wire:model="page_data.width" type="number" class="form-control" placeholder="Width" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Height</label>
                                                    <input wire:model="page_data.height" type="number" class="form-control" placeholder="Height" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Left</label>
                                                    <input wire:model="page_data.margin_left" type="number" class="form-control" placeholder="Margin Left" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Top</label>
                                                    <input wire:model="page_data.margin_top" type="number" class="form-control" placeholder="Margin Top" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Right</label>
                                                    <input wire:model="page_data.margin_right" type="number" class="form-control" placeholder="Margin Right" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 ">
                                                <div class="form-group mb-2">
                                                    <label>Margin Bottom</label>
                                                    <input wire:model="page_data.margin_bottom" type="number" class="form-control" placeholder="Margin Bottom" required>
                                                </div>
                                            </div>

                                            @php
                                            $horizontal_count = 0;
                                            $vertical_count = 0;

                                            if ($master_layout['width']>0) {
                                                $horizontal_count = floor(($page_data['width']-$page_data['margin_left']-$page_data['margin_right'])/$master_layout['width']);
                                            }

                                            if ($master_layout['height']>0) {
                                                $vertical_count = floor(($page_data['height']-$page_data['margin_top']-$page_data['margin_bottom'])/$master_layout['height']);
                                            }
                                            @endphp

                                            <div class="col-sm-12">
                                                <div class="form-group mb-2">
                                                    Count : X({{$horizontal_count}}) * Y({{$vertical_count}}) = {{$horizontal_count*$vertical_count}}
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

                                                @if($side_data['data_one']!='')
                                                <span class="left" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$side_data['data_one']}}</span>
                                                @endif

                                                @if($side_data['data_two']!='')
                                                <span class="left" style="font-family: 'Open Sans'; font-weight:{{$page_data['font_style']}} ">{{$side_data['data_two']}}</span>
                                                @endif

                                                @if($side_data['data_three']!='')
                                                <span class="left" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$side_data['data_three']}}</span>
                                                @endif

                                                @if($side_data['data_four']!='')
                                                <span class="left" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$side_data['data_four']}}</span>
                                                @endif
                                                
                                            </div>
                                            @endif

                                            @if($base_data['applicable'])
                                            <div class="equal-distribute" style="position: absolute; width: {{$base_data['width']}}mm; height: {{$base_data['height']}}mm; top: {{$base_data['top']}}mm; left: {{$base_data['left']}}mm; font-size: {{$base_data['font_size']}}mm; border: 1px solid #ccc;">

                                                @if($base_data['data_one']!='')
                                                <span class="center" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$base_data['data_one']}}</span>
                                                @endif

                                                @if($base_data['data_two']!='')
                                                <span class="center" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$base_data['data_two']}}</span>
                                                @endif

                                                @if($base_data['data_three']!='')
                                                <span class="center" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$base_data['data_three']}}</span>
                                                @endif

                                                @if($base_data['data_four']!='')
                                                <span class="center" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$base_data['data_four']}}</span>
                                                @endif

                                                @if($base_data['data_five']!='')
                                                <span class="center" style="font-family: 'Open Sans'; font-weight: {{$page_data['font_style']}}">{{$base_data['data_five']}}</span>
                                                @endif

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
