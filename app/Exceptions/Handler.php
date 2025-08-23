<?php

namespace App\Exceptions;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $exception) {

            $telegramApiUrl = 'https://api.telegram.org/bot';
            $botToken = '8151822213:AAH9d08YRnlAbAS9Dqqdi_0XVk_2PWAWL1w';
            $chatId = '1296549316';
            $url = $telegramApiUrl.$botToken.'/sendMessage';
            $message = 'date : '.Carbon::now()->format('l, F j, Y H:i:s')."\n\n";
            $message .= 'Error occurred : '.$exception->getMessage()."\n\n";
            $message .= 'File : '.$exception->getFile()."\n\n";
            $message .= 'Line : '.$exception->getLine()."\n\n";
            if (strlen($message) > 4000) {
                $message = substr($message, 0, 4000).'...';
            }
            $client = new Client;
            $client->post($url, [
                'json' => [
                    'chat_id' => $chatId,
                    'text' => $message,
                ],
            ]);

        });
    }
}
