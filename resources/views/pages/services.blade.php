@extends('layouts.app')
@section('title', 'خدماتنا | عين عربية')
@section('description', 'سوق تجارة إلكترونية B2B، متجر إلكتروني للبيع والتصدير، تصميم وتطوير المواقع والتطبيقات، وكتالوجات إلكترونية متعددة الوسائط.')

@section('content')
@include('partials.page-hero', ['title' => 'خدماتنا', 'lead' => 'حلول رقمية متكاملة تساعد المصانع والشركات على التسويق والبيع والتصدير.'])

<section class="section">
  <div class="wrap">
    <div class="grid grid--2">
      @foreach (config('ainarabia.services') as $i => $s)
        <article class="card card--lift feature reveal" style="--i: {{ $i % 2 }}">
          <span class="tile"><x-icon :name="$s['icon']"/></span>
          <h2 class="h3">{{ $s['title'] }}</h2>
          <p>{{ $s['text'] }}</p>
        </article>
      @endforeach
    </div>

    <div class="cta-band reveal" style="margin-top:2.5rem">
      <div><h2>احجز متجرك الإلكتروني باسم شركتك</h2><p>للوصول إلى الأسواق المحلية والدولية: تسويق، بيع، وتصدير.</p></div>
      <div class="cta-band__actions">
        <a class="btn btn--light btn--lg" href="{{ route('ecommerce') }}">شاهد الباقات</a>
        <a class="btn btn--outline-light btn--lg" href="{{ config('ainarabia.external.store') }}" target="_blank" rel="noopener">زيارة المتجر</a>
      </div>
    </div>
  </div>
</section>
@endsection
