<?php

namespace App\Support\Excel;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Reader
{
    public function __construct(protected Spreadsheet $spreadsheet)
    {
    }

    public function get(): Collection
    {
        $rows = $this->spreadsheet->getActiveSheet()->toArray(null, true, true, false);
        $heading = array_map(fn ($h) => Str::slug((string) $h, '_'), array_shift($rows) ?? []);

        return collect($rows)
            ->filter(fn ($row) => count(array_filter($row, fn ($v) => $v !== null && $v !== '')))
            ->map(fn ($row) => (object) array_combine($heading, array_pad(array_slice($row, 0, count($heading)), count($heading), null)))
            ->values();
    }
}
