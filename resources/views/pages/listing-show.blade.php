@extends('layouts.app')
@section('title', $item['title'].' | عين عربية')
@section('description', $item['summary'])

@section('content')
@php($typeLabel = ['offer' => 'عرض بيع', 'request' => 'طلب شراء', 'opportunity' => 'فرصة استثمار'][$item['type']] ?? 'فرصة')
<section class="page-hero">
  <div class="wrap page-hero__in">
    <nav class="crumbs" aria-label="مسار الصفحة">
      <a href="{{ route('home') }}">الرئيسية</a><span aria-hidden="true">/</span>
      <a href="{{ route('opportunities', ['category' => $item['category']]) }}">{{ $category['label'] }}</a><span aria-hidden="true">/</span>
      <span>{{ $item['title'] }}</span>
    </nav>
    <span class="eyebrow" style="background:rgba(255,255,255,.12);color:#cfe2ff">{{ $typeLabel }} · {{ $category['label'] }}</span>
    <h1 class="h1">{{ $item['title'] }}</h1>
    <p class="lead">{{ $item['summary'] }}</p>
  </div>
</section>

<section class="section">
  <div class="wrap split">
    <div>
      <div class="listing" style="--hue: {{ $category['hue'] }}">
        <div class="listing__media" style="border-radius:var(--r-xl);aspect-ratio:16/9"><x-icon :name="$category['icon']" style="width:5rem;height:5rem"/></div>
      </div>
      <div class="prose" style="margin-top:2rem">
        <h2>تفاصيل الإعلان</h2>
        <p>{{ $item['summary'] }} للحصول على المواصفات الكاملة والأسعار والكميات المتاحة ومعاينة الصنف، تواصل معنا وسنوصلك مباشرة بصاحب الإعلان.</p>
        <p>تحصل عين عربية على عمولة 2% بعد إتمام الصفقة فقط، ولا رسوم على الاستفسار والتفاوض.</p>
      </div>
    </div>
    <aside class="panel" style="position:sticky;top:calc(var(--header-h) + 24px)">
      <h2 class="h3" style="margin-bottom:1rem">اطلب هذا الإعلان</h2>
      @include('partials.lead-form', ['type' => $item['type'] === 'request' ? 'request' : 'offer', 'withSubject' => true, 'subject' => $item['title'], 'subjectLabel' => 'الإعلان', 'messageLabel' => 'استفسارك', 'button' => 'أرسل استفسارك'])
    </aside>
  </div>
</section>

@if ($related->isNotEmpty())
<section class="section section--surface">
  <div class="wrap">
    <div class="section__head"><h2 class="h2">إعلانات مشابهة</h2></div>
    <div class="grid grid--3">
      @foreach ($related as $i => $r)
        @include('partials.listing-card', ['item' => $r, 'i' => $i])
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection
