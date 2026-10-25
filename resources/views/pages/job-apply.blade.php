@extends('layouts.app')
@section('title', 'التقديم على وظيفة | عين عربية')
@section('description', 'قدّم على وظيفة في عين عربية بإرسال بياناتك وسنتواصل معك.')

@section('content')
@include('partials.page-hero', ['title' => 'التقديم على وظيفة', 'crumb' => 'تقديم', 'lead' => 'اترك بياناتك وسنتواصل معك. يمكنك أيضًا إرسال سيرتك الذاتية على ' . config('ainarabia.contact.jobs_email')])
<section class="section">
  <div class="wrap" style="max-width:760px">
    <div class="panel reveal">
      @include('partials.lead-form', ['type' => 'job', 'withSubject' => true, 'subject' => request('job'), 'subjectLabel' => 'الوظيفة المطلوبة', 'messageLabel' => 'نبذة عن خبرتك ورابط أعمالك', 'button' => 'أرسل طلبي'])
    </div>
  </div>
</section>
@endsection
