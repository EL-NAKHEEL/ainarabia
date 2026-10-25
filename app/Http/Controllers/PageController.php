<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featured = collect(config('ainarabia.listings'))->shuffle(crc32(date('Y-m-d')))->take(6)->values();

        return view('pages.home', ['featured' => $featured]);
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function ecommerce(): View
    {
        return view('pages.ecommerce');
    }

    public function payments(): View
    {
        return view('pages.payments');
    }

    public function register(): View
    {
        return view('pages.register');
    }

    public function investment(): View
    {
        return view('pages.investment');
    }

    public function benefit(): View
    {
        return view('pages.benefit');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function group(): View
    {
        return view('pages.group');
    }

    public function work(): View
    {
        return view('pages.work');
    }

    public function videos(): View
    {
        return view('pages.videos');
    }

    public function jobs(): View
    {
        return view('pages.jobs');
    }

    public function jobApply(): View
    {
        return view('pages.job-apply');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }
}
