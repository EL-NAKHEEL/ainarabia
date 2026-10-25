@extends('layouts.app')
@section('title', 'سجل شركتك | عين عربية')
@section('description', 'سجل شركتك أو مصنعك في منصة عين عربية واعرض منتجاتك لآلاف الباحثين عن موردين وشركاء داخل مصر وخارجها.')

@section('content')
@include('partials.page-hero', ['title' => 'سجل شركتك', 'lead' => 'أنشئ ملفًا تعريفيًا لشركتك أو مصنعك، وأضف منتجاتك، وابدأ في استقبال الطلبات.'])

<section class="section">
  <div class="wrap split">
    <div>
      <h2 class="h2 reveal">ماذا ستحصل عليه؟</h2>
      <ul class="checklist reveal" style="margin-top:1.4rem;--i:1">
        <li><x-icon name="check"/> ملف تعريفي لشركتك يظهر في نتائج البحث بالمنصة.</li>
        <li><x-icon name="check"/> عرض منتجاتك وخدماتك في الأقسام المناسبة داخل مصر وخارجها.</li>
        <li><x-icon name="check"/> إمكانية الدردشة والتفاوض مع الأعضاء داخل المنصة.</li>
        <li><x-icon name="check"/> تسويق على مواقع التواصل بأيدي مسوقين محترفين.</li>
        <li><x-icon name="check"/> متجر إلكتروني باسم شركتك للبيع والتصدير (اختياري).</li>
      </ul>
      <div class="notice reveal" style="margin-top:2rem;--i:2"><x-icon name="spark"/><p>عند إتمام صفقة عبر المنصة تحصل الشركة على عمولة 2% فقط. ولا رسوم على التسجيل أو الاستفسار.</p></div>
    </div>
    <div class="panel reveal" style="--i:1">
      <h2 class="h3" style="margin-bottom:1rem">بيانات الشركة</h2>
      @include('partials.lead-form', ['type' => 'register', 'withCompany' => true, 'withSubject' => true, 'subjectLabel' => 'نشاط الشركة', 'messageLabel' => 'منتجاتك أو خدماتك', 'button' => 'سجل الآن'])
    </div>
  </div>
</section>
@endsection
