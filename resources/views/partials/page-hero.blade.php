{{-- المتغيرات: $title, $lead (اختياري), $crumb (اسم الصفحة في المسار) --}}
<section class="page-hero">
  <div class="wrap page-hero__in">
    <nav class="crumbs" aria-label="مسار الصفحة">
      <a href="{{ route('home') }}">الرئيسية</a><span aria-hidden="true">/</span><span>{{ $crumb ?? $title }}</span>
    </nav>
    <h1 class="h1 reveal">{{ $title }}</h1>
    @isset($lead)<p class="lead reveal" style="--i:1">{{ $lead }}</p>@endisset
    @isset($actions)<div class="hero__cta reveal" style="--i:2">{{ $actions }}</div>@endisset
  </div>
</section>
