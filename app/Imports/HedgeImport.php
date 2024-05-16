<?php

namespace App\Imports;

use App\Models\Hedge;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class HedgeImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ($k == 0 || count($row) != 36) {
                continue;
            }
            $crm_id = $row[0] ?? '';
            if (!$crm_id) {
                continue;
            }

            $one = Hedge::where('crm_id', $crm_id)->first();
            if (!$one) {
                $order = new Hedge([
                    'crm_id'                     => $row[0],
                    'company_id'                 => 0,
                    'order_id'                   => 0,
                    'status'                     => $row[3],
                    'type'                       => $row[4],
                    'is_merge_hedging'           => $row[5],
                    'hedging_no'                 => $row[6],
                    'trade_type'                 => $row[7],
                    'is_virtual'                 => $row[8],
                    'mark_no'                    => $row[9],
                    'factory'                    => $row[10],
                    'customer_name'              => $row[11],
                    'customer_sap'               => $row[12],
                    'amount'                     => $row[13],
                    'available_amount'           => $row[14],
                    'margin_amount'              => $row[15],
                    'pricing_method'             => $row[16],
                    'purchase_settlement_method' => $row[18],
                    'customer_settlement_method' => $row[19],
                    'settlement_date'            => !empty($row[20]) ? Date::excelToDateTimeObject($row[20])->format('Y-m-d H:i:s') : null,
                    'copper_price'               => $row[26],
                    'customer_copper_price'      => $row[27],
                    'zinc_price'                 => $row[28],
                    'customer_zinc_price'        => $row[29],
                    'aluminum_price'             => $row[30],
                    'customer_aluminum_price'    => $row[31],
                    'crm_created_at'             => !empty($row[34]) ? Date::excelToDateTimeObject($row[34])->format('Y-m-d H:i:s') : null,
                    'submit_at'                  => !empty($row[35]) ? Date::excelToDateTimeObject($row[35])->format('Y-m-d H:i:s') : null,
                ]);
                // 写入数据库
                $order->save();
            }
        }
    }
}
