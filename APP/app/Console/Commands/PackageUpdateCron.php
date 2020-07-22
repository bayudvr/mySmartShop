<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PackageUpdateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Package Status';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::notice("Package checking has been started");
        DB::update('update trpack set TRPACK_STATUS = 2, TRPACK_UPDT_BY = 0, TRPACK_UPDT_BY_TEXT = "System", TRPACK_UPDT_TIMESTAMP = now() where TRPACK_UNTIL < ?',['2022-12-01']);
        Log::notice("Package checking has been ended");
    }
}
