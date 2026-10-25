@extends('layouts.app')
@section('title', 'عن الشركة | عين عربية')
@section('description', 'شبكة معلومات الصناعات العربية (عين عربية): شركة مساهمة مصرية تأسست عام 2003 برأس مال 20 مليون جنيه، تعمل على تنشيط التجارة وتطوير الصناعة.')

@section('content')
@php($a = config('ainarabia.about'))
@include('partials.page-hero', ['title' => 'عن الشركة', 'lead' => $a['lead']])

<section class="section">
  <div class="wrap split">
    <div>
      <h2 class="h2 reveal">أهدافنا</h2>
      <ul class="checklist reveal" style="margin-top:1.4rem;--i:1">@foreach ($a['goals'] as $g)<li><x-icon name="check"/> {{ $g }}</li>@endforeach</ul>
      <h2 class="h2 reveal" style="margin-top:2.5rem">أنشطتنا</h2>
      <div class="tags reveal" style="margin-top:1.2rem">@foreach ($a['activities'] as $x)<span>{{ $x }}</span>@endforeach</div>
    </div>
    <dl class="facts reveal" style="--i:1;margin:0">
      @foreach ($a['facts'] as $f)<div><dt>{{ $f['label'] }}</dt><dd>{{ $f['value'] }}</dd></div>@endforeach
    </dl>
  </div>
</section>

<section class="section section--surface">
  <div class="wrap">
    <div class="section__head section__head--center reveal"><span class="eyebrow">إنجازات</span><h2 class="h2">اعتراف وجوائز</h2></div>
    <div class="grid grid--3">
      @foreach ($a['recognition'] as $i => $r)
        <div class="card feature reveal" style="--i: {{ $i }}"><span class="tile"><x-icon name="shield"/></span><p style="color:var(--text);font-weight:500">{{ $r }}</p></div>
      @endforeach
    </div>
    <p class="reveal" style="margin-top:2rem;text-align:center"><a class="link-arrow" href="{{ route('group') }}">تعرف على مجموعة شركات عين عربية <x-icon name="arrow"/></a></p>
  </div>
</section>
@endsection
