<?php

namespace App\Console\Commands\ImportData;

use App\Imports\OrderImport;
use App\Imports\OrderItemImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrderItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hlcrm:import-order-item';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入CRM 订单明细数据';

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

        $filename = 'orderItem20240515.xlsx';
        $filePath = public_path('uploads/excel/' . $filename);

        Excel::import(new OrderItemImport(), $filePath);

        return 0;
    }
}
