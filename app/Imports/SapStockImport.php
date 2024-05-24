<?php

namespace App\Imports;

use App\Models\OrderItem;
use App\Models\SapStock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class SapStockImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ($k == 0 || count($row) != 13) {
                continue;
            }
            $crm_id = $row[0] ?? '';
            if (!$crm_id) {
                continue;
            }

            $one = SapStock::where('salesman_name', $row[0])
                ->where('storage_date', $row[1])
                ->where('purchase_no', $row[2])
                ->where('customer_name', $row[3])
                ->where('category', $row[4])
                ->where('material_description', $row[5])
                ->where('unrestricted_stock1', $row[6])
                ->where('unit', $row[7])
                ->where('mark_no', $row[8])
                ->where('spec', $row[9])
                ->where('customer_no', $row[10])
                ->where('unrestricted_stock2', $row[11])
                ->where('unit2', $row[12])
                ->first();
            if (!$one) {
                $sap_stock = new SapStock([
                    'salesman_name'        => $row[0],
                    'storage_date'         => !empty($row[1]) ? Date::excelToDateTimeObject($row[1])->format('Y-m-d H:i:s') : null,
                    'purchase_no'          => $row[2],
                    'customer_name'        => $row[3],
                    'category'             => $row[4],
                    'material_description' => $row[5],
                    'unrestricted_stock1'  => $row[6],
                    'unit'                 => $row[7],
                    'mark_no'              => $row[8],
                    'spec'                 => $row[9],
                    'customer_no'          => $row[10],
                    'unrestricted_stock2'  => $row[11],
                    'unit2'                => $row[12],
                ]);
                // 写入数据库
                $sap_stock->save();
            }
        }
    }
}
