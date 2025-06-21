<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Notification;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $notificacoes = Notification::where('user_id', auth()->id())
                    ->latest()
                    ->take(100)
                    ->get();

                $notificacoesNaoLidas = $notificacoes->where('read', false);

                $view->with('notificacoes', $notificacoes)
                    ->with('notificacoesNaoLidas', $notificacoesNaoLidas);
            }
        });
    }
}
