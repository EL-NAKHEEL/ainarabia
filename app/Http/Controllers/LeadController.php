<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * يستقبل كل نماذج الموقع (تواصل، تسجيل شركة، وظائف، عرض بيع، طلب شراء، استثمار).
 * حاليًا يُسجَّل الطلب في storage/logs/laravel.log. اربطه لاحقًا بالبريد أو قاعدة البيانات
 * أو CRM (مثال: Mail::to(config('ainarabia.contact.email'))->send(...)).
 */
class LeadController extends Controller
{
    private const TYPES = ['contact', 'register', 'job', 'offer', 'request', 'investment', 'subscription'];

    public function store(Request $request): RedirectResponse
    {
        // حقل مخفي لاصطياد الروبوتات
        if ($request->filled('website')) {
            return back();
        }

        $data = $request->validate([
            'type' => ['required', 'in:'.implode(',', self::TYPES)],
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,30}$/'],
            'email' => ['nullable', 'email', 'max:160'],
            'company' => ['nullable', 'string', 'max:160'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['nullable', 'string', 'max:3000'],
        ], [
            'name.required' => 'من فضلك اكتب اسمك.',
            'phone.required' => 'رقم الهاتف مطلوب حتى نتواصل معك.',
            'phone.regex' => 'رقم الهاتف غير صحيح.',
            'email.email' => 'البريد الإلكتروني غير صحيح.',
        ]);

        Log::info('ainarabia.lead', $data + ['ip' => $request->ip()]);

        return back()->with('sent', 'وصلنا طلبك، وسنتواصل معك في أقرب وقت.');
    }
}
