{{--
 * DIYAR Estates — Mobile Menu Partial
 * Included in: layouts/app.blade.php
--}}
<div id="mobileMenu" class="mobile-menu">
  <button id="closeMenuBtn" class="absolute top-7 right-7 text-white text-3xl" aria-label="Close menu">
    <i class="fas fa-times"></i>
  </button>

  <a href="{{ route('home') }}"
     class="{{ request()->routeIs('home') ? 'text-gold' : '' }}">Home</a>

  <a href="{{ route('about') }}"
     class="{{ request()->routeIs('about') ? 'text-gold' : '' }}">About</a>

  <a href="{{ route('projects.egypt') }}"
     class="{{ request()->routeIs('projects.egypt*') ? 'text-gold' : '' }}">Egypt Projects</a>

  <a href="{{ route('projects.usa') }}"
     class="{{ request()->routeIs('projects.usa*') ? 'text-gold' : '' }}">USA Projects</a>

  <a href="{{ route('projects.turkey') }}"
     class="{{ request()->routeIs('projects.turkey*') ? 'text-gold' : '' }}">Turkey Projects</a>

  <a href="{{ route('investors') }}"
     class="{{ request()->routeIs('investors') ? 'text-gold' : '' }}">Investors</a>

  <a href="{{ route('contact') }}"
     class="{{ request()->routeIs('contact') ? 'text-gold' : '' }}">Contact</a>

  <a href="{{ route('contact') }}" class="btn btn-gold mt-6">Schedule Consultation</a>
</div>
