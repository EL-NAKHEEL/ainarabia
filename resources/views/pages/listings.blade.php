@extends('layouts.app')
@section('title', $meta['title'].' | عين عربية')
@section('description', $meta['lead'])

@section('content')
@include('partials.page-hero', ['title' => $meta['title'], 'lead' => $meta['lead'], 'actions' => new \Illuminate\Support\HtmlString('<a class="btn btn--light" href="'.route('contact', ['subject' => $meta['cta']]).'">'.e($meta['cta']).'</a>')])

<section class="section section--tight">
  <div class="wrap">
    <div class="toolbar glass">
      <form class="search" action="{{ url()->current() }}" method="get" role="search">
        <x-icon name="search"/>
        <input type="search" name="q" value="{{ $search }}" placeholder="ابحث داخل {{ $meta['title'] }}" aria-label="بحث">
        @if ($activeCategory)<input type="hidden" name="category" value="{{ $activeCategory }}">@endif
        <button class="btn btn--primary btn--sm" type="submit">بحث</button>
      </form>
      <div class="rail rail__mask">
        <div class="rail__track" data-rail>
          <a class="chip @unless($activeCategory) is-active @endunless" style="--hue:212" href="{{ url()->current() }}{{ $search ? '?q='.urlencode($search) : '' }}"><span class="tile"><x-icon name="spark"/></span>الكل</a>
          @foreach ($categories as $key => $cat)
            <a class="chip @if($activeCategory === $key) is-active @endif" style="--hue: {{ $cat['hue'] }}" href="{{ url()->current() }}?category={{ $key }}{{ $search ? '&q='.urlencode($search) : '' }}">
              <span class="tile"><x-icon :name="$cat['icon']"/></span>{{ $cat['label'] }}
            </a>
          @endforeach
        </div>
      </div>
    </div>

    @if ($items->isEmpty())
      <div class="empty">
        <x-icon name="search"/>
        <h2 class="h3">لا توجد نتائج حاليًا</h2>
        <p class="muted">لم نجد إعلانات مطابقة. يمكنك أن تكون أول من يضيف.</p>
        <a class="btn btn--primary" href="{{ route('contact', ['subject' => $meta['cta']]) }}">{{ $meta['cta'] }}</a>
      </div>
    @else
      <p class="muted" style="margin-bottom:1rem">{{ $items->count() }} نتيجة</p>
      <div class="grid grid--3">
        @foreach ($items as $i => $item)
          @include('partials.listing-card', ['item' => $item, 'i' => $i % 3])
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
