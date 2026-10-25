@extends('layouts.app')
@section('title', 'وسائل الدفع | عين عربية')
@section('description', 'طرق سداد متعددة: تحويل بنكي بالجنيه والدولار، بطاقات فيزا وماستركارد، فودافون كاش، الدفع بمقر الشركة، أو التحصيل عن طريق مندوب.')

@section('content')
@include('partials.page-hero', ['title' => 'وسائل الدفع', 'lead' => 'اختر طريقة السداد الأنسب لك.'])

<section class="section">
  <div class="wrap">
    <div class="grid grid--3">
      @foreach (config('ainarabia.payments') as $i => $p)
        <article class="card card--lift feature reveal" style="--i: {{ $i % 3 }}">
          <span class="tile"><x-icon :name="$p['icon']"/></span>
          <h2 class="h3">{{ $p['title'] }}</h2>
          <p>{{ $p['text'] }}</p>
        </article>
      @endforeach
    </div>

    <div class="notice notice--warn reveal" style="margin-top:2rem">
      <x-icon name="shield"/>
      <p>للحصول على أرقام الحسابات وبيانات التحويل الرسمية، تواصل معنا هاتفيًا على <a class="link-arrow" style="display:inline" href="tel:{{ config('ainarabia.contact.sales_phone') }}"><bdi>{{ config('ainarabia.contact.sales_phone') }}</bdi></a> وتأكد من اسم المستفيد قبل أي تحويل. رقم فودافون كاش: <bdi>{{ config('ainarabia.contact.vodafone_cash') }}</bdi>.</p>
    </div>
  </div>
</section>
@endsection
