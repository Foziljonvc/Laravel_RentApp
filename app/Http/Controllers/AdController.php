<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Branch;

class AdController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $ads = Ad::all();
        $branches = Branch::all();
        return view('home', compact('ads', 'branches'));
    }

    public function create_ad(int $adId = null): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $ad = Ad::where('id', $adId)->first();
        $branches = Branch::all();
        return view('create-ad', compact('ad', 'branches'));
    }
}
