@props(['message','success'])

@if ($message)
<div {{ $attributes->merge(['class' => 'alert alert-'.($success==false?'danger':'success')]) }} role="alert">
    {{ $message }}
</div>
@endif
