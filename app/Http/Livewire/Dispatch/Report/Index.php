<?php

namespace App\Http\Livewire\Dispatch\Report;

use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\DNS1D;

class Index extends Component
{
    use WithFileUploads;

    public $file;

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
    ];

    public function render()
    {
        return view('livewire.dispatch.report.index')
            ->layout('layouts.dispatch');
    }

    public function modify()
    {
        $this->validate();

        $rows = Excel::toArray([], $this->file)[0];
        unset($rows[0]); // remove header

        if (count($rows) === 0) {
            $this->addError('file', 'Excel file has no data.');
            return;
        }

        $labels = collect($rows)->map(function ($row) {
            return [
                'title'      => trim($row[0] ?? ''),
                'publisher'  => trim($row[1] ?? ''),
                'on_sale'    => trim($row[2] ?? ''),
                'isbn'       => trim($row[3] ?? ''),
                'batch'      => trim($row[4] ?? ''),
                'ppon'       => trim($row[5] ?? ''),
                'ctn_qty'    => (int) ($row[6] ?? 0),
                'ctn_wgt'    => trim($row[7] ?? ''),
                'usd'        => number_format((float) ($row[8] ?? 0), 2),
                'cad'        => number_format((float) ($row[9] ?? 0), 2),
            ];
        })->values();

        $pdf = Pdf::loadView('pdf.dispatch.export-label', [
            'labels' => $labels
        ])->setPaper('A4');

        return response()->streamDownload(
            fn () => print($pdf->output()),
            'dispatch-prh-labels.pdf'
        );
    }

    public function sample()
    {
        // return response()->download(
        //     storage_path('app/samples/prh_dispatch_sample.xlsx')
        // );
    }
}
