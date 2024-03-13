<table>
	<thead>
		<tr>
			<th>serial_no</th>
			<th>batch</th>
			@foreach ($client->getClientAttributes as $key=>$attribute)
			<th>{{$attribute->getCodeAttribute->name}}</th>
			@endforeach

			@if($job_card->divide_in_lot=='Yes')
			<th>lot</th>
			<th>lot_s_no</th>
			@endif
			@if($client->id==4)
			<th>date</th>
			<th>wh</th>
			@endif
			<th>sheet_no</th>
		</tr>
	</thead>

	<tbody>
		@php
		$sheet_no = 1;
		$count = 1;
		@endphp
		@foreach($codes as $code)
		<tr>
			<td>{{$code->serial_no}}</td>
			<td>{{$code->getBatch->batch_code}}</td>

			@php
			$data = json_decode($code->code_data,true);
			@endphp

			@foreach ($client->getClientAttributes as $key=>$attribute)
			<td>{{$data[$attribute->getCodeAttribute->name]??'-'}}</td>
			@endforeach

			@if($job_card->divide_in_lot=='Yes')
			<td>{{$code->lot??''}}</td>
			<td>{{$code->lot_s_no??''}}</td>
			@endif
			@if($client->id==4)
			<td>{{date("M'y")}}</td>
			<td>GW</td>
			@endif
			@if($codes_per_sheet)
			<td>{{$sheet_no}}</td>
			@endif
			@php
			if($count<$codes_per_sheet){
				$count++;
			}
			else{
				$sheet_no++;
				$count=1;
			}
			@endphp
		</tr>
		@endforeach
	</tbody>
</table>