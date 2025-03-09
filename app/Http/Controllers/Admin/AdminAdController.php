<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Package;
use Illuminate\Http\Request;

class AdminAdController extends Controller
{
    public function index()
    {
        $ads = Ad::with(['user', 'category', 'city', 'media'])->orderBy('created_at', 'desc')->get();
        return view('admin.ads.index', compact('ads'));
    }

    public function pending()
    {
        $ads = Ad::with(['user', 'category', 'city', 'media'])
                 ->where('status', 'pending')
                 ->orderBy('created_at', 'desc')
                 ->get();
        return view('admin.ads.pending', compact('ads'));
    }

    public function edit($id)
{
    // Получаем объявление
    $ad = Ad::findOrFail($id);

    // Получаем значение package из таблицы ads
    $packageId = $ad->package;

    // Получаем имя пакета из таблицы packages
    $packageName = Package::where('id', $packageId)->value('name');

    // Если пакет не найден, используем значение по умолчанию
    $packageName = $packageName ?? 'Не указан';

    return view('admin.ads.edit', compact('ad', 'packageName'));
}

public function update(Request $request, $id)
{
    $ad = Ad::findOrFail($id);

    // Проверяем, был ли статус изменен на "Одобрено"
    $isApproved = $request->status === 'approved' && $ad->status !== 'approved';

    // Обновляем данные объявления
    $ad->update([
        'description' => $request->description,
        'status' => $request->status,
        'approved_at' => $isApproved ? now() : $ad->approved_at, // Обновляем approved_at, если статус изменен на "Одобрено"
    ]);

    return redirect()->route('admin.ads.index')->with('success', 'Объявление успешно обновлено!');
}

    public function destroy($id)
    {
        $ad = Ad::findOrFail($id);
        $ad->delete();

        return redirect()->route('admin.ads.index')->with('success', 'Объявление успешно удалено!');
    }
}