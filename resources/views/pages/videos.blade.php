@extends('layouts.app')
@section('title', 'فيديوهات عين عربية')
@section('description', 'شاهد فيديوهات عين عربية على يوتيوب: شرح المنصة والخدمات وقصص النجاح.')

@section('content')
@include('partials.page-hero', ['title' => 'فيديوهات', 'lead' => 'شاهد شرح المنصة والخدمات على قناتنا.'])
<section class="section">
  <div class="wrap">
    <a class="reveal" href="https://www.youtube.com/@ainarabia9885" target="_blank" rel="noopener" aria-label="قناة عين عربية على يوتيوب">
      <div class="video-card"><span class="play"><x-icon name="play"/></span></div>
    </a>
    <div class="section__head" style="margin-top:2rem">
      <div><h2 class="h3">قناة عين عربية على يوتيوب</h2><p class="muted">كل الفيديوهات الجديدة تُنشر على القناة.</p></div>
      <a class="btn btn--primary" href="https://www.youtube.com/@ainarabia9885" target="_blank" rel="noopener"><x-icon name="youtube"/> افتح القناة</a>
    </div>
    <p class="notice"><x-icon name="spark"/><span>لعرض فيديوهات محددة داخل الصفحة، أضف معرّفات الفيديو في <bdi>config/ainarabia.php</bdi> وستُعرض هنا كبطاقات.</span></p>
  </div>
</section>
@endsection
