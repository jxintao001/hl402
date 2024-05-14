<?php

namespace App\Console\Commands\ImportData;

use Illuminate\Console\Command;

class ImportOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hlcrm:import-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入CRM订单数据';

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
        dd(111);exit();
        return 0;
    }
}
