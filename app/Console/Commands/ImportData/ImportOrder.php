<?php

namespace App\Console\Commands\ImportData;

use App\Imports\OrderImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

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
    protected $description = '导入CRM 订单数据';

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

        $filename = 'order20240522.xlsx';
        $filePath = public_path('uploads/excel/' . $filename);


        Excel::import(new OrderImport(), $filePath);

        return 0;
    }
}
