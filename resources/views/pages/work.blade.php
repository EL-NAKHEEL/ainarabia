@extends('layouts.app')
@section('title', 'أعمال سابقة | عين عربية')
@section('description', 'مشروعات نفذتها عين عربية مع مركز تحديث الصناعة ووزارة الاتصالات وتكنولوجيا المعلومات، وجوائز وبرامج اعتراف.')

@section('content')
@include('partials.page-hero', ['title' => 'أعمال سابقة', 'lead' => 'مشروعات وشراكات وجوائز على مدى أكثر من عقدين.'])
<section class="section">
  <div class="wrap">
    <div class="grid grid--2">
      @foreach (config('ainarabia.work') as $i => $w)
        <article class="card card--lift feature reveal" style="--i: {{ $i % 2 }}"><span class="tile"><x-icon name="check"/></span><h2 class="h3">{{ $w['title'] }}</h2><p>{{ $w['text'] }}</p></article>
      @endforeach
    </div>
    <p class="notice reveal" style="margin-top:1.6rem"><x-icon name="spark"/><span>أضف تفاصيل كل مشروع وصوره هنا من ملف <bdi>config/ainarabia.php</bdi> (مفتاح <bdi>work</bdi>).</span></p>
  </div>
</section>
@endsection
