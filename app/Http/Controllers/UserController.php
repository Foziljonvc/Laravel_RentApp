<?php

namespace App\Http\Controllers;

use App\Models\User_Element;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function save_ad(): \Illuminate\Http\RedirectResponse
    {
        $ad_id = request('ad');
        $user_id = auth()->id();
        $element = request('save');

        User_Element::query()->create([
            'ad_id' => $ad_id,
            'user_id' => $user_id,
            'element_id' => $element
        ]);

        return redirect()->route('home');
    }
    public function lose_ad(): \Illuminate\Http\RedirectResponse
    {
        $ad_id = request('ad');
        $user_id = auth()->id();
        $element_id = request('save');

        User_Element::query()
            ->where('ad_id', $ad_id)
            ->where('user_id', $user_id)
            ->where('element_id', $element_id)
            ->delete();

        return redirect()->route('home');
    }
    public function validate(Request $request, array $data)
    {

    }
}
