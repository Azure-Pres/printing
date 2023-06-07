@php
$serials = getSerialNo($data->id);
@endphp

@if($serials['from'])
{{$serials['from']}}
@endif
-
@if($serials['to'])
{{$serials['to']}}
@endif