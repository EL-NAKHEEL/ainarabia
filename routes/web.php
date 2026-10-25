<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

// سوق الأعمال
Route::get('/فرص-أعمال', [ListingController::class, 'index'])->defaults('scope', 'all')->name('opportunities');
Route::get('/عروض-البيع', [ListingController::class, 'index'])->defaults('scope', 'offer')->name('offers');
Route::get('/طلبات-الشراء', [ListingController::class, 'index'])->defaults('scope', 'request')->name('requests');
Route::get('/إعلان/{id}', [ListingController::class, 'show'])->whereNumber('id')->name('listing.show');

// الخدمات والاشتراكات
Route::get('/خدماتنا', [PageController::class, 'services'])->name('services');
Route::get('/باقات-التجارة-الإلكترونية', [PageController::class, 'ecommerce'])->name('ecommerce');
Route::get('/وسائل-الدفع', [PageController::class, 'payments'])->name('payments');
Route::get('/سجل-شركتك', [PageController::class, 'register'])->name('register');
Route::get('/الاستثمار', [PageController::class, 'investment'])->name('investment');
Route::get('/كيف-تستفيد', [PageController::class, 'benefit'])->name('benefit');

// الشركة
Route::get('/عن-الشركة', [PageController::class, 'about'])->name('about');
Route::get('/مجموعة-شركات-عين-عربية', [PageController::class, 'group'])->name('group');
Route::get('/أعمال-سابقة', [PageController::class, 'work'])->name('work');
Route::get('/فيديوهات', [PageController::class, 'videos'])->name('videos');
Route::get('/وظائف', [PageController::class, 'jobs'])->name('jobs');
Route::get('/وظائف/تقديم', [PageController::class, 'jobApply'])->name('jobs.apply');
Route::get('/اتصل-بنا', [PageController::class, 'contact'])->name('contact');
Route::get('/سياسة-الخصوصية', [PageController::class, 'privacy'])->name('privacy');

// النماذج
Route::post('/طلب', [LeadController::class, 'store'])->middleware('throttle:6,1')->name('lead.store');

// تحويلات من روابط الموقع القديم (WordPress) للحفاظ على ترتيب محركات البحث
Route::permanentRedirect('/investment', '/الاستثمار');
Route::permanentRedirect('/jobs', '/وظائف');
Route::permanentRedirect('/jobs/apply', '/وظائف/تقديم');
Route::permanentRedirect('/e-commerce', '/باقات-التجارة-الإلكترونية');
Route::permanentRedirect('/عرض-بيع', '/عروض-البيع');
Route::permanentRedirect('/طلب-شراء', '/طلبات-الشراء');
Route::permanentRedirect('/سياسات-الخصوصية', '/سياسة-الخصوصية');
Route::permanentRedirect('/فيديوهات-عين-عربية', '/فيديوهات');
