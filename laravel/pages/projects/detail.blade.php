{{--
 * DIYAR Estates — Project Detail Page (Blade)
 *
 * Route: /projects/{country}/{slug}
 * Route name: projects.detail
 *
 * Controller: App\Http\Controllers\ProjectController@show
 * Passes: $project (Eloquent Model or array)
 *
 * Expected $project properties (from DB or config):
 *   title, slug, country, category, location, description, full_description,
 *   hero_image, gallery (array of image paths), masterplan_image, video_url,
 *   investment_highlights (array of key=>value), amenities (array of strings),
 *   lat, lng (for Google Maps)
--}}
@extends('layouts.app')

@section('title', $project['title'])
@section('description', Str::limit($project['description'], 160))

@section('content')

  {{-- PROJECT HERO --}}
  <section class="project-hero">
    <div class="page-hero-bg"
         style="background-image:url('{{ Str::startsWith($project['hero_image'], 'http') ? $project['hero_image'] : Storage::url($project['hero_image']) }}');">
    </div>
    <div class="page-hero-overlay"></div>

    <div class="container" style="position:relative;z-index:2;padding-bottom:64px;">

      {{-- Breadcrumb --}}
      <div class="breadcrumb mb-5">
        <div class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></div>
        <span class="breadcrumb-sep"><i class="fas fa-chevron-right text-xs"></i></span>
        <div class="breadcrumb-item">
          <a href="{{ route('projects.' . strtolower($project['country'])) }}">{{ $project['country'] }} Projects</a>
        </div>
        <span class="breadcrumb-sep"><i class="fas fa-chevron-right text-xs"></i></span>
        <div class="breadcrumb-item active">{{ $project['title'] }}</div>
      </div>

      {{-- Badges --}}
      <div class="flex flex-wrap items-center gap-3 mb-4">
        <span class="card-badge">{{ $project['country'] }}</span>
        <span class="card-badge">{{ $project['category'] }}</span>
        @if(isset($project['status']))
          <span class="card-badge" style="color:rgba(72,187,120,0.9);border-color:rgba(72,187,120,0.3);">
            {{ $project['status'] }}
          </span>
        @endif
      </div>

      {{-- Title --}}
      <h1 class="heading-xl text-white" style="line-height:1.1;max-width:800px;">
        {!! $project['title_html'] ?? e($project['title']) !!}
      </h1>

      {{-- Location --}}
      <p style="color:rgba(255,255,255,0.6);font-size:15px;margin-top:12px;">
        <i class="fas fa-location-dot" style="color:#C9A84C;margin-right:6px;"></i>
        {{ $project['location'] }}
      </p>

    </div>
  </section>


  {{-- OVERVIEW + INVESTMENT HIGHLIGHTS --}}
  <section class="section-pad bg-section">
    <div class="container">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

        {{-- Overview --}}
        <div class="lg:col-span-2">
          <div class="section-label mb-4" data-reveal>Project Overview</div>
          <h2 class="heading-md text-white mb-5" data-reveal data-delay="100">
            {!! $project['subtitle'] ?? 'Project <em class="text-gold not-italic">Details</em>' !!}
          </h2>
          <div class="gold-line mb-7" data-reveal data-delay="150"></div>

          <div style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.95;" data-reveal data-delay="200">
            {!! $project['full_description'] !!}
          </div>

          {{-- Key Metrics --}}
          @if(isset($project['metrics']))
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-5 mt-10" data-reveal data-delay="250">
              @foreach($project['metrics'] as $metric)
                <div style="padding:24px 16px;background:rgba(201,168,76,0.05);border:1px solid rgba(201,168,76,0.15);text-align:center;">
                  <div style="font-family:'Playfair Display',serif;font-size:1.8rem;font-weight:700;color:#C9A84C;">{{ $metric['value'] }}</div>
                  <div style="font-size:9px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.4);margin-top:5px;">{{ $metric['label'] }}</div>
                </div>
              @endforeach
            </div>
          @endif
        </div>

        {{-- Investment Highlights --}}
        <div data-reveal data-delay="150">
          <div class="highlight-box mb-5">
            <h4><i class="fas fa-chart-line" style="color:#C9A84C;margin-right:8px;"></i>Investment Highlights</h4>
            <div class="space-y-4 mt-4">
              @foreach($project['investment_highlights'] as $key => $value)
                <div class="flex justify-between items-center py-3" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                  <span style="font-size:13px;color:rgba(255,255,255,0.5);">{{ $key }}</span>
                  <span style="font-size:14px;font-weight:600;color:#C9A84C;">{{ $value }}</span>
                </div>
              @endforeach
            </div>
          </div>

          <a href="{{ route('contact') }}?project={{ $project['slug'] }}" class="btn btn-gold w-full justify-center mb-3">
            <i class="fas fa-envelope text-xs mr-2"></i> Invest in This Project
          </a>

          <a href="{{ route('projects.brochure', $project['slug']) }}"
             class="btn btn-outline w-full justify-center"
             data-download="{{ $project['slug'] }}_brochure">
            <i class="fas fa-download text-xs mr-2"></i> Download Brochure
          </a>
        </div>

      </div>
    </div>
  </section>


  {{-- IMAGE GALLERY --}}
  @if(isset($project['gallery']) && count($project['gallery']))
    <section class="section-pad bg-primary">
      <div class="container">
        <div class="section-label mb-4" data-reveal>Visual Tour</div>
        <h2 class="heading-md text-white mb-10" data-reveal data-delay="100">
          Project <em class="text-gold not-italic">Gallery</em>
        </h2>
        <div class="gallery-grid" style="grid-template-columns:repeat(3,1fr);" data-reveal>
          @foreach($project['gallery'] as $index => $image)
            <div class="gallery-item {{ $index === 0 ? 'col-span-2' : '' }}"
                 data-lightbox
                 style="height:{{ $index === 0 ? '380px' : '260px' }};">
              <img src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}"
                   alt="{{ $project['title'] }} - Image {{ $index + 1 }}" loading="lazy" />
              <div class="gallery-hover"><i class="fas fa-expand"></i></div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif


  {{-- MASTER PLAN --}}
  @if(isset($project['masterplan_image']))
    <section class="section-pad bg-section">
      <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
          <div>
            <div class="section-label mb-4" data-reveal>Development Layout</div>
            <h2 class="heading-md text-white mb-6" data-reveal data-delay="100">
              Master <em class="text-gold not-italic">Plan</em>
            </h2>
            <div class="gold-line mb-7" data-reveal data-delay="150"></div>
            @if(isset($project['amenities']))
              <ul class="space-y-4" style="color:rgba(255,255,255,0.6);font-size:15px;line-height:1.9;" data-reveal data-delay="200">
                @foreach($project['amenities'] as $amenity)
                  <li class="flex items-center gap-3">
                    <i class="fas fa-check" style="color:#C9A84C;font-size:12px;"></i>
                    {{ $amenity }}
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
          <div class="masterplan-wrap" data-reveal data-delay="150">
            <img src="{{ Str::startsWith($project['masterplan_image'], 'http') ? $project['masterplan_image'] : Storage::url($project['masterplan_image']) }}"
                 alt="{{ $project['title'] }} Master Plan" />
          </div>
        </div>
      </div>
    </section>
  @endif


  {{-- VIDEO --}}
  @if(isset($project['video_url']))
    <section class="section-pad bg-primary">
      <div class="container">
        <div class="text-center mb-12">
          <div class="section-label mb-4" data-reveal>Project Walkthrough</div>
          <h2 class="heading-md text-white" data-reveal data-delay="100">
            Watch the <em class="text-gold not-italic">Presentation</em>
          </h2>
        </div>
        <div class="video-thumb max-w-4xl mx-auto" style="height:480px;"
             data-video="{{ $project['video_url'] }}" data-reveal>
          <img src="{{ $project['video_thumbnail'] ?? $project['hero_image'] }}" alt="Project video" style="width:100%;height:100%;object-fit:cover;" />
          <div class="play-btn"><i class="fas fa-play" style="margin-left:4px;"></i></div>
        </div>
      </div>
    </section>
  @endif


  {{-- LOCATION MAP --}}
  <section class="section-pad bg-section">
    <div class="container">
      <div class="section-label mb-4" data-reveal>Location</div>
      <h2 class="heading-md text-white mb-8" data-reveal data-delay="100">
        Project <em class="text-gold not-italic">Location</em>
      </h2>
      <div class="map-placeholder" style="height:420px;" data-reveal>
        @if(isset($project['map_embed']))
          {!! $project['map_embed'] !!}
        @endif
        {{-- Without embed URL, shows styled placeholder --}}
      </div>
    </div>
  </section>


  {{-- CONTACT / INVEST FORM --}}
  <section class="section-pad bg-primary">
    <div class="container">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

        <div>
          <div class="section-label mb-4" data-reveal>Invest in {{ $project['title'] }}</div>
          <h2 class="heading-md text-white mb-6" data-reveal data-delay="100">
            Interested? <em class="text-gold not-italic">Let's Talk</em>
          </h2>
          <div class="gold-line mb-7" data-reveal data-delay="150"></div>
          <p style="color:rgba(255,255,255,0.55);font-size:15px;line-height:1.9;" data-reveal data-delay="200">
            Our investment team is ready to provide a full due diligence package,
            financial projections, and a personalized investment structure.
          </p>
        </div>

        <div data-reveal data-delay="150">
          {{-- In Laravel, this form posts to a route that sends email or stores to DB --}}
          <form method="POST"
                action="{{ route('contact.project.inquiry') }}"
                data-form
                style="background:#0E1F35;padding:44px;border:1px solid rgba(201,168,76,0.12);">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project['id'] }}" />
            <input type="hidden" name="project_name" value="{{ $project['title'] }}" />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div class="form-group">
                <label class="form-label">First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="First" required />
              </div>
              <div class="form-group">
                <label class="form-label">Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Last" required />
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="your@email.com" required />
            </div>
            <div class="form-group">
              <label class="form-label">Phone / WhatsApp</label>
              <input type="tel" name="phone" class="form-control" placeholder="+1 (000) 000-0000" />
            </div>
            <div class="form-group">
              <label class="form-label">Investment Interest</label>
              <select name="investment_range" class="form-control">
                <option value="">Select investment range</option>
                <option>$15,000 – $50,000</option>
                <option>$50,000 – $250,000</option>
                <option>$250,000 – $1,000,000</option>
                <option>$1,000,000+</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control" placeholder="Tell us about your investment goals…" rows="4"></textarea>
            </div>

            @if($errors->any())
              <div style="color:#E53E3E;font-size:13px;margin-bottom:16px;">
                @foreach($errors->all() as $error)
                  <div>{{ $error }}</div>
                @endforeach
              </div>
            @endif

            @if(session('success'))
              <div style="color:rgba(72,187,120,0.9);font-size:13px;margin-bottom:16px;">
                {{ session('success') }}
              </div>
            @endif

            <button type="submit" class="btn btn-gold w-full justify-center">
              Send Inquiry <i class="fas fa-arrow-right text-xs ml-2"></i>
            </button>
          </form>
        </div>

      </div>
    </div>
  </section>


  {{-- RELATED PROJECTS --}}
  @if(isset($relatedProjects) && $relatedProjects->count())
    <section class="section-pad bg-section">
      <div class="container">
        <div class="section-label mb-4" data-reveal>Also in {{ $project['country'] }}</div>
        <h2 class="heading-md text-white mb-10" data-reveal data-delay="100">
          Related <em class="text-gold not-italic">Projects</em>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-{{ min($relatedProjects->count(), 3) }} gap-8">
          @foreach($relatedProjects as $related)
            @include('partials.project-card', ['project' => $related])
          @endforeach
        </div>
      </div>
    </section>
  @endif

@endsection
