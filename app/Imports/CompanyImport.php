<?php

namespace App\Imports;

use App\Models\Company;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class CompanyImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $k => $row) {
            if ($k == 0) {
                continue;
            }
            $sap_code = $row[3] ?? '';
            $code = $row[17] ?? '';
            if (!$sap_code || !$code) {
                continue;
            }
            $dateTime = Date::excelToDateTimeObject($row['15']);
            $crm_created_at = $dateTime->format('Y-m-d H:i:s');
            $one = Company::where('sap_code', $sap_code)->where('code', $code)->first();
            if (!$one) {
                $company = new Company([
                    'code'           => $code,
                    'name'           => $row[4],
                    'short_name'     => $row[16],
                    'sap_code'       => $sap_code,
                    'crm_created_at' => $crm_created_at
                ]);
                // 写入数据库
                $company->save();
            }
        }
    }
}
