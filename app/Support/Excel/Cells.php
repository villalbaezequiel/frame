<?php

namespace App\Support\Excel;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Cells
{
    public function __construct(protected Worksheet $worksheet, protected string $range)
    {
    }

    public function setValue($value): static
    {
        $this->worksheet->setCellValue(explode(':', $this->range)[0], $value);

        return $this;
    }

    public function setBackground(string $color): static
    {
        $this->style()->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($this->rgb($color));

        return $this;
    }

    public function setFontSize($size): static
    {
        $this->style()->getFont()->setSize($size);

        return $this;
    }

    public function setFontWeight($weight = 'bold'): static
    {
        $this->style()->getFont()->setBold($weight === true || $weight === 'bold');

        return $this;
    }

    public function setFontColor(string $color): static
    {
        $this->style()->getFont()->getColor()->setRGB($this->rgb($color));

        return $this;
    }

    public function setAlignment(string $alignment): static
    {
        $this->style()->getAlignment()->setHorizontal($alignment);

        return $this;
    }

    public function setBorder($top = 'none', $right = 'none', $bottom = 'none', $left = 'none'): static
    {
        $borders = $this->style()->getBorders();
        $borders->getTop()->setBorderStyle($top);
        $borders->getRight()->setBorderStyle($right);
        $borders->getBottom()->setBorderStyle($bottom);
        $borders->getLeft()->setBorderStyle($left);

        return $this;
    }

    protected function style()
    {
        return $this->worksheet->getStyle($this->range);
    }

    protected function rgb(string $color): string
    {
        return strtoupper(ltrim($color, '#'));
    }
}
