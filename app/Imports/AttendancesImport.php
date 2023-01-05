<?php

namespace App\Imports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;

class AttendancesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Attendance([
            'empid'     => $row[0],
            'name'    => $row[1],
            'date'    => $row[2],
            'intime'    => $row[3],
            'outtime'    => $row[4],
            'late'    => $row[5],
            'erlayout'    => $row[6]
        ]);
    }
}
