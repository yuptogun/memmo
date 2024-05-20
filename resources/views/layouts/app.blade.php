<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name', 'memmo'))</title>

  <meta property="og:type" content="website">
  <meta property="og:url" content="https://memmo.cc">
  <meta property="og:title" content="memmo">
  <meta property="og:image" content="/favicons/apple-touch-icon.png">
  <meta property="og:description" content="this is how every note app works.">
  <meta property="og:site_name" content="memmo">
  <meta property="og:locale" content="en_US">
  <meta property="og:image:width" content="180">
  <meta property="og:image:height" content="180">
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="https://memmo.cc" />
  <meta name="twitter:title" content="memmo" />
  <meta name="twitter:description" content="this is how every note app works." />
  <meta name="twitter:image" content="/favicons/apple-touch-icon.png" />
  <link rel="shortcut icon" href="/favicons/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
  <link rel="manifest" href="/favicons/site.webmanifest">
  <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#624538">
  <meta name="apple-mobile-web-app-title" content="memmo">
  <meta name="application-name" content="memmo">
  <meta name="msapplication-TileColor" content="#624538">
  <meta name="theme-color" content="#624538">
  <link rel="stylesheet" href="/fonts/overused-grotesk.css" />
  @livewireStyles
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
  @livewireScriptConfig
</body>

</html>