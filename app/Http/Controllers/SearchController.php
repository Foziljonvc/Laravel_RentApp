<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Branch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $title = request()->input('name');
        $branch = request()->input('branch');
        $min_price = request('min_price', 0);
        $max_price = request('max_price', PHP_INT_MAX);

        $ads = Ad::search($title, $branch, $min_price, $max_price);
        $branches = Branch::all();

        return view('home', compact('ads', 'branches'));
    }
}
