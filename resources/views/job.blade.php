<x-layout>
    <x-slot:heading>
        Job: {{$job['title']}}
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{$job['title']}}</h2>
    <ul>
        <p>This job pays {{ $job['salary'] }} per year.</p>
    </ul>
</x-layout>