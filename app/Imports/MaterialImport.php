<?php

namespace App\Imports;

use App\Models\Material;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class MaterialImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ($k == 0 || count($row) != 30) {
                continue;
            }
            $crm_id = $row[0] ?? '';
            if (!$crm_id) {
                continue;
            }

            $one = Material::where('crm_id', $crm_id)->first();
            if (!$one) {
                $order = new Material([
                    'crm_id'                   => $row[0],
                    'apply_no'                 => $row[5],
                    'rownum'                   => $row[6],
                    'sap_material_no'          => $row[7],
                    'material_description'     => $row[8],
                    'trade_type'               => $row[9],
                    'material_group'           => $row[10],
                    'final_spec'               => $row[11],
                    'mrp_controller'           => $row[12],
                    'purchase_type'            => $row[13],
                    'production_administrator' => $row[14],
                    'internal_mark_no'         => $row[15],
                    'settlement_unit'          => $row[16],
                    'theoretical_weight'       => $row[17],
                    'combination_matching'     => $row[18],
                    'class_process'            => $row[20],
                    'mark_no'                  => $row[21],
                    'material_status'          => $row[22],
                    'metric_spec'              => $row[26],
                    'british_spec'             => $row[27],
                    'unit'                     => $row[28],
                    'crm_created_at'           => !empty($row[29]) ? Date::excelToDateTimeObject($row[29])->format('Y-m-d H:i:s') : null
                ]);
                // 写入数据库
                $order->save();
            }
        }

    }
}
