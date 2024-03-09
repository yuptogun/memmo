<x-app-layout>
  @section('title', $memmo->title . ' | ' . config('app.name'))
  <h2 class="mb-3 text-lg font-bold">{{ $memmo->title }}</h2>
  <div class="prose">{!! nl2br($memmo->content) !!}</div>
  <div class="flex justify-end items-center mt-3">
    <div class="text-sm text-gray-500">
      {{ $memmo->saved_around }} on <a href="/" target="_blank" class="text-paper-600 hover:text-paper-800">{{ config('app.name') }}</a>
    </div>
  </div>
</x-app-layout>