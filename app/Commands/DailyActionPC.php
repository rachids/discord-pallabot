<?php

namespace App\Commands;

use App\Exceptions\ChannelNotFoundException;
use App\Services\EmpireService;
use Discord\Discord;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;

class DailyActionPC extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'bot:actionspc';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Envoie le nombre d\'actions PC quotidiennement sur Discord.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $config = [
            'token' => env('DISCORD_TOKEN'),
        ];

        try {
            $discord = new Discord($config);
            $discord->on('ready', function (Discord $discord) {
                $channel = $discord->getChannel(env('DISCORD_CHANNEL_ID_FOR_PC_ACTIONS'));

                if($channel) {
                    $empire = new EmpireService();
                    $channel->sendMessage($empire->getActionsPC());
                } else {
                    throw new ChannelNotFoundException("Channel introuvable.");
                }
            });

        } catch (\Exception $e) {
            Log::error("Impossible d'envoyer le nb d'actions PC :(", [
                'message' => $e->getMessage(),
                'exception' => $e
            ]);
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        $schedule->command(static::class)->dailyAt('05:59');
    }
}
