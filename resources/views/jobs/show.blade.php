<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>

    <h2 class="font-bold text-lg">{{ $job->title }}</h2>

    <p>
        Tags :
        @foreach ($job->tags as $tag)
            {{ $tag->name }}
        @endforeach
    </p>
    <br>
    <p>
        This posted by {{ $job->employer->name }}
        <br>
        This job pays {{ Number::currency($job->salary, 'USD') }}
    </p>

    @can('edit-job', $job)
        <p>
            <x-button href="/jobs/{{ $job->id }}/edit" class="mt-6">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
