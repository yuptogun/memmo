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
      <livewire:layout.navigation />

      <main class="bg-paper p-6 drop-shadow-md">
        {{ $slot }}
      </main>

      <div class="pt-8 pb-4 text-center text-gray-200 text-xs">
        &copy; 2019~ by <a href="https://yuptogun.com" target="_blank" class="hover:border-b">yuptogun</a>
      </div>
  </div>
</body>

</html>