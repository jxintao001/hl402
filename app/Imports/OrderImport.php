<?php

namespace App\Imports;

use App\Models\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class OrderImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ($k == 0 || count($row) != 33) {
                continue;
            }
            $no = $row[3] ?? '';
            if (!$no) {
                continue;
            }

            $one = Order::where('no', $no)->first();
            if (!$one) {
                $order = new Order([
                    'audit_status'            => $row[3],
                    'current_approver'        => $row[4],
                    'is_transmit'             => $row[5],
                    'cancel_status'           => $row[6],
                    'sap_no'                  => $row[7],
                    'no'                      => $row[8],
                    'contract'                => $row[9],
                    'purchase_no'             => $row[10],
                    'trade_type'              => $row[11],
                    'order_type'              => $row[12],
                    'actual_customer'         => $row[13],
                    'sold_to_party'           => $row[14],
                    'is_coil'                 => $row[16],
                    'istopims'                => $row[17],
                    'product_approval_at'     => !empty($row[18]) ? Date::excelToDateTimeObject($row[18])->format('Y-m-d H:i:s') : null,
                    'is_bargan'               => $row[19],
                    'change_status'           => $row[20],
                    'delivery_date'           => !empty($row[22]) ? Date::excelToDateTimeObject($row[22])->format('Y-m-d H:i:s') : null,
                    'total_weight'            => $row[23],
                    'total_net_weight_cancel' => $row[24],
                    'final_delivery_date'     => !empty($row[25]) ? Date::excelToDateTimeObject($row[25])->format('Y-m-d H:i:s') : null,
                    'other_remark'            => $row[27],
                    'current_approval_step'   => $row[29],
                    'audit_at'                => !empty($row[32]) ? Date::excelToDateTimeObject($row[32])->format('Y-m-d H:i:s') : null,
                    'crm_created_at'          => !empty($row[31]) ? Date::excelToDateTimeObject($row[31])->format('Y-m-d H:i:s') : null
                ]);
                // 写入数据库
                $order->save();
            }
        }
    }
}
