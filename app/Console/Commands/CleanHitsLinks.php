<?php

namespace App\Console\Commands;

use App\Models\Link;
use Illuminate\Console\Command;

class CleanHitsLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:clean-hits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpa todos os números de acesso dos links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Link::query()->update(['hits' => 0]);
    }
}
