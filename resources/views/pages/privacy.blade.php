@extends('layouts.app')
@section('title', 'سياسة الخصوصية | عين عربية')
@section('description', 'سياسة الخصوصية واتفاقية المستخدم لخدمات عين عربية: ما نجمعه، وكيف نستخدمه، وكيف تدير بياناتك أو تحذفها.')

@section('content')
@include('partials.page-hero', ['title' => 'سياسة الخصوصية', 'lead' => 'سياسة الخصوصية واتفاقية المستخدم'])
<section class="section">
  <div class="wrap">
    <div class="prose">
      @foreach (config('ainarabia.privacy') as $s)
        <h2>{{ $loop->iteration }}. {{ $s['title'] }}</h2>
        <p>{{ $s['text'] }}</p>
      @endforeach
    </div>
  </div>
</section>
@endsection
