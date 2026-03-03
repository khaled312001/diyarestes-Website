{{--
 * DIYAR Estates — Navigation Header Partial
 * Included in: layouts/app.blade.php
 *
 * Variables auto-detected:
 *   Route::currentRouteName() — to highlight active nav links
--}}
<nav id="navbar">
  <div class="container flex items-center justify-between">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
      <div class="logo-mark"><span class="logo-letter">D</span></div>
      <div>
        <div class="logo-name">DIYAR</div>
        <div class="logo-sub">Estates</div>
      </div>
    </a>

    {{-- Desktop Navigation --}}
    <div class="hidden lg:flex items-center gap-10">

      <a href="{{ route('home') }}"
         class="nav-link {{ request()->routeIs('home') ? 'text-gold' : '' }}">Home</a>

      <a href="{{ route('about') }}"
         class="nav-link {{ request()->routeIs('about') ? 'text-gold' : '' }}">About</a>

      {{-- Projects Dropdown --}}
      <div class="dropdown">
        <a href="#" class="nav-link flex items-center gap-1 {{ request()->routeIs('projects.*') ? 'text-gold' : '' }}">
          Projects <i class="fas fa-chevron-down text-xs opacity-60 ml-1"></i>
        </a>
        <div class="dropdown-panel">
          <a href="{{ route('projects.egypt') }}" class="{{ request()->routeIs('projects.egypt*') ? 'text-gold' : '' }}">
            <i class="fas fa-circle text-xs mr-2 opacity-40"></i>Egypt Projects
          </a>
          <a href="{{ route('projects.usa') }}" class="{{ request()->routeIs('projects.usa*') ? 'text-gold' : '' }}">
            <i class="fas fa-circle text-xs mr-2 opacity-40"></i>USA Projects
          </a>
          <a href="{{ route('projects.turkey') }}" class="{{ request()->routeIs('projects.turkey*') ? 'text-gold' : '' }}">
            <i class="fas fa-circle text-xs mr-2 opacity-40"></i>Turkey Projects
          </a>
        </div>
      </div>

      <a href="{{ route('investors') }}"
         class="nav-link {{ request()->routeIs('investors') ? 'text-gold' : '' }}">Investors</a>

      <a href="{{ route('contact') }}"
         class="nav-link {{ request()->routeIs('contact') ? 'text-gold' : '' }}">Contact</a>

    </div>

    {{-- CTA + Mobile Toggle --}}
    <div class="flex items-center gap-5">
      <a href="{{ route('contact') }}" class="btn btn-gold btn-sm hidden lg:inline-flex">
        Schedule Consultation
      </a>
      <button id="menuBtn" class="lg:hidden text-white text-xl p-1" aria-label="Open menu">
        <i class="fas fa-bars"></i>
      </button>
    </div>

  </div>
</nav>
