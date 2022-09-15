<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'nama' => $row['nama'],
            'nrp' => $row['nrp'],
            'no_keputusan_pengangkatan' => $row['no_keputusan_pengangkatan'],
            'tgl_pengangkatan' => $row['tgl_pengangkatan'],
            'tgl_masuk' => $row['tgl_masuk'],
            'tgl_lahir' => $row['tgl_lahir'],
            'npwp' => $row['npwp'],
            'bank' => $row['bank'],
            'no_rek' => $row['no_rek'],
            'jabatan' => $row['jabatan'],
            'role_id' => $row['role_id'],
            'password' => Hash::make('123456789')
        ]);
    }
}
