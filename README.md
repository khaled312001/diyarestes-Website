# DIYAR Estates — Frontend Website

**International Real Estate Development & Investment**
**www.diyarestes.com**

---

## Project Overview

This is the complete frontend implementation for DIYAR Estates, an international real estate
development and investment company with headquarters in the USA and branches in Egypt and Turkey.

The design system delivers a **premium, luxury corporate aesthetic** using:
- Deep Navy (`#0A1628`) + Gold (`#C9A84C`) color palette
- Playfair Display (headings) + Inter (body) typography
- Scroll-reveal animations via IntersectionObserver
- Fully responsive (mobile-first)
- SEO-ready semantic HTML5

---

## Folder Structure

```
diyarestes-website/
│
├── css/
│   └── app.css                 ← Complete design system (all components)
│
├── js/
│   └── app.js                  ← All interactivity (nav, counters, gallery, forms, accordions)
│
├── index.html                  ← Home page
├── about.html                  ← About Us
├── investors.html              ← Investors / Investment Relations
├── contact.html                ← Contact Us
│
├── projects/
│   ├── egypt.html              ← Egypt Projects listing
│   ├── usa.html                ← USA Projects listing
│   ├── turkey.html             ← Turkey Projects listing
│   │
│   ├── candle-hotel.html       ← Project Detail: Candle Hotel – Dendera
│   ├── al-reef-al-qenawi.html  ← Project Detail: Al Reef Al Qenawi – 4000 Feddan
│   ├── feddan-farm-160.html    ← Project Detail: 160 Feddan Farm
│   ├── usa-project-1.html      ← Project Detail: Diyar Luxury Residences (USA)
│   └── turkey-project-1.html   ← Project Detail: Bosphorus View Residences (Turkey)
│
├── laravel/                    ← Laravel Blade-ready templates
│   ├── layouts/
│   │   └── app.blade.php       ← Main application layout
│   ├── partials/
│   │   ├── header.blade.php    ← Navigation component
│   │   ├── footer.blade.php    ← Footer component
│   │   └── project-card.blade.php ← Reusable project card
│   └── pages/
│       ├── home.blade.php      ← Home page (loop-ready)
│       └── projects/
│           └── detail.blade.php ← Generic project detail page
│
└── README.md
```

---

## Pages Included

| Page | File | Description |
|------|------|-------------|
| Home | `index.html` | Hero, stats, featured projects, why invest, global presence, CTA |
| About Us | `about.html` | Company story, vision/mission, team, timeline, values |
| Egypt Projects | `projects/egypt.html` | Project listing grid for Egypt |
| USA Projects | `projects/usa.html` | Project listing grid for USA |
| Turkey Projects | `projects/turkey.html` | Project listing grid for Turkey |
| Candle Hotel | `projects/candle-hotel.html` | Full project detail with gallery, masterplan, video |
| Al Reef Al Qenawi | `projects/al-reef-al-qenawi.html` | Full project detail |
| 160 Feddan Farm | `projects/feddan-farm-160.html` | Full project detail |
| USA Project | `projects/usa-project-1.html` | Full project detail (USA template) |
| Turkey Project | `projects/turkey-project-1.html` | Full project detail (Turkey template) |
| Investors | `investors.html` | Investment opportunities table, market analysis, FAQ, form |
| Contact | `contact.html` | Contact form, office addresses, map placeholder |

---

## Tech Stack

| Technology | Usage |
|------------|-------|
| **Tailwind CSS** (CDN) | Layout utilities, responsive grid |
| **Custom CSS** (`css/app.css`) | Design system, premium effects, animations |
| **Vanilla JS** (`js/app.js`) | All interactivity (no frameworks) |
| **Font Awesome 6.5** | Icons |
| **Google Fonts** | Playfair Display + Inter + Cormorant Garamond |

---

## Laravel Integration Guide

### Step 1: Create Laravel Project

```bash
composer create-project laravel/laravel diyar-estates
cd diyar-estates
npm install
```

### Step 2: Install Tailwind CSS

```bash
npm install -D tailwindcss @tailwindcss/forms
npx tailwindcss init
```

Update `tailwind.config.js`:
```js
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0A1628',
        'primary-light': '#152238',
        section: '#0E1F35',
        gold: '#C9A84C',
        'gold-light': '#E5C97A',
      },
      fontFamily: {
        heading: ['"Playfair Display"', 'Georgia', 'serif'],
        body: ['Inter', 'system-ui', 'sans-serif'],
        accent: ['"Cormorant Garamond"', 'Georgia', 'serif'],
      }
    }
  },
  plugins: [],
}
```

### Step 3: Copy Assets

```bash
# Copy CSS and JS
cp diyarestes-website/css/app.css resources/css/diyar.css
cp diyarestes-website/js/app.js  resources/js/diyar.js

# Copy images to public
mkdir -p public/images/countries public/images/projects
# Add your images here
```

### Step 4: Copy Blade Templates

```bash
# Layouts
cp laravel/layouts/app.blade.php resources/views/layouts/app.blade.php

# Partials
mkdir -p resources/views/partials
cp laravel/partials/header.blade.php       resources/views/partials/header.blade.php
cp laravel/partials/footer.blade.php       resources/views/partials/footer.blade.php
cp laravel/partials/project-card.blade.php resources/views/partials/project-card.blade.php

# Pages
cp laravel/pages/home.blade.php            resources/views/pages/home.blade.php
cp laravel/pages/projects/detail.blade.php resources/views/pages/projects/detail.blade.php
```

### Step 5: Define Routes (`routes/web.php`)

```php
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Core pages
Route::get('/',          [HomeController::class, 'index'])->name('home');
Route::get('/about',     [AboutController::class, 'index'])->name('about');
Route::get('/investors', [InvestorController::class, 'index'])->name('investors');
Route::get('/contact',   [ContactController::class, 'index'])->name('contact');
Route::post('/contact',  [ContactController::class, 'send'])->name('contact.send');

// Project listings
Route::get('/projects/egypt',  [ProjectController::class, 'egypt'])->name('projects.egypt');
Route::get('/projects/usa',    [ProjectController::class, 'usa'])->name('projects.usa');
Route::get('/projects/turkey', [ProjectController::class, 'turkey'])->name('projects.turkey');

// Project detail
Route::get('/projects/{country}/{slug}', [ProjectController::class, 'show'])->name('projects.detail');

// Project inquiry form
Route::post('/projects/inquiry', [ProjectController::class, 'inquiry'])->name('contact.project.inquiry');

// Brochure download
Route::get('/projects/{slug}/brochure', [ProjectController::class, 'brochure'])->name('projects.brochure');

// Legal
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms',   'pages.terms')->name('terms');
```

### Step 6: Database Schema (Projects Table)

```php
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->string('country');             // 'Egypt' | 'USA' | 'Turkey'
    $table->string('category');            // 'Hospitality' | 'Agriculture' | 'Residential' ...
    $table->string('location');
    $table->string('status')->default('Active');
    $table->text('description');           // Short description (card)
    $table->longText('full_description');  // Rich HTML for detail page
    $table->string('title_html')->nullable(); // Title with HTML formatting
    $table->string('subtitle')->nullable();
    $table->string('hero_image');
    $table->json('gallery')->nullable();   // Array of image paths
    $table->string('masterplan_image')->nullable();
    $table->string('video_url')->nullable();
    $table->string('video_thumbnail')->nullable();
    $table->json('metrics')->nullable();   // [{value, label}, ...]
    $table->json('amenities')->nullable(); // ["Feature 1", "Feature 2", ...]
    $table->json('investment_highlights')->nullable(); // {"Key": "Value", ...}
    $table->string('map_embed')->nullable();
    $table->decimal('lat', 10, 7)->nullable();
    $table->decimal('lng', 10, 7)->nullable();
    $table->boolean('featured')->default(false);
    $table->integer('sort_order')->default(0);
    $table->timestamps();
    $table->softDeletes();
});
```

### Step 7: Example Controller

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function egypt()
    {
        $projects = Project::where('country', 'Egypt')
                           ->orderBy('sort_order')
                           ->get();
        return view('pages.projects.egypt', compact('projects'));
    }

    public function usa()
    {
        $projects = Project::where('country', 'USA')
                           ->orderBy('sort_order')
                           ->get();
        return view('pages.projects.usa', compact('projects'));
    }

    public function turkey()
    {
        $projects = Project::where('country', 'Turkey')
                           ->orderBy('sort_order')
                           ->get();
        return view('pages.projects.turkey', compact('projects'));
    }

    public function show(string $country, string $slug)
    {
        $project = Project::where('slug', $slug)
                          ->whereRaw('LOWER(country) = ?', [strtolower($country)])
                          ->firstOrFail();

        $relatedProjects = Project::where('country', $project->country)
                                  ->where('id', '!=', $project->id)
                                  ->limit(2)
                                  ->get();

        return view('pages.projects.detail', compact('project', 'relatedProjects'));
    }

    public function inquiry(Request $request)
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:100',
            'last_name'        => 'required|string|max:100',
            'email'            => 'required|email',
            'phone'            => 'nullable|string|max:30',
            'investment_range' => 'nullable|string',
            'message'          => 'nullable|string|max:2000',
            'project_id'       => 'required|exists:projects,id',
        ]);

        // Send email using Laravel Mail
        // Mail::to('invest@diyarestes.com')->send(new ProjectInquiryMail($validated));

        // Or store in DB
        // ProjectInquiry::create($validated);

        return back()->with('success', 'Thank you for your inquiry. Our team will contact you within 24 hours.');
    }

    public function brochure(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $path = storage_path('app/brochures/' . $slug . '.pdf');

        if (!file_exists($path)) {
            abort(404, 'Brochure not available yet.');
        }

        return response()->download($path, $project->title . ' - DIYAR Estates.pdf');
    }
}
```

### Step 8: Home Controller

```php
<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('featured', true)
                                   ->orderBy('sort_order')
                                   ->limit(3)
                                   ->get();

        $stats = [
            ['value' => '2.5', 'prefix' => '$', 'suffix' => 'B+', 'label' => 'Assets Under Development'],
            ['value' => '50',  'prefix' => '',  'suffix' => '+',  'label' => 'Premium Projects'],
            ['value' => '3',   'prefix' => '',  'suffix' => '',   'label' => 'Countries'],
            ['value' => '15',  'prefix' => '',  'suffix' => '+',  'label' => 'Years of Excellence'],
        ];

        return view('pages.home', compact('featuredProjects', 'stats'));
    }
}
```

### Step 9: Config File (`config/diyar.php`)

```php
<?php

return [
    'email' => [
        'general'   => env('DIYAR_EMAIL_GENERAL',   'info@diyarestes.com'),
        'investors' => env('DIYAR_EMAIL_INVESTORS',  'invest@diyarestes.com'),
        'egypt'     => env('DIYAR_EMAIL_EGYPT',      'egypt@diyarestes.com'),
        'turkey'    => env('DIYAR_EMAIL_TURKEY',     'turkey@diyarestes.com'),
    ],
    'social' => [
        'linkedin'  => env('DIYAR_LINKEDIN',  '#'),
        'facebook'  => env('DIYAR_FACEBOOK',  '#'),
        'instagram' => env('DIYAR_INSTAGRAM', '#'),
        'twitter'   => env('DIYAR_TWITTER',   '#'),
    ],
    'google_maps_key' => env('GOOGLE_MAPS_API_KEY', ''),
];
```

---

## Google Maps Integration

Replace the `.map-placeholder` divs in each page with:

```html
<iframe
  src="https://maps.google.com/maps?q=LOCATION&t=&z=13&ie=UTF8&iwloc=&output=embed"
  width="100%" height="100%"
  style="border:0; filter:invert(90%) hue-rotate(180deg);"
  allowfullscreen loading="lazy">
</iframe>
```

The dark filter `invert(90%) hue-rotate(180deg)` creates a dark-mode map matching the design.

---

## Form Email Setup (Laravel)

```bash
# Install Laravel Mail
# Configure in .env:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=info@diyarestes.com
MAIL_FROM_NAME="DIYAR Estates"
```

Create Mailable:
```bash
php artisan make:mail ProjectInquiryMail --markdown=emails.project-inquiry
```

---

## SEO Optimization

All pages include:
- Semantic HTML5 structure (`<article>`, `<section>`, `<nav>`, `<main>`, `<footer>`)
- Descriptive `alt` attributes on all images
- Meta `description` per page
- Open Graph tags
- Structured heading hierarchy (H1 → H2 → H3)
- `loading="lazy"` on below-fold images

For Laravel, add in `app.blade.php`:
```html
<!-- Sitemap: /sitemap.xml via spatie/laravel-sitemap -->
<link rel="canonical" href="{{ url()->current() }}" />
```

---

## Animation System

Animations use native IntersectionObserver (no library dependency):

```html
<!-- Fade up on scroll -->
<div data-reveal>Content</div>

<!-- With delay (ms) -->
<div data-reveal data-delay="200">Content</div>

<!-- Slide from left -->
<div data-reveal-left>Content</div>

<!-- Slide from right -->
<div data-reveal-right>Content</div>
```

Counter animation:
```html
<div class="stat-num"
     data-counter="2.5"
     data-prefix="$"
     data-suffix="B+">$2.5B+</div>
```

---

## Design Tokens (CSS Variables)

```css
--clr-primary:      #0A1628   /* Deep Navy */
--clr-primary-light:#152238   /* Medium Navy */
--clr-section:      #0E1F35   /* Section background */
--clr-gold:         #C9A84C   /* Primary accent gold */
--clr-gold-light:   #E5C97A   /* Light gold */
--clr-gold-dark:    #A6863D   /* Dark gold */
--font-heading:     'Playfair Display', serif
--font-body:        'Inter', sans-serif
--font-accent:      'Cormorant Garamond', serif
```

---

## Browser Support

- Chrome 80+
- Firefox 75+
- Safari 13+
- Edge 80+
- Mobile: iOS Safari 13+, Android Chrome 80+

---

## Deployment Checklist

- [ ] Replace CDN Tailwind with compiled CSS (`npm run build`)
- [ ] Add real images to `public/images/`
- [ ] Configure Google Maps API key
- [ ] Set up SMTP for contact forms
- [ ] Add brochure PDFs to `storage/app/brochures/`
- [ ] Configure social media links in `config/diyar.php`
- [ ] Set up SSL certificate (HTTPS)
- [ ] Add sitemap via `spatie/laravel-sitemap`
- [ ] Configure caching (`php artisan optimize`)
- [ ] Set up image optimization (Spatie Media Library)

---

## Credits

**Design & Development:** DIYAR Estates Frontend System
**Company:** DIYAR Estates — www.diyarestes.com
**Tech Stack:** HTML5 + Tailwind CSS + Vanilla JS → Laravel Blade
