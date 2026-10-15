<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection; 
use Maatwebsite\Excel\Concerns\WithHeadings;   
use Maatwebsite\Excel\Concerns\WithMapping;    
use Maatwebsite\Excel\Concerns\WithStyles;     
use Maatwebsite\Excel\Concerns\WithEvents;     
use Maatwebsite\Excel\Events\AfterSheet;       
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting; 
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;     
use Illuminate\Contracts\View\View;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PegawaiExport implements WithMultipleSheets
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function sheets(): array
{
    // Data untuk sheet lain tetap seperti semula
    $pegawaiAktif = Pegawai::with('pendidikans')
        ->whereNull('status')
        ->orderBy('pangkat_golongan', 'desc')
        ->get();

    // KHUSUS Sheet Data Pegawai → urut berdasarkan ID ASC (urutan input)
    $pegawaiDataSheet = Pegawai::with('pendidikans')
        ->whereNull('status')
        ->orderBy('id', 'asc')
        ->get();

    $pegawaiMutasi = Pegawai::with('pendidikans')
        ->where('status', 'mutasi')
        ->latest()
        ->get();

    $pegawaiPensiun = Pegawai::with('pendidikans')
        ->where('status', 'pensiun')
        ->latest()
        ->get();

    $groupedKP = $pegawaiAktif->whereNotNull('next_kp')
        ->sortBy('next_kp')
        ->groupBy(fn($p) => Carbon::parse($p->next_kp)->format('Y'));

    if ($groupedKP->isEmpty()) {
        $groupedKP = collect([date('Y') => collect([])]);
    }

    $groupedKGB = $pegawaiAktif->whereNotNull('next_kgb')
        ->sortBy('next_kgb')
        ->groupBy(fn($p) => Carbon::parse($p->next_kgb)->format('Y'));

    if ($groupedKGB->isEmpty()) {
        $groupedKGB = collect([date('Y') => collect([])]);
    }

    return [
        new GenericSheet($groupedKP, 'exports.sheet_kp', 'Data KP'),
        new GenericSheet($groupedKGB, 'exports.sheet_kgb', 'Data KGB'),

        // GANTI di sini pakai $pegawaiDataSheet
        new SheetDataPegawaiFormatted($pegawaiDataSheet, 'Data Pegawai'),

        new GenericSheet($pegawaiMutasi, 'exports.sheet_mutasi', 'Data Mutasi'),
        new GenericSheet($pegawaiPensiun, 'exports.sheet_pensiun', 'Data Pensiun'),
        new GenericSheet($pegawaiAktif, 'exports.sheet_satya_excel', 'Satyalancana'),
    ];
}
}

class GenericSheet implements FromView, WithTitle, ShouldAutoSize
{
    private $data;
    private $view;
    private $title;

    public function __construct($data, $view, $title) {
        $this->data = $data;
        $this->view = $view;
        $this->title = $title;
    }

    public function view(): View {
        return view($this->view, [
            ($this->title == 'Data KP' ? 'groupedKP' : ($this->title == 'Data KGB' ? 'groupedKGB' : 'data')) => $this->data
        ]);
    }

    public function title(): string {
        return $this->title;
    }
}

class SheetDataPegawaiFormatted implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithEvents, WithTitle, WithColumnFormatting
{
    private $data;
    private $title;
    private $rowNumber = 0;

    public function __construct($data, $title) {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection() {
        return $this->data;
    }

    public function title(): string {
        return $this->title;
    }

    public function columnFormats(): array {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function map($pegawai): array {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $pegawai->nama_lengkap,
            "'" . $pegawai->nip,
            $pegawai->pangkat_golongan,
            $this->formatDate($pegawai->tmt_pangkat),
            $pegawai->jabatan,
            $this->formatDate($pegawai->tmt_jabatan),
            $pegawai->mk_tahun,
            $pegawai->mk_bulan,
            $this->formatDiklatList($pegawai->diklat_nama, true),
            $this->formatDiklatList($pegawai->diklat_tahun, false),
            $this->formatDiklatList($pegawai->diklat_durasi, false),

            $this->formatPendidikanList($pegawai->pendidikans, 'pendidikan_nama', true),
            $this->formatPendidikanList($pegawai->pendidikans, 'pendidikan_tahun', false),
            $this->formatPendidikanList($pegawai->pendidikans, 'pendidikan_ijazah', false),

            $this->formatDate($pegawai->tanggal_lahir),
        ];
    }

    private function formatDiklatList($data, $useNumbering = false) {
        if (!$data) return '-';
        $items = explode('|', $data);
        if (count($items) > 1) {
            $formatted = [];
            foreach ($items as $index => $item) {
                if ($useNumbering) {
                    $formatted[] = ($index + 1) . ". " . trim($item);
                } else {
                    $formatted[] = trim($item);
                }
            }
            return implode("\n", $formatted);
        }
        return $items[0];
    }

    private function formatPendidikanList($collection, $field, $useNumbering = false) {
        if (!$collection || $collection->isEmpty()) return '-';

        $formatted = [];

        foreach ($collection as $index => $item) {
            $value = $item->$field ?? '-';

            if ($useNumbering) {
                $formatted[] = ($index + 1) . ". " . $value;
            } else {
                $formatted[] = $value;
            }
        }

        return implode("\n", $formatted);
    }

    private function formatDate($date) {
        return $date ? Carbon::parse($date)->format('d-m-Y') : '-';
    }

    public function headings(): array {
        return [
            ['DAFTAR URUT KEPANGKATAN APARATUR SIPIL NEGARA BALAI PEMASYARAKATAN KELAS II MAGELANG'],
            [''],
            ['NO', 'NAMA LENGKAP', 'NIP', 'PANGKAT', '', 'JABATAN', '', 'MASA KERJA', '', 'DIKLAT', '', '', 'PENDIDIKAN', '', '', 'TANGGAL LAHIR'],
            ['', '', '', 'GOL/RUANG', 'T.M.T', 'NAMA', 'T.M.T', 'TAHUN', 'BULAN', 'NAMA', 'TAHUN', 'DURASI', 'NAMA', 'TAHUN', 'TINGKAT IJAZAH', '']
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 19,
                    'color' => ['rgb' => '000080']
                ]
            ],
            3 => ['font' => ['bold' => true]],
            4 => ['font' => ['bold' => true]]
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $sheet->mergeCells('A1:P1');
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->mergeCells('A3:A4');
                $sheet->mergeCells('B3:B4');
                $sheet->mergeCells('C3:C4');
                $sheet->mergeCells('D3:E3');
                $sheet->mergeCells('F3:G3');
                $sheet->mergeCells('H3:I3');
                $sheet->mergeCells('J3:L3');
                $sheet->mergeCells('M3:O3');
                $sheet->mergeCells('P3:P4');

                $sheet->getStyle('A3:P4')->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => '000000']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '8064A2']],
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
                ]);

                $lastRow = $sheet->getHighestRow();
                $dataRange = 'A5:P' . $lastRow;

                $sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true
                    ]
                ]);

                $sheet->getStyle($dataRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // LEFT alignment untuk kolom tertentu
                $sheet->getStyle('B5:B' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('J5:J' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
                $sheet->getStyle('M5:M' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT); // PENDIDIKAN NAMA LEFT

                $sheet->getRowDimension(1)->setRowHeight(30);
            }
        ];
    }
}