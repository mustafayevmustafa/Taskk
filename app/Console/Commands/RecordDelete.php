<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class RecordDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'records:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete 30 days old records each hour.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Article::where('created_at', '<=', now()->subDays(30)->endOfDay())->delete();

        return 0;
    }
}
