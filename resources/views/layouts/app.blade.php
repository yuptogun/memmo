<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="/fonts/freesans.css" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="container mx-auto max-w-xl drop-shadow-md">
      <livewire:layout.navigation />

      <!-- Page Content -->
      <main class="bg-paper p-4 sm:p-6 lg:p-8">
        {{ $slot }}
      </main>
  </div>
</body>

</html>