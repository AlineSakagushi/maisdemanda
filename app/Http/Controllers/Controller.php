<?php

namespace App\Http\Controllers;
use App\Models\Notification;
abstract class Controller
{
   public function enviarNotificacao($userId)
{
    Notification::create([
        'user_id' => $userId,
        'title' => 'Nova Solicitação',
        'message' => 'Você recebeu uma nova solicitação.',
        'type' => 'info',
        'action_url' => route('solicitacoes.index'),
        'action_text' => 'Ver Solicitação',
    ]);
}

}


