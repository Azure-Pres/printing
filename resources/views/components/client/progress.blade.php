<div>
	<div wire:poll.3000ms>
		@php
		$progresses = currentUploadProgresses();
		@endphp

		@foreach($progresses as $progress)
		<div class="alert alert-primary">
			Uploading progress {{$progress->progress_id}}. We have processed {{$progress->processed_rows}} rows.
		</div>
		@endforeach
	</div>
</div>
