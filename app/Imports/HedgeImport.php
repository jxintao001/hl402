<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;


class HedgeImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            print_r($row);exit();
        }
        exit();
    }
}
