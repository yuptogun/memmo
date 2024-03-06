<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'memmo') }}</title>

  <link rel="stylesheet" href="/fonts/freesans.css" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="container mx-auto max-w-xl">
    <div class="container mx-auto max-w-xl fixed z-10">
      <livewire:layout.navigation />
    </div>
    <div class="bg-paper pt-16 drop-shadow-md">
      <main class="p-6">
        {{ $slot }}
      </main>
    </div>

      <div class="pt-8 pb-4 text-center text-gray-200 text-xs">
        &copy; 2019~ by <a href="https://yuptogun.com/" target="_blank" class="hover:border-b">yuptogun</a>
      </div>
  </div>
</body>

</html>