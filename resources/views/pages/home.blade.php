@extends('layouts.app')
@section('title', 'عين عربية | سوق B2B للتجارة والصناعة والزراعة والاستثمار')
@section('description', 'اعرض وابحث واشترِ وصدّر: ماكينات وخطوط إنتاج وخامات وسكراب ومنتجات زراعية وفرص استثمار، وأنشئ متجرك الإلكتروني باسم شركتك.')

@section('content')
@php($c = config('ainarabia'))

<section class="hero">
  <div class="wrap hero__in">
    <div>
      <span class="eyebrow reveal"><x-icon name="spark"/> منصة B2B مصرية منذ 2003</span>
      <h1 class="h1 reveal" style="--i:1">سوقك الأول للتجارة <em>والصناعة والزراعة</em></h1>
      <p class="lead reveal" style="--i:2">اعرض منتجاتك، وابحث عن الماكينات والخامات والفرص، وسوّق وصدّر إلى أسواق جديدة، كل ذلك في منظومة أعمال واحدة.</p>

      <form class="hero__search reveal" style="--i:3" action="{{ route('opportunities') }}" method="get" role="search">
        <div class="search">
          <x-icon name="search"/>
          <input type="search" name="q" placeholder="ابحث عن ماكينة أو خامة أو مصنع" aria-label="بحث">
          <select name="category" aria-label="القسم">
            <option value="">كل الأقسام</option>
            @foreach ($c['categories'] as $key => $cat)
              <option value="{{ $key }}">{{ $cat['label'] }}</option>
            @endforeach
          </select>
        </div>
        <button class="btn btn--primary" type="submit">بحث</button>
      </form>

      <div class="hero__quick reveal" style="--i:4">
        <span>الأكثر بحثًا:</span>
        <a href="{{ route('opportunities', ['category' => 'machinery']) }}">ماكينات</a>
        <a href="{{ route('opportunities', ['category' => 'raw-materials']) }}">خامات</a>
        <a href="{{ route('opportunities', ['category' => 'export']) }}">تصدير</a>
        <a href="{{ route('opportunities', ['category' => 'investment']) }}">استثمار</a>
      </div>
    </div>

    <div class="hero__visual reveal" style="--i:3" data-parallax aria-hidden="true">
      <div class="float-card float-card--a" data-depth="14">
        <span class="pill"><x-icon name="shield"/> سوق B2B</span>
        <strong style="margin-top:.6rem">+11 قسمًا</strong>
        <span>ماكينات، خامات، تصدير، زراعة وأكثر</span>
      </div>
      <div class="float-card float-card--b" data-depth="-18">
        <span>عروض وطلبات تتجدد باستمرار</span>
        <div class="bars"><i style="height:30%"></i><i style="height:44%"></i><i style="height:38%"></i><i style="height:62%"></i><i style="height:55%"></i><i style="height:78%"></i><i style="height:92%"></i></div>
      </div>
      <div class="float-card float-card--c" data-depth="10">
        <span class="ico"><x-icon name="store"/></span>
        <div><strong style="font-size:1.1rem">متجرك الإلكتروني</strong><span>باسم شركتك للبيع والتصدير</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section section--tight">
  <div class="wrap">
    <div class="section__head reveal">
      <div>
        <h2 class="h2">تصفح حسب القسم</h2>
        <p class="lead" style="margin-top:.4rem">اسحب لتستكشف كل الأقسام.</p>
      </div>
      <a class="link-arrow" href="{{ route('opportunities') }}">كل الفرص <x-icon name="arrow"/></a>
    </div>
    <div class="rail rail__mask reveal">
      <div class="rail__track" data-rail>
        @foreach ($c['categories'] as $key => $cat)
          <a class="chip" style="--hue: {{ $cat['hue'] }}" href="{{ route('opportunities', ['category' => $key]) }}">
            <span class="tile"><x-icon :name="$cat['icon']"/></span>{{ $cat['label'] }}
          </a>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="section" style="padding-top:1rem">
  <div class="wrap">
    <div class="section__head reveal">
      <div>
        <span class="eyebrow">مختارات اليوم</span>
        <h2 class="h2">أحدث العروض والفرص</h2>
      </div>
      <a class="link-arrow" href="{{ route('offers') }}">كل العروض <x-icon name="arrow"/></a>
    </div>
    <div class="grid grid--3">
      @foreach ($featured as $i => $item)
        @include('partials.listing-card', ['item' => $item, 'i' => $i % 3])
      @endforeach
    </div>
  </div>
</section>

<section class="section section--surface">
  <div class="wrap">
    <div class="section__head section__head--center reveal">
      <span class="eyebrow">خدماتنا</span>
      <h2 class="h2">كل ما تحتاجه لتنمية أعمالك</h2>
      <p class="lead">من السوق الإلكتروني إلى المتجر والتطبيقات، حلول متكاملة تحت مظلة واحدة.</p>
    </div>
    <div class="bento">
      <a class="tile-lg tile-lg--brand span-4 reveal" href="{{ route('ecommerce') }}">
        <span class="tile"><x-icon name="store"/></span>
        <div>
          <h3>احجز متجرك الإلكتروني باسم شركتك</h3>
          <p>بِع محليًا وعالميًا، واستقبل المدفوعات من أي مكان، وأدر طلباتك من أي جهاز. باقات تبدأ من 2,000 جنيه.</p>
        </div>
        <span class="link-arrow" style="color:#fff">اعرض الباقات <x-icon name="arrow"/></span>
      </a>
      <a class="tile-lg reveal" style="--i:1" href="{{ route('register') }}">
        <span class="tile"><x-icon name="market"/></span>
        <div><h3>سجل شركتك</h3><p>ملف تعريفي ومنتجات وتواصل مباشر مع المشترين.</p></div>
      </a>
      @foreach (array_slice($c['services'], 2, 3) as $i => $s)
        <a class="tile-lg reveal" style="--i:{{ $i + 2 }}" href="{{ route('services') }}">
          <span class="tile"><x-icon :name="$s['icon']"/></span>
          <div><h3>{{ $s['title'] }}</h3><p>{{ \Illuminate\Support\Str::limit($s['text'], 80) }}</p></div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="stats reveal">
      @foreach ($c['stats'] as $s)
        <div class="stat"><strong>{{ $s['value'] }}</strong><span>{{ $s['label'] }}</span></div>
      @endforeach
    </div>
  </div>
</section>

<section class="section section--dark">
  <div class="wrap split">
    <div class="reveal">
      <span class="eyebrow"><x-icon name="trend"/> الاستثمار</span>
      <h2 class="h2">فرص استثمار في التكنولوجيا والصناعة والزراعة</h2>
      <p class="lead">شركة مساهمة مصرية بخبرة تمتد لأكثر من عقدين، تستقبل المستثمرين المصريين والعرب والأجانب بحدود دنيا واضحة.</p>
      <div class="hero__cta">
        <a class="btn btn--light btn--lg" href="{{ route('investment') }}">تفاصيل الاستثمار <x-icon name="arrow" class="icon-arrow-move"/></a>
        <a class="btn btn--outline-light btn--lg" href="tel:{{ $c['contact']['investment_phone'] }}"><x-icon name="phone"/> <bdi>{{ $c['contact']['investment_phone'] }}</bdi></a>
      </div>
    </div>
    <div class="grid reveal" style="--i:2">
      @foreach ($c['invest']['minimums'] as $m)
        <div class="invest-card"><small>{{ $m['who'] }} - الحد الأدنى</small><strong>{{ $m['amount'] }}</strong><span>{{ $m['unit'] }}</span></div>
      @endforeach
    </div>
  </div>
</section>

<section class="section">
  <div class="wrap">
    <div class="section__head section__head--center reveal">
      <span class="eyebrow">كيف تستفيد</span>
      <h2 class="h2">ابدأ في ثلاث خطوات</h2>
    </div>
    <div class="steps">
      <div class="step reveal"><h3>سجل شركتك</h3><p>أنشئ ملف شركتك أو مصنعك وأضف منتجاتك وبيانات التواصل.</p></div>
      <div class="step reveal" style="--i:1"><h3>انشر عرضك أو طلبك</h3><p>أضف عرض بيع أو طلب شراء، ويستهدف مسوقونا العملاء على مواقع التواصل.</p></div>
      <div class="step reveal" style="--i:2"><h3>أتمم الصفقة</h3><p>تواصل مباشرة مع الطرف الآخر وتفاوض داخل المنصة، وعمولتنا 2% بعد إتمام الصفقة فقط.</p></div>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0">
  <div class="wrap">
    <div class="cta-band reveal">
      <div>
        <h2>جاهز لعرض منتجك على المشترين والمصانع؟</h2>
        <p>سجل الآن، أو اتصل بنا وسنساعدك في تجهيز ملف شركتك.</p>
      </div>
      <div class="cta-band__actions">
        <a class="btn btn--light btn--lg" href="{{ route('register') }}">سجل شركتك</a>
        <a class="btn btn--outline-light btn--lg" href="{{ route('contact') }}">تواصل معنا</a>
      </div>
    </div>
  </div>
</section>
@endsection
