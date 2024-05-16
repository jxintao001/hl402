<?php

namespace App\Console\Commands\ImportData;

use App\Imports\HedgeImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportHedge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hlcrm:import-hedge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入CRM 保值单数据';

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

        $filename = 'hedge20240516.xlsx';
        $filePath = public_path('uploads/excel/' . $filename);


        Excel::import(new HedgeImport(), $filePath);

        return 0;
    }
}
