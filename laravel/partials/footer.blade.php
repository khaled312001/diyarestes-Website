{{--
 * DIYAR Estates — Footer Partial
 * Included in: layouts/app.blade.php
--}}
<footer>
  <div class="container" style="padding-top:80px; padding-bottom:60px;">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

      {{-- Brand --}}
      <div>
        <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline mb-6">
          <div class="logo-mark"><span class="logo-letter">D</span></div>
          <div>
            <div class="logo-name">DIYAR</div>
            <div class="logo-sub">Estates</div>
          </div>
        </a>
        <p class="footer-info mb-6">
          International real estate development and investment with a premium portfolio
          across USA, Egypt &amp; Turkey.
        </p>
        <div class="flex gap-3">
          <a href="{{ config('diyar.social.linkedin', '#') }}" class="social-btn" aria-label="LinkedIn">
            <i class="fab fa-linkedin-in"></i>
          </a>
          <a href="{{ config('diyar.social.facebook', '#') }}" class="social-btn" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="{{ config('diyar.social.instagram', '#') }}" class="social-btn" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="{{ config('diyar.social.twitter', '#') }}" class="social-btn" aria-label="X/Twitter">
            <i class="fab fa-x-twitter"></i>
          </a>
        </div>
      </div>

      {{-- Navigation --}}
      <div>
        <h5 class="footer-heading">Navigation</h5>
        <a href="{{ route('home') }}" class="footer-link">Home</a>
        <a href="{{ route('about') }}" class="footer-link">About Us</a>
        <a href="{{ route('projects.egypt') }}" class="footer-link">Egypt Projects</a>
        <a href="{{ route('projects.usa') }}" class="footer-link">USA Projects</a>
        <a href="{{ route('projects.turkey') }}" class="footer-link">Turkey Projects</a>
        <a href="{{ route('investors') }}" class="footer-link">Investors</a>
        <a href="{{ route('contact') }}" class="footer-link">Contact</a>
      </div>

      {{-- USA HQ --}}
      <div>
        <h5 class="footer-heading">USA Headquarters</h5>
        <div class="space-y-3 footer-info">
          <div class="flex gap-3 items-start">
            <i class="fas fa-location-dot footer-icon"></i>
            <span>United States<br>Main Headquarters</span>
          </div>
          <div class="flex gap-3 items-center">
            <i class="fas fa-envelope footer-icon"></i>
            <a href="mailto:{{ config('diyar.email.general', 'info@diyarestes.com') }}">
              {{ config('diyar.email.general', 'info@diyarestes.com') }}
            </a>
          </div>
          <div class="flex gap-3 items-center">
            <i class="fas fa-globe footer-icon"></i>
            <a href="https://www.diyarestes.com">www.diyarestes.com</a>
          </div>
        </div>
      </div>

      {{-- Branches --}}
      <div>
        <h5 class="footer-heading">Regional Offices</h5>
        <div class="space-y-5 footer-info">
          <div>
            <div style="font-size:11px;font-weight:600;color:rgba(255,255,255,0.65);letter-spacing:1px;margin-bottom:4px;">Egypt Branch</div>
            <p>Egypt Regional Office<br>Upper Egypt Operations</p>
          </div>
          <div>
            <div style="font-size:11px;font-weight:600;color:rgba(255,255,255,0.65);letter-spacing:1px;margin-bottom:4px;">Turkey Branch</div>
            <p>Turkey Regional Office<br>Istanbul &amp; Beyond</p>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{-- Footer Bottom --}}
  <div style="border-top:1px solid rgba(255,255,255,0.05); padding:22px 0;">
    <div class="container flex flex-col md:flex-row justify-between items-center gap-4">
      <p style="font-size:12px; color:rgba(255,255,255,0.22);">
        &copy; {{ date('Y') }} DIYAR Estates. All rights reserved.
      </p>
      <div class="flex gap-6">
        <a href="{{ route('privacy') }}" style="font-size:12px;color:rgba(255,255,255,0.22);text-decoration:none;">Privacy Policy</a>
        <a href="{{ route('terms') }}" style="font-size:12px;color:rgba(255,255,255,0.22);text-decoration:none;">Terms of Use</a>
      </div>
    </div>
  </div>
</footer>
