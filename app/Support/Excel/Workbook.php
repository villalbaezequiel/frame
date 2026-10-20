<?php

namespace App\Support\Excel;

use Closure;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Workbook
{
    protected Spreadsheet $spreadsheet;

    protected bool $firstSheet = true;

    public function __construct(protected string $filename)
    {
        $this->spreadsheet = new Spreadsheet();
    }

    public function sheet(string $title, ?Closure $callback = null): static
    {
        if ($this->firstSheet) {
            $worksheet = $this->spreadsheet->getActiveSheet();
            $this->firstSheet = false;
        } else {
            $worksheet = $this->spreadsheet->createSheet();
        }

        // Excel forbids these in sheet titles and caps them at 31 chars.
        $worksheet->setTitle(mb_substr(str_replace(['\\', '/', '?', '*', '[', ']', ':'], '-', $title), 0, 31));
        $this->spreadsheet->setActiveSheetIndex($this->spreadsheet->getIndex($worksheet));

        if ($callback) {
            $callback(new Sheet($worksheet));
        }

        return $this;
    }

    public function download(string $extension = 'xls'): never
    {
        $writerType = ['xlsx' => 'Xlsx', 'xls' => 'Xls', 'csv' => 'Csv'][$extension] ?? 'Xls';
        $mime = [
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls' => 'application/vnd.ms-excel',
            'csv' => 'text/csv',
        ][$extension] ?? 'application/vnd.ms-excel';

        $this->spreadsheet->setActiveSheetIndex(0);

        $filename = "{$this->filename}.{$extension}";
        $writer = IOFactory::createWriter($this->spreadsheet, $writerType);

        response()->streamDownload(
            fn () => $writer->save('php://output'),
            $filename,
            ['Content-Type' => $mime]
        )->send();

        exit;
    }

    public function store(string $extension = 'xls', ?string $path = null): string
    {
        $writerType = ['xlsx' => 'Xlsx', 'xls' => 'Xls', 'csv' => 'Csv'][$extension] ?? 'Xls';
        $path = rtrim($path ?? storage_path('exports'), '/');

        if (! is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $file = "{$path}/{$this->filename}.{$extension}";
        IOFactory::createWriter($this->spreadsheet, $writerType)->save($file);

        return $file;
    }
}
