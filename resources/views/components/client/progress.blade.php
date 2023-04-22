<div>
	<div wire:poll.3000ms>
		@php
		$progresses = currentUploadProgresses();
		@endphp

		@foreach($progresses as $progress)
		<div class="alert alert-primary">
			Uploading progress {{$progress->progress_id}}. Total {{$progress->total_rows}} rows. Processed {{$progress->processed_rows}} rows. Uploaded {{$progress->uploaded_rows}} rows.
		</div>
		@endforeach
	</div>
</div>
