<x-layout>
		<x-slot:heading>
				Job: {{ $job['title'] }}
		</x-slot:heading>

		<h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
		<p>This job pays {{ $job['salary'] }} per year.</p>

		@can('edit-job', $job)
				{{-- @can evaluates the edit-job Gate or Policy. So you can define that in the AppServiceProvider  --}}
				<p class="mt-6">
						{{-- attributes can be accessed as array keys or properties. Eloquent allows use of properties --}}
						<x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
				</p>
		@endcan
</x-layout>
