<?php

namespace App\Commands;

use App\DiscordCommands\ActionsPCCommand;
use App\Entities\Discord\CommandEntity;
use App\Entities\Discord\OptionEntity;
use Discord\Discord;
use Discord\DiscordCommandClient;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;
use LaravelZero\Framework\Commands\Command;

class DiscordCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'bot:start';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Démarre le bot et le connecte au Discord.';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $config = [
            'token' => env('DISCORD_TOKEN'),
            'prefix' => '!',
            'description' => 'Le bot quasi-officiel de la Palladium Corporation. Priez la Corbeille et tout se passera bien.',
        ];

        try {
            $discord = new DiscordCommandClient($config);

            $this->registerCommands($discord);

            $discord->run();
        } catch (\Exception $e) {
            Log::error('Une erreur avec DiscordPHP est survenue', [
                'exception' => $e->getMessage(),
            ]);
        }
    }

    private function registerCommands(Discord $discord)
    {
        foreach ($this->getCommands() as $command) {
            $discord->registerCommand($command->name, $command->callable, $command->options->toArray());
        }
    }

    private function getCommands(): array
    {
        $actionsPcCommand = new CommandEntity(
            name: "Actions de la PC",
            callable: new ActionsPCCommand(),
            options: new OptionEntity(
                aliases: ['action', 'actions'],
                cooldown:50,
                cooldownMessage:"La commande est trop récente, faut patienter.",
                description: "Nb d'actions de la PC",
                longDescription: "Affiche la quantité d'actions de la Palladium Corporation en circulation."
            )
        );

        return [$actionsPcCommand];
    }
}
