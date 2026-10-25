<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>@yield('title', config('ainarabia.name').' | '.config('ainarabia.tagline'))</title>
  <meta name="description" content="@yield('description', 'عين عربية: منصة B2B مصرية لعرض وشراء وتصدير المنتجات الصناعية والزراعية، وفرص الاستثمار والمتاجر الإلكترونية.')">
  <meta name="theme-color" content="#f5f5f7" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#06142e" media="(prefers-color-scheme: dark)">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="ar_AR">
  <meta property="og:site_name" content="{{ config('ainarabia.name') }}">
  <meta property="og:title" content="@yield('title', config('ainarabia.name'))">
  <meta property="og:description" content="@yield('description', config('ainarabia.tagline'))">
  <script>document.documentElement.classList.add('js')</script>
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
</head>
<body>
  @include('partials.sprite')
  <a class="skip" href="#main">تخطي إلى المحتوى</a>

  @include('partials.header')

  <main id="main">
    @yield('content')
  </main>

  @include('partials.footer')

  @if (session('sent'))
    <div class="toast" role="status" data-toast><x-icon name="check"/> {{ session('sent') }}</div>
  @endif

  <script src="{{ asset('js/app.js') }}?v={{ filemtime(public_path('js/app.js')) }}" defer></script>
</body>
</html>
