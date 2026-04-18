<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class SiswaImport implements ToModel
{
    public function model(array $row)
    {
        return new Siswa([
            'nis' => $row[0],
            'nama' => $row[1],
            'kelas' => $row[2],
            'password' => Hash::make('123456') // default password
        ]);
    }
}
