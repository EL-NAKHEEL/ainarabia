@extends('layouts.app')
@section('title', 'فرص الاستثمار | عين عربية')
@section('description', 'استثمر في شركة مصرية مساهمة تعمل في تكنولوجيا المعلومات والتجارة الإلكترونية والطب عن بعد والمعلوماتية الزراعية. الحد الأدنى وشروط صرف الأرباح.')

@section('content')
@php($inv = config('ainarabia.invest'))
<section class="page-hero">
  <div class="wrap page-hero__in">
    <nav class="crumbs" aria-label="مسار الصفحة"><a href="{{ route('home') }}">الرئيسية</a><span aria-hidden="true">/</span><span>الاستثمار</span></nav>
    <h1 class="h1 reveal">فرص استثمار في القاهرة</h1>
    <p class="lead reveal" style="--i:1">شركة مساهمة مصرية تعمل في التكنولوجيا والتجارة الإلكترونية، بفريق خبرته تمتد لنحو 30 عامًا، وتفتح الباب للمستثمرين المصريين والعرب والأجانب.</p>
    <div class="hero__cta reveal" style="--i:2">
      <a class="btn btn--light btn--lg" href="tel:{{ config('ainarabia.contact.investment_phone') }}"><x-icon name="phone"/> <bdi>{{ config('ainarabia.contact.investment_phone') }}</bdi></a>
      <a class="btn btn--outline-light btn--lg" href="#invest-form">اطلب التواصل</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="section__head"><h2 class="h2 reveal">الحد الأدنى للاستثمار</h2></div>
    <div class="grid grid--3">
      @foreach ($inv['minimums'] as $i => $m)
        <div class="card feature reveal" style="--i: {{ $i }}">
          <span class="muted">{{ $m['who'] }}</span>
          <strong style="font-size:2.2rem;line-height:1.1;color:var(--brand)">{{ $m['amount'] }}</strong>
          <span>{{ $m['unit'] }}</span>
        </div>
      @endforeach
    </div>
    <p class="muted reveal" style="margin-top:1rem">يمكن إيداع رأس المال على دفعات.</p>
  </div>
</section>

<section class="section section--surface">
  <div class="wrap split">
    <div class="reveal">
      <h2 class="h2">نظام صرف الأرباح</h2>
      <ul class="checklist" style="margin-top:1.4rem">
        @foreach ($inv['terms'] as $t)
          <li><x-icon name="check"/> {{ $t }}</li>
        @endforeach
      </ul>
    </div>
    <div class="reveal" style="--i:1">
      <h2 class="h2">مجالات عمل الشركة</h2>
      <div class="tags" style="margin-top:1.4rem">
        @foreach ($inv['sectors'] as $s)<span>{{ $s }}</span>@endforeach
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap split">
    <div class="reveal">
      <h2 class="h2">قبل أن تقرر</h2>
      <p class="lead">الاستثمار ينطوي على مخاطر. نوصيك بطلب القوائم المالية المدققة والتحقق من بيانات الشركة وتراخيصها لدى الجهات الرسمية، واستشارة مستشار مالي مستقل قبل اتخاذ القرار.</p>
      <div class="notice notice--warn" style="margin-top:1.4rem"><x-icon name="shield"/><p>رقم السجل التجاري: 16421، ترخيص النشاط: 192 من هيئة تنمية صناعة تكنولوجيا المعلومات. يتم الإيداع في حسابات بنكية باسم الشركة، ونوفر بيانات الحسابات عند التواصل.</p></div>
    </div>
    <div class="panel reveal" id="invest-form" style="--i:1">
      <h2 class="h3" style="margin-bottom:1rem">اطلب التواصل من فريق الاستثمار</h2>
      @include('partials.lead-form', ['type' => 'investment', 'messageLabel' => 'المبلغ المتوقع أو أي استفسار', 'button' => 'تواصلوا معي'])
    </div>
  </div>
</section>
@endsection
