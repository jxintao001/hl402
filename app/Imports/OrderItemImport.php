<?php

namespace App\Imports;

use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class OrderItemImport implements ToCollection
{

    public function collection(Collection $rows)
    {

        foreach ($rows as $k => $row) {
            if ($k == 0 || count($row) != 44) {
                continue;
            }
            $crm_id = $row[0] ?? '';
            if (!$crm_id) {
                continue;
            }

            $one = OrderItem::where('crm_id', $crm_id)->first();
            if (!$one) {
                $order = new OrderItem([
                    'crm_id'                => $row[0],
                    'company_id'            => 0,
                    'order_id'              => 0,
                    'is_new_line'           => $row[3],
                    'cancel_status'         => $row[4],
                    'refusal_cause'         => $row[5],
                    'no'                    => $row[6],
                    'sap_no'                => $row[7],
                    'purchase_no'           => $row[8],
                    'rownum'                => $row[9],
                    'trade_type'            => $row[10],
                    'order_type'            => $row[11],
                    'actual_customer'       => $row[12],
                    'sold_to_party'         => $row[13],
                    'delivery_date'         => !empty($row[15]) ? Date::excelToDateTimeObject($row[15])->format('Y-m-d H:i:s') : null,
                    'confirm_date'          => !empty($row[16]) ? Date::excelToDateTimeObject($row[16])->format('Y-m-d H:i:s') : null,
                    'class_process'         => $row[17],
                    'material_description'  => $row[18],
                    'material_no'           => $row[19],
                    'mark_no'               => $row[20],
                    'net_weight'            => $row[21],
                    'order_amount'          => $row[22],
                    'quantity_shipped'      => $row[23],
                    'net_shipped_weight'    => $row[24],
                    'marketing_unit'        => $row[25],
                    'unit_selling_price'    => $row[26],
                    'ton_processing_charge' => $row[27],
                    'selling_price'         => $row[28],
                    'price'                 => $row[29],
                    'copper_price'          => $row[30],
                    'aluminum_price'        => $row[31],
                    'zinc_price'            => $row[32],
                    'hedging_no'            => $row[33],
                    'distribution_channel'  => $row[34],
                    'crm_created_at'        => !empty($row[35]) ? Date::excelToDateTimeObject($row[35])->format('Y-m-d H:i:s') : null,
                    'packaging_methods'     => $row[37],
                    'material_group'        => $row[42],
                    'submit_at'             => !empty($row[43]) ? Date::excelToDateTimeObject($row[43])->format('Y-m-d H:i:s') : null,
                ]);
                // 写入数据库
                $order->save();
            }
        }
    }
}
