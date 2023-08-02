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
		</tr>
	</thead>

	<tbody>

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
		</tr>
		@endforeach
	</tbody>
</table>