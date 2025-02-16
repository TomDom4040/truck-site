<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\City;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        // Загружаем объявления с нужными связями
        $ads = Ad::with(['user', 'category', 'city', 'media'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('index', compact('ads'));
    }

    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        $user = Auth::user(); // Получаем авторизованного пользователя

        return view('ads.create', compact('categories', 'cities', 'user'));
    }

    public function store(Request $request)
    {
        // Валидация входящих данных
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'city_id'     => 'required|exists:cities,id',
            'description' => 'required|string|max:500',
            'media'       => 'nullable|array',
            'media.*'     => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
            'tg'          => 'nullable|boolean',
            'fb'          => 'nullable|boolean',
            'package'     => 'required|in:1,5,10,30',
        ]);

        // Вычисление цены
        $price = $this->calculatePrice($request);

        // Создание нового объявления
        $ad = new Ad();
        $ad->user_id = Auth::id();  // Убедитесь, что пользователь авторизован
        $ad->category_id = $request->category_id;
        $ad->city_id = $request->city_id;
        $ad->description = $request->description;
        $ad->price = $price;
        $ad->package = $request->package;
        $ad->tg = $request->boolean('tg', false);
        $ad->fb = $request->boolean('fb', false);
        $ad->status = 'pending';  // Объявление в статусе ожидания модерации

        $ad->save();

        // Логирование для отладки: проверьте, что запись успешно сохранена
        Log::info('Новое объявление создано', $ad->toArray());

        // Загрузка медиафайлов, если они были переданы
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

        // После сохранения перенаправляем на главную страницу
        return redirect('/')->with('success', 'Объявление успешно создано!');
    }
    public function myAds()
    {
        $user = Auth::user();
        $ads = Ad::with(['user', 'category', 'city', 'media'])
                 ->where('user_id', $user->id)
                 ->orderBy('created_at', 'desc')
                 ->get();
    
        return view('ads.my', compact('ads'));
    }
    private function calculatePrice(Request $request)
    {
        $category = Category::find($request->category_id);
        $city = City::find($request->city_id);
        $packagePrice = $this->getPackagePrice($request->package);
        $socialPrice = ($request->boolean('tg', false) ? 1 : 0) + ($request->boolean('fb', false) ? 1 : 0);

        return ($category->price ?? 0) + ($city->price ?? 0) + $packagePrice + $socialPrice;
    }

    private function getPackagePrice($package)
    {
        $prices = [
            1  => 1,
            5  => 4,
            10 => 7,
            30 => 15,
        ];
    
        return $prices[$package] ?? 0;
    }
}
