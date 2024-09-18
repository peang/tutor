<x-layout>
  <x-slot:heading>
    Job Page
  </x-slot:heading>

  <h2 class="font-bold text-lg">{{$job->title}}</h2>

  <p>
    Tags :
    @foreach ($job->tags as $tag)
    {{$tag->name}}
  @endforeach
  </p>
  <br>
  <p>
    This posted by {{$job->employer->name}}
    <br>
    This job pays {{Number::currency($job->salary, 'USD')}}
  </p>
</x-layout>