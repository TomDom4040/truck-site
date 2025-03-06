<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Media;
use App\Models\Package;
use App\Models\SocialPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::with(['user', 'category', 'city', 'media'])->orderBy('created_at', 'desc')->get();
        return view('index', compact('ads'));
    }

    public function create()
{
    $user = Auth::user();

    if (empty($user->name) || empty($user->description)) {
        return redirect()->route('profile.edit');
    }

    $categories = Category::all();
    $cities = City::all();
    $packages = Package::all();
    $socialPrices = SocialPrice::first();

    return view('ads.create', compact('categories', 'cities', 'packages', 'socialPrices', 'user'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'description' => 'required|string|max:500',
            'media'       => 'nullable|array',
            'media.*'     => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
            'tg'          => 'nullable|boolean',
            'fb'          => 'nullable|boolean',
            'package'     => 'required|integer|exists:packages,id',
        ]);

        $price = $this->calculatePrice($request);

        $ad = new Ad();
        $ad->user_id = Auth::id();
        $ad->category_id = $request->category_id;
        $ad->city_id = $request->city_id;
        $ad->description = $request->description;
        $ad->price = $price;
        $ad->package = $request->package;
        $ad->tg = $request->boolean('tg', false);
        $ad->fb = $request->boolean('fb', false);
        $ad->status = 'pending';

        $ad->save();

        Log::info('Новое объявление создано', $ad->toArray());

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $path = $file->store('ads/media', 'public');
                $type = str_contains($file->getMimeType(), 'video') ? 'video' : 'image';

                $ad->media()->create([
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        return redirect('/')->with('success', 'Объявление успешно создано!');
    }

    public function myAds()
    {
        $user = Auth::user();
        $ads = Ad::with(['user', 'category', 'city', 'media'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('ads.my', compact('user', 'ads'));
    }

    private function calculatePrice(Request $request)
    {
        $category = Category::find($request->category_id);
        $city = City::find($request->city_id);
        $package = Package::find($request->package);
        $socialPrices = SocialPrice::first();

        $tgPrice = $request->boolean('tg', false) ? ($socialPrices->tg_price ?? 0) : 0;
        $fbPrice = $request->boolean('fb', false) ? ($socialPrices->fb_price ?? 0) : 0;

        return ($category->price ?? 0) + ($city->price ?? 0) + ($package->price ?? 0) + $tgPrice + $fbPrice;
    }
}
