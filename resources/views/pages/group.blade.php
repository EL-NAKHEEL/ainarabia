@extends('layouts.app')
@section('title', 'مجموعة شركات عين عربية')
@section('description', 'شبكات ومشروعات مجموعة عين عربية: الطب عن بعد، السياحة، الاستشارات، الزراعة، التنمية البشرية، التكنولوجيا الحيوية وغيرها.')

@section('content')
@include('partials.page-hero', ['title' => 'مجموعة شركات عين عربية', 'crumb' => 'المجموعة', 'lead' => 'منظومة من الشبكات والمشروعات التي تخدم قطاعات الصناعة والتجارة والصحة والتعليم والزراعة.'])
<section class="section">
  <div class="wrap">
    <div class="grid grid--3">
      @foreach (config('ainarabia.group') as $i => $g)
        <article class="card card--lift feature reveal" style="--i: {{ $i % 3 }}">
          <span class="tile"><x-icon name="spark"/></span>
          <h2 class="h3">{{ $g['name'] }}</h2>
          <p>{{ $g['text'] }}</p>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endsection
