<?php

namespace App\Exports\Sheets;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class KgbSheet implements FromView, WithTitle, ShouldAutoSize
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $query = Pegawai::whereNull('status')
                        ->whereNotNull('next_kgb');

        if ($this->tahun) {
            $query->whereYear('next_kgb', $this->tahun);
        }

        if ($this->bulan) {
            $query->whereMonth('next_kgb', $this->bulan);
        }

        $groupedKGB = $query
            ->orderBy('next_kgb', 'asc')
            ->get()
            ->groupBy(fn ($p) => Carbon::parse($p->next_kgb)->format('Y'));

        return view('exports.sheet_kgb', compact('groupedKGB'));
    }

    public function title(): string
    {
        return 'Rekap KGB';
    }
}
