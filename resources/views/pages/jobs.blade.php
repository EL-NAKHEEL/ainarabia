@extends('layouts.app')
@section('title', 'وظائف | عين عربية')
@section('description', 'وظائف في التسويق والمبيعات والبرمجة والتصميم والدعم الفني وإدارة المحتوى. قدّم الآن أو أرسل سيرتك الذاتية.')

@section('content')
@include('partials.page-hero', ['title' => 'وظائف', 'lead' => 'انضم لفريق يبني منظومة أعمال عربية. إمكانية العمل عن بعد حسب جدول عمل يومي.', 'actions' => new \Illuminate\Support\HtmlString('<a class="btn btn--light btn--lg" href="'.route('jobs.apply').'">قدّم الآن</a>')])
<section class="section">
  <div class="wrap">
    <div class="split">
      <div style="display:grid;gap:.8rem">
        @foreach (config('ainarabia.jobs') as $i => $j)
          <a class="job reveal" style="--i: {{ $i % 4 }}" href="{{ route('jobs.apply', ['job' => $j['title']]) }}">
            <div><h2 class="h3">{{ $j['title'] }}</h2>@isset($j['text'])<p>{{ $j['text'] }}</p>@endisset</div>
            <span class="badge">{{ $j['tag'] }}</span>
          </a>
        @endforeach
      </div>
      <aside class="panel reveal" style="position:sticky;top:calc(var(--header-h) + 24px)">
        <h2 class="h3" style="margin-bottom:1rem">طرق التقديم</h2>
        <ul class="contact-list">
          <li><span class="ico"><x-icon name="mail"/></span><div>أرسل سيرتك الذاتية<br><a href="mailto:{{ config('ainarabia.contact.jobs_email') }}">{{ config('ainarabia.contact.jobs_email') }}</a></div></li>
          <li><span class="ico"><x-icon name="whatsapp"/></span><div>واتساب أو اتصال<br><a href="tel:{{ config('ainarabia.contact.sales_phone') }}"><bdi>{{ config('ainarabia.contact.sales_phone') }}</bdi></a> · <a href="tel:01068808542"><bdi>01068808542</bdi></a></div></li>
          <li><span class="ico"><x-icon name="clock"/></span><div>مواعيد العمل<br>يوميًا من 7 صباحًا حتى 11 مساءً</div></li>
        </ul>
        <p style="margin-top:1.2rem"><a class="link-arrow" href="{{ config('ainarabia.external.jobs_pdf') }}" target="_blank" rel="noopener">تفاصيل الوظائف (PDF) <x-icon name="arrow"/></a></p>
      </aside>
    </div>
  </div>
</section>
@endsection
