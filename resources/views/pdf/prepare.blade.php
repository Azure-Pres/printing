@php
$master_image = $data['master_image'];
$page_data = $data['page_data'];
$master_layout = $data['master_layout'];
$qr_code = $data['qr_code'];
$base_data = $data['base_data'];
$side_data = $data['side_data'];
@endphp
<html>
<head>
    <style>
        @page {
            margin-left: ['margin_left'];
            margin-top: ['margin_top'];
            margin-right: ['margin_right'];
            margin-bottom: ['margin_bottom'];
        }

        .page-break {
            page-break-after: always;
        }

        .wrapper {
            display: inline-block;
            vertical-align :top;
        }

        .equal-distribute{
            display: table;
            table-layout: fixed; 
        }

        .equal-distribute span.left{
            display: table-cell;
            text-align: left;
        }

        .equal-distribute span.center{
            display: table-cell;
            text-align: center;
        }
    </style>
</head>
<body>
    @foreach($codes as $code)
    @php
    $code_data = json_decode($code->code_data,true);
    $lot = $code->lot??'';
    $lot_s_no = $code->lot_s_no??'';
    @endphp

    <div class="wrapper" style="position: relative; width: {{$master_layout['width']}}mm; height: {{$master_layout['height']}}mm; border: 1px solid #ccc;">

        @if ($master_image)
        <img style="width:100%; height:100%;" src="{{asset($master_image)}}">
        @endif

        <div style="position: absolute; width: {{$qr_code['width']}}mm; height: {{$qr_code['height']}}mm; top: {{$qr_code['top']}}mm; left: {{$qr_code['left']}}mm; ">
            <img style="width:100%; height:100%;" src="data:image/png;base64, {!! base64_encode(QrCode::generate($code_data[$qr_code['field']])) !!} ">
        </div>

        @if($side_data['applicable'])
        <div class="equal-distribute" style="position: absolute; width: {{$side_data['width']}}mm; height: {{$side_data['height']}}mm; top: {{$side_data['top']}}mm; left: {{$side_data['left']}}mm; transform: rotate({{$side_data['rotate']}}deg); font-size: {{$side_data['font_size']}}mm; ">


            @if($side_data['data_one']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $side_data, 'position'=>'data_one', 'class'=>'left'])
            @endif

            @if($side_data['data_two']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $side_data, 'position'=>'data_two', 'class'=>'left'])
            @endif

            @if($side_data['data_three']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $side_data, 'position'=>'data_three', 'class'=>'left'])
            @endif

            @if($side_data['data_four']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $side_data, 'position'=>'data_four', 'class'=>'left'])
            @endif

        </div>
        @endif

        @if($base_data['applicable'])
        <div class="equal-distribute" style="position: absolute; width: {{$base_data['width']}}mm; height: {{$base_data['height']}}mm; top: {{$base_data['top']}}mm; left: {{$base_data['left']}}mm; font-size: {{$base_data['font_size']}}mm; ">

            @if($base_data['data_one']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $base_data, 'position'=>'data_one', 'class'=>'center', 'lot'=>$lot, 'lot_s_no'=> $lot_s_no])
            @endif

            @if($base_data['data_two']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $base_data, 'position'=>'data_two', 'class'=>'center', 'lot'=>$lot, 'lot_s_no'=> $lot_s_no])
            @endif

            @if($base_data['data_three']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $base_data, 'position'=>'data_three', 'class'=>'center', 'lot'=>$lot, 'lot_s_no'=> $lot_s_no])
            @endif

            @if($base_data['data_four']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $base_data, 'position'=>'data_four', 'class'=>'center', 'lot'=>$lot, 'lot_s_no'=> $lot_s_no])
            @endif

            @if($base_data['data_five']!='')
            @include('pdf.data',['code_data'=> $code_data, 'field' => $base_data, 'position'=>'data_five', 'class'=>'center', 'lot'=>$lot, 'lot_s_no'=> $lot_s_no])
            @endif

        </div>
        @endif
    </div>
    @endforeach
</body></html>
