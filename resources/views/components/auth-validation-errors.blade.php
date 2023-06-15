@props(['errors'])

@if ($errors->any())
<div {{ $attributes }}>
    <div class="font-medium text-red-600">
        {{ __('Whoops! Ada yang salah.') }}
    </div>

    <ul class="mt-1 list-disc list-inside text-sm text-red-600">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif