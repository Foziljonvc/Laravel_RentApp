<?php
namespace App\Http\Controllers;
use App\Models\Ad;
use App\Models\Ad_Image;
use App\Models\Branch;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\Status as StatusEnum;
class AdController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $user_id = auth()->id();
        $ads = Ad::select('ads.*', 'users_elements.*')
            ->leftJoin('users_elements', function($join) use ($user_id) {
                $join->on('ads.id', '=', 'users_elements.ad_id')
                    ->where('users_elements.user_id', $user_id);
            })
            ->get();
        $branches = Branch::all();
        return view('home', compact('ads', 'branches'));
    }
    public function show_ad(int $adId = null): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $ad = Ad::where('id', $adId)->first();
        $branches = Branch::all();
        return view('create-ad', compact('ad', 'branches'));
    }
    public function store(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $this->validate(['image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'branch_id' => 'required|integer|exists:branches,id',
            'price' => 'required|integer',
            'rooms' => 'required|integer',
            'square' => 'required|integer'], $request);

        if (!$request->hasFile('image')) {
            $defaultImage = 'default/ad_image.png';
            $file = 'ad_image' . uniqid() .'png';
            Storage::disk('public')->copy($defaultImage, $file);
        } else {
            $file = $request->file('image')->store('/', 'public');
        }
        try {
            $ad = Ad::query()->create([
                'title'       => request('title'),
                'description' => request('description'),
                'price'       => request('price'),
                'rooms'       => request('rooms'),
                'address'     => request('address'),
                'gender'      => request('gender'),
                'user_id'     => auth()->id(),
                'branch_id'   => request('branch_id'),
                'status_id'   => Status::query()->create(['name' => StatusEnum::ACTIVE->value])->id,
                'square'      => request('square'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        Ad_Image::query()->create([
            'ad_id'   => $ad->id,
            'name'    => $file,
        ]);

        return redirect()->route('home');
    }
    public function validate(array $data, Request $request): void
    {
        $request->validate($data);
    }
}
