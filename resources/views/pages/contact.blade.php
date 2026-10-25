@extends('layouts.app')
@section('title', 'اتصل بنا | عين عربية')
@section('description', 'تواصل مع عين عربية: مدينة نصر - القاهرة. هواتف الاستثمار والمبيعات والدعم الفني، ومواعيد العمل يوميًا من 8 صباحًا حتى 11 مساءً.')

@section('content')
@php($ct = config('ainarabia.contact'))
@include('partials.page-hero', ['title' => 'اتصل بنا', 'lead' => 'يسعدنا سماعك. اختر الطريقة الأنسب.'])
<section class="section">
  <div class="wrap split">
    <div class="panel reveal">
      <h2 class="h3" style="margin-bottom:1rem">أرسل رسالة</h2>
      @include('partials.lead-form', ['type' => 'contact', 'withCompany' => true, 'withSubject' => true, 'subject' => request('subject'), 'button' => 'إرسال'])
    </div>
    <div class="reveal" style="--i:1">
      <ul class="contact-list">
        <li><span class="ico"><x-icon name="trend"/></span><div><strong>الاستثمار</strong><br><a href="tel:{{ $ct['investment_phone'] }}"><bdi>{{ $ct['investment_phone'] }}</bdi></a></div></li>
        <li><span class="ico"><x-icon name="store"/></span><div><strong>المتاجر والتسويق (واتساب)</strong><br><a href="tel:{{ $ct['sales_phone'] }}"><bdi>{{ $ct['sales_phone'] }}</bdi></a></div></li>
        <li><span class="ico"><x-icon name="phone"/></span><div><strong>الدعم الفني</strong><br><a href="tel:{{ $ct['support_phone'] }}"><bdi>{{ $ct['support_phone'] }}</bdi></a></div></li>
        <li><span class="ico"><x-icon name="phone"/></span><div><strong>أرقام أخرى</strong><br>@foreach (['01068808542','01068808543','01068808544','01068808545'] as $n)<a href="tel:{{ $n }}"><bdi>{{ $n }}</bdi></a>@if(!$loop->last) · @endif @endforeach</div></li>
        <li><span class="ico"><x-icon name="mail"/></span><div><strong>البريد الإلكتروني</strong><br><a href="mailto:{{ $ct['email'] }}">{{ $ct['email'] }}</a></div></li>
        <li><span class="ico"><x-icon name="pin"/></span><div><strong>العنوان</strong><br>{{ $ct['address'] }}</div></li>
        <li><span class="ico"><x-icon name="clock"/></span><div><strong>مواعيد العمل</strong><br>{{ $ct['hours'] }}</div></li>
      </ul>
      <div class="card card__pad" style="margin-top:1.5rem">
        <strong>وكيلنا في الإمارات</strong>
        <p class="muted" style="margin-top:.4rem">{{ $ct['uae_agent']['name'] }} - {{ $ct['uae_agent']['place'] }}<br>المدير العام: {{ $ct['uae_agent']['manager'] }}<br><a class="link-arrow" style="display:inline" href="tel:{{ $ct['uae_agent']['phone'] }}"><bdi>{{ $ct['uae_agent']['phone'] }}</bdi></a></p>
      </div>
    </div>
  </div>
</section>
@endsection
