<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Media;
use App\Models\Package;
use App\Models\SocialPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
{
    $ads = Ad::with(['user', 'category', 'city', 'media'])
             ->where('status', 'approved')
             ->orderBy('approved_at', 'desc') // Сортировка по дате одобрения
             ->get();

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
    $socialPrices = SocialPrice::first(); // Получаем первую запись из таблицы social_prices

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
        'package_id'  => 'required|integer|exists:packages,id', // Убедитесь, что это поле есть
    ]);

    $price = $this->calculatePrice($request);

    $ad = new Ad();
    $ad->user_id = Auth::id();
    $ad->category_id = $request->category_id;
    $ad->city_id = $request->city_id;
    $ad->description = $request->description;
    $ad->price = $price;
    $ad->package_id = $request->package_id; // Используйте package_id
    $ad->tg = $request->boolean('tg');
    $ad->fb = $request->boolean('fb');
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
        $ads = Ad::with(['user', 'category', 'city', 'media'])
                 ->where('user_id', $user->id)
                 ->orderBy('created_at', 'desc')
                 ->get();

        return view('ads.my', compact('user', 'ads'));
    }

    public function calculatePrice(Request $request)
{
    $category = Category::find($request->category_id);
    $city = City::find($request->city_id);
    $package = Package::find($request->package_id); // Используйте package_id
    $socialPrices = SocialPrice::first();

    $tgPrice = $request->boolean('tg', false) ? ($socialPrices->tg_price ?? 0) : 0;
    $fbPrice = $request->boolean('fb', false) ? ($socialPrices->fb_price ?? 0) : 0;

    return ($category->price ?? 0) + ($city->price ?? 0) + ($package->price ?? 0) + $tgPrice + $fbPrice;
}
public function update(Request $request, $id)
{
    $ad = Ad::findOrFail($id);

    $validated = $request->validate([
        'description' => 'required|string|max:500',
        'status' => 'required|in:pending,approved,rejected',
    ]);

    // Если статус изменен на "approved", обновляем approved_at
    if ($request->status === 'approved' && $ad->status !== 'approved') {
        $validated['approved_at'] = now();
    }

    $ad->update($validated);

    return redirect()->route('admin.ads.edit', $ad->id)->with('success', 'Объявление успешно обновлено!');
}
 
}