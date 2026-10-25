@extends('layouts.app')
@section('title', 'باقات التسويق والتجارة الإلكترونية | عين عربية')
@section('description', 'خمس باقات للتسويق والتصدير من 2,000 جنيه شهريًا، تشمل التصميم والإعلانات المدفوعة ومكتب مبيعات حسب الباقة.')

@section('content')
@include('partials.page-hero', ['title' => 'باقات التسويق والتجارة الإلكترونية', 'crumb' => 'الباقات', 'lead' => 'اختر الباقة المناسبة لحجم نشاطك. الأسعار بالجنيه المصري، وللشركات خارج مصر بالدولار.'])

<section class="section">
  <div class="wrap">
    <div class="plans">
      @foreach (config('ainarabia.plans') as $i => $p)
        <article @class(['plan', 'reveal', 'plan--featured' => !empty($p['featured'])]) style="--i: {{ $i }}">
          @if (!empty($p['featured']))<span class="plan__flag">الأكثر طلبًا</span>@endif
          <div>
            <span class="muted" style="font-size:.85rem">المستوى {{ $p['level'] }}</span>
            <h2>{{ $p['name'] }}</h2>
            <p class="muted" style="font-size:.9rem">{{ $p['for'] }}</p>
          </div>
          <div class="price"><strong>{{ $p['egp'] }}</strong><small>جنيه</small></div>
          <p class="muted" style="font-size:.88rem;margin-top:-.6rem">أو {{ $p['usd'] }} دولار خارج مصر</p>
          <ul>
            @foreach ($p['features'] as $f)
              <li><x-icon name="check"/> <span>{{ $f }}</span></li>
            @endforeach
          </ul>
          <a class="btn {{ !empty($p['featured']) ? 'btn--light' : 'btn--primary' }}" href="{{ route('contact', ['subject' => 'اشتراك باقة '.$p['name']]) }}">اطلب الآن</a>
        </article>
      @endforeach
    </div>

    <div class="notice reveal" style="margin-top:2rem">
      <x-icon name="shield"/>
      <p>الأرقام المذكورة (مشاهدات وعملاء) أهداف تسويقية للباقة وليست ضمانًا. تُحدَّد النتائج المتفق عليها في العقد. <a class="link-arrow" style="display:inline" href="{{ config('ainarabia.external.brochure') }}" target="_blank" rel="noopener">حمّل الكتيب التعريفي</a></p>
    </div>
  </div>
</section>

<section class="section section--surface">
  <div class="wrap split">
    <div class="reveal">
      <h2 class="h2">اشتراك شهري أو عمولة على الصفقة</h2>
      <p class="lead">تسويق شهري بنتائج محددة في العقد، أو عمولة 2% فقط بعد إتمام الصفقة بين البائع والمشتري.</p>
    </div>
    <div class="panel reveal" style="--i:1">
      <h3 class="h3" style="margin-bottom:1rem">اطلب استشارة مجانية</h3>
      @include('partials.lead-form', ['type' => 'subscription', 'withCompany' => true, 'messageLabel' => 'أخبرنا عن نشاطك', 'button' => 'تواصلوا معي'])
    </div>
  </div>
</section>
@endsection
