@php($c = config('ainarabia'))
<footer class="site-footer">
  <div class="wrap">
    <div class="footer__top">
      <div class="footer__about">
        <a class="brand brand--light" href="{{ route('home') }}">
          <span class="brand__mark"><svg viewBox="0 0 40 40" aria-hidden="true"><path d="M3 20C8 11 14 7 20 7s12 4 17 13c-5 9-11 13-17 13S8 29 3 20z" fill="none" stroke="currentColor" stroke-width="2.400"/><circle cx="20" cy="20" r="6.500" fill="currentColor"/></svg></span>
          <span class="brand__text"><strong>عين عربية</strong><small>منظومة الأعمال</small></span>
        </a>
        <p>{{ $c['legal_name'] }}. نعمل على تنشيط التجارة وتطوير الصناعة وتنمية الإنتاج بتوظيف التكنولوجيا.</p>
        <div class="social">
          @foreach ($c['social'] as $s)
            <a href="{{ $s['url'] }}" target="_blank" rel="noopener" aria-label="{{ $s['label'] }}"><x-icon :name="$s['icon']"/></a>
          @endforeach
        </div>
      </div>

      @foreach ($c['footer_links'] as $title => $links)
        <nav class="footer__col" aria-label="{{ $title }}">
          <h3>{{ $title }}</h3>
          @foreach ($links as $l)
            <a href="{{ route($l['route']) }}">{{ $l['label'] }}</a>
          @endforeach
        </nav>
      @endforeach

      <div class="footer__col">
        <h3>تواصل معنا</h3>
        <a href="tel:{{ $c['contact']['investment_phone'] }}"><bdi>{{ $c['contact']['investment_phone'] }}</bdi> · الاستثمار</a>
        <a href="tel:{{ $c['contact']['sales_phone'] }}"><bdi>{{ $c['contact']['sales_phone'] }}</bdi> · المتاجر والتسويق</a>
        <a href="mailto:{{ $c['contact']['email'] }}">{{ $c['contact']['email'] }}</a>
        <span>{{ $c['contact']['hours'] }}</span>
      </div>
    </div>

    <div class="footer__bottom">
      <span>© 2003 – {{ date('Y') }} عين عربية. جميع الحقوق محفوظة.</span>
      <span class="footer__apps">
        <a href="{{ $c['external']['play'] }}" target="_blank" rel="noopener">تطبيق أندرويد</a>
        <a href="{{ $c['external']['store'] }}" target="_blank" rel="noopener">متجر عين</a>
      </span>
    </div>
  </div>
</footer>
