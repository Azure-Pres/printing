@props(['message'])

@if ($message)
<div {{ $attributes->merge(['class' => 'font-medium text-sm text-success']) }}>
    {{ $message }}
</div>
@endif
