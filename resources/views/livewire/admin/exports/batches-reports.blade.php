<table>
	<thead>
		<tr>
			<th>FIle name</th>
			<th>Batch</th>
			<th>Language</th>
		</tr>
	</thead>

	<tbody>

		@foreach($batches as $batch)
		<tr>
			<td>
				{{$batch->file_name}}
			</td>
			<td>
				{{$batch->batch}}
			</td>
			<td>
				{{$batch->language}}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>