# عين عربية: الموقع الجديد (Laravel + Blade)

إعادة تصميم وهيكلة لموقع ainarabia.com بتصميم عصري يدعم العربية (RTL) والوضع الداكن، بدون أي خطوة build لواجهة الموقع (HTML/CSS/JS خالص).

## التشغيل محليًا

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

ثم افتح http://127.0.0.1:8000. لا يحتاج المشروع قاعدة بيانات: الجلسات والكاش على الملفات.

## أين أعدّل؟

| ما تريد تغييره | الملف |
| --- | --- |
| أي نص أو رقم أو قسم أو إعلان أو باقة أو وظيفة | `config/ainarabia.php` |
| شكل الصفحات | `resources/views/pages/*.blade.php` |
| الهيدر والفوتر والقائمة | `resources/views/partials/` |
| الألوان والخطوط والمسافات | `public/css/app.css` (متغيرات `:root` في أوله) |
| الحركة والتفاعل | `public/js/app.js` |
| الروابط (URLs) | `routes/web.php` |
| استقبال النماذج | `app/Http/Controllers/LeadController.php` |

## ملاحظات

- **النماذج** (تواصل، تسجيل شركة، وظائف، استثمار، اشتراك) تُسجَّل حاليًا في `storage/logs/laravel.log`. اربطها بالبريد أو قاعدة البيانات داخل `LeadController`.
- **الإعلانات** تُقرأ من `config/ainarabia.php`. للتشغيل الفعلي اربطها بقاعدة بيانات أو بـ WordPress REST API.
- **الروابط القديمة** (مثل `/investment` و`/jobs` و`/e-commerce`) تُحوَّل تلقائيًا للروابط الجديدة بتحويل 301.
- **الشعار**: الشعار الحالي رمز SVG نصي. استبدله بشعار الشركة داخل `partials/header.blade.php` و`partials/footer.blade.php`.
- الصفحات تحترم `prefers-reduced-motion` و`prefers-reduced-transparency` و`prefers-contrast`.
