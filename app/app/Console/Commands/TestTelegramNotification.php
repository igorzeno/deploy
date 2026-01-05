<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestTelegramNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:telegram';

    /**
     * 2. Быстрый тест отправки: ЭТО ТЕСТОВЫЙ КЛАСС ОСТАВИЛ ДЛЯ ТЕСТОВ.
     * php artisan make:command TestTelegramNotification
     * php artisan test:telegram
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID');

        if (!$token || !$chatId) {
            $this->error('Не настроены TELEGRAM_BOT_TOKEN или TELEGRAM_CHAT_ID в .env');
            return;
        }

//        $message = "🔄 Тестовое уведомление из Docker\n";
        $message = "⏰ Время: " . now()->format('d.m.Y H:i:s') . "\n";
        $message .= "🚀 Проект: " . config('php.name') . "\n";
        $message .= "🐳 Docker: Локальное окружение";

        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        $response = file_get_contents($url . '?' . http_build_query([
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]));

        if ($response) {
            $this->info('✅ Сообщение отправлено в Telegram!');
        } else {
            $this->error('❌ Ошибка отправки');
        }
    }
}
