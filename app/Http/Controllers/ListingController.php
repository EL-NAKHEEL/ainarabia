<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    private const SCOPES = [
        'all' => ['title' => 'فرص أعمال', 'lead' => 'تصفح فرص التصدير والاستثمار والماكينات والخامات والزراعة وغيرها في مكان واحد.', 'cta' => 'أضف فرصتك'],
        'offer' => ['title' => 'عروض البيع', 'lead' => 'منتجات وخطوط إنتاج وخامات معروضة للبيع والتصدير من مصانع وشركات موثقة.', 'cta' => 'أضف عرض بيع'],
        'request' => ['title' => 'طلبات الشراء', 'lead' => 'ما يبحث عنه المشترون الآن. اعرض منتجك على من يطلبه.', 'cta' => 'أضف طلب شراء'],
    ];

    public function index(Request $request, string $scope): View
    {
        $meta = self::SCOPES[$scope];
        $categories = config('ainarabia.categories');
        $activeCategory = $request->query('category');
        $search = trim((string) $request->query('q', ''));

        $items = collect(config('ainarabia.listings'))
            ->when($scope === 'offer', fn ($c) => $c->where('type', 'offer'))
            ->when($scope === 'request', fn ($c) => $c->where('type', 'request'))
            ->when($activeCategory && isset($categories[$activeCategory]), fn ($c) => $c->where('category', $activeCategory))
            ->when($search !== '', fn ($c) => $c->filter(fn ($i) => str_contains($i['title'].' '.$i['summary'], $search)))
            ->values();

        return view('pages.listings', [
            'meta' => $meta,
            'scope' => $scope,
            'items' => $items,
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'search' => $search,
        ]);
    }

    public function show(int $id): View
    {
        $all = collect(config('ainarabia.listings'));
        $item = $all->firstWhere('id', $id);
        abort_unless($item, 404);

        $related = $all->where('category', $item['category'])->where('id', '!=', $id)->take(3)->values();

        return view('pages.listing-show', [
            'item' => $item,
            'category' => config('ainarabia.categories')[$item['category']],
            'related' => $related,
        ]);
    }
}
