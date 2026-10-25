{{-- المتغيرات: $type, $button, وحقول اختيارية: $withCompany, $withSubject, $messageLabel, $subject --}}
<form class="form" method="post" action="{{ route('lead.store') }}" novalidate>
  @csrf
  <input type="hidden" name="type" value="{{ $type }}">
  <div class="hp" aria-hidden="true"><label>الموقع<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

  <div class="row">
    <div class="field">
      <label for="{{ $type }}-name">الاسم</label>
      <input id="{{ $type }}-name" name="name" value="{{ old('name') }}" autocomplete="name" required @error('name') aria-invalid="true" @enderror>
      @error('name')<span class="err">{{ $message }}</span>@enderror
    </div>
    <div class="field">
      <label for="{{ $type }}-phone">رقم الهاتف / واتساب</label>
      <input id="{{ $type }}-phone" name="phone" type="tel" inputmode="tel" dir="ltr" style="text-align:right" value="{{ old('phone') }}" autocomplete="tel" required @error('phone') aria-invalid="true" @enderror>
      @error('phone')<span class="err">{{ $message }}</span>@enderror
    </div>
  </div>

  <div class="row">
    @if (!empty($withCompany))
      <div class="field">
        <label for="{{ $type }}-company">اسم الشركة أو المصنع</label>
        <input id="{{ $type }}-company" name="company" value="{{ old('company') }}" autocomplete="organization">
      </div>
    @endif
    <div class="field">
      <label for="{{ $type }}-email">البريد الإلكتروني (اختياري)</label>
      <input id="{{ $type }}-email" name="email" type="email" dir="ltr" style="text-align:right" value="{{ old('email') }}" autocomplete="email" @error('email') aria-invalid="true" @enderror>
      @error('email')<span class="err">{{ $message }}</span>@enderror
    </div>
  </div>

  @if (!empty($withSubject))
    <div class="field">
      <label for="{{ $type }}-subject">{{ $subjectLabel ?? 'الموضوع' }}</label>
      <input id="{{ $type }}-subject" name="subject" value="{{ old('subject', $subject ?? '') }}">
    </div>
  @endif

  <div class="field">
    <label for="{{ $type }}-message">{{ $messageLabel ?? 'رسالتك' }}</label>
    <textarea id="{{ $type }}-message" name="message">{{ old('message') }}</textarea>
  </div>

  <button class="btn btn--primary btn--lg" type="submit">{{ $button ?? 'إرسال' }} <x-icon name="arrow" class="icon-arrow-move"/></button>
</form>
