@php($cat = config('ainarabia.categories')[$item['category']])
@php($typeLabel = ['offer' => 'عرض بيع', 'request' => 'طلب شراء', 'opportunity' => 'فرصة استثمار'][$item['type']] ?? 'فرصة')
<a class="card listing reveal" style="--hue: {{ $cat['hue'] }}; --i: {{ $i ?? 0 }}" href="{{ route('listing.show', $item['id']) }}">
  <div class="listing__media">
    <span class="badge">{{ $cat['label'] }}</span>
    <x-icon :name="$cat['icon']"/>
  </div>
  <div class="listing__body">
    <span class="muted" style="font-size:.82rem">{{ $typeLabel }}</span>
    <h3>{{ $item['title'] }}</h3>
    <p>{{ $item['summary'] }}</p>
    <div class="listing__foot"><span>التفاصيل</span><x-icon name="arrow"/></div>
  </div>
</a>
