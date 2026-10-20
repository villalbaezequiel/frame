<?php

namespace App\Support\Excel;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Sheet
{
    public function __construct(protected Worksheet $worksheet)
    {
    }

    /**
     * @param  iterable|Arrayable  $source  list of associative rows
     */
    public function fromArray($source, $nullValue = null, string $startCell = 'A1', bool $strictNull = false, bool $headingGeneration = true): static
    {
        $rows = $source instanceof Arrayable ? $source->toArray() : (array) $source;
        $rows = array_values(array_map(fn ($row) => $row instanceof Arrayable ? $row->toArray() : (array) $row, $rows));

        if (! $rows) {
            return $this;
        }

        $data = [];

        if ($headingGeneration) {
            $data[] = array_keys($rows[0]);
        }

        foreach ($rows as $row) {
            $data[] = array_map(
                fn ($v) => is_array($v) || is_object($v) ? json_encode($v) : $v,
                array_values($row)
            );
        }

        $this->worksheet->fromArray($data, $nullValue, $startCell, $strictNull);

        return $this;
    }

    public function cell(string $cell, Closure $callback): static
    {
        $callback(new Cells($this->worksheet, $cell));

        return $this;
    }

    public function cells(string $range, Closure $callback): static
    {
        $callback(new Cells($this->worksheet, $range));

        return $this;
    }

    public function setWidth(array|string $column, ?int $width = null): static
    {
        $columns = is_array($column) ? $column : [$column => $width];

        foreach ($columns as $letter => $w) {
            $this->worksheet->getColumnDimension($letter)->setWidth($w);
        }

        return $this;
    }

    public function setStyle(array $style): static
    {
        $this->worksheet->getParent()->getDefaultStyle()->applyFromArray($style);

        return $this;
    }

    public function setBorder(string $range, string $style = 'thin'): static
    {
        (new Cells($this->worksheet, $range))->setBorder($style, $style, $style, $style);

        return $this;
    }
}
