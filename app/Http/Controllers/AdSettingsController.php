<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Category;
use App\Models\Package; // Добавьте этот импорт
use App\Models\SocialPrice;
use Illuminate\Http\Request;

class AdSettingsController extends Controller
{
    // Метод для отображения всех городов и категорий
    public function index()
    {
        $cities = City::all();
        $categories = Category::all();
        $packages = Package::all();
        $socialPrices = SocialPrice::first(); // Берем первую запись из social_prices

        return view('admin.ad-settings', compact('cities', 'categories', 'packages', 'socialPrices'));
    }

    // Метод для добавления нового города
    public function storeCity(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        City::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.ad-settings.index')->with('success', 'Город добавлен!');
    }

    // Метод для обновления информации о городе
    public function updateCity(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $city = City::findOrFail($id);
        $city->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.ad-settings.index', ['active_tab' => $request->input('active_tab')])
                         ->with('success', 'Город обновлен!');
    }

    // Метод для удаления города
    public function destroyCity($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('admin.ad-settings.index')->with('success', 'Город удален!');
    }

    // Метод для добавления новой категории
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->price = $request->input('price');
        $category->save();

        return redirect()->route('admin.ad-settings.index')->with('success', 'Категория успешно создана!');
    }

    // Метод для обновления категории
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.ad-settings.index', ['active_tab' => $request->input('active_tab')])
                         ->with('success', 'Категория обновлена!');
    }

    // Метод для удаления категории
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.ad-settings.index')->with('success', 'Категория удалена!');
    }

    // Метод для добавления нового пакета
    public function storePackage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'posts_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        Package::create($validated);
    
        return redirect()->back()->with('success', 'Пакет успешно добавлен!');
    }
    
    public function updatePackage(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'posts_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
    
        $package = Package::findOrFail($id);
        $package->update($validated);
    
        return redirect()->back()->with('success', 'Пакет успешно обновлен!');
    }
    
    public function destroyPackage($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
    
        return redirect()->back()->with('success', 'Пакет успешно удален!');
    }
    
    public function updateSocialPrice(Request $request)
    {
        $validated = $request->validate([
            'tg_price' => 'required|numeric|min:0',
            'fb_price' => 'required|numeric|min:0',
        ]);
    
        SocialPrice::updateOrCreate(
            ['id' => 1], 
            ['tg_price' => $validated['tg_price'], 'fb_price' => $validated['fb_price']]
        );
    
        return redirect()->back()->with('success', 'Цены для соцсетей обновлены!');
    }
}
