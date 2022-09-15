<?php

namespace App\Exports;

use App\Present;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersPresentExport implements FromView
{

    private $tanggal;

    public function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        $presents = Present::whereTanggal($this->tanggal)->orderBy('jam_masuk')->get();
        return view('presents.users-excel', compact('presents'));
    }
}
