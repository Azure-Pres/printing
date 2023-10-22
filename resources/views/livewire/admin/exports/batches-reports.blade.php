<table>
	<thead>
		<tr>
			<th>Batch</th>
			<th>Language</th>
			<th>Online Verified</th>
			<th>Offline Verified</th>
		</tr>
	</thead>

	<tbody>

		@foreach($batches as $batch)
		<tr>
			<td>{{$batch->batch}}</td>
			<td>{{$batch->language}}</td>
			<td>{{$batch->first_verified_count}}</td>
			<td>{{$batch->second_verified_count}}</td>
		</tr>
		@endforeach
	</tbody>
</table>