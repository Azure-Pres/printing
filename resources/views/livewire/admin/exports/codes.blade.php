<table>
	<thead>
		<tr>
			<th>serial_no</th>
			<th>batch</th>
			@foreach ($client->getClientAttributes as $key=>$attribute)
			<th>{{$attribute->getCodeAttribute->name}}</th>
			@endforeach
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
			<th>{{$data[$attribute->getCodeAttribute->name]??'-'}}</th>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>