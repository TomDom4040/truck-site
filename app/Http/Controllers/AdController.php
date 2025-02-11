<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $categories = Category::all(); // Получаем все категории
        $cities = City::all(); // Получаем все города
        $themes = Theme::all();  // Получаем все темы из базы данных
        return view('ads.create', compact('user', 'categories', 'cities', 'themes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'city' => 'required|exists:cities,id',  // Убедитесь, что город существует
        'price' => 'required|numeric|min:0',
        'media' => 'nullable|array',
        'media.*' => 'file|mimes:jpg,png,mp4,mov|max:10240',
    ]);

    $category = Category::find($request->category_id);
    $city = City::find($request->city);  // Получаем выбранный город
    $mediaPaths = [];
    $totalPrice = $category->price_photo + $city->price;  // Начальная стоимость

    if ($request->hasFile('media')) {
        foreach ($request->file('media') as $file) {
            $path = $file->store('ads_media', 'public');
            $mediaPaths[] = $path;

            if (str_contains($file->getMimeType(), 'image')) {
                $totalPrice += $category->price_photo;
            } elseif (str_contains($file->getMimeType(), 'video')) {
                $totalPrice += $category->price_video;
            }
        }
    }

    $ad = Ad::create([
        'user_id' => Auth::id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'city' => $city->name,  // Сохраняем название города
        'price' => $totalPrice,
        'media' => json_encode($mediaPaths),
        'status' => 'pending',
    ]);

    return redirect()->route('ads.payment', ['ad' => $ad->id]);
}

    public function payment(Ad $ad)
    {
        return view('ads.payment', compact('ad'));
    }
}

