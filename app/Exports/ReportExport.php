<?php

namespace App\Exports;

use App\Present;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;

class ReportExport implements FromView, WithCustomValueBinder, ShouldAutoSize
{
    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
        return true;
    }

    public function view(): View
    {
        $presents = Present::whereBetween('tanggal', [request('tanggal_awal', date('Y-m-d',strtotime('-1 months'))), request('tanggal_akhir', date('Y-m-d',strtotime('now')))])
            ->orderBy('tanggal')
            ->orderBy('jam_masuk')
            ->get()->groupBy('tanggal');
        $users = User::all();
        return view('presents.report', compact('presents','users'));
    }
}
