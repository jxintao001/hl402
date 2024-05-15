<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;


class OrderImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        print_r($rows->toArray());exit();
        foreach ($rows as $row)
        {
            print_r($row);exit();
        }
        exit();
    }
}
