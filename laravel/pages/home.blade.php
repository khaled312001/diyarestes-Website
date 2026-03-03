{{--
 * DIYAR Estates — Home Page Blade Template
 *
 * Route: /
 * Route name: home
 * Controller: App\Http\Controllers\HomeController@index
 *
 * Passes:
 *   $featuredProjects  — Collection of 3 featured projects
 *   $stats             — Array of company statistics
--}}
@extends('layouts.app')

@section('title', 'International Real Estate Investment')
@section('description', 'DIYAR Estates — International Real Estate Development & Investment. Premium portfolio across USA, Egypt & Turkey.')

@section('content')

  {{-- ======================================================
       HERO
  ====================================================== --}}
  <section class="hero">
    <div class="hero-bg" style="background-image:url('{{ asset('images/hero-main.jpg') }}');"></div>
    <div class="hero-overlay"></div>

    <div class="container hero-content">
      <div class="max-w-3xl">
        <div class="section-label mb-6" data-reveal>International Real Estate Excellence</div>

        <h1 class="heading-xl font-bold text-white mb-7" style="line-height:1.08;" data-reveal data-delay="120">
          Invest in Tomorrow's<br>
          <em class="text-gold not-italic">Prime Real Estate</em>
        </h1>

        <p class="text-lg mb-12 max-w-xl leading-relaxed" style="color:rgba(255,255,255,0.68);" data-reveal data-delay="240">
          A globally trusted real estate development and investment firm delivering
          exceptional results across the United States, Egypt, and Turkey.
        </p>

        <div class="flex flex-wrap gap-4" data-reveal data-delay="360">
          <a href="{{ route('projects.egypt') }}" class="btn btn-gold">
            Explore Projects <i class="fas fa-arrow-right text-xs ml-1"></i>
          </a>
          <a href="{{ route('investors') }}" class="btn btn-outline">
            Investor Relations
          </a>
        </div>
      </div>
    </div>

    <div class="scroll-cue">
      <span>Scroll</span>
      <div class="scroll-line"></div>
    </div>
  </section>


  {{-- ======================================================
       STATS BAR
  ====================================================== --}}
  <section style="background:#0E1F35; border-top:1px solid rgba(201,168,76,0.1); border-bottom:1px solid rgba(201,168,76,0.1);">
    <div class="container section-pad-sm">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-10 lg:divide-x" style="--tw-divide-opacity:0.08;">
        @foreach($stats as $stat)
          <div class="text-center" data-reveal data-delay="{{ $loop->index * 100 }}">
            <div class="stat-num"
                 data-counter="{{ $stat['value'] }}"
                 data-prefix="{{ $stat['prefix'] ?? '' }}"
                 data-suffix="{{ $stat['suffix'] ?? '' }}">
              {{ ($stat['prefix'] ?? '') . $stat['value'] . ($stat['suffix'] ?? '') }}
            </div>
            <div class="stat-label">{{ $stat['label'] }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </section>


  {{-- ======================================================
       FEATURED PROJECTS
  ====================================================== --}}
  <section class="section-pad bg-primary">
    <div class="container">

      <div class="max-w-xl mb-16">
        <div class="section-label mb-4" data-reveal>Our Portfolio</div>
        <h2 class="heading-lg text-white mb-5" data-reveal data-delay="100">
          Signature <em class="text-gold not-italic">Projects</em>
        </h2>
        <div class="gold-line mb-6" data-reveal data-delay="150"></div>
        <p style="color:rgba(255,255,255,0.55);line-height:1.85;font-size:15px;" data-reveal data-delay="200">
          From luxury hospitality near ancient Egyptian temples to expansive agricultural
          investments and boutique developments across three continents.
        </p>
      </div>

      {{-- Project cards loop — ready for dynamic data --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($featuredProjects as $project)
          @include('partials.project-card', ['project' => $project])
        @endforeach
      </div>

      <div class="text-center mt-14" data-reveal>
        <a href="{{ route('projects.egypt') }}" class="btn btn-outline">
          View All Projects <i class="fas fa-arrow-right text-xs ml-2"></i>
        </a>
      </div>

    </div>
  </section>


  {{-- ======================================================
       WHY INVEST WITH US
  ====================================================== --}}
  <section class="section-pad bg-section">
    <div class="container">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

        <div>
          <div class="section-label mb-5" data-reveal>Why Choose DIYAR</div>
          <h2 class="heading-lg text-white mb-6" style="line-height:1.2;" data-reveal data-delay="100">
            Built on Trust,<br>Driven by <em class="text-gold not-italic">Excellence</em>
          </h2>
          <div class="gold-line mb-6" data-reveal data-delay="150"></div>
          <p style="color:rgba(255,255,255,0.55);font-size:15px;line-height:1.9;max-width:500px;margin-bottom:44px;" data-reveal data-delay="200">
            Over 15 years of building a reputation for exceptional real estate investments
            with strong returns, unwavering integrity, and a truly global perspective.
          </p>

          <div class="space-y-8">
            <div class="flex items-start gap-6 feature-item" data-reveal data-delay="100">
              <div class="icon-box"><i class="fas fa-globe"></i></div>
              <div>
                <h4>Global Expertise</h4>
                <p>Operating across three continents with deep local market knowledge and international investment standards.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 feature-item" data-reveal data-delay="200">
              <div class="icon-box"><i class="fas fa-shield-halved"></i></div>
              <div>
                <h4>Legally Secured Investments</h4>
                <p>All projects are legally vetted, transparently structured, and backed by tangible real estate assets.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 feature-item" data-reveal data-delay="300">
              <div class="icon-box"><i class="fas fa-chart-line"></i></div>
              <div>
                <h4>Consistent Strong Returns</h4>
                <p>Proven track record of above-market returns through strategic development timing and asset selection.</p>
              </div>
            </div>
          </div>

          <div class="mt-12" data-reveal data-delay="400">
            <a href="{{ route('investors') }}" class="btn btn-gold">
              Investor Relations <i class="fas fa-arrow-right text-xs ml-2"></i>
            </a>
          </div>
        </div>

        <div class="relative" data-reveal-right data-delay="100">
          <img src="{{ asset('images/why-invest.jpg') }}"
               alt="DIYAR Estates Building"
               style="width:100%;height:560px;object-fit:cover;display:block;" />
          <div style="position:absolute;bottom:-28px;left:-28px;background:#0A1628;border:1px solid rgba(201,168,76,0.2);padding:28px 36px;min-width:210px;">
            <div style="font-size:9px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#C9A84C;margin-bottom:6px;">Client Satisfaction</div>
            <div style="font-family:'Playfair Display',serif;font-size:3rem;font-weight:700;color:white;line-height:1;">98%</div>
            <div style="font-size:12px;color:rgba(255,255,255,0.35);margin-top:4px;">Investor Retention Rate</div>
          </div>
        </div>

      </div>
    </div>
  </section>


  {{-- ======================================================
       GLOBAL PRESENCE
  ====================================================== --}}
  <section class="section-pad bg-primary">
    <div class="container">
      <div class="text-center mb-16">
        <div class="section-label mb-4" data-reveal>Our Reach</div>
        <h2 class="heading-lg text-white mb-5" data-reveal data-delay="100">
          A Truly <em class="text-gold not-italic">Global</em> Footprint
        </h2>
        <div class="gold-line-c mb-6" data-reveal data-delay="150"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Country cards can also be looped from a $countries collection --}}
        <div class="country-card" data-reveal>
          <div class="country-card-img">
            <img src="{{ asset('images/countries/usa.jpg') }}" alt="United States" loading="lazy" />
          </div>
          <div class="country-card-body">
            <div class="country-tag">Main Headquarters</div>
            <h3>United States</h3>
            <p>Our main HQ drives strategic direction, investor relations, and premier North American real estate operations.</p>
            <div class="country-stats">
              <div class="country-stats-item"><div class="num">12+</div><div class="lbl">Projects</div></div>
              <div class="country-stats-item"><div class="num">$1.2B</div><div class="lbl">Portfolio</div></div>
            </div>
            <a href="{{ route('projects.usa') }}" class="btn btn-outline-gold btn-sm">View USA Projects</a>
          </div>
        </div>

        <div class="country-card" data-reveal data-delay="150">
          <div class="country-card-img">
            <img src="{{ asset('images/countries/egypt.jpg') }}" alt="Egypt" loading="lazy" />
          </div>
          <div class="country-card-body">
            <div class="country-tag">Regional Office</div>
            <h3>Egypt</h3>
            <p>Active development across Upper Egypt with landmark hospitality, agricultural, and land development projects.</p>
            <div class="country-stats">
              <div class="country-stats-item"><div class="num">20+</div><div class="lbl">Projects</div></div>
              <div class="country-stats-item"><div class="num">$850M</div><div class="lbl">Portfolio</div></div>
            </div>
            <a href="{{ route('projects.egypt') }}" class="btn btn-outline-gold btn-sm">View Egypt Projects</a>
          </div>
        </div>

        <div class="country-card" data-reveal data-delay="300">
          <div class="country-card-img">
            <img src="{{ asset('images/countries/turkey.jpg') }}" alt="Turkey" loading="lazy" />
          </div>
          <div class="country-card-body">
            <div class="country-tag">Regional Office</div>
            <h3>Turkey</h3>
            <p>Premium residential and commercial developments in Turkey's most sought-after locations including Istanbul.</p>
            <div class="country-stats">
              <div class="country-stats-item"><div class="num">18+</div><div class="lbl">Projects</div></div>
              <div class="country-stats-item"><div class="num">$500M</div><div class="lbl">Portfolio</div></div>
            </div>
            <a href="{{ route('projects.turkey') }}" class="btn btn-outline-gold btn-sm">View Turkey Projects</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- ======================================================
       CTA
  ====================================================== --}}
  <section style="background:var(--grad-cta);padding:120px 0;position:relative;overflow:hidden;">
    <div class="container relative z-10">
      <div class="max-w-2xl mx-auto text-center">
        <div class="section-label mb-6" data-reveal>Begin Your Investment Journey</div>
        <h2 class="heading-lg text-white mb-6" style="line-height:1.2;" data-reveal data-delay="100">
          Ready to Invest in<br><em class="text-gold not-italic">Premium Real Estate?</em>
        </h2>
        <p style="color:rgba(255,255,255,0.58);font-size:15px;line-height:1.9;margin-bottom:48px;" data-reveal data-delay="200">
          Connect with our investment team and discover exclusive opportunities carefully
          tailored to your financial goals and risk profile.
        </p>
        <div class="flex flex-wrap justify-center gap-4" data-reveal data-delay="300">
          <a href="{{ route('contact') }}" class="btn btn-gold">
            Schedule a Consultation <i class="fas fa-arrow-right text-xs ml-2"></i>
          </a>
          <a href="{{ route('investors') }}" class="btn btn-outline">
            Download Investment Profile
          </a>
        </div>
      </div>
    </div>
  </section>

@endsection
