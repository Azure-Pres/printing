
@if($field[$position]=='azure_with_tnc')
<span class="{{$class}}">APPL Azure press private limited|*T&C Apply</span>
@elseif($field[$position]=='vendor_code')
<span class="{{$class}}">{{$field['vendor_code']??''}}</span>
@elseif($field[$position]=='lot_serial_combined')

<span class="{{$class}}">{{$lot??''}}-{{$lot_s_no??''}}</span>

@else
<span class="{{$class}}">{{$code_data[$field[$position]]??''}}</span>
@endif