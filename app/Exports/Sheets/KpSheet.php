<?php

namespace App\Exports\Sheets;

use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class KpSheet implements FromView, WithTitle, ShouldAutoSize
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
                        ->whereNotNull('next_kp');

        if ($this->tahun) {
            $query->whereYear('next_kp', $this->tahun);
        }

        if ($this->bulan) {
            $query->whereMonth('next_kp', $this->bulan);
        }

        $groupedKP = $query
            ->orderBy('next_kp', 'asc')
            ->get()
            ->groupBy(fn ($p) => Carbon::parse($p->next_kp)->format('Y'));

        return view('exports.sheet_kp', compact('groupedKP'));
    }

    public function title(): string
    {
        return 'Rekap KP';
    }
}
