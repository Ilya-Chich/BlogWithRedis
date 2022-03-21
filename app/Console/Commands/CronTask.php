<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CronTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $login = env('DB_USERNAME', '');
        $pass = env('DB_PASSWORD', '');
        $filename = 'database_backup_' . time() . '.sql';
        exec("mysqldump blog --password=$pass --user=$login --single-transaction >/var/backups/" . $filename, $output);
        if ($output) {
            Log::error($output);
        }
    }
}
