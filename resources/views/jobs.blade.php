<x-layout>
    <x-slot:heading>
        Jobs Page List
    </x-slot:heading>
    <h1>Jobs Page</h1>
    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="jobs/{{$job['id']}}" class="text-blue-500 hover:underline">
                <strong>{{ $job['title'] }}:</strong></a> pays {{ $job['salary'] }} per year. 
        </li>
        @endforeach
    </ul>
</x-layout>