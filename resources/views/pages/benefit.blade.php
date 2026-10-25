@extends('layouts.app')
@section('title', 'كيف تستفيد | عين عربية')
@section('description', 'اكتشف كيف تستفيد من موسوعة الأعمال: البحث عن الفرص، الإعلان عن العروض والطلبات، التسويق الإلكتروني، الاشتراك الشهري، وربط المصانع والشركات.')

@section('content')
@include('partials.page-hero', ['title' => 'كيف تستفيد', 'lead' => 'موسوعة الأعمال التي تجمع الفرص الصناعية والتجارية والاستثمارية في مكان واحد.'])
<section class="section">
  <div class="wrap">
    <div class="grid grid--3">
      @foreach (config('ainarabia.benefit') as $i => $b)
        <article class="step reveal" style="--i: {{ $i % 3 }}"><h2 class="h3" style="margin-bottom:.5rem">{{ $b['title'] }}</h2><p>{{ $b['text'] }}</p></article>
      @endforeach
    </div>
    <div class="cta-band reveal" style="margin-top:2.5rem">
      <div><h2>ابدأ الآن</h2><p>سجل شركتك أو اطلب باقة تسويقية تناسب نشاطك.</p></div>
      <div class="cta-band__actions"><a class="btn btn--light btn--lg" href="{{ route('register') }}">سجل شركتك</a><a class="btn btn--outline-light btn--lg" href="{{ route('ecommerce') }}">الباقات</a></div>
    </div>
  </div>
</section>
@endsection
