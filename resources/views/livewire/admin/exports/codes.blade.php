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

			<th>date</th>
			<th>wh</th>
		</tr>
	</thead>

	<tbody>
		@php
		$lot = 1;
		$lot_s_no = 1;
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
			<td>{{$lot}}</td>
			<td>{{$lot_s_no}}</td>

			@php

			if ($job_card->lot_size==$lot_s_no) {
				$lot = $lot+1;
				$lot_s_no=0;
			}

			$lot_s_no=$lot_s_no+1;
			@endphp
			@endif

			<td>{{date("M'y")}}</td>
			<td>GW</td>
		</tr>
		@endforeach
	</tbody>
</table>