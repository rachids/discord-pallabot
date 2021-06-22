<?php


namespace App\DiscordCommands;


use App\Services\EmpireService;
use Discord\Parts\Channel\Message;
use Illuminate\Support\Facades\Log;

class ActionsPCCommand
{
    public function __invoke(Message $message, array $parameters)
    {
        $message->channel->broadcastTyping();

        // $empire = $parameters[0] ?? 'pc'; TODO: permettre de choisir un empire.

        try {
            $empireService = new EmpireService();
            $message->channel->sendMessage($empireService->getActionsPC());

        } catch (\Exception $e) {
            Log::error('Erreur avec la commande ActionsPCCommand', [
                'exception' => $e->getMessage(),
            ]);
            $message->channel->sendMessage("`J'ai croisé un bug, il ressemblait vachement à krabot.`");
        }
    }
}
