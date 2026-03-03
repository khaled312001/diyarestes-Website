{{--
 * DIYAR Estates — Main Laravel Layout (app.blade.php)
 *
 * Usage:
 *   @extends('layouts.app')
 *   @section('title', 'Page Title')
 *   @section('description', 'Meta description')
 *   @section('content') ... @endsection
 *
 * Optional sections:
 *   @section('head')     — Extra <head> content (page-specific CSS)
 *   @section('scripts')  — Footer scripts before </body>
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="@yield('description', 'DIYAR Estates — International Real Estate Development & Investment across USA, Egypt & Turkey.')" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  {{-- Open Graph --}}
  <meta property="og:title" content="@yield('title', 'DIYAR Estates') | DIYAR Estates" />
  <meta property="og:description" content="@yield('description', 'Global real estate development with premium projects across USA, Egypt & Turkey.')" />
  <meta property="og:image" content="{{ asset('images/og-image.jpg') }}" />
  <meta property="og:url" content="{{ url()->current() }}" />
  <meta property="og:type" content="website" />

  <title>@yield('title', 'DIYAR Estates') | International Real Estate</title>

  {{-- Tailwind CSS (in production, compile via npm run build) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,700&family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet" />

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  {{-- Custom Design System CSS --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

  {{-- Page-specific head content --}}
  @yield('head')
</head>

<body class="bg-primary text-white">

  {{-- NAVIGATION (shared partial) --}}
  @include('partials.header')

  {{-- MOBILE MENU (shared partial) --}}
  @include('partials.mobile-menu')

  {{-- MAIN CONTENT --}}
  <main>
    @yield('content')
  </main>

  {{-- FOOTER (shared partial) --}}
  @include('partials.footer')

  {{-- Base JavaScript --}}
  <script src="{{ asset('js/app.js') }}"></script>

  {{-- Page-specific scripts --}}
  @yield('scripts')

</body>
</html>
