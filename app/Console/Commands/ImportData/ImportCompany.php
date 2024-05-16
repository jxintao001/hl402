<?php

namespace App\Console\Commands\ImportData;

use App\Imports\CompanyImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hlcrm:import-company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入CRM 企业数据';

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

        $filename = 'company20240515.xlsx';
        $filePath = public_path('uploads/excel/' . $filename);


        Excel::import(new CompanyImport(), $filePath);

        return 0;
    }
}
