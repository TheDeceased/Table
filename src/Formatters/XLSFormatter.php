<?php

namespace TheDeceased\Table\Formatters;

use TheDeceased\Table\TableInterface;

class XLSFormatter implements FormatterInterface
{
    /**
     * @var TableInterface
     */
    private $table;
    /** @var  \PHPExcel */
    private $sheet;
    private $xlsx;

    public function __construct(TableInterface $table)
    {
        $this->table = $table;

        $this->xlsx = new \PHPExcel();
        $this->xlsx->setActiveSheetIndex(0);
        $this->sheet = $this->xlsx->getActiveSheet();

        $this->sheet->getDefaultStyle()->getFont()->setName('Arial Cyr');
        $this->sheet->getDefaultStyle()->getFont()->setSize(10);
    }

    public function output()
    {
        $rows = $this->table->getRows();
        foreach ($this->table->getColumnsWidths('xls') as $index => $width) {
            $this->sheet->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex($index))->setWidth($width);
        }
        foreach ($this->table->getColumnsStyles('xls') as $index => $style) {
            $xlsStyle = $this->convertStyles($style);
            $this->sheet->getStyle($this->getCellRange([$index, 0], [$index, $this->table->getHeight()]))->applyFromArray($xlsStyle);
        }
        foreach ($this->table->getRanges() as $range) {
            $style = $range->getStyles('xls');
            if ($style) {
                $xlsStyle = $this->convertStyles($style);
                $this->sheet->getStyle($this->getCellRange($range->getStart(), $range->getEnd()))->applyFromArray($xlsStyle);
            }
        }
        foreach ($rows as $rowIndex => $row) {
            $cellIndex = 0;
            $height = $row->getHeight('xls');
            if ($height) {
                $this->sheet->getRowDimension($rowIndex + 1)->setRowHeight($height);
            }
            $style = $row->getStyles('xls');
            $cells = $row->getCells();
            if ($style) {
                $xlsStyle = $this->convertStyles($style);
                $range = $this->getCellRange([0, $rowIndex], [$row->getWidth() - 1, $rowIndex]);
                $this->sheet->getStyle($range)->applyFromArray($xlsStyle);
            }
            foreach ($cells as $cell) {
                if (!$cell->isVisible()) {
                    $cellIndex += $cell->colspan();
                    continue;
                }
                $colspan = $cell->colspan() - 1;
                $rowspan = $cell->rowspan() - 1;
                $this->sheet->setCellValue($this->getCellCoordinates($cellIndex, $rowIndex), $cell->value());
                if ($colspan || $rowspan) {
                    $range = $this->getCellRange(
                        [$cellIndex, $rowIndex],
                        [$cellIndex + $colspan, $rowIndex + $rowspan]
                    );
                    $this->sheet->mergeCells($range);
                }
                $cellIndex += $cell->colspan();
            }
        }
        $writer = new \PHPExcel_Writer_Excel2007($this->xlsx);
        $writer->save('file.xls');
        return 'Report saved to \'file.xls\'';
    }

    private function getCellCoordinates($cellIndex, $rowIndex)
    {
        return \PHPExcel_Cell::stringFromColumnIndex($cellIndex) . ($rowIndex + 1);
    }

    private function getCellRange($startCoords, $endCoords)
    {
        return $this->getCellCoordinates($startCoords[0], $startCoords[1]) . ':' . $this->getCellCoordinates($endCoords[0], $endCoords[1]);
    }

    private function convertStyles($style)
    {
        $xlsStyles = [];
        if (!empty($style['background'])) {
            $xlsStyles['fill'] = [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => $style['background']],
            ];
        }
        if (!empty($style['font'])) {
            $xlsStyles['font'] = [];
            if (!empty($style['font']['size'])) {
                $xlsStyles['font']['size'] = $style['font']['size'];
            }
            if (!empty($style['font']['bold'])) {
                $xlsStyles['font']['bold'] = $style['font']['bold'];
            }
            if (!empty($style['font']['italic'])) {
                $xlsStyles['font']['italic'] = $style['font']['italic'];
            }
        }
        if (!empty($style['align'])) {
            $xlsStyles['alignment'] = [];
            if (!empty($style['align']['vertical'])) {
                $valign = '';
                switch ($style['align']['vertical']) {
                    case 'top':
                        $valign = \PHPExcel_Style_Alignment::VERTICAL_TOP;
                        break;
                    case 'middle':
                    case 'center':
                        $valign = \PHPExcel_Style_Alignment::VERTICAL_CENTER;
                        break;
                    case 'bottom':
                        $valign = \PHPExcel_Style_Alignment::VERTICAL_BOTTOM;
                        break;
                }
                if ($valign) {
                    $xlsStyles['alignment']['vertical'] = $valign;
                }
            }
            if (!empty($style['align']['horizontal'])) {
                $align = '';
                switch ($style['align']['horizontal']) {
                    case 'left':
                        $align = \PHPExcel_Style_Alignment::HORIZONTAL_LEFT;
                        break;
                    case 'middle':
                    case 'center':
                        $align = \PHPExcel_Style_Alignment::HORIZONTAL_CENTER;
                        break;
                    case 'right':
                        $align = \PHPExcel_Style_Alignment::HORIZONTAL_RIGHT;
                        break;
                }
                if ($align) {
                    $xlsStyles['alignment']['horizontal'] = $align;
                }
            }
        }
        if (!empty($style['border'])) {
            $border = '';
            switch ($style['border']) {
                case 'thin':
                    $border = \PHPExcel_Style_Border::BORDER_THIN;
                    break;
                case 'thick':
                    $border = \PHPExcel_Style_Border::BORDER_THICK;
                    break;
                case 'none':
                    $border = \PHPExcel_Style_Border::BORDER_NONE;
                    break;
            }
            if ($border) {
                $xlsStyles['borders']['allborders']['style'] = $border;
            }
        }
        return $xlsStyles;
    }
}