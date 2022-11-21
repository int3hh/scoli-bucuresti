<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:schools';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls schools from bucharest';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
