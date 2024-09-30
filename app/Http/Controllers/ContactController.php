<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        // Валидация данных формы
        $request->validate([
            'phone' => 'required',
            'name' => 'required',
        ]);

        // Получаем данные из формы
        $phone = $request->input('phone');
        $name = $request->input('name');

        // Ваш токен бота
        $token = env('TELEGRAM_BOT_TOKEN');

        // ID чата, куда отправляем сообщение
        $chat_id = env('TELEGRAM_CHAT_ID');

        // Формируем сообщение
        $message = "Новая заявка с сайта:\nИмя: $name\nТелефон: $phone";

        // Отправка сообщения через Telegram API
        $response = Http::get("https://api.telegram.org/bot$token/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message
        ]);

        // Проверка успешности отправки
        if ($response->successful()) {
            return redirect()->back()->with('success', 'Заявка успешно отправлена!');
        } else {
            return redirect()->back()->with('error', 'Ошибка при отправке заявки!');
        }
    }
}


