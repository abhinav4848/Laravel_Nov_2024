@props(['name'])

@error($name)
		{{-- $message variable is only available inside @error blade directive --}}
		<p class="mt-1 text-xs text-red-500 font-semibold"> {{ $message }} </p>
@enderror

{{-- @if ($errors->any())
		<ul>
				@foreach ($errors->all() as $error)
						<li class="text-red-500 italic">{{ $error }}</li>
				@endforeach
		</ul>
@endif --}}
