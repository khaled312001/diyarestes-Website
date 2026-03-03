{{--
 * DIYAR Estates — Project Card Component (Blade)
 *
 * Usage in a Blade view:
 *   @foreach($projects as $project)
 *     @include('partials.project-card', ['project' => $project])
 *   @endforeach
 *
 * Or as a Blade Component:
 *   <x-project-card :project="$project" />
 *
 * Expected $project object/array properties:
 *   - id          (int)    : Unique project ID
 *   - title       (string) : Project name
 *   - slug        (string) : URL slug (e.g., "candle-hotel-dendera")
 *   - country     (string) : "Egypt" | "USA" | "Turkey"
 *   - category    (string) : Project type (Hospitality, Agriculture, Residential, etc.)
 *   - location    (string) : Location label (e.g., "Qena, Egypt")
 *   - description (string) : Short description (2-3 sentences)
 *   - image       (string) : Path to image (relative to storage or public)
 *   - status      (string) : "Active" | "Pre-Launch" | "Operational" | "Completed"
 *   - delay       (int)    : Animation delay in ms (0, 100, 200, etc.) — optional
--}}

@php
  $delay    = $project['delay'] ?? $loop->index * 100;
  $slug     = $project['slug'] ?? Str::slug($project['title']);
  $country  = $project['country'] ?? 'Global';
  $category = $project['category'] ?? 'Real Estate';
  $image    = $project['image'] ?? 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80';
  $status   = $project['status'] ?? 'Active';
  $routeMap = ['Egypt' => 'projects.egypt', 'USA' => 'projects.usa', 'Turkey' => 'projects.turkey'];
  $detailRoute = 'projects.detail'; {{-- Route name for project detail pages --}}
@endphp

<article class="card" data-reveal @if($delay) data-delay="{{ $delay }}" @endif>

  {{-- Image --}}
  <div class="card-img">
    <img
      src="{{ Str::startsWith($image, 'http') ? $image : Storage::url($image) }}"
      alt="{{ $project['title'] }}"
      loading="lazy"
    />
  </div>

  {{-- Body --}}
  <div class="card-body">

    {{-- Badges --}}
    <div class="flex items-center gap-2">
      <span class="card-badge">{{ $country }}</span>
      <span style="font-size:10px;color:rgba(255,255,255,0.3);letter-spacing:1px;">{{ $category }}</span>
    </div>

    {{-- Title --}}
    <h3>{{ $project['title'] }}</h3>

    {{-- Description --}}
    <p>{{ $project['description'] }}</p>

    {{-- Status badge (optional) --}}
    @if(isset($project['status']))
      @php
        $statusColor = match($status) {
          'Active', 'Operational' => 'rgba(72,187,120,0.9)',
          'Pre-Launch'            => 'rgba(100,149,237,0.9)',
          '90% Sold'              => 'rgba(255,165,0,0.9)',
          default                 => 'rgba(201,168,76,0.9)',
        };
      @endphp
      <span style="font-size:10px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:{{ $statusColor }};">
        ● {{ $status }}
      </span>
    @endif

    {{-- CTA Button --}}
    <a href="{{ route($detailRoute, ['slug' => $slug]) }}" class="btn btn-outline-gold btn-sm">
      View Project <i class="fas fa-arrow-right text-xs ml-1"></i>
    </a>

  </div>
</article>
