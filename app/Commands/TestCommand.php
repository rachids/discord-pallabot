<?php

namespace App\Commands;

use App\Services\EmpireService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use LaravelZero\Framework\Commands\Command;

class TestCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'bot:test';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Connecte le bot au Discord.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $empire = new EmpireService();
        dd($empire->getActionsPC());
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
