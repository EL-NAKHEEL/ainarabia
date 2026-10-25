@php($c = config('ainarabia'))
<header class="site-header" data-header>
  <div class="topbar">
    <div class="wrap topbar__in">
      <a href="tel:{{ $c['contact']['investment_phone'] }}"><x-icon name="phone"/> استثمار: <bdi>{{ $c['contact']['investment_phone'] }}</bdi></a>
      <a href="tel:{{ $c['contact']['sales_phone'] }}"><x-icon name="phone"/> متاجر وتسويق: <bdi>{{ $c['contact']['sales_phone'] }}</bdi></a>
      <a class="topbar__store" href="{{ $c['external']['store'] }}" rel="noopener" target="_blank">احجز متجرك الإلكتروني <x-icon name="arrow"/></a>
    </div>
  </div>

  <div class="bar">
    <div class="wrap bar__in">
      <a class="brand" href="{{ route('home') }}" aria-label="عين عربية - الرئيسية">
        <span class="brand__mark"><svg viewBox="0 0 40 40" aria-hidden="true"><path d="M3 20C8 11 14 7 20 7s12 4 17 13c-5 9-11 13-17 13S8 29 3 20z" fill="none" stroke="currentColor" stroke-width="2.400"/><circle cx="20" cy="20" r="6.500" fill="currentColor"/><circle cx="22.500" cy="17.500" r="2" fill="var(--surface)"/></svg></span>
        <span class="brand__text"><strong>عين عربية</strong><small>منظومة الأعمال</small></span>
      </a>

      <nav class="nav" aria-label="القائمة الرئيسية">
        @foreach ($c['nav'] as $item)
          @if (isset($item['children']))
            <div class="nav__drop">
              <button class="nav__link" type="button" aria-expanded="false" aria-haspopup="true">{{ $item['label'] }} <x-icon name="chevron"/></button>
              <div class="menu glass" role="menu">
                @foreach ($item['children'] as $child)
                  <a role="menuitem" href="{{ route($child['route']) }}" @class(['is-active' => request()->routeIs($child['route'])])>{{ $child['label'] }}</a>
                @endforeach
              </div>
            </div>
          @else
            <a class="nav__link @if(request()->routeIs($item['route'])) is-active @endif" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
          @endif
        @endforeach
      </nav>

      <div class="bar__actions">
        <a class="btn btn--ghost btn--sm hide-sm" href="{{ route('contact') }}">اتصل بنا</a>
        <a class="btn btn--primary btn--sm" href="{{ route('register') }}">سجل شركتك</a>
        <button class="icon-btn menu-toggle" type="button" aria-label="فتح القائمة" aria-expanded="false" aria-controls="sheet" data-sheet-open><x-icon name="menu"/></button>
      </div>
    </div>
  </div>
</header>

<div class="scrim" data-scrim hidden></div>
<aside class="sheet glass" id="sheet" role="dialog" aria-modal="true" aria-label="القائمة" hidden data-sheet>
  <div class="sheet__grip" aria-hidden="true"></div>
  <div class="sheet__head">
    <strong>القائمة</strong>
    <button class="icon-btn" type="button" aria-label="إغلاق" data-sheet-close><x-icon name="close"/></button>
  </div>
  <form class="search search--sheet" action="{{ route('opportunities') }}" method="get" role="search">
    <x-icon name="search"/>
    <input type="search" name="q" placeholder="ابحث عن منتج أو مصنع أو فرصة" aria-label="بحث">
  </form>
  <nav class="sheet__nav">
    @foreach ($c['nav'] as $item)
      @if (isset($item['children']))
        <p class="sheet__label">{{ $item['label'] }}</p>
        @foreach ($item['children'] as $child)
          <a href="{{ route($child['route']) }}">{{ $child['label'] }} <x-icon name="arrow"/></a>
        @endforeach
      @else
        <a href="{{ route($item['route']) }}">{{ $item['label'] }} <x-icon name="arrow"/></a>
      @endif
    @endforeach
  </nav>
  <div class="sheet__cta">
    <a class="btn btn--primary" href="{{ route('register') }}">سجل شركتك</a>
    <a class="btn btn--ghost" href="{{ route('contact') }}">اتصل بنا</a>
  </div>
</aside>
