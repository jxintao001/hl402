<?php

namespace App\Console\Commands\ImportData;

use App\Imports\SapStockImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportSapStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hlcrm:import-sap-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入SAP 库存数据';

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

        $filename = 'sapStock20240518.xlsx';
        $filePath = public_path('uploads/excel/' . $filename);

        Excel::import(new SapStockImport(), $filePath);

        return 0;
    }
}
