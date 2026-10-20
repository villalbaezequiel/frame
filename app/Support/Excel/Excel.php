<?php

namespace App\Support\Excel;

use Closure;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Minimal replacement for the Maatwebsite\Excel 2.x closure API
 * (Excel::create / Excel::load) on top of PhpSpreadsheet.
 */
class Excel
{
    public static function create(string $filename, ?Closure $callback = null): Workbook
    {
        $workbook = new Workbook($filename);

        if ($callback) {
            $callback($workbook);
        }

        return $workbook;
    }

    /**
     * Read a spreadsheet; the first row becomes the (slugged) column keys.
     */
    public static function load(string $path, ?Closure $callback = null): Reader
    {
        $reader = new Reader(IOFactory::load($path));

        if ($callback) {
            $callback($reader);
        }

        return $reader;
    }
}
